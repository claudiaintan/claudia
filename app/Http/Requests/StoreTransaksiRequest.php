<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
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
        return [
            'ongkir' => ['required', 'string', 'exists:ongkirs,id'],
            'alamat' => ['required', 'string', 'max:255'],
            'kodepos' => ['required', 'string', 'max:255'],
            'bayar' => ['nullable', 'image'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
