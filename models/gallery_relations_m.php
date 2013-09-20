<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_Relations_m extends MY_Model {

    public function image_exists_in_gallery($gallery_id, $image_id)
    {
        $query = $this->db->get_where('photo_gallery_rel', array('image_id' => $image_id, 'gallery_id' => $gallery_id));

        if($query->num_rows() > 0) {
            return true;
        }

        return false;
    }
    /**
     * Gets all the images and return the ones not associated with the gallery as gallery_id NULL
     * 
     * @param  [type] $images     [description]
     * @param  [type] $gallery_id [description]
     * @return [type]             [description]
     */
    public function get_images($gallery_id)
    {

        $this->db->select('i.id, i.name, i.filename, i.description, i.width, i.height, pg_rel.gallery_id');
        $this->db->from('files AS i');
        $this->db->join('photo_gallery_rel AS pg_rel', 'pg_rel.image_id = i.id AND pg_rel.gallery_id = ' . $gallery_id, 'left');
        
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_images_in_gallery($gallery_id)
    {
        $this->db->select('i.id, i.name, i.filename, i.description, i.width, i.height, pg.name AS gallery_name');
        $this->db->from('files AS i');
        $this->db->join('photo_gallery_rel AS pg_rel', 'pg_rel.image_id = i.id AND pg_rel.gallery_id = ' . $gallery_id);
        $this->db->join('photo_gallery AS pg', 'pg.id = ' . $gallery_id);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }
    public function insert($input, $skip_validation=false)  
    {
        $this->db->insert('photo_gallery_rel', $input); 
    }

    public function remove_image($input)
    {
        $this->db->delete('photo_gallery_rel', $input);
    }

}

/* End of file gallery_relations_m.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/models/gallery_relations_m.php */