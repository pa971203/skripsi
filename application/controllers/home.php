<?php 
class home extends CI_Controller
{
public function index()

{
$data = array(
			'title' => 'Halaman HOME' , 
			'isi' => 'home',
			
		);


		//  Initiate curl


		$this->load->view('user/template/wrapper', $data);
}
}


