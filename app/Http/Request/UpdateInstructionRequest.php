<?php

namespace App\Http\Request;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInstructionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:20000',
            'file' => 'nullable|file|mimes:txt,docx'
        ];
    }
}
