<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_Relations_m extends MY_Model {

    public function image_exists_in_gallery($image_id)
    {
        $query = $this->db->get_where('photo_gallery_rel', array('image_id' => $image_id));

        if($query->num_rows() > 0) {
            return true;
        }

        return false;
    }
    /**
     * This needs a rewrite. It should be done with a single query
     * 
     * @param  [type] $images     [description]
     * @param  [type] $gallery_id [description]
     * @return [type]             [description]
     */
    public function get_images($gallery_id)
    {
        $this->db->select('i.id, i.name, i.filename, i.description, i.width, i.height, pg.id AS gallery_id');
        $this->db->from('files AS i');
        $this->db->join('photo_gallery_rel AS pg_rel', 'pg_rel.image_id = i.id AND i.type="i"', 'left');
        $this->db->join('photo_gallery AS pg', 'pg.id = pg_rel.gallery_id AND pg.id = ' . $gallery_id, 'left');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_images_in_gallery($gallery_id)
    {
        
    }
    public function insert($input, $skip_validation=false)  
    {
        $this->db->insert('photo_gallery_rel', $input); 
    }

}

/* End of file gallery_relations_m.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/models/gallery_relations_m.php */