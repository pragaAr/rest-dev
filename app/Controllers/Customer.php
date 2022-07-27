<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\CustomerModel;

class Customer extends BaseController
{
  use ResponseTrait;

  function __construct()
  {
    $this->model = new CustomerModel();
  }

  public function index()
  {
    $data = $this->model->orderBy('idCust', 'asc')->findAll();

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
    $data = $this->model->where('idCust', $id)->find();

    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound("Data with id $id not found!");
    }
  }

  public function create()
  {
    $data = [
      'namaCust'      => $this->request->getVar('namaCust'),
      'kdKota'        => $this->request->getVar('kdKota'),
      'alamatCust'    => $this->request->getVar('alamatCust'),
      'notelpCust'    => $this->request->getVar('notelpCust'),
      'jenisCust'     => $this->request->getVar('jenisCust'),
      'userCustId'    => 1,
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

    $data['idCust'] = $id;

    $isExist = $this->model->where('idCust', $id)->find();

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
    $data = $this->model->where('idCust', $id)->find();

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
