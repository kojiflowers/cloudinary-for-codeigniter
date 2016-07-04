<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// load Cloudinary PHP API library normally using lowercase "dummy" filename
		$this->load->library('cloudinarylib');
	}


	public function index()
	{
		// use Cloudinary PHP API library to load image from Cloudinary
		$data['image'] = cl_image_tag("sample.jpg", array( "alt" => "Sample Image" ));

		$this->load->view('welcome_message',$data);
	}
}
