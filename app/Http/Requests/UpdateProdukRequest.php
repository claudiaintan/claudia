<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdukRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'string', 'exists:kategoris,id'],
            'harga' => ['required', 'string', 'max:512'],
            'stok' => 'required|numeric',
            'bobot' => ['required', 'numeric', "min:0"],
            'gambar' => ['nullable|image|mimes:jpeg,png,jpg|max:2048'],
        ];
    }
}
