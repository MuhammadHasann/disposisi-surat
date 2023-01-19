<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
  public function index()
  {
    $data = array(
      'title' => 'dashboard',
      'content' => 'admin/dashboard/index'
    );
    $this->load->view('admin/template/main', $data);
  }
}