<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;


class Auth extends BaseController
{
  use ResponseTrait;

  public function index()
  {
    $validation = \Config\Services::validation();
    $rules = [
      'emailUser' => [
        'rules' => 'required|valid_email',
        'errors' => [
          'required' => 'Silahkan masukan email anda!',
          'valid_email' => 'Silahkan masukan email yang valid!'
        ]
      ],
      'passUser' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Silahkan masukan password anda!',
        ]
      ]
    ];

    $validation->setRules($rules);

    if (!$validation->withRequest($this->request)->run()) {
      return $this->fail($validation->getErrors());
    }
    $model = new UserModel();

    $email = $this->request->getVar('emailUser');
    $pass = $this->request->getVar('passUser');

    $data = $model->getEmail($email);
    if ($data['passUser'] != md5($pass)) {
      return $this->fail("Password salah!");
    }

    helper('jwt');
    $response = [
      'messages' => 'Authenticated success!',
      'data'  => $data,
      'access_token' => createJWT($email)
    ];

    return $this->respond($response);
  }
}
