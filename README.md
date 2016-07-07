# cloudinary-for-codeigniter

This repo demonstrates how to integrate the latest Cloudinary API PHP library into CodeIgniter 3 using a dummy library.  

This dummy library technique can be used to get around CodeIgniter 3's issues with loading libraries dependent on namespaces like Cloudinary's.

_This project is still very much in development | Master branch is the main branch. / Dev branch is the working branch._

**Integrate Cloudinary PHP API Library into CodeIgniter**

1. Clone this project (if you haven't already)

2. In the CodeIgniter "application/libraries" folder, put your "cloudinary" folder (containing the Cloudinary PHP API library) and the file called Cloudinarylib.php (located in the "cloudinary-for-codeigniter" folder).

3. Open the "Cloudinarylib.php" file and replace the placeholder API connect info with your actual API connect info:

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

4. Once the above steps are completed, your Cloudinary API library will be availabe via the "cloudinarylib" name and can be loaded like any other CodeIgniter library.

Below is from the CodeIgniter sample site within the Example folder which uses the standard welcome page controller and the "sample" image from Cloudinary:

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

In your welcome_page view, echo the variable like you normally would to display the image:
```php
<?php echo $image; ?>
```

If done correctly, you should see an image popup at the bottom of your welcome page.

**Additional Info**

Feel free to fork this project and make some cool stuff with it.  It is still early stage but I welcome help from the dev community.

For updates and/or other stuff to check out, visit my [blog](http://kojiflowers.com/my-blog) or follow me on [Twitter: @KojiFlowers](http://twitter.com/kojiflowers).
