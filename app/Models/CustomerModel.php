<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
  protected $table = "customer";
  protected $primaryKey = "idCust";
  protected $allowedFields = [
    'namaCust',
    'kdCabang',
    'alamatCust',
    'notelpCust',
    'jenisCust',
    'custCreateAt',
    'userCustId'
  ];
  protected $createdField  = 'custCreateAt';
  protected $validationRules = [
    'namaCust'    => 'required',
    'kdCabang'    => 'required',
    'alamatCust'  => 'required',
    'notelpCust'  => 'required',
    'jenisCust'   => 'required',
  ];
  protected $validationMessages = [
    'namaCust' => [
      'required' => 'Nama Customer harus diisi!'
    ],
    'kdCabang' => [
      'required' => 'Kode Cabang harus diisi!'
    ],
    'alamatCust' => [
      'required' => 'Alamat Customer harus diisi!'
    ],
    'notelpCust' => [
      'required' => 'No Telepon Customer harus diisi!'
    ],
    'jenisCust' => [
      'required' => 'Jenis Customer harus diisi!'
    ],
  ];
}
