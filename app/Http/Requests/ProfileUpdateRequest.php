<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'business_name' => ['nullable', 'string', 'max:100'],
            'public_name' => ['nullable', 'string', 'max:70'],
            'phone' => ['nullable', 'string', 'max:30'],
            'contact_email' => ['nullable', 'email', 'max:50'],
            'instagram' => ['nullable', 'string', 'max:50'],
            'twitter' => ['nullable', 'string', 'max:50'],
            'homepage' => ['nullable', 'string', 'max:100'],
            'colors' => ['nullable', Rule::in(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'])],
        ];
    }
}
