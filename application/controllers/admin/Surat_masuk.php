<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Surat_masuk extends CI_Controller {
  public function __construct()
  {
    parent::__construct();

    $this->load->model("Masuk_model");
    cek_login();

    $this->load->library('form_validation');
  }

  public function index()
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'View Data Surat',
      'surat' => $this->Masuk_model->getAll(),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'content'=> 'admin/surat_masuk/index'
    );

    $this->load->view('admin/template/main',$data);
  }

  public function add()
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'Tambah Data Surat Masuk',
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'content'=> 'admin/surat_masuk/add_form'
    );

    $this->load->view('admin/template/main',$data);
  }

  public function save()
  {
    $this->Masuk_model->Save();

    if($this->db->affected_rows()>0){
      $this->session->set_flashdata("success","Data Surat Masuk Berhasil DiSimpan");
    }

    redirect('admin/surat_masuk');
  }

  public function getedit($id)
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'Update Data Surat Masuk',
      'surat' => $this->Masuk_model->getById($id),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'content'=> 'admin/surat_masuk/edit_form'
    );

    $this->load->view('admin/template/main',$data);
  }

  public function edit()
  {
    $this->Masuk_model->editData();

    if($this->db->affected_rows()>0){
      $this->session->set_flashdata("success","Data user Berhasil DiUpdate");
    }

    redirect('admin/surat_masuk');
  }

  function delete($id)
  {
    $this->Masuk_model->delete($id);
    $this->db->query("ALTER TABLE tb_surat_masuk AUTO_INCREMENT = 1");
    redirect('admin/surat_masuk');
  }
}
