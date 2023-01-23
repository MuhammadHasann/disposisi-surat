<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Surat_ajuan extends CI_Controller {
    
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
      'title' => 'View Data Surat Pengajuan',
      'userlog'=> infoLogin(),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'surat' => $this->db->where('is_active',1)->where('user_id', $user_id)->get('tb_surat_masuk')->result(),
      'content'=> 'sekretaris/surat_ajuan/index'
    );

    $this->load->view('sekretaris/template/main',$data);
  }

  public function add()
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'Tambah Data Surat Pengajuan',
      'userlog'=> infoLogin(),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'content'=> 'sekretaris/surat_ajuan/add_form'
    );

    $this->load->view('sekretaris/template/main',$data);
  }

  public function save()
  {
    $this->Masuk_model->saveAjuan();

    if($this->db->affected_rows()>0){
      $this->session->set_flashdata("success","Data Surat Masuk Berhasil DiSimpan");
    }
    
    redirect('surat_ajuan');
  }

  public function getedit($id)
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'Update Data Surat Masuk',
      'userlog'=> infoLogin(),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'surat' => $this->Masuk_model->getById($id),
      'content'=> 'sekretaris/surat_ajuan/edit_form'
    );

    $this->load->view('sekretaris/template/main',$data);
  }

  public function edit()
  {
    $this->Masuk_model->editData();

    if($this->db->affected_rows()>0){
      $this->session->set_flashdata("success","Data user Berhasil DiUpdate");
    }

    redirect('surat_ajuan');
  }
  
  function delete($id)
  {
    $this->Masuk_model->delete($id);
    $this->db->query("ALTER TABLE tb_surat_masuk AUTO_INCREMENT = 1");
    redirect('surat_ajuan');
  }
}
