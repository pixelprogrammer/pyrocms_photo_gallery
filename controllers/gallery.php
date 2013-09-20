<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends Public_Controller {

    public function index()
    {   
        $this->template->build('gallery');
    }

}

/* End of file gallery.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/controllers/gallery.php */