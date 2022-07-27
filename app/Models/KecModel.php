<?php

namespace App\Models;

use CodeIgniter\Model;

class KecModel extends Model
{
  protected $table = "kecamatan";
  protected $primaryKey = "idKec";
  protected $allowedFields = [
    'kdKec',
    'namaKec',
    'kdKota',
    'luarJangkauan',
    'oljKec',
    'kecCreateAt',
    'userKecId'
  ];
  protected $createdField  = 'kecCreateAt';
  protected $validationRules = [
    'kdKec' => 'required',
    'namaKec' => 'required',
    'kdKota' => 'required',
    'luarJangkauan' => 'required',
    'oljKec' => 'required',
  ];
  protected $validationMessages = [
    'kdKec' => [
      'required' => 'Kode Kecamatan harus diisi!'
    ],
    'namaKec' => [
      'required' => 'Nama Kecamatan harus diisi!'
    ],
    'kdKota' => [
      'required' => 'Kode Kota harus diisi!'
    ],
    'luarJangkauan' => [
      'required' => 'Luar Jangkauan harus diisi!'
    ],
    'oljKec' => [
      'required' => 'OLJ harus diisi!'
    ],
  ];
}
