<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
  protected $table = "cabang";
  protected $primaryKey = "idCabang";
  protected $allowedFields = [
    'kdCabang',
    'kdKota',
    'alamatCabang',
    'cabangCreateAt',
    'userCabangId'
  ];
  protected $createdField  = 'cabangCreateAt';
  protected $validationRules = [
    'kdCabang' => 'required',
    'kdKota' => 'required',
    'alamatCabang' => 'required',
  ];
  protected $validationMessages = [
    'kdCabang' => [
      'required' => 'Kode Kecamatan harus diisi!'
    ],
    'kdKota' => [
      'required' => 'Nama Kecamatan harus diisi!'
    ],
    'alamatCabang' => [
      'required' => 'Kode Kota harus diisi!'
    ]
  ];
}
