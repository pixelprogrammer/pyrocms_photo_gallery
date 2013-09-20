<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugin_Photo_Gallery extends Plugin {

    public $version = '0.1.0';
    public $name = array(
        'en' => 'Photo Gallery');

    public static $first = true;

    public $description = array(
        'en' => 'A plugin to display the Photo Galleries');

    /**
     * Gets the gallery images specific to the gallery
     *
     * Usage:
     *
     * {{ photo_gallery:gallery_images id="1" }}
     *     {{ name }}
     *     {{ id }}
     *     {{ description }}
     * {{ /photo_gallery:gallery_images }}
     * 
     * @return [type] [description]
     */
    public function gallery_images($gallery_id=false) {
        $this->load->model('gallery_relations_m');

        if($gallery_id === false) {
            $gallery_id = $this->attribute('id', false);
        }
        
        if($gallery_id) {
            // lets get the images
            if($images = $this->gallery_relations_m->get_images_in_gallery($gallery_id)) {
                $image_array = array();
                foreach($images as $image) {
                    $image->gallery_name = str_replace(' ', '', $image->gallery_name);
                    $image->url_large = base_url() . 'files/large/' . $image->filename;

                    array_push($image_array, get_object_vars($image));
                    
                }

                return $image_array;
            }
        }
    }

    /**
     * This function gets all the galleries and images
     *
     * Usage:
     * {{ photo_gallery:all }}
     *     {{ gallery }}
     *         {{ gallery_name }}
     *         {{ images }}
     *             <img src="{{ full_url }}" title="description">
     *         {{ /images }}
     *     {{ /gallery }}
     * {{ /photo_gallery:all }}
     * 
     * @return [array]
     */
    public function all()
    {
        $this->load->model('photo_gallery_m');
        $this->load->model('gallery_relations_m');

        // first lets get all live galleries
        $galleries = $this->photo_gallery_m->get_all();

        $gallery_array = array();
        foreach($galleries as $gallery) {
            $gallery = get_object_vars($gallery);
            $gallery['images'] = $this->gallery_images($gallery['id']);
            // add a default thumbnail if none exists
            if($gallery['thumbnail_id'] == NULL) {
                $gallery['thumbnail_id'] = $gallery['images'][0]['filename'];
            }

            array_push($gallery_array, $gallery);
        }
        
        return $gallery_array;
        // return $test;
    }

    public function loop_counter()
    {
        static $counter = array();

        $identifier = $this->attribute('identifier') ? $this->attribute('identifier') : 'default';

        if($this->attribute('start') != NULL) {
            $counter[$identifier] = (int)$this->attribute('start');
            return;
        }

        // calculate the step
        if($this->attribute('step') != NULL && is_numeric((int)$this->attribute('step'))) {
            $counter[$identifier] += (int)$this->attribute('step');
        }

        if($this->attribute('true_every')) {
            // this will return true every number of sequences
            if($counter[$identifier]%(int)$this->attribute('true_every') == 0){
                return true; // the counter is divisible by the number
            }

            return false;
        }

        if(!$this->attribute('show') || !$this->attribute('show') == 'false') {
            return $counter[$identifier];
        }

    }

}

/* End of file plugin.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/plugin.php */