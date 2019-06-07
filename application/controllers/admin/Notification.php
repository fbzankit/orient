<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        $qry = "SELECT * FROM notification order by id desc";
        $notification = $this->db->query($qry);
        $data['notifications'] = $notification->result();
//        print_r($data);
//        die;

        $this->load->view('admin/header');
        $this->load->view('admin/notification/index', $data);
        $this->load->view('admin/footer');
    }

// Show registration page
    public function add_notification() {

        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg', validation_errors());
                $this->load->view('admin/header');
                $this->load->view('admin/notification/index', $data);
                $this->load->view('admin/footer');
            } else {
                $values = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                $query = $this->db->insert('notification', $values);
                $this->session->set_flashdata('msg', 'notification Added');
                redirect('admin/notification');
            }
        } else {
            $this->load->view('admin/header');
            $this->load->view('admin/notification/add_notification');
            $this->load->view('admin/footer');
        }
    }

}

?>
