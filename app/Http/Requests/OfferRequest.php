<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'phone'      => ['required', 'string', 'max:30'],
            'branch_id'  => ['nullable', 'exists:branches,id'],
            'doctor_id'  => ['nullable', 'exists:doctors,id'],
            // 'offer_id'   => ['nullable', 'exists:offers,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'country'    => ['required', 'exists:countries,id'],
            'region'     => ['required', 'exists:regions,id'],
            'date'       => ['required', 'date', 'after_or_equal:today'],
            'time'       => ['required', 'date_format:H:i'],
            'message'    => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        $lang = app()->getLocale();

        return [
            'name.required'      => $lang === 'ar' ? 'الاسم مطلوب' : 'Name is required',
            'name.max'           => $lang === 'ar' ? 'الاسم طويل جداً' : 'Name is too long',
            'phone.required'     => $lang === 'ar' ? 'رقم الهاتف مطلوب' : 'Phone is required',
            'phone.max'          => $lang === 'ar' ? 'رقم الهاتف طويل جداً' : 'Phone is too long',
            'branch_id.exists'   => $lang === 'ar' ? 'الفرع غير موجود' : 'Branch not found',
            'doctor_id.exists'   => $lang === 'ar' ? 'الطبيب غير موجود' : 'Doctor not found',
            'offer_id.exists'    => $lang === 'ar' ? 'العرض غير موجود' : 'Offer not found',
            'service_id.exists'  => $lang === 'ar' ? 'الخدمة غير موجودة' : 'Service not found',
            'country.required'   => $lang === 'ar' ? 'الدولة مطلوبة' : 'Country is required',
            'country.in'         => $lang === 'ar' ? 'الدولة غير صحيحة' : 'Invalid country',
            'region.required'    => $lang === 'ar' ? 'المنطقة مطلوبة' : 'Region is required',
            'region.max'         => $lang === 'ar' ? 'المنطقة طويلة جداً' : 'Region is too long',
            'date.required'      => $lang === 'ar' ? 'تاريخ الحجز مطلوب' : 'Booking date is required',
            'date.date'          => $lang === 'ar' ? 'تاريخ الحجز غير صحيح' : 'Invalid booking date',
            'date.after_or_equal'=> $lang === 'ar' ? 'تاريخ الحجز يجب أن يكون اليوم أو بعده' : 'Booking date must be today or later',
            'time.required'      => $lang === 'ar' ? 'الوقت مطلوب' : 'Booking time is required',
            'time.date_format'   => $lang === 'ar' ? 'تنسيق الوقت غير صحيح' : 'Invalid time format',
            'message.max'        => $lang === 'ar' ? 'الرسالة طويلة جداً' : 'Message is too long',
        ];
    }
}
