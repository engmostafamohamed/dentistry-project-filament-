<?php

namespace App\Filament\Resources\Guests\Schemas;

use App\Models\Branch;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Offer;
use App\Models\Region;
use App\Models\Service;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class GuestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('patient_tabs')
                    ->columnSpanFull()
                    ->persistTabInQueryString()
                    ->tabs([

                        // ══════════════════════════════════════════════════════
                        // TAB 1 — Basic Information
                        // ══════════════════════════════════════════════════════
                        Tab::make(__('filament-language-switcher::guests.basic_info'))
                            ->icon('heroicon-o-user')
                            ->schema([
                                Grid::make()->columns(1)->schema([

                                    Section::make(__('filament-language-switcher::guests.guest_info'))
                                        ->columns(2)->compact()
                                        ->schema([
                                            TextInput::make('name')
                                                ->label(__('filament-language-switcher::guests.name'))
                                                ->dehydrated(true),

                                            TextInput::make('phone')
                                                ->label(__('filament-language-switcher::guests.phone'))
                                                ->dehydrated(true)
                                                ->type('number')
                                                ->required()
                                                ->rules([
                                                    'required',
                                                    'digits:11',
                                                    'regex:/^01[0-2,5][0-9]{8}$/',
                                                ])
                                                ->validationMessages([
                                                    'required'    => __('filament-language-switcher::guests.phone_required'),
                                                    'digits'      => __('filament-language-switcher::guests.phone_number_must_be_11_digits'),
                                                    'regex'    => __('filament-language-switcher::guests.invalid_phone'),
                                                ]),
                                        ]),

                                    Section::make(__('filament-language-switcher::guests.branch_info'))
                                        ->columns(3)->compact()
                                        ->schema([
                                            Select::make('country_id')
                                                ->label(__('filament-language-switcher::guests.country_name'))
                                                ->options(function () {
                                                    $locale = app()->getLocale();
                                                    $col='name_' . $locale;
                                                    return Country::all()->pluck($col, 'id');
                                                })
                                                ->searchable()
                                                ->live()
                                                ->dehydrated(false) // not saved in a guests column
                                                ->afterStateUpdated(function ($set) {
                                                    $set('region_id', null);
                                                    $set('branch_id', null);
                                                }),
                                            Select::make('region_id')
                                                ->label(__('filament-language-switcher::guests.region_name'))
                                                ->options(function ($get, $record) {
                                                    $countryId = $get('country_id');
                                                    if (!$countryId && $record?->country_id) {
                                                        $countryId = Branch::find($record->branch_id)?->country_id ;
                                                    }
                                                    if (!$countryId) return [];
                                                    $locale = app()->getLocale();
                                                    return Region::where('country_id', $countryId)
                                                        ->get()
                                                        ->pluck('name_' . $locale, 'id');
                                                })
                                                ->searchable()
                                                ->live()
                                                ->dehydrated(false) // not saved in a guests column
                                                ->disabled(fn ($get,$record) => !($get('country_id') ?? $record?->country_id))
                                                ->afterStateUpdated(function ($set) {
                                                    $set('branch_id', null);
                                                }),

                                            Select::make('branch_id')
                                                ->label(__('filament-language-switcher::guests.branch'))
                                                ->options(function ($get, $record) {
                                                    $regionId = $get('region_id');
                                                    if (!$regionId && $record?->branch_id) {
                                                        $regionId = Branch::find($record->branch_id)?->region_id ;
                                                    }
                                                    if (!$regionId) return [];
                                                    return Branch::where('region_id', $regionId)
                                                        ->pluck('name', 'id');
                                                })
                                                ->searchable()
                                                ->live()
                                                ->dehydrated(true)  // save to DB
                                                ->disabled(fn ($get ,$record) => !($get('region_id') ?? $record?->region_id)),


                                            Textarea::make('description')
                                                ->label(__('filament-language-switcher::guests.description'))
                                                ->dehydrated(false)->rows(3)->columnSpanFull()
                                                ->default(fn ($record) => $record?->description ?: '—')
                                                ->visible(fn ($record) => ! empty($record?->description)),
                                        ]),

                                    Section::make(__('filament-language-switcher::guests.application_info'))
                                        ->columns(2)->compact()
                                        ->schema([
                                            Select::make('service_id')
                                                ->label(__('filament-language-switcher::guests.service'))
                                                ->options(function () {
                                                    $locale = app()->getLocale();
                                                    return Service::all()->mapWithKeys(function ($service) use ($locale) {
                                                        $title = $service->title;
                                                        $label = is_array($title)
                                                            ? ($title[$locale] ?? $title['en'] ?? reset($title) ?? '—')
                                                            : (string) ($title ?: '—');
                                                        return [$service->id => $label];
                                                    });
                                                })
                                                ->searchable()
                                                ->live()
                                                ->dehydrated(true),

                                            Select::make('offer_id')
                                                ->label(__('filament-language-switcher::guests.offer'))
                                                ->options(function () {
                                                    $locale = app()->getLocale();
                                                    return Offer::all()->mapWithKeys(function ($offer) use ($locale) {
                                                        $title = $offer->title;
                                                        $label = is_array($title)
                                                            ? ($title[$locale] ?? $title['en'] ?? reset($title) ?? '—')
                                                            : (string) ($title ?: '—');
                                                        return [$offer->id => $label];
                                                    });
                                                })
                                                ->searchable()
                                                ->live()
                                                ->nullable()
                                                ->placeholder(__('Select an offer'))
                                                ->dehydrated(true), // saves to guests table

                                            Select::make('doctor_id')
                                                ->label(__('filament-language-switcher::guests.doctor_name'))
                                                ->options(function ($record) {
                                                    $query = Doctor::query()->whereNotNull('name')->where('name', '!=', '');
                                                    if ($record && $record->branch_id) {
                                                        $query->where('branch_id', $record->branch_id);
                                                    }
                                                    $doctors = $query->orderBy('name')
                                                        ->pluck('name', 'id')
                                                        ->filter(fn ($n) => ! empty($n))
                                                        ->toArray();
                                                    return ['' => 'filament-language-switcher::guests.not_found_doctor'] + $doctors;
                                                })
                                                ->searchable()->nullable()
                                                ->placeholder(__('Select a doctor'))
                                                ->preload()->native(false)
                                                ->getOptionLabelUsing(function ($value) {
                                                    if (empty($value)) return 'filament-language-switcher::guests.not_found_doctor';
                                                    return Doctor::find($value)?->name ?? '— Unknown —';
                                                }),

                                            ToggleButtons::make('status')
                                                ->label(__('filament-language-switcher::guests.status'))
                                                ->inline()->required()
                                                ->options([
                                                    'new'       => __('filament-language-switcher::guests.new'),
                                                    'completed'      => __('filament-language-switcher::guests.completed'),
                                                    'cancelled'      => __('filament-language-switcher::guests.cancelled'),
                                                    'continues' => __('filament-language-switcher::guests.continues'),
                                                ])
                                                ->colors(['new' => 'primary','continues' => 'warning', 'completed' => 'success', 'cancelled' => 'danger'])
                                                ->icons([
                                                    'new'       => 'heroicon-o-clock',
                                                    'completed' => 'heroicon-o-check-circle',
                                                    'continues' => 'heroicon-o-arrow-path',
                                                    'cancelled' => 'heroicon-o-x-circle',
                                                ]),

                                            DateTimePicker::make('booking_at')
                                                ->label(__('filament-language-switcher::guests.booking_date'))
                                                ->dehydrated(true)
                                                ->displayFormat('d M Y - h:i A')->placeholder('—'),
                                        ]),
                                ]),
                            ]),

                        // ══════════════════════════════════════════════════════
                        // TAB 2 — Medical History
                        // ══════════════════════════════════════════════════════
                        Tab::make(__('filament-language-switcher::guests.medical_history'))
                            ->icon('heroicon-o-clipboard-document-list')
                            ->schema([
                                Grid::make()->columns(2)->schema([

                                    // Chronic Diseases
                                    Section::make(__('filament-language-switcher::guests.chronic_diseases'))
                                        ->columnSpan(1)
                                        ->schema([
                                            // CheckboxList::make('chronic_diseases')
                                            //     ->label('')
                                            //     ->options([
                                            //         'diabetes'     => __('Diabetes'),
                                            //         'heart'        => __('Heart Disease'),
                                            //         'hypertension' => __('High Blood Pressure'),
                                            //         'asthma'       => __('Asthma'),
                                            //         'hepatitis'    => __('Hepatitis'),
                                            //         'other'        => __('Other'),
                                            //     ])
                                            //     ->columns(2)
                                            //     ->gridDirection('row'),
                                        ]),

                                    // Allergies & Alerts
                                    Section::make(__('filament-language-switcher::guests.allergies_and_alerts'))
                                        ->description(__('filament-language-switcher::guests.known_allergies'))
                                        ->columnSpan(1)
                                        ->schema([
                                            // Textarea::make('allergies')
                                            //     ->label(__('Allergy Details'))
                                            //     ->placeholder(__('Enter allergy details here...'))
                                            //     ->rows(3),

                                            // Textarea::make('medical_notes')
                                            //     ->label(__('Important Medical Notes'))
                                            //     ->placeholder(__('Any previous surgeries or special cases...'))
                                            //     ->rows(3),
                                        ]),

                                    // Previous Reports Upload
                                    Section::make(__('filament-language-switcher::guests.previous_medical_reports_and_files'))
                                        ->columnSpanFull()
                                        ->schema([
                                            // FileUpload::make('medical_files')
                                            //     ->label('')
                                            //     ->multiple()
                                            //     ->acceptedFileTypes(['application/pdf', 'image/*'])
                                            //     ->directory('medical-history')
                                            //     ->maxSize(51200)
                                            //     ->nullable(),
                                        ]),
                                ]),
                            ]),

                        // ══════════════════════════════════════════════════════
                        // TAB 3 — Treatment Plan
                        // ══════════════════════════════════════════════════════
                        Tab::make(__('filament-language-switcher::guests.treatment_plan'))
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                Grid::make()->columns(2)->schema([

                                    // Tooth Chart
                                    Section::make(__('filament-language-switcher::guests.interactive_tooth_chart'))
                                        ->columnSpan(1)
                                        ->schema([
                                            // Placeholder::make('tooth_chart')
                                            //     ->label('')
                                            //     ->content(fn ($record) => self::toothChart()),
                                        ]),

                                    // Proposed Procedures
                                    Section::make(__('filament-language-switcher::guests.proposed_procedures'))
                                        ->columnSpan(1)
                                        ->schema([
                                            // Placeholder::make('procedures_grid')
                                            //     ->label('')
                                            //     ->content(fn () => self::proceduresGrid()),
                                        ]),

                                    // Cost Summary
                                    Section::make(__('filament-language-switcher::guests.estimated_cost_summary'))
                                        ->columnSpanFull()->columns(3)
                                        ->schema([
                                            // TextInput::make('cleaning_cost')
                                            //     ->label(__('Scaling & Polishing'))
                                            //     ->prefix('EGP')->numeric()->placeholder('0'),

                                            // TextInput::make('composite_cost')
                                            //     ->label(__('Composite Filling'))
                                            //     ->prefix('EGP')->numeric()->placeholder('0'),

                                            // TextInput::make('root_canal_cost')
                                            //     ->label(__('Root Canal'))
                                            //     ->prefix('EGP')->numeric()->placeholder('0'),
                                        ]),
                                ]),
                            ]),

                        // ══════════════════════════════════════════════════════
                        // TAB 4 — Laboratory Orders
                        // ══════════════════════════════════════════════════════
                        Tab::make(__('filament-language-switcher::guests.laboratory_orders'))
                            ->icon('heroicon-o-beaker')
                            ->schema([
                                Grid::make()->columns(1)->schema([

                                    Section::make(__('filament-language-switcher::guests.lab_requests'))
                                        ->description(__('filament-language-switcher::guests.dental_lab_orders'))
                                        ->schema([
                                            // Placeholder::make('lab_orders_table')
                                            //     ->label('')
                                            //     ->content(fn ($record) => self::labOrdersTable()),
                                        ]),

                                    Section::make(__('filament-language-switcher::guests.lab_statistics'))
                                        ->columns(3)
                                        ->schema([
                                            // Placeholder::make('stat_active')
                                            //     ->label('')
                                            //     ->content(fn () => self::labStat('08', __('Active Orders'), '#3b82f6')),

                                            // Placeholder::make('stat_returned')
                                            //     ->label('')
                                            //     ->content(fn () => self::labStat('02', __('Returned Orders'), '#ef4444')),

                                            // Placeholder::make('stat_accuracy')
                                            //     ->label('')
                                            //     ->content(fn () => self::labStat('94%', __('Accuracy Rate'), '#22c55e')),
                                        ]),
                                ]),
                            ]),

                        // ══════════════════════════════════════════════════════
                        // TAB 5 — X-rays & Documents
                        // ══════════════════════════════════════════════════════
                        Tab::make(__('filament-language-switcher::guests.xrays_and_documents'))
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Grid::make()->columns(1)->schema([

                                    Section::make(__('filament-language-switcher::guests.upload_xrays_and_documents'))
                                        ->description(__('filament-language-switcher::guests.supports_dicom_jpg_png_pdf_max_50mb_per_file'))
                                        ->schema([
                                            // FileUpload::make('documents')
                                            //     ->label('')
                                            //     ->multiple()
                                            //     ->acceptedFileTypes(['image/*', 'application/pdf'])
                                            //     ->directory('patient-documents')
                                            //     ->maxSize(51200)
                                            //     ->nullable(),
                                        ]),

                                    Section::make(__('filament-language-switcher::guests.previous_records_2023'))
                                        ->schema([
                                            // Placeholder::make('documents_table')
                                            //     ->label('')
                                            //     ->content(fn ($record) => self::documentsTable()),
                                        ]),
                                ]),
                            ]),

                    ]),
            ]);
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Tooth Chart
    // ──────────────────────────────────────────────────────────────────────────
    private static function toothChart(): HtmlString
    {
        $upper = [18,17,16,15,14,13,12,11, 21,22,23,24,25,26,27,28];
        $lower = [48,47,46,45,44,43,42,41, 31,32,33,34,35,36,37,38];

        $row = function (array $teeth): string {
            $h = '<div style="display:flex;gap:4px;justify-content:center;flex-wrap:wrap;">';
            foreach ($teeth as $t) {
                $h .= '<button type="button"
                    style="width:34px;height:34px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);
                           background:#1e293b;color:#94a3b8;font-size:11px;font-weight:600;cursor:pointer;transition:all .15s;"
                    onmouseover="this.style.background=\'#3b82f6\';this.style.color=\'#fff\'"
                    onmouseout="this.style.background=\'#1e293b\';this.style.color=\'#94a3b8\'"
                    title="Tooth ' . $t . '">' . $t . '</button>';
            }
            return $h . '</div>';
        };

        $html = '
        <div style="background:#0f172a;border-radius:12px;padding:1.25rem;">
            <p style="text-align:center;font-size:.62rem;letter-spacing:.1em;color:#64748b;text-transform:uppercase;margin-bottom:.75rem;">
                UPPER ARCH (MAXILLARY)
            </p>
            ' . $row($upper) . '
            <div style="margin:10px 0;border-top:1px solid rgba(255,255,255,0.05);"></div>
            ' . $row($lower) . '
            <p style="text-align:center;font-size:.62rem;letter-spacing:.1em;color:#64748b;text-transform:uppercase;margin-top:.75rem;">
                LOWER ARCH (MANDIBULAR)
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;margin-top:.85rem;flex-wrap:wrap;">
                <span style="display:flex;align-items:center;gap:5px;font-size:.7rem;color:#94a3b8;">
                    <span style="width:10px;height:10px;border-radius:3px;background:#22c55e;display:inline-block;"></span>' . __('Healthy') . '
                </span>
                <span style="display:flex;align-items:center;gap:5px;font-size:.7rem;color:#94a3b8;">
                    <span style="width:10px;height:10px;border-radius:3px;background:#3b82f6;display:inline-block;"></span>' . __('Under Treatment') . '
                </span>
                <span style="display:flex;align-items:center;gap:5px;font-size:.7rem;color:#94a3b8;">
                    <span style="width:10px;height:10px;border-radius:3px;background:#ef4444;display:inline-block;"></span>' . __('Needs Treatment') . '
                </span>
            </div>
        </div>';

        return new HtmlString($html);
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Procedures Grid
    // ──────────────────────────────────────────────────────────────────────────
    private static function proceduresGrid(): HtmlString
    {
        $items = [
            ['icon' => '🧹', 'name' => __('Scaling & Polishing'),    'desc' => __('Surface cleaning & tartar removal'),  'color' => '#3b82f6'],
            ['icon' => '🦷', 'name' => __('Composite Filling'),      'desc' => __('Cavity restoration'),                 'color' => '#f97316'],
            ['icon' => '💉', 'name' => __('Root Canal'),             'desc' => __('Pulp inflammation treatment'),        'color' => '#8b5cf6'],
            ['icon' => '👑', 'name' => __('Zirconia Crown'),         'desc' => __('Tooth protection after root canal'),  'color' => '#ec4899'],
        ];

        $html = '<div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">';
        foreach ($items as $p) {
            $html .= '
            <div style="background:#0f172a;border:1px solid rgba(255,255,255,0.07);border-radius:12px;
                        padding:1rem;display:flex;flex-direction:column;gap:.5rem;cursor:pointer;transition:border-color .2s;"
                 onmouseover="this.style.borderColor=\'' . $p['color'] . '55\'"
                 onmouseout="this.style.borderColor=\'rgba(255,255,255,0.07)\'">
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <span style="font-size:1.3rem;">' . $p['icon'] . '</span>
                    <span style="font-size:.65rem;color:' . $p['color'] . ';font-weight:700;
                                 background:' . $p['color'] . '22;padding:2px 8px;border-radius:20px;">
                        + ' . __('Add') . '
                    </span>
                </div>
                <p style="font-size:.78rem;font-weight:600;color:#f1f5f9;margin:0;">' . e($p['name']) . '</p>
                <p style="font-size:.68rem;color:#64748b;margin:0;">' . e($p['desc']) . '</p>
            </div>';
        }

        return new HtmlString($html . '</div>');
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Lab Orders Table
    // ──────────────────────────────────────────────────────────────────────────
    private static function labOrdersTable(): HtmlString
    {
        $orders = [
            [
                'type'     => __('Upper Acrylic Denture'),
                'sent'     => '2023-10-10', 'expected' => '2023-10-18', 'received' => '2023-10-17',
                'label'    => __('Completed'), 'color' => '#22c55e',
            ],
            [
                'type'     => __('Zirconia Crown'),
                'sent'     => '2023-10-15', 'expected' => '2023-10-20', 'received' => '—',
                'label'    => __('Returned'),  'color' => '#ef4444',
                'return'   => ['reason' => __('Final measurements mismatch'), 'date' => '2023-10-21', 'new_exp' => '2023-10-25'],
            ],
            [
                'type'     => __('Clear Aligner'),
                'sent'     => '2023-10-20', 'expected' => '2023-10-30', 'received' => '—',
                'label'    => __('In Progress'), 'color' => '#3b82f6',
            ],
        ];

        $th = fn ($t) => '<th style="padding:.6rem .75rem;text-align:center;color:#64748b;font-weight:500;white-space:nowrap;">' . $t . '</th>';

        $html = '<div style="overflow-x:auto;"><table style="width:100%;border-collapse:collapse;font-size:.78rem;">';
        $html .= '<thead><tr style="border-bottom:1px solid rgba(255,255,255,0.08);">'
               . $th(__('Sample Type')) . $th(__('Sent')) . $th(__('Expected'))
               . $th(__('Received')) . $th(__('Status')) . $th(__('Actions'))
               . '</tr></thead><tbody>';

        foreach ($orders as $o) {
            $html .= '
            <tr style="border-bottom:1px solid rgba(255,255,255,0.05);">
                <td style="padding:.75rem;color:#f1f5f9;font-weight:500;">' . e($o['type']) . '</td>
                <td style="padding:.75rem;text-align:center;color:#94a3b8;">' . e($o['sent']) . '</td>
                <td style="padding:.75rem;text-align:center;color:#94a3b8;">' . e($o['expected']) . '</td>
                <td style="padding:.75rem;text-align:center;color:#94a3b8;">' . e($o['received']) . '</td>
                <td style="padding:.75rem;text-align:center;">
                    <span style="background:' . $o['color'] . '22;color:' . $o['color'] . ';
                                 padding:3px 10px;border-radius:20px;font-size:.7rem;font-weight:600;">
                        ' . e($o['label']) . '
                    </span>
                </td>
                <td style="padding:.75rem;text-align:center;">
                    <button type="button" style="background:rgba(255,255,255,0.05);border:none;
                            border-radius:6px;padding:4px 8px;color:#94a3b8;cursor:pointer;">✏️</button>
                </td>
            </tr>';

            if (isset($o['return'])) {
                $r = $o['return'];
                $html .= '
                <tr style="background:rgba(239,68,68,0.05);border-bottom:1px solid rgba(255,255,255,0.05);">
                    <td colspan="6" style="padding:.5rem .75rem;">
                        <div style="display:flex;gap:1.5rem;align-items:center;font-size:.72rem;flex-wrap:wrap;">
                            <span style="color:#ef4444;">⚠ ' . __('Reason') . ': <strong>' . e($r['reason']) . '</strong></span>
                            <span style="color:#64748b;">' . __('Return Date') . ': ' . e($r['date']) . '</span>
                            <span style="color:#3b82f6;">' . __('New Expected') . ': <strong>' . e($r['new_exp']) . '</strong></span>
                            <button type="button" style="margin-left:auto;background:#ef444422;border:1px solid #ef444444;
                                    border-radius:6px;padding:3px 10px;color:#ef4444;cursor:pointer;font-size:.72rem;">
                                ↩ ' . __('Resend to Lab') . '
                            </button>
                        </div>
                    </td>
                </tr>';
            }
        }

        return new HtmlString($html . '</tbody></table></div>');
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Lab Stat card
    // ──────────────────────────────────────────────────────────────────────────
    private static function labStat(string $value, string $label, string $color): HtmlString
    {
        return new HtmlString('
        <div style="background:#0f172a;border:1px solid rgba(255,255,255,0.07);border-radius:12px;
                    padding:1.1rem 1.3rem;display:flex;align-items:center;gap:1rem;">
            <div style="width:42px;height:42px;border-radius:10px;background:' . $color . '22;
                        display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.2rem;">🔬</div>
            <div>
                <p style="font-size:1.6rem;font-weight:700;color:#f9fafb;margin:0;line-height:1;">' . e($value) . '</p>
                <p style="font-size:.65rem;color:#6b7280;margin:.2rem 0 0;text-transform:uppercase;letter-spacing:.06em;">' . e($label) . '</p>
            </div>
        </div>');
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Documents Table
    // ──────────────────────────────────────────────────────────────────────────
    private static function documentsTable(): HtmlString
    {
        $docs = [
            ['name' => __('Pre-treatment Clinical Photo'), 'type' => 'JPG Image',    'date' => '18 Aug 2023', 'size' => '4.5 MB', 'tag' => 'X-RAY',      'tagColor' => '#f97316'],
            ['name' => __('Implant Consent Form'),         'type' => 'PDF Document', 'date' => '10 Aug 2023', 'size' => '1.2 MB', 'tag' => 'PDF REPORT',  'tagColor' => '#ef4444'],
        ];

        $html = '
        <div style="display:flex;gap:.5rem;margin-bottom:1rem;flex-wrap:wrap;">
            <button type="button" style="background:#3b82f6;color:#fff;border:none;border-radius:20px;padding:4px 14px;font-size:.72rem;cursor:pointer;">' . __('All') . '</button>
            <button type="button" style="background:rgba(255,255,255,0.06);color:#94a3b8;border:none;border-radius:20px;padding:4px 14px;font-size:.72rem;cursor:pointer;">X-Ray</button>
            <button type="button" style="background:rgba(255,255,255,0.06);color:#94a3b8;border:none;border-radius:20px;padding:4px 14px;font-size:.72rem;cursor:pointer;">' . __('Medical Reports') . '</button>
        </div>
        <table style="width:100%;border-collapse:collapse;font-size:.78rem;">
            <thead>
                <tr style="border-bottom:1px solid rgba(255,255,255,0.08);">
                    <th style="padding:.6rem .75rem;text-align:left;color:#64748b;font-weight:500;">' . __('File Name') . '</th>
                    <th style="padding:.6rem;text-align:center;color:#64748b;font-weight:500;">' . __('Type') . '</th>
                    <th style="padding:.6rem;text-align:center;color:#64748b;font-weight:500;">' . __('Upload Date') . '</th>
                    <th style="padding:.6rem;text-align:center;color:#64748b;font-weight:500;">' . __('Size') . '</th>
                    <th style="padding:.6rem;text-align:center;color:#64748b;font-weight:500;">' . __('Actions') . '</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($docs as $d) {
            $html .= '
            <tr style="border-bottom:1px solid rgba(255,255,255,0.05);">
                <td style="padding:.75rem;color:#f1f5f9;">
                    <div style="display:flex;align-items:center;gap:.6rem;">
                        <span style="background:' . $d['tagColor'] . '22;color:' . $d['tagColor'] . ';
                                     font-size:.6rem;font-weight:700;padding:2px 7px;border-radius:4px;white-space:nowrap;">
                            ' . e($d['tag']) . '
                        </span>
                        ' . e($d['name']) . '
                    </div>
                </td>
                <td style="padding:.75rem;text-align:center;color:#94a3b8;">' . e($d['type']) . '</td>
                <td style="padding:.75rem;text-align:center;color:#94a3b8;">' . e($d['date']) . '</td>
                <td style="padding:.75rem;text-align:center;color:#94a3b8;">' . e($d['size']) . '</td>
                <td style="padding:.75rem;text-align:center;">
                    <div style="display:flex;gap:.4rem;justify-content:center;">
                        <button type="button" style="background:rgba(255,255,255,0.05);border:none;border-radius:6px;padding:4px 8px;color:#94a3b8;cursor:pointer;">👁</button>
                        <button type="button" style="background:rgba(255,255,255,0.05);border:none;border-radius:6px;padding:4px 8px;color:#94a3b8;cursor:pointer;">⬇</button>
                        <button type="button" style="background:rgba(239,68,68,0.1);border:none;border-radius:6px;padding:4px 8px;color:#ef4444;cursor:pointer;">🗑</button>
                    </div>
                </td>
            </tr>';
        }

        $html .= '
            </tbody>
        </table>
        <div style="display:flex;justify-content:space-between;align-items:center;
                    margin-top:1rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.06);flex-wrap:wrap;gap:.5rem;">
            <span style="font-size:.72rem;color:#64748b;">
                ' . __('Total Files') . ': <strong style="color:#f1f5f9;">12 ' . __('files') . '</strong>
                &nbsp;|&nbsp;' . __('Storage') . ': <strong style="color:#f1f5f9;">32.4 MB</strong>
            </span>
            <div style="display:flex;gap:.5rem;">
                <button type="button" style="background:rgba(255,255,255,0.06);border:none;border-radius:8px;
                        padding:5px 14px;color:#94a3b8;font-size:.72rem;cursor:pointer;">
                    📄 ' . __('Print All Reports') . '
                </button>
                <button type="button" style="background:rgba(59,130,246,0.15);border:none;border-radius:8px;
                        padding:5px 14px;color:#3b82f6;font-size:.72rem;cursor:pointer;">
                    ⬇ ' . __('Download All') . '
                </button>
            </div>
        </div>';

        return new HtmlString($html);
    }
}
