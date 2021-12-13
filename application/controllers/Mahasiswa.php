<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script allowed');


/**
 *
 */
class Mahasiswa extends RestController
{

  public function __construct(){
    parent::__construct();
    $this->load->model('Mahasiswa_model', 'mhs');
  }

  public function index_get(){
    $id = $this->get('id');
    if ($id === null) {
      $mahasiswa = $this->mhs->getMahasiswa();
    }else {
      $mahasiswa = $this->mhs->getMahasiswa($id);
    }

    if($mahasiswa){
      $this->response([
        'status' => true,
        'data' => $mahasiswa
      ], RESTController::HTTP_OK);
    }else {
      $this->response([
        'status' => false,
        'message' => 'data not found'
      ], RESTController::HTTP_NOT_FOUND);
    }
  }

  public function index_delete(){
    $id = $this->delete('id');

    if ($id === null) {
      $this->response([
        'status' => false,
        'message' => 'provide an id'
      ], RESTController::HTTP_BAD_REQUEST);
    }else {
      $delete = $this->mhs->deleteMahasiswa($id);

      if ($delete) {
        $this->response([
          'status' => true,
          'id' => $id,
          'message' => 'deleted'
        ], RESTController::HTTP_OK);
      }else {
        $this->response([
          'status' => false,
          'message' => 'id not found'
        ], RESTController::HTTP_NOT_FOUND);
      }
    }
  }

  public function index_post(){
    $data = [
      'nrp' => $this->post('nrp'),
      'nama' => $this->post('nama'),
      'email' => $this->post('email'),
      'jurusan' => $this->post('jurusan')
    ];

    $create = $this->mhs->createMahasiswa($data);

    if ($create) {
      $this->response([
        'status' => true,
        'message' => 'new mahasiswa created'
      ], RESTController::HTTP_CREATED);
    }else {
      $this->response([
        'status' => false,
        'message' => 'failed to add'
      ], RESTController::HTTP_BAD_REQUEST);
    }
  }

  public function index_put(){
    $id = $this->put('id');

    $data = [
      'nrp' => $this->put('nrp'),
      'nama' => $this->put('nama'),
      'email' => $this->put('email'),
      'jurusan' => $this->put('jurusan')
    ];

    $update = $this->mhs->updateMahasiswa($data, $id);

    if ($update) {
      $this->response([
        'status' => true,
        'message' => 'mahasiswa updated'
      ], RESTController::HTTP_OK);
    }else {
      $this->response([
        'status' => false,
        'message' => 'failed to edit'
      ], RESTController::HTTP_BAD_REQUEST);
    }
  }

}
