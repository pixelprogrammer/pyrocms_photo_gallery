<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public $section = 'galleries';
    
    public function index()
    {
        $this->load->model('photo_gallery_m');

        $galleries = $this->photo_gallery_m->get_all_with_details();

        $this->template->set('galleries', $galleries)
                       ->set('title', 'Galleries')
                       ->build('admin/index');
    }

    public function create()
    {

        $this->load->model('photo_gallery_m');

        if($this->input->post('btn_action')) {
        
            // lets create a photo gallery
            // lets see if a slug was entered if not then
            // we will auto generate one for them

            $input = array(
                'name' => $this->input->post('name'),
                'slug' => $this->input->post('slug'),
                'description' => $this->input->post('description'),
                'status' => $this->input->post('status')
                );

            if($id = $this->photo_gallery_m->insert($input)) {

                $this->session->set_flashdata('success', 'Photo Gallery was created');
                if($this->input->post('btn_action') == 'save_exit') {
                    redirect('admin/photo_gallery');
                } else {
                    redirect('admin/photo_gallery/edit');
                }
            }

        }
        
        $this->template->set('title', 'Create a Photo Gallery')
                       ->build('admin/create');
    }

    public function edit($id)
    {
        $this->load->model('photo_gallery_m');
        $this->load->model('images_m');
        $this->load->model('gallery_relations_m');

        $gallery = $this->photo_gallery_m->get_gallery($id);
        $images = $this->gallery_relations_m->get_images($id);

        $this->template->set('title', 'Add Photos to ' . $gallery->name)
                       ->set('gallery', $gallery)
                       ->set('images', $images)
                       ->append_css('module::files.css')
                       ->append_js('module::gallery.js')
                       ->build('admin/edit');
    }

    public function add_image($ajax=false)
    {
        $this->load->model('gallery_relations_m');
        $success_message = 'Image was added successfully';
        $error_message = 'Image already exists';
        $input = array(
            'gallery_id' => $this->input->post('gallery_id'),
            'image_id' => $this->input->post('image_id')
        );

        if($this->gallery_relations_m->image_exists_in_gallery($input['image_id'])) {
            //error
            if($ajax) {
                echo json_encode(array(
                    'message' => $error_message,
                    'type' => 'error',
                    'location' => ''
                    ));
                exit();
            } else {
                $this->session->set_flashdata('error', $error_message);
                redirect('admin/photo_gallery/edit/' . $this->input->post('gallery_id'));
            }
        }

        $this->gallery_relations_m->insert($input);
        // success
        if($ajax) {
            echo json_encode(array(
                'message' => $success_message,
                'type' => 'success',
                'location' => 'added'));
            exit();  
        } else {
            $this->session->set_flashdata('success', $success_message);
            redirect('admin/photo_gallery/edit/' . $this->input->post('gallery_id'));
        }
    }
}

/* End of file admin.php */
/* Location: .//Applications/MAMP/htdocs/pyro_test/addons/shared_addons/modules/photo_gallery/controllers/admin.php */