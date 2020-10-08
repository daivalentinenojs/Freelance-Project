<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JenisNilaiFormRequest;

class JenisNilaiFormRequest extends Request
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
            'namaMataKuliah.required' => 'Silahkan menginputkan nama mata kuliah !',
            'jenisNilai.required' => 'Silahkan menginputkan jenis nilai mata kuliah !',
            'bobotNilai.required' => 'Silahkan menginputkan bobot nilai mata kuliah !',
            'bobotNilai.max' => 'Total dari bobot yang diinputkan untuk mata kuliah tersebut tidak boleh lebih dari 100% !',
            'bobotNilai.min' => 'Total dari bobot yang diinputkan untuk mata kuliah tersebut tidak boleh kurang dari 1% !',
            'TotalDBDanInput.max' => 'Total dari bobot yang diinputkan dan bobot penilaian dari database untuk mata kuliah tersebut tidak boleh lebih dari 100% !',
            'CheckPenilaianAda.max' => 'Jenis penilaian yang diinputkan hanya boleh dilakukan satu kali saja !',
            'CheckSemuaKP.required' => 'Silahkan menginputkan kelas pararel mata kuliah !',
            'CheckNilaiKoorBukanKoor.max' => 'Jenis penilaian sudah pernah diinputkan oleh Koordinator !',
            'CheckBobotNol.max' => 'Bobot jenis penilaian tidak boleh kurang dari 1% !',
            'CheckSemuaKPBisaDitambah.max' => 'Salah satu kelas pararel dari dari Mata Kuliah yang Anda pilih mempunyai jumlah bobot penilaian lebih dari 100% !',
            'CheckSemuaKPUTSUAS.max' => 'Salah satu kelas pararel dari Mata Kuliah sudah mempunyai Jenis Penilaian yang Anda pilih !',
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
            'namaMataKuliah' => 'required',
            'jenisNilai' => 'required',
            'bobotNilai' => 'required|Numeric|Min:1|Max:100',
            'TotalDBDanInput' => 'Numeric|Max:100',
            'CheckPenilaianAda' => 'Integer|Max:1',
            'CheckSemuaKP' => 'required',
            'CheckNilaiKoorBukanKoor' => 'Integer|Max:1',
            'CheckSemuaKPBisaDitambah' => 'Integer|Max:1',
            'CheckBobotNol' => 'Integer|Max:1',
            'CheckSemuaKPUTSUAS' => 'Integer|Max:1',
        ];
    }
}
