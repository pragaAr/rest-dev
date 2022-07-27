<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
  protected $table = "user";
  protected $primaryKey = "idUser";
  protected $allowedFields = [
    'namaUser',
    'notelpUser',
    'emailUser',
    'passUser',
    'userRole',
    'userCreateAt',
  ];
  protected $createdField  = 'userCreateAt';
  protected $validationRules = [
    'namaUser'    => 'required',
    'notelpUser'  => 'required',
    'emailUser'   => 'required|valid_email',
    'passUser'    => 'required',
    'userRole'    => 'required',
  ];
  protected $validationMessages = [
    'namaUser' => [
      'required' => 'Nama User harus diisi!'
    ],
    'notelpUser' => [
      'required' => 'No Telepon User harus diisi!'
    ],
    'emailUser' => [
      'required' => 'Email User harus diisi!',
      'valid_email' => 'Silahkan masukan Email yang valid!',
    ],
    'passUser' => [
      'required' => 'Password User harus diisi!'
    ],
    'userRole' => [
      'required' => 'User Role harus diisi!'
    ],
  ];

  function getEmail($email)
  {
    $builder = $this->table("user");
    $data = $builder->where("emailUser", $email)->first();

    if (!$data) {
      throw new Exception("Data not found..");
    }
    return $data;
  }
}
