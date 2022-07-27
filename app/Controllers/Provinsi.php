<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ProvinsiModel;

class Provinsi extends BaseController
{
  use ResponseTrait;

  function __construct()
  {
    $this->model = new ProvinsiModel();
  }

  public function index()
  {
    $data = $this->model->orderBy('kdProv', 'asc')->findAll();
    return $this->respond($data, 200);
  }

  public function show($kd = null)
  {
    $data = $this->model->where('kdProv', $kd)->find();

    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound("Data with Code $kd not found!");
    }
  }

  public function create()
  {
    $data = [
      'kdProv'        => $this->request->getVar('kdProv'),
      'namaProv'      => $this->request->getVar('namaProv'),
      'userProvId'    => 1,
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

    $data['idProv'] = $id;

    $isExist = $this->model->where('idProv', $id)->find();

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
        'success' => "Data with id $id successfully updated!"
      ]
    ];

    return $this->respond($response);
  }

  public function delete($id = null)
  {
    $data = $this->model->where('idProv', $id)->find();

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
