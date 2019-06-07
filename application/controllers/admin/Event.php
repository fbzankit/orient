<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        $qry = "SELECT * FROM event order by event_id desc";
        $event = $this->db->query($qry);
        $data['events'] = $event->result();
        $this->load->view('admin/header');
        $this->load->view('admin/event/index', $data);
        $this->load->view('admin/footer');
    }

    public function event_del($id) {

        $this->db->where('event_id', $id);
        if ($this->db->delete('event')) {
            $this->session->set_flashdata('msg', 'Event Deleted Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('msg', 'Event Not Deleted Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function add_event() {
        if (!empty($this->input->post())) {
//            print_r($_FILES);
//            die('here');
            $this->form_validation->set_rules('event_heading', 'Event Heading', 'required');
            $this->form_validation->set_rules('event_location', 'Event Location', 'required');
            $this->form_validation->set_rules('event_description', 'Event Description', 'required');
            if ($this->form_validation->run() == FALSE) {
                $qry = "SELECT * FROM event order by event_id desc";
                $event = $this->db->query($qry);
                $data['events'] = $event->result();
//        print_r($data);die;
                $this->load->view('admin/header');
                $this->load->view('admin/event/add_event', $data);
                $this->load->view('admin/footer');
            } else {
//                print_r($this->input->post());die;
                if (!empty($_FILES['event_image'])) {
//                    print_r($_FILES);
//            die('here1');
                    $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/includes/img/event';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = time() . $_FILES['event_image']['name'];
                    $config['file_type'] = $_FILES['event_image']['type'];
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('event_image')) {
                        $uploadData = $this->upload->data();
//                print_r($uploadData);die;
                        $picture = $uploadData['file_name'];
                    } else {
                        $picture = '';
                    }
                } else {
                    $picture = '';
                }

                $values = array(
                    'event_heading' => $this->input->post('event_heading'),
                    'event_image' => $picture,
                    'event_location' => $this->input->post('event_location'),
                    'event_description' => $this->input->post('event_description'),
                    'created_at' => date('Y-m-d H:i:s')
                );

//                print_r($values);die;
                $event = $this->db->query("SELECT * FROM event WHERE event_heading='" . $values['event_heading'] . "'");
                $a = $event->result();
                if (empty($a)) {
                    $query = $this->db->insert('event', $values);
                    $this->session->set_flashdata('msg', 'Event Added');
//                    redirect('admin/event');
                } else {
                    $this->session->set_flashdata('msg', 'Event Already Exist');
                }

                redirect('admin/event/index');
            }
        } else {
                $qry = "SELECT * FROM event order by event_id desc";
                $event = $this->db->query($qry);
                $data['events'] = $event->result();


            $this->load->view('admin/header');
            $this->load->view('admin/event/add_event', $data);
            $this->load->view('admin/footer');
        }
    }

    public function event_edit($id) {
        if ($id != '') {
            $event = $this->db->query("SELECT * FROM event WHERE event_id = '" . $id . "'"); 
            $data['events'] = $event->row_array();
//            print_r($data);die; 
            $this->load->view('admin/header');
            $this->load->view('admin/event/add_event', $data);
            $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('msg', 'Select Event To Edit.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function event_update() {
//        $data['catIdUrl'] = $catId;
//        $data['levelUrl'] = $level;
//        print_r($this->input->post());die;
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('event_heading', 'Event Heading', 'required');
            $this->form_validation->set_rules('event_location', 'Event Location', 'required');
            $this->form_validation->set_rules('event_description', 'Event Description', 'required');
            $this->form_validation->set_rules('event_id', 'Event Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                if (!empty($_FILES['event_image'])) {
//                    print_r($_FILES);die;
                    $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/includes/img/event';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = time() . $_FILES['event_image']['name'];
                    $config['file_type'] = $_FILES['event_image']['type'];
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('event_image')) {
                        $uploadData = $this->upload->data();
//                print_r($uploadData);die;
                        $picture = $uploadData['file_name'];
                    } else {
                        $picture = $this->input->post('event_image_name');
                    }
                } else {
                    $picture = $this->input->post('event_image_name');
                }
                $values = array(
                    'event_heading' => $this->input->post('event_heading'),
                    'event_location' => $this->input->post('event_location'),
                    'event_description' => $this->input->post('event_description'),
                    'event_id' => $this->input->post('event_id'),
                    'event_image' => $picture
                );
//                echo "<pre>";
//                print_r($values);die;
                $this->db->where('event_id', $values['event_id']);
                $this->db->update('event', $values);
                $this->session->set_flashdata('msg', 'Event Updated');
                redirect('admin/event/');
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function zone_update_status($id, $status) {
//        echo 'Id ->'.$id,'<br>';
//        echo 'status ->'.$status;die;
        $this->db->update('event', array('zone_status' => $status), "zone_id =" . $id);
        $this->session->set_flashdata('msg', 'Event Status Updated.');
        redirect('admin/zone');
    }

}

?>
