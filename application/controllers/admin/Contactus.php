<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {

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
        $contact_us = $this->db->query("SELECT * FROM contact_us");
        $data['contact_us'] = $contact_us->row_array();
//            print_r($data);die;
        $this->load->view('admin/header');
        $this->load->view('admin/contactus/add_contact', $data);
        $this->load->view('admin/footer');
    }

    public function contactus_update() {
//        print_r($this->input->post());die;
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('contact', 'Contact', 'required');
            $this->form_validation->set_rules('address', 'Contact', 'required');
            $this->form_validation->set_rules('website', 'Contact', 'required');
            $this->form_validation->set_rules('facebook', 'Contact', 'required');
            $this->form_validation->set_rules('whatsapp', 'Contact', 'required');
            $this->form_validation->set_rules('contact_id', 'Contact Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                redirect('admin/contactus');
            } else {
                $values = array(
                    'contact' => $this->input->post('contact'),
                    'address' => $this->input->post('address'),
                    'website' => $this->input->post('website'),
                    'facebook' => $this->input->post('facebook'),
                    'whatsapp' => $this->input->post('whatsapp'),
                    'contact_id' => $this->input->post('contact_id')
                );
                $this->db->where('contact_id', $values['contact_id']);
                $this->db->update('contact_us', $values);
                $this->session->set_flashdata('msg', 'Contact us Cotent Updated');
                redirect('admin/contactus');
            }
        } else {
            redirect('admin/contactus');
        }
    }

}

?>
