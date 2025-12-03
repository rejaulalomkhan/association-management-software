<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // If email field contains a phone number, skip email validation
        if ($this->has('email') && preg_match('/^[0-9+\-\s()]+$/', $this->email)) {
            // Store original value
            $this->merge([
                'phone_number' => $this->email,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'password' => ['required', 'string'],
        ];

        // If it's a phone number, don't validate as email
        if ($this->has('phone_number')) {
            $rules['email'] = ['required', 'string'];
        } else {
            $rules['email'] = ['required', 'string', 'email'];
        }

        return $rules;
    }
}
