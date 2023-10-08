<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'nama' => 'required',
            // 'jenis_acara' => 'required',
            // 'warna' => 'required',
            // 'deskripsi' => 'required',
            // 'waktu_mulai' => 'required',
            // 'waktu_selesai' => 'required',
            // 'lokasi' => 'required',
            // 'harga' => 'required',
            // 'batas_pendaftaran' => 'required',
            // 'gambar' => 'required',
            // 'terbuka_untuk' => 'required'
        ];
    }
}