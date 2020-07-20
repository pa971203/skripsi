<?php 
class gis extends CI_Controller
{
public function index()

{
$data = array(
			'title' => 'Halaman Peta sebaran' , 
			'isi' => 'gis',
			
		);


		//  Initiate curl


		$this->load->view('user/template/wrapper', $data);
}
}


