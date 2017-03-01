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

        /* The rest of the Cloudinary library is available using it's namespace "\Cloudinary\"
        To see it in action, uncomment code line below and replace "url_to_image" with an image url
        and when the welcome page loads it will upload to your Cloudinary account and return a response object
        in the $data['imageupload'] array.

        -- See Cloudinary PHP API docs for additional examples.
        */

        // $data['imageupload'] = \Cloudinary\Uploader::upload("url_to_image");

		$this->load->view('welcome_message',$data);
	}
}
