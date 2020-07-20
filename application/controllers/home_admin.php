<?php 
class home_admin extends CI_Controller
{
public function index()

{
$data ['judul'] = 'halaman home';
$this->load->view('admin/template/header', $data);
$this->load->view('admin/template/nav');
$this->load->view('admin/home/index');
$this->load->view('admin/template/footer');
}
}

