<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index($ex_id) {

        $qry = "SELECT distributor.*,executive.ex_name FROM distributor JOIN executive ON distributor.ex_id = executive.ex_id WHERE distributor.ex_id = '".$ex_id."' order by ex_id desc"; 
        // $executives = $this->db->query($qry);
        // $config = array();
        // $config["base_url"] = base_url() . "admin/executive/index".$state_id;
        // $config["total_rows"] = $executives->num_rows();
        // $config["per_page"] = 20;
        // $config["uri_segment"] = 4;
        // $config['full_tag_open'] = '<ul class="pagination">';
        // $config['full_tag_close'] = '</ul><!--pagination-->';
        // $config['first_link'] = '&laquo; First';
        // $config['first_tag_open'] = '<li class="prev page">';
        // $config['first_tag_close'] = '</li>';
        // $config['last_link'] = 'Last &raquo;';
        // $config['last_tag_open'] = '<li class="next page">';
        // $config['last_tag_close'] = '</li>';
        // $config['next_link'] = 'Next &rarr;';
        // $config['next_tag_open'] = '<li class="next page">';
        // $config['next_tag_close'] = '</li>';
        // $config['prev_link'] = '&larr; Previous';
        // $config['prev_tag_open'] = '<li class="prev page">';
        // $config['prev_tag_close'] = '</li>';
        // $config['cur_tag_open'] = '<li class="active"><a href="">';
        // $config['cur_tag_close'] = '</a></li>';
        // $config['num_tag_open'] = '<li class="page">';
        // $config['num_tag_close'] = '</li>';
        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // $data["links"] = $this->pagination->create_links();
        // $data['per_page'] = 20;
        // $data['offset'] = $page;
        // $data["total_rows"] = $executives->num_rows();
        // $data["curr_page"] = $this->pagination->cur_page;

        // $executives = $this->db->query("$qry limit {$config['per_page']} offset {$page}");
        $distributors = $this->db->query($qry);
        $data['distributors'] = $distributors->result();
        // $data['num'] = $executives->num_rows();

        $executives = $this->db->query("SELECT * FROM executive WHERE ex_id = '".$ex_id."'");
        $data['executives'] = $executives->result();
        $data['ex_idd'] = $ex_id;
// echo "<pre>"; print_r($data);die;
        $this->load->view('admin/header');
        $this->load->view('admin/distributor/index', $data);
        $this->load->view('admin/footer');
    }

// Show registration page 
    public function add_dis($ex_id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('ex_id', 'Area Manager', 'required');
            $this->form_validation->set_rules('dis_name', 'distributor Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {

                $executive = $this->db->query("SELECT * FROM executive WHERE ex_status='A' AND ex_id='".$ex_id."'");
                $data['executive'] = $executive->row_array();

                $this->load->view('admin/header');
                $this->load->view('admin/distributor/add_dis',$data);
                $this->load->view('admin/footer');
            } else {
   //             print_r($this->input->post());die;
                $values = array(
                    'ex_id' => $this->input->post('ex_id'),
                    'dis_name' => $this->input->post('dis_name'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'dis_status' => 'A',
                    'created_at' => date('Y-m-d H:i:s')
                );
//                print_r($values);die;
                $distributor = $this->db->query("SELECT * FROM distributor WHERE dis_name='" . $values['dis_name'] . "'");
                $a = $distributor->result();
                $url = 'admin/distributor/index/'. $values['ex_id'];
                if (empty($a)) {
                    $query = $this->db->insert('distributor', $values);
                    $this->session->set_flashdata('msg', 'distributor Added');

                    redirect($url);
                } else {
                    $this->session->set_flashdata('msg', 'distributor Already Exist');
                    redirect($url);
                }
            }
        } else {

            $executive = $this->db->query("SELECT * FROM executive WHERE ex_status='A' AND ex_id='".$ex_id."'");
            $data['executive'] = $executive->row_array();

            $this->load->view('admin/header');
            $this->load->view('admin/distributor/add_dis',$data);
            $this->load->view('admin/footer');
        }
    }// Show registration page 
    
    public function ex_del($id) {

        if ($this->db->delete("executive", "state_id=" . $id)) {

            $this->session->set_flashdata('msg', 'state Deleted Successfully.');

            redirect('admin/state');
        } else {

            $this->session->set_flashdata('msg', 'state Not Deleted Successfully.');

            redirect('admin/executive');
        }
    }

    public function state_edit($id) {

        if ($id != '') {
            $state = $this->db->query("SELECT * FROM executive WHERE state_id = '" . $id . "'");
            $data['state'] = $state->row_array();
//            print_r($data['state']['ex_name']);die;
            $this->load->view('admin/header');
            $this->load->view('admin/state/add_state', $data);
            $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('msg', 'Select state To Edit.');
            redirect('admin/executive');
        }
    }

    public function state_update() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('ex_name', 'state Name', 'required');
            $this->form_validation->set_rules('state_id', 'state Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/header');
                $this->load->view('admin/state/add_state');
                $this->load->view('admin/footer');
            } else {
                $values = array(
                    'ex_name' => $this->input->post('ex_name'),
                    'state_id' => $this->input->post('state_id')
                );
                $this->db->where('state_id', $values['state_id']);
                $this->db->update('executive', $values);
                $this->session->set_flashdata('msg', 'state Updated');
                redirect('admin/executive');
            }
        } else {
            $this->load->view('admin/header');
            $this->load->view('admin/state/add_state');
            $this->load->view('admin/footer');
        }
    }

    public function state_update_status($id,$status) {
//        echo 'Id ->'.$id,'<br>';
//        echo 'status ->'.$status;die;
        $this->db->update('executive', array('ex_status' => $status), "state_id =" . $id);
        $this->session->set_flashdata('msg', 'state Status Updated.');
        redirect('admin/executive');
    }

}

?>
