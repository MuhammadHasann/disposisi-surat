<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("User_model");
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data = array(
      'title' => 'View Data User',
      'user' => $this->User_model->getAll(),
      'content'=> 'admin/user/index'
    );

    $this->load->view('admin/template/main', $data);
  }

  public function add()
  {
    $data = array(
      'title' => 'Tambah Data User',
      'user' => $this->User_model->getAll(),
      'content'=> 'admin/user/add_form'
    );

    $this->load->view('admin/template/main', $data);
  }

  public function save()
  {
    $this->User_model->Save();

    if($this->db->affected_rows()>0){
      $this->session->set_flashdata("success","Data user Berhasil DiSimpan");
    }

    redirect('admin/user');
  }

  public function getedit($id)
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'Update Data user',
      'users' => $this->User_model->getById($id),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'content'=> 'admin/user/edit_form'
    );

    $this->load->view('admin/template/main',$data);
  }

  public function edit()
  {
    $this->User_model->editData();

    if($this->db->affected_rows()>0){
      $this->session->set_flashdata("success","Data user Berhasil DiUpdate");
    }

    redirect('admin/user');
  }

  function delete($id)
  {
    $this->User_model->delete($id);
    $this->db->query("ALTER TABLE tb_user AUTO_INCREMENT = 1");
    redirect('admin/user');
  }
}
  