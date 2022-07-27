<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends BaseController
{
  use ResponseTrait;

  function __construct()
  {
    $this->model = new UserModel();
  }

  public function index()
  {
    $data = $this->model->orderBy('idUser', 'asc')->findAll();

    $response = [
      'status'    => 200,
      'error'     => null,
      'messages'  => [
        'success' => "No data in database.."
      ]
    ];

    if (!empty($data)) {
      return $this->respond($data, 200);
    } else {
      return $this->respond($response);
    }
  }

  public function show($id = null)
  {
    $data = $this->model->where('idUser', $id)->find();

    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound("Data with id $id not found!");
    }
  }

  public function create()
  {
    $data = [
      'namaUser'      => $this->request->getVar('namaUser'),
      'notelpUser'    => $this->request->getVar('notelpUser'),
      'emailUser'     => $this->request->getVar('emailUser'),
      'passUser'      => $this->request->getVar('passUser'),
      'userRole'      => $this->request->getVar('userRole'),
    ];

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    $response = [
      'status'    => 201,
      'error'     => null,
      'messages'  => 'Data inserted succesfully!'
    ];

    return $this->respond($response);
  }

  public function update($id = null)
  {
    $data = $this->request->getRawInput();

    $data['idUser'] = $id;

    $isExist = $this->model->where('idUser', $id)->find();

    if (!$isExist) {
      return $this->failNotFound("Data with id $id not found!");
    }

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    $response = [
      'status'    => 200,
      'error'     => null,
      'messages'  => [
        'success' => "Data with id $id successfully update!"
      ]
    ];

    return $this->respond($response);
  }

  public function delete($id = null)
  {
    $data = $this->model->where('idUser', $id)->find();

    if ($data) {
      $this->model->delete($id);

      $response = [
        'status'    => 200,
        'error'     => null,
        'messages'  => [
          'success' => "Data deleted successfully!"
        ]
      ];

      return $this->respondDeleted($response);
    } else {
      return $this->failNotFound("Data with id $id not found!");
    }
  }
}
