<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_Photo_Gallery extends Module {

    public $version = '0.1.0';

    public function info()
    {
        $this->lang->load('photo_gallery/gallery');

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
                'galleries' => array(
                    'name' => 'photo_gallery:title',
                    'uri' => 'admin/photo_gallery',
                    'shortcuts' => array(
                        array(
                            'name' => 'photo_gallery:add_title',
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
        $this->dbforge->drop_table('photo_gallery_rel');
        $this->dbforge->drop_table('photo_gallery');

        // Create the gallery schema
        $gallery_schema = "CREATE TABLE " . $this->db->dbprefix('photo_gallery') . " (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `description` text COLLATE utf8_unicode_ci NOT NULL,
            `thumbnail_id` char(15) DEFAULT NULL,
            `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `status` int(1) NOT NULL,
            `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_on` datetime DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) 
        ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

        // Create the gallery relationships schema
        $gallery_rel_schema = "CREATE TABLE " . $this->db->dbprefix('photo_gallery_rel') . " (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `gallery_id` int(10) unsigned NOT NULL,
                `image_id` char(15) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
        
        // Lets create the tables needed 
        if(!$this->db->query($gallery_schema)) {
            return false;
        }

        if(!$this->db->query($gallery_rel_schema)) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if($this->dbforge->drop_table('photo_gallery') && $this->dbforge->drop_table('photo_gallery_rel')) {
            return true;
        }

        return false;
    }

    public function upgrade($old_version)
    {
        
    }

}

/* End of file details.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/details.php */