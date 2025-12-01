<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Region;

class CountryRegionSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'code' => 'SA',
                'name_en' => 'Saudi Arabia',
                'name_ar' => 'المملكة العربية السعودية',
                'regions' => [
                    ['name_en' => 'Riyadh', 'name_ar' => 'الرياض'],
                    ['name_en' => 'Jeddah', 'name_ar' => 'جدة'],
                    ['name_en' => 'Dammam', 'name_ar' => 'الدمام'],
                    ['name_en' => 'Makkah', 'name_ar' => 'مكة المكرمة'],
                    ['name_en' => 'Madinah', 'name_ar' => 'المدينة المنورة'],
                    ['name_en' => 'Abha', 'name_ar' => 'أبها'],
                    ['name_en' => 'Tabuk', 'name_ar' => 'تبوك'],
                    ['name_en' => 'Khobar', 'name_ar' => 'الخبر'],
                    ['name_en' => 'Al Qassim', 'name_ar' => 'القصيم'],
                    ['name_en' => 'Jazan', 'name_ar' => 'جازان'],
                    ['name_en' => 'Hail', 'name_ar' => 'حائل'],
                    ['name_en' => 'Najran', 'name_ar' => 'نجران'],
                    ['name_en' => 'Al Bahah', 'name_ar' => 'الباحة'],
                    ['name_en' => 'Al Jouf', 'name_ar' => 'الجوف'],
                ]
            ],
            [
                'code' => 'EG',
                'name_en' => 'Egypt',
                'name_ar' => 'مصر',
                'regions' => [
                    ['name_en' => 'Cairo', 'name_ar' => 'القاهرة'],
                    ['name_en' => 'Alexandria', 'name_ar' => 'الإسكندرية'],
                    ['name_en' => 'Giza', 'name_ar' => 'الجيزة'],
                    ['name_en' => 'Mansoura', 'name_ar' => 'المنصورة'],
                    ['name_en' => 'Tanta', 'name_ar' => 'طنطا'],
                    ['name_en' => 'Asyut', 'name_ar' => 'أسيوط'],
                    ['name_en' => 'Suez', 'name_ar' => 'السويس'],
                    ['name_en' => 'Fayoum', 'name_ar' => 'الفيوم'],
                    ['name_en' => 'Ismailia', 'name_ar' => 'الإسماعيلية'],
                    ['name_en' => 'Minya', 'name_ar' => 'المنيا'],
                ]
            ]
        ];

        foreach ($countries as $countryData) {
            $country = Country::create([
                'code' => $countryData['code'],
                'name_en' => $countryData['name_en'],
                'name_ar' => $countryData['name_ar'],
            ]);

            foreach ($countryData['regions'] as $regionData) {
                Region::create([
                    'country_id' => $country->id,
                    'name_en' => $regionData['name_en'],
                    'name_ar' => $regionData['name_ar'],
                ]);
            }
        }
    }
}
