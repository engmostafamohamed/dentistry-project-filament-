<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => [
                    'en' => 'General Dentistry',
                    'ar' => 'طب الأسنان العام',
                ],
                'description' => [
                    'en' => 'Comprehensive dental care including cleaning, fillings, and checkups.',
                    'ar' => 'رعاية شاملة للأسنان تشمل التنظيف والحشوات والفحوصات الدورية.',
                ],
                'image' => 'services/general.jpg',
            ],
            [
                'title' => [
                    'en' => 'Cosmetic Dentistry',
                    'ar' => 'طب تجميل الأسنان',
                ],
                'description' => [
                    'en' => 'Enhance your smile with whitening, veneers, and aesthetic treatments.',
                    'ar' => 'ابتسامة أجمل مع تبييض الأسنان، العدسات، والعلاجات الجمالية.',
                ],
                'image' => 'services/cosmetic.jpg',
            ],
            [
                'title' => [
                    'en' => 'Orthodontics',
                    'ar' => 'تقويم الأسنان',
                ],
                'description' => [
                    'en' => 'Alignment correction using braces or Invisalign.',
                    'ar' => 'تصحيح اصطفاف الأسنان باستخدام التقويم أو الإنفزلاين.',
                ],
                'image' => 'services/orthodontics.jpg',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
