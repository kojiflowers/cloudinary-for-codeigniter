# cloudinary-for-codeigniter
This repo demonstrates how to integrate the latest Cloudinary API PHP library into CodeIgniter 3 using a dummy library.  

This dummy library technique can be used to get around CodeIgniter 3's issues with loading libraries dependent on namespaces like Cloudinary's.

**This project is still very much in development | Master branch is the main branch. / Dev branch is the working branch.**

**The Problem**

As I found out on a project just a little while ago, CodeIgniter 3 does not play nice with "libraries" that use PHP namespaces and that are directly loaded within the "libraries" folder.
This becomes a problem because several PHP based API services use namespaces both to initialize the library code and to interact with the API and thus, they are not as plug and play as desired.
Case in point: Cloudinary and their PHP API library.  If you try to load and use Cloudinary's PHP library the normal way in CodeIgniter, it breaks due to the heavy use of namespaces both to setup the API connection and throughout the library itself.

**The Solution**

Luckily, the solution is actually fairly easy to implement and involves just one extra step to indirectly load the Cloudinary library into CodeIgniter via a "dummy" library.  

**Implementing the Solution:**

1. In the CodeIgniter "application/libraries"" folder put your "cloudinary" folder (containing the Cloudinary PHP API library) and the file called Cloudinarylib.php (this is the dummy library).
2. in "Cloudinarylib.php" replace the api info with your actual api info:
```php
<?php
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
```

**Using The Cloudinary Library Within CodeIgniter**

Once the above steps are completed, your Cloudinary API library will be availabe via the "cloudinarylib" name and can be loaded like any other CodeIgniter library.
Below is my example, using the standard welcome page controller and the "sample" image from Cloudinary:

```php
	<?php
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

		$this->load->view('welcome_message',$data);
	}
}
```

In your view, you echo the variable like you normally would to display the image:
```php
<?php echo $image; ?>
```
