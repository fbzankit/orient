<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller {

    function __construct() {
        parent::__construct();
//die('hi');
        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        $about_us = $this->db->query("SELECT * FROM about_us");
        $data['about_us'] = $about_us->row_array();
//            print_r($data);die;
        $this->load->view('admin/header');
        $this->load->view('admin/aboutus/add_aboutus', $data);
        $this->load->view('admin/footer');
    }

    public function aboutus_update() {
//        print_r($this->input->post());die;
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('about_content', 'About Content', 'required');
            $this->form_validation->set_rules('about_id', 'About Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                redirect('admin/aboutus');
            } else {
                $values = array(
                    'about_content' => $this->input->post('about_content'),
                    'about_id' => $this->input->post('about_id')
                );
                $this->db->where('about_id', $values['about_id']);
                $this->db->update('about_us', $values);
                $this->session->set_flashdata('msg', 'About us Content Updated');
                redirect('admin/aboutus');
            }
        } else {
            redirect('admin/aboutus');
        }
    }

}

?>
