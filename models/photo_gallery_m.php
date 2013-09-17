<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_Gallery_m extends MY_Model {

    /**
     * Get all the photo galleries
     * 
     * @param  integer $limit  
     * @param  integer $offset 
     * @return [mixed] Photo Gallery Object or Boolean false if none found
     *
     * $gallery_object:
     *     ->id [int]
     *     ->name [string]
     *     ->description [string]
     *     ->slug [string]
     *     ->status [int boolean]
     *     ->thumnbnail_id [int] 0 if none found
     */
    public function get_all($limit=0, $offset=0)
    {   
        $this->db->select('*');
        $query = $this->db->get('photo_gallery');
        if($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    /**
     * much like the get_all function except it returns a number of photos within that gallery parameter to the object
     * 
     * @param  integer $limit  
     * @param  integer $offset 
     * @return [mixed]
     *
     * $gallery_object: (same as get_all and...)
     *     ->num_photos [int]
     */
    public function get_all_with_details($limit=0, $offset=0)
    {
        $this->db->select('photo_gallery.*, COUNT(' . $this->db->dbprefix('photo_gallery_rel.image_id') . ') as num_photos');
        // $this->db->select('photo_gallery.*, COUNT(photo_gallery_rel.image_id) as num_photos');
        $this->db->from('photo_gallery');
        $this->db->join('photo_gallery_rel', 'photo_gallery.id = photo_gallery_rel.gallery_id', 'left');
        $this->db->group_by('photo_gallery.id');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    /**
     * returns a gallery by its id
     * 
     * @param  [int] $id
     * @return [mixed] false if none was found and  
     */
    public function get_gallery($id)
    {
        $query = $this->db->get_where('photo_gallery', array('id' => $id));

        if($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }
    
    public function update($id, $input=array(), $skip_validation=false)
    {
        
    }

    public function insert($input=array(), $skip_validation=false)
    {
        if($input['slug'] == '' || $input['slug'] === NULL) {
            $input['slug'] = str_replace(' ', '-', strtolower($input['name']));
        }

        $this->db->insert('photo_gallery', $input);
        return $this->db->insert_id();
    }

}

/* End of file galleries_m.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/models/galleries_m.php */