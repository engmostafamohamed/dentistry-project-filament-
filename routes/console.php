<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$databaseCopyTables = [
    'users',
    'password_reset_tokens',
    'sessions',
    'cache',
    'cache_locks',
    'jobs',
    'job_batches',
    'failed_jobs',
    'user_languages',
    'countries',
    'regions',
    'branches',
    'offers',
    'services',
    'doctors',
    'pages',
    'sections',
    'available_slots',
    'guests',
    'offer_service',
    'notifications',
    'reservations',
    'treatments',
    'guest_cosmetic_profiles',
    'medical_form_templates',
    'medical_questions',
    'guest_medical_form_links',
    'guest_medical_answers',
    'doctor_services',
];

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('db:copy-mysql-to-supabase {--chunk=500}', function () use ($databaseCopyTables) {
    $sourceConnection = 'mysql';
    $targetConnection = 'supabase';
    $chunkSize = max((int) $this->option('chunk'), 1);
    $tables = $databaseCopyTables;

    $source = DB::connection($sourceConnection);
    $target = DB::connection($targetConnection);
    $targetSchema = Schema::connection($targetConnection);

    $this->info('Clearing Supabase tables...');

    foreach (array_reverse($tables) as $table) {
        if (! $targetSchema->hasTable($table)) {
            continue;
        }

        $target->statement(
            'TRUNCATE TABLE '.$target->getQueryGrammar()->wrapTable($table).' RESTART IDENTITY CASCADE'
        );
    }

    $this->info('Copying rows from local MySQL to Supabase...');

    foreach ($tables as $table) {
        if (! Schema::connection($sourceConnection)->hasTable($table) || ! $targetSchema->hasTable($table)) {
            $this->warn("Skipping {$table}; table is missing on source or target.");
            continue;
        }

        $sourceColumns = Schema::connection($sourceConnection)->getColumnListing($table);
        $targetColumns = $targetSchema->getColumnListing($table);
        $columns = array_values(array_intersect($sourceColumns, $targetColumns));

        if ($columns === []) {
            $this->warn("Skipping {$table}; no matching columns.");
            continue;
        }

        $booleanColumns = collect($target->select(
            'select column_name from information_schema.columns where table_schema = current_schema() and table_name = ? and data_type = ?',
            [$table, 'boolean']
        ))->pluck('column_name')->all();

        $copied = 0;

        $source->table($table)
            ->select($columns)
            ->orderBy($columns[0])
            ->chunk($chunkSize, function ($rows) use ($target, $table, $booleanColumns, &$copied) {
                $payload = $rows->map(function ($row) use ($booleanColumns) {
                    $row = (array) $row;

                    foreach ($booleanColumns as $column) {
                        if (array_key_exists($column, $row) && $row[$column] !== null) {
                            $row[$column] = (bool) $row[$column];
                        }
                    }

                    return $row;
                })->all();

                if ($payload !== []) {
                    $target->table($table)->insert($payload);
                    $copied += count($payload);
                }
            });

        $serialColumn = collect($target->select(
            'select column_default from information_schema.columns where table_schema = current_schema() and table_name = ? and column_name = ?',
            [$table, 'id']
        ))->pluck('column_default')->first();

        if (is_string($serialColumn) && str_contains($serialColumn, 'nextval')) {
            $target->statement(
                'select setval(pg_get_serial_sequence(?, ?), coalesce(max(id), 1), max(id) is not null) from '
                .$target->getQueryGrammar()->wrapTable($table),
                ['public.'.$table, 'id']
            );
        }

        $this->line("Copied {$copied} rows: {$table}");
    }

    $this->info('Data copy complete.');
})->purpose('Copy local MySQL data into the Supabase PostgreSQL database');

Artisan::command('db:compare-mysql-supabase', function () use ($databaseCopyTables) {
    $sourceConnection = 'mysql';
    $targetConnection = 'supabase';

    $this->table(['Table', 'MySQL', 'Supabase'], collect($databaseCopyTables)->map(function ($table) use ($sourceConnection, $targetConnection) {
        $mysqlCount = Schema::connection($sourceConnection)->hasTable($table)
            ? DB::connection($sourceConnection)->table($table)->count()
            : 'missing';

        $supabaseCount = Schema::connection($targetConnection)->hasTable($table)
            ? DB::connection($targetConnection)->table($table)->count()
            : 'missing';

        return [$table, $mysqlCount, $supabaseCount];
    })->all());
})->purpose('Compare local MySQL and Supabase PostgreSQL table counts');
