<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Zone extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        $qry = "SELECT zones.*, zone_list.name as zone_name , zone_list.id as z_id
        FROM zones 
        JOIN zone_list 
        ON zones.zone_name =  zone_list.id
        order by zone_id desc";
        $zones = $this->db->query($qry);
        $config = array();
        $config["base_url"] = base_url() . "admin/zone/index";
        $config["total_rows"] = $zones->num_rows();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['per_page'] = 20;
        $data['offset'] = $page;
        $data["total_rows"] = $zones->num_rows();
        $data["curr_page"] = $this->pagination->cur_page;

        $zones = $this->db->query("$qry limit {$config['per_page']} offset {$page}");
        $data['zones'] = $zones->result();
        $data['num'] = $zones->num_rows();

        $this->load->view('admin/header');
        $this->load->view('admin/zone/index', $data);
        $this->load->view('admin/footer');
    }

// Show registration page
    public function add_zone() {        
        if (!empty($this->input->post())) {
            // print_r($this->input->post());die;
            $this->form_validation->set_rules('zone_name', 'Zone Name', 'required');
            $this->form_validation->set_rules('zone_head_name', 'Zone Head Name', 'required');
            // $this->form_validation->set_rules('zone_states', 'Zone States', 'required');
            $this->form_validation->set_rules('designation', 'Designation', 'required');
            $this->form_validation->set_rules('zone_code', 'Zone Code', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/header');
                $this->load->view('admin/zone/add_zone');
                $this->load->view('admin/footer');
            } else {
                $values = array(
                    'zone_name' => $this->input->post('zone_name'),
                    'zone_head_name' => $this->input->post('zone_head_name'),
                    'designation' => $this->input->post('designation'),
                    'zone_code' => $this->input->post('zone_code'),
                    'zone_status' => 'A',
                    'created_at' => date('Y-m-d H:i:s')
                );
                $u_values = array(
                    'name' => $this->input->post('zone_head_name'),
                    'emp_id' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'user_type' => '1'
                );
//                print_r($values);die;
                $user = $this->db->query("SELECT * FROM users WHERE emp_id='" . $u_values['emp_id'] . "' OR email= '".$u_values['emp_id']."'");
                $u = $user->row_array();
                if (empty($u)) {
                    $query = $this->db->insert('users', $u_values);
                    $user_id = $this->db->insert_id();
                }else{
                    $user_id = $u['id'];
                }

                $zones = $this->db->query("SELECT * FROM zones WHERE zone_name='" . $values['zone_name'] . "'");
                $a = $zones->result();
                if (empty($a)) {
                    $query = $this->db->insert('zones', $values);
                    $qw = "UPDATE zone_list SET zone_user = '".$user_id."' WHERE id='" . $values['zone_name'] . "'";
                    $hello = $this->db->query($qw);
                    // print_r($hello);die;

                    $this->session->set_flashdata('msg', 'Zone Added');
                    redirect('admin/zone');
                } else {
                    $this->session->set_flashdata('msg', 'Zone Already Exist');
                    redirect('admin/zone');
                }
            }
        } else {
            $zone_list = $this->db->query("SELECT * FROM zone_list WHERE zone_user = '0'");
            $data['zonesAll'] = $zone_list->result_array();
            $this->load->view('admin/header');
            $this->load->view('admin/zone/add_zone',$data);
            $this->load->view('admin/footer');
        }
    }

    public function zone_del($id) {

        if ($this->db->delete("zones", "zone_id=" . $id)) {

            $this->session->set_flashdata('msg', 'Zone Deleted Successfully.');

            redirect('admin/zone');
        } else {

            $this->session->set_flashdata('msg', 'Zone Not Deleted Successfully.');

            redirect('admin/zone');
        }
    }

    public function zone_edit($id) {

        if ($id != '') {
            $zone = $this->db->query("SELECT * FROM zones WHERE zone_id = '" . $id . "'");
            $data['zone'] = $zone->row_array();
//            print_r($data['zone']['zone_name']);die;
            $this->load->view('admin/header');
            $this->load->view('admin/zone/add_zone', $data);
            $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('msg', 'Select Zone To Edit.');
            redirect('admin/zone');
        }
    }

    public function zone_update() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('zone_name', 'Zone Name', 'required');
            $this->form_validation->set_rules('zone_head_name', 'Zone Head Name', 'required');
            $this->form_validation->set_rules('zone_states', 'Zone States', 'required');
            $this->form_validation->set_rules('designation', 'Designation', 'required');
            $this->form_validation->set_rules('zone_code', 'Zone Code', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('zone_id', 'Zone Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/header');
                $this->load->view('admin/zone/add_zone');
                $this->load->view('admin/footer');
            } else {
                $values = array(
                    'zone_name' => $this->input->post('zone_name'),
                    'zone_head_name' => $this->input->post('zone_head_name'),
                    'zone_states' => $this->input->post('zone_states'),
                    'designation' => $this->input->post('designation'),
                    'zone_code' => $this->input->post('zone_code'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'zone_id' => $this->input->post('zone_id')
                );
                $this->db->where('zone_id', $values['zone_id']);
                $this->db->update('zones', $values);
                $this->session->set_flashdata('msg', 'Zone Updated');
                redirect('admin/zone');
            }
        } else {
            $this->load->view('admin/header');
            $this->load->view('admin/zone/add_zone');
            $this->load->view('admin/footer');
        }
    }

    public function zone_update_status($id,$status) {
//        echo 'Id ->'.$id,'<br>';
//        echo 'status ->'.$status;die;
        $this->db->update('zones', array('zone_status' => $status), "zone_id =" . $id);
        $this->session->set_flashdata('msg', 'Zone Status Updated.');
        redirect('admin/zone');
    }

}

?>
