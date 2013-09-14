<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_Photo_Gallery extends Module {

    public $version = '1.0.0';

    public function info()
    {   
        $info = array(
            'name' => array(
                'en' => 'Photo Gallery'),
            'description' => array(
                'en' => 'Create Photo Galleries for your website'),
            'frontend' => true,
            'backend' => true,
            'skip_xss' => true,
            'menu' => 'content',
            'sections' => array(
                'gallery' => array(
                    'name' => 'gallery:title',
                    'uri' => 'admin/photo_gallery',
                    'shortcuts' => array(
                        array(
                            'name' => 'gallery:add_title',
                            'uri' => 'admin/photo_gallery/create',
                            'class' => 'add',
                        ),
                    ),
                ),
            ),
        );

        return $info;
    }

    public function install()
    {
        $this->dbforge->drop_table('photo_galleries');
        $this->dbforge->drop_table('photo_gallery');

        // Create the gallery schema
        $gallery_schema = "CREATE TABLE " . $this->db->dbprefix('photo_gallery') . " (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `description` text COLLATE utf8_unicode_ci NOT NULL,
            `thumbnail_id` int(11) unsigned NOT NULL,
            `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `status` int(1) NOT NULL,
            `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_on` datetime DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) 
        ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

        if(!$this->db->query($gallery_schema)) {
            $this->session->set_flashdata('error', 'There was an error creating the photo gallery database table');
            return false;

        }

        return true;
    }

    public function uninstall()
    {
        if(!$this->dbforge->drop_table('photo_gallery')) {
            return false;
        }

        return true;
    }

    public function upgrade($old_version)
    {
        
    }

}

/* End of file details.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/details.php */