<?php


/**
 *
 */
class Mahasiswa_model extends CI_Model
{

  function __construct()
  {
    // code...
  }

  public function getMahasiswa($id = null) {
    if ($id === null) {
      $mahasiswa =  $this->db->get('mahasiswa')->result_array();
      return $mahasiswa;
    }else {
      $mahasiswa =  $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
      return $mahasiswa;
    }
  }

  public function deleteMahasiswa($id = null){
      $delete =  $this->db->delete('mahasiswa', ['id' => $id]);
      return $this->db->affected_rows();
  }

  public function createMahasiswa($data){
    $this->db->insert('mahasiswa', $data);
    return $this->db->affected_rows();
  }

  public function updateMahasiswa($data, $id){
    $this->db->update('mahasiswa', $data, ['id' => $id]);
    return $this->db->affected_rows();
  }

}
