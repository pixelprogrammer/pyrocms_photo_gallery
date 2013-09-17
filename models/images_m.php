<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images_m extends MY_Model {

    /**
     * get all uploaded images
     * @return [mixed] array of image file objects or false if none found
     */
    public function get_all()
    {
        $this->db->select('id, name, filename, description, width, height, alt_attribute');
        $query = $this->db->get_where('files', array('type' => 'i'));

        if($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

}

/* End of file images_m.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/models/images_m.php */