<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JenisNilaiHapusFormRequest;

class JenisNilaiHapusFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'kodeMkBuka.required' => 'Silahkan menginputkan kode mata kuliah buka !',
            'kpMkBuka.required' => 'Silahkan menginputkan kelas pararel mata kuliah buka !',
            'JenisNilai.required' => 'Silahkan menginputkan jenis penilaian !',
            'waktuBuat.required' => 'Silahkan menginputkan waktu buat !',
            'dosenPembuat.required' => 'Silahkan menginputkan NPK dosen pembuat nilai !',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kodeMkBuka' => 'required',
            'kpMkBuka' => 'required',
            'JenisNilai' => 'required',
            'waktuBuat' => 'required',
            'dosenPembuat' => 'required',
        ];
    }
}
