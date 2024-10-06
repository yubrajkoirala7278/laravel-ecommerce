<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $paymentMethod = $this->input('payment_method'); 
        return [
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required'],
            'country_name'=>['required'],
            'address'=>['required'],
            'apartment'=>['required'],
            'city'=>['required'],
            'state'=>['required'],
            'Zip'=>['nullable'],
            'phone'=>['required'],
            'card_number'=>$paymentMethod=='stripe'?['required']:['nullable']
        ];
    }
}
