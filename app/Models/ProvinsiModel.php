<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
  protected $table = "provinsi";
  protected $primaryKey = "idProv";
  protected $allowedFields = [
    'kdProv',
    'namaProv',
    'provCreateAt',
    'userProvId'
  ];
  protected $createdField  = 'provCreateAt';

  protected $validationRules = [
    'kdProv' => 'required',
    'namaProv' => 'required',
  ];
  protected $validationMessages = [
    'kdProv' => [
      'required' => 'Kode Provinsi harus diisi!'
    ],
    'namaProv' => [
      'required' => 'Nama Provinsi harus diisi!'
    ]
  ];
}
