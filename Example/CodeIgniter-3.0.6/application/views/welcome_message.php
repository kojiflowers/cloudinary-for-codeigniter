<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Using the Cloudinary PHP API library in CodeIgniter</title>

    <style type="text/css">

        ::selection { background-color: #E13300; color: white; }
        ::-moz-selection { background-color: #E13300; color: white; }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        pre {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>

<div id="container">
    <h1>Cloudinary API and CodeIgniter</h1>

    <div id="body">
        <h4>Integrate Cloudinary PHP API Library into CodeIgniter:</h4>
        <p>1. Clone this project out on <a target="_blank" title="cloudinary-for-codeigniter on github" href="https://github.com/kojiflowers/cloudinary-for-codeigniter">GitHub</a> if you haven't already.</p>
        <p>2. In the CodeIgniter "application/libraries" folder, put your "cloudinary" folder (containing the Cloudinary PHP API library) and the file called Cloudinarylib.php (located in the "cloudinary-for-codeigniter" folder).</p>
        <p>3. Open the "Cloudinarylib.php" file and replace the placeholder API connect info with your actual API connect info:</p>
        <pre>
&lt;?php
defined('BASEPATH') OR exit('No direct script access allowed');

// setup the dummy class for Cloudinary
class Cloudinarylib {

    public function __construct()
    {

        // include the cloudinary library within the dummy class
        require('cloudinary/src/Cloudinary.php');
        require 'cloudinary/src/Uploader.php';
        require 'cloudinary/src/Api.php';

        \Cloudinary::config(array(
            "cloud_name" => "your_cloud_name",
            "api_key" => "your_api_key", /*874837483274837*/
            "api_secret" => "your_api_secret" /* a676b67565c6767a6767d6767f676fe1 */
        ));
    }
}
	</pre>

        <h4>Using The Cloudinary Library Within CodeIgniter</h4>
        <p>4. Once the above steps are completed, your Cloudinary API library will be availabe via the "cloudinarylib" name and can be loaded like any other CodeIgniter library.</p>
        <p>Below is from the CodeIgniter sample site within the Example folder which uses the standard welcome page controller and the "sample" image from Cloudinary:</p>
        <pre>
	&lt;?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			// load the cloudinary dummy library
			$this->load->library('cloudinarylib');
		}

	public function index()
	{

		// execute cloudinary api call to grab sample image and assign to $image variable in the view
		$data['image'] = cl_image_tag("sample.jpg", array( "alt" => "Sample Image" ));

        /* The rest of the Cloudinary library is available using it's namespace "\Cloudinary\"
        To see it in action, uncomment code line below and replace "url_to_image" with an image url
        and when the welcome page loads it will upload to your Cloudinary account and return a response object
        in the $data['imageupload'] array.

        -- See Cloudinary PHP API docs for additional examples.
        */

        //$data['imageupload'] = \Cloudinary\Uploader::upload("https://kojiflowers.com/wp-content/uploads/2017/01/vide-1050x478.png");

		$this->load->view('welcome_message',$data);
	}
}
	</pre>

        <p> In the view, you echo the variable like you normally would:</p>
        <pre>
&lt;?php echo $image; ?&gt;
		</pre>
        <p>If done correctly, your image should load here:</p>
        <?php echo $image; ?>
        <br />
        <p>As for the rest of the library, now you can access it by using the "\Cloudinary\" namespace in whichever class you have loaded the Cloudinary library.</p>
        <pre>
            $data['imageupload'] = \Cloudinary\Uploader::upload("https://kojiflowers.com/wp-content/uploads/2017/01/vide-1050x478.png");
        </pre>
        <p>This example will execute the image upload when the Welcome page loads.</p>

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>