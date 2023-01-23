<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
  public function index()
  {
    $user_id = $this->session->userdata('id');
    $data = array(
      'title' => 'dashboard',
      'content' => 'admin/dashboard/index',
      'user' => $this->db->where('is_active',1)->where('id', $user_id)->get('tb_user')->result(),
    );
    $this->load->view('admin/template/main', $data);
  }
}