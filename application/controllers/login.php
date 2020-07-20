<?php 
class login extends CI_Controller
{
public function index()

{
$data ['judul'] = 'halaman Login';
$this->load->view('admin/tl/header', $data);
$this->load->view('admin/login/index');
$this->load->view('admin/tl/footer');
}
}

