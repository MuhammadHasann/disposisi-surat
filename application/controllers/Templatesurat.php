<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Templatesurat extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Template_model");

    cek_login();

    $this->load->library('form_validation');
  }

  public function index()
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'View Data History',
      'userlog'=> infoLogin(),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'template' => $this->Template_model->getAll(),
      'content'=> 'sekretaris/template_surat/index'
    );

    $this->load->view('sekretaris/template/main',$data);
  }

  public function surat_ajuan($id)
  {
    $surat = $this->Template_model->getById($id);
    $nama = $surat->nama;
    $perihal = $surat->perihal;
    $date = $surat->tgl_kirim;
    $kepada = $surat->tujuan_surat;
    // memanggil dan membaca template dokumen
    $alamat_file = base_url('assets/lap/contoh_surat.rtf');
    $document = file_get_contents($alamat_file);
    // isi dokumen dinyatakan dalam bentuk string
    $document = str_replace("#NAMA", $nama, $document);
    $document = str_replace("#PER", $perihal, $document);
    $document = str_replace("#SURAT_TO", $kepada, $document);
    $document = str_replace("#DATE", $date, $document);
    // header untuk membuka file output RTF dengan MS. Word
    header("Content-type: application/msword");
    header("Content-disposition: inline; filename=Laporan_contoh.rtf");
    header("Content-length: ".strlen($document));
    echo $document;
  }

  public function add()
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'Tambah Data Template Surat',
      'userlog'=> infoLogin(),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'content'=> 'sekretaris/template_surat/add_form'
    );

    $this->load->view('sekretaris/template/main',$data);
  }

  public function save()
  {
    $this->Template_model->save();

    if($this->db->affected_rows()>0){
      $this->session->set_flashdata("success","Data Surat Masuk Berhasil DiSimpan");
    }
    
    redirect('templatesurat');
  }

  public function getedit($id)
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'Update Data Template Surat',
      'userlog'=> infoLogin(),
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
      'surat' => $this->Template_model->getById($id),
      'content'=> 'sekretaris/template_surat/edit_form'
    );

    $this->load->view('sekretaris/template/main',$data);
  }

  public function edit()
  {
    $this->Template_model->editData();

    if($this->db->affected_rows()>0){
      $this->session->set_flashdata("success","Data user Berhasil DiUpdate");
    }

    redirect('templatesurat');
  }
  
  function delete($id)
  {
    $this->Template_model->delete($id);
    $this->db->query("ALTER TABLE tb_template_surat AUTO_INCREMENT = 1");
    redirect('templatesurat');
  }
}
