<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JenisNilaiEditFormRequest;

class JenisNilaiEditFormRequest extends Request
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
            'mkBuka.required' => 'Silahkan menginputkan kode mata kuliah buka !',
            'kpMkBuka.required' => 'Silahkan menginputkan kelas pararel mata kuliah buka !',
            'JenisNilai.required' => 'Silahkan menginputkan jenis penilaian !',
            'waktuBuat.required' => 'Silahkan menginputkan waktu buat !',
            'dosenPembuat.required' => 'Silahkan menginputkan NPK dosen pembuat nilai !',

            'CheckSemuaKP.max' => 'Salah satu kelas pararel dari dari Mata Kuliah yang Anda pilih mempunyai jumlah bobot penilaian lebih dari 100% !',
            'bobotNilai.max' => 'Total dari bobot yang diinputkan untuk mata kuliah tersebut tidak boleh lebih dari 100% !',
            'TotalDBDanInput.max' => 'Total dari bobot yang diinputkan dan bobot penilaian dari database untuk mata kuliah tersebut tidak boleh lebih dari 100% !',
            'KetentuanNilai.max' => 'Silahkan menginputkan ketentuan nilai dengan benar !',
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
            'bobotNilai' => 'Numeric|Max:100',
            'KetentuanNilai' => 'Integer|Max:1',
            'TotalDBDanInput' => 'Numeric|Max:100',
            'CheckSemuaKP' => 'Integer|Max:1',
        ];
    }
}
