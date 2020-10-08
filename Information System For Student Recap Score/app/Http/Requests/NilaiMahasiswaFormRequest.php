<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NilaiMahasiswaFormRequest;

class NilaiMahasiswaFormRequest extends Request
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
          'kodeMkBuka.required' => 'Silahkan menginputkan kode mata kuliah !',
          'KPMkBuka.required' => 'Silahkan menginputkan kelas pararel mata kuliah !',
          'CheckInputNilai.required' => 'Ada Nilai Mahasiswa yang masih kosong !',
          'CheckInputNilai.max' => 'Nilai Mahasiswa tidak boleh lebih dari 100 !',
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
            'KPMkBuka' => 'required',
            'CheckInputNilai' => 'required|Numeric|Max:1',
        ];
    }
}
