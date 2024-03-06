<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Fluent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('user'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function validator()
    {
        $validator = Validator::make($this->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'roles' => 'required'
        ]);

        $validator->sometimes('password', 'min:6|confirmed', function (Fluent $input) {
            return !$input->filled('password');
        });

        return $validator;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'email' => 'email address',
            'first_name' => 'first name',
            'last_name' => 'last name'
        ];
    }
}
