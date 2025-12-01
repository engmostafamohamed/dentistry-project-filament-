<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use Carbon\Carbon;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            [
                'title' => [
                    'en' => 'Teeth Whitening - 20% Off',
                    'ar' => 'تبييض الأسنان - خصم 20٪',
                ],
                'description' => [
                    'en' => 'Brighten your smile with professional whitening this month only!',
                    'ar' => 'احصل على ابتسامة أكثر إشراقًا بعرض تبييض الأسنان لهذا الشهر فقط!',
                ],
                'image' => 'offers/whitening.jpg',
                'discount' => 20,
                'expires_at' => Carbon::now()->addDays(30),
            ],
            [
                'title' => [
                    'en' => 'Free Consultation for Braces',
                    'ar' => 'استشارة مجانية لتقويم الأسنان',
                ],
                'description' => [
                    'en' => 'Book a free orthodontic consultation and plan your perfect smile.',
                    'ar' => 'احجز استشارتك المجانية لتقويم الأسنان واحصل على ابتسامة مثالية.',
                ],
                'image' => 'offers/braces.jpg',
                'discount' => null,
                'expires_at' => Carbon::now()->addDays(15),
            ],
            [
                'title' => [
                    'en' => 'Dental Cleaning Package',
                    'ar' => 'باقة تنظيف الأسنان',
                ],
                'description' => [
                    'en' => 'Comprehensive cleaning and checkup at a special price.',
                    'ar' => 'تنظيف شامل وفحص بأسعار خاصة.',
                ],
                'image' => 'offers/cleaning.jpg',
                'discount' => 10,
                'expires_at' => Carbon::now()->addDays(45),
            ],
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }
    }
}
