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
      return $this->failNotFound("Data dengan Kode $kd tidak ditemukan");
    }
  }

  public function create()
  {
    $data = [
      'kdProv'        => $this->request->getVar('kdProv'),
      'namaProv'      => $this->request->getVar('namaProv'),
      'dateProvAdd'   => date('Y-m-d H:i:s'),
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
      return $this->failNotFound("Data dengan id $id tidak ditemukan");
    }

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    $response = [
      'status'    => 200,
      'error'     => null,
      'messages'  => [
        'success' => "Data dengan id $id berhasil di update!"
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
          'success' => "Data berhasil dihapus!"
        ]
      ];

      return $this->respondDeleted($response);
    } else {
      return $this->failNotFound("Data dengan id $id tidak ditemukan");
    }
  }
}
