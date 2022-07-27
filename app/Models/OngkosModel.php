<?php

namespace App\Models;

use CodeIgniter\Model;

class OngkosModel extends Model
{
  protected $table = "ongkos";
  protected $primaryKey = "idOngkos";
  protected $allowedFields = [
    'kdKotaAsal',
    'kdKotaTujuan',
    'ongkosMin',
    'ongkosVolume',
    'ongkosCreateAt',
    'userOngkosId'
  ];
  protected $createdField  = 'ongkosCreateAt';
  protected $validationRules = [
    'kdKotaAsal'    => 'required',
    'kdKotaTujuan'  => 'required',
    'ongkosMin'     => 'required',
    'ongkosVolume'  => 'required',
  ];
  protected $validationMessages = [
    'kdKotaAsal' => [
      'required' => 'Kota Asal harus diisi!'
    ],
    'kdKotaTujuan' => [
      'required' => 'Kota Tujuan harus diisi!'
    ],
    'ongkosMin' => [
      'required' => 'Ongkos Minimal harus diisi!'
    ],
    'ongkosVolume' => [
      'required' => 'Ongkos Volume harus diisi!'
    ]
  ];
}
