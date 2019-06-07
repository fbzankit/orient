<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        $banner = $this->db->query("SELECT * FROM banner");
        $data['banners'] = $banner->result();
        $this->load->view('admin/header');
        $this->load->view('admin/banner/banner_list', $data);
        $this->load->view('admin/footer');
    }

    public function add_banner() {
        if (isset($_FILES['banner_image'])) {
            $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/includes/img/banner';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = time() . $_FILES['banner_image']['name'];
            $config['file_type'] = $_FILES['banner_image']['type'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('banner_image')) {
                $uploadData = $this->upload->data();
//                print_r($uploadData);die;
                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }
            $values = array(
                'image' => $picture
            );
            $query = $this->db->insert('banner', $values);
            $this->session->set_flashdata('msg', 'Banner Added');
            redirect('admin/banner');

            $this->load->view('admin/header');
            $this->load->view('admin/banner/add_banner');
            $this->load->view('admin/footer');
        } else {

            $this->load->view('admin/header');
            $this->load->view('admin/banner/add_banner');
            $this->load->view('admin/footer');
        }
    }

    public function banner_del($id) {
        if ($this->db->delete("banner", "id=" . $id)) {
            $this->session->set_flashdata('msg', 'Banner Deleted Successfully.');
            redirect('admin/banner');
        } else {
            $this->session->set_flashdata('msg', 'banner Not Deleted Successfully.');
            redirect('admin/banner');
        }
    }

    public function banner_edit($id) {
        $banner = $this->db->query("SELECT * FROM banner where id='".$id."'");
        $data['banners'] = $banner->row_array();
        
        print_r($data);die;
        
        $this->load->view('admin/header');
        $this->load->view('admin/banner/add_banner');
        $this->load->view('admin/footer');
    }

}
