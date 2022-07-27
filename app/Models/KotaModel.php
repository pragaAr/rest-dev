<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
  protected $table = "kota";
  protected $primaryKey = "idKota";
  protected $allowedFields = [
    'kdKota',
    'namaKota',
    'provKota',
    'kotaCreateAt',
    'userKotaId'
  ];
  protected $createdField  = 'kotaCreateAt';
  protected $validationRules = [
    'kdKota' => 'required',
    'namaKota' => 'required',
  ];
  protected $validationMessages = [
    'kdKota' => [
      'required' => 'Kode Kota harus diisi!'
    ],
    'namaKota' => [
      'required' => 'Nama Kota harus diisi!'
    ],
    'provKota' => [
      'required' => 'Provinsi harus diisi!'
    ]
  ];
}
