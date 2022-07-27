<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\OngkosModel;

class Ongkos extends BaseController
{
  use ResponseTrait;

  function __construct()
  {
    $this->model = new OngkosModel();
  }

  public function index()
  {
    $data = $this->model->orderBy('idOngkos', 'asc')->findAll();

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
    $data = $this->model->where('idOngkos', $id)->find();

    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound("Data with id $id not found!");
    }
  }

  public function create()
  {
    $data = [
      'kdKotaAsal'     => $this->request->getVar('kdKotaAsal'),
      'kdKotaTujuan'   => $this->request->getVar('kdKotaTujuan'),
      'ongkosMin'      => $this->request->getVar('ongkosMin'),
      'ongkosMin'      => $this->request->getVar('ongkosMin'),
      'ongkosVolume'   => $this->request->getVar('ongkosVolume'),
      'userOngkosId'   => 1,
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

    $data['idOngkos'] = $id;

    $isExist = $this->model->where('idOngkos', $id)->find();

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
    $data = $this->model->where('idOngkos', $id)->find();

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
