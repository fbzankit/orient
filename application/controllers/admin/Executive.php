<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Executive extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index($am_id) {

        $qry = "SELECT executive.* FROM executive WHERE executive.am_id = '".$am_id."' order by ex_id desc"; 
        $executives = $this->db->query($qry);
        // print_r($executives->result());die;
        // $sales_managers = $this->db->query($qry);
        // $config = array();
        // $config["base_url"] = base_url() . "admin/sales_manager/index".$state_id;
        // $config["total_rows"] = $sales_managers->num_rows();
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
        // $data["total_rows"] = $sales_managers->num_rows();
        // $data["curr_page"] = $this->pagination->cur_page;

        // $sales_managers = $this->db->query("$qry limit {$config['per_page']} offset {$page}");

        $allExecutives = array();
        if($executives->num_rows() > 0){
            $executiveAll = $executives->result_array();
            foreach ($executiveAll as $key => $executive) {
                // print_r($executive);die;
                $areasAll = $this->db->query("SELECT name FROM area_list WHERE id IN(" . $executive['districts_name'] . ")");
                $districts_names = $areasAll->result_array();
                // print_r($districts_names);die;
                $stArr = array();
                $executive['areasAll_name'] = '';
                foreach ($districts_names as $area_key => $area_name) {
                    array_push($stArr, $area_name['name']);
                }
                $sts = implode(',', $stArr);
                $executive['areasAll_name'] = $sts;
                $allAreas[] = $executive;

            }
        }else{
            $allAreas[] = '';
        }
        $data['executives'] = $allAreas;
        $data['am_idd'] = $am_id;
        


        $this->load->view('admin/header');
        $this->load->view('admin/executive/index', $data);
        $this->load->view('admin/footer');
    }

// Show registration page 
    public function add_ex($am_id) {
        if (!empty($this->input->post() && $this->input->post('districts') !== NULL)) {
            // $this->form_validation->set_rules('am_id', 'Area Manager', 'required');
            $this->form_validation->set_rules('ex_name', 'Executive Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $area_manager = $this->db->query("SELECT * FROM area_manager WHERE am_status='A' AND am_id='".$am_id."'");
                if($area_manager->num_rows() > 0){
                            // print_r($area_manager->row_array());
                    $areas = $area_manager->row_array();
                    $areasAll = $this->db->query("SELECT * FROM area_list WHERE id IN (".$areas['am_name'].")");
                    $data['districtAll'] = $areasAll->result_array();
                            // print_r($areasAll->result_array());die;
                }else{
                   $data['districtAll'] = '';
               }
               $data['am_idd'] = $am_id;
               $this->load->view('admin/header');
               $this->load->view('admin/executive/add_ex',$data);
               $this->load->view('admin/footer');
           } else {
           //             print_r($this->input->post());die;

                $districts_array = implode(',', $this->input->post('districts'));

                $values = array(
                    'am_id' => $am_id,
                    'districts_name' => $districts_array,
                    'ex_head_name' => $this->input->post('ex_name'),
                    'ex_status' => 'A',
                    'created_at' => date('Y-m-d H:i:s')
                );
                $u_values = array(
                    'name' => $this->input->post('ex_name'),
                    'emp_id' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'user_type' => '4'
                );

                $user = $this->db->query("SELECT * FROM users WHERE emp_id='" . $u_values['emp_id'] . "' OR email= '".$u_values['emp_id']."'");
                $u = $user->row_array();
                            // print_r($u);die;
                if (empty($u)) {
                    $query = $this->db->insert('users', $u_values);

                    $user_id = $this->db->insert_id();
                }else{
                    $user_id = $u['id'];
                }

                            // foreach ($this->input->post('states') as $key => $value) {
                            //      $this->db->update('state_list', array('state_user' => $user_id), "id =" . $value);
                            // }



                $url = 'admin/executive/index/'. $values['am_id'];
                $query = $this->db->insert('executive', $values);
                $this->session->set_flashdata('msg', 'Executive Added');
                redirect($url);

            }
        } else {


            $area_manager = $this->db->query("SELECT * FROM area_manager WHERE am_status='A' AND am_id='".$am_id."'");
            if($area_manager->num_rows() > 0){
                            // print_r($area_manager->row_array());
                $areas = $area_manager->row_array();
                $areasAll = $this->db->query("SELECT * FROM area_list WHERE id IN (".$areas['am_name'].")");
                $data['districtAll'] = $areasAll->result_array();
                            // print_r($areasAll->result_array());die;
            }else{
               $data['districtAll'] = '';
           }
           $data['am_idd'] = $am_id;
           $this->load->view('admin/header');
           $this->load->view('admin/executive/add_ex',$data);
           $this->load->view('admin/footer');
        }
    }// Show registration page 
    
    public function sm_del($id) {

        if ($this->db->delete("sales_manager", "state_id=" . $id)) {

            $this->session->set_flashdata('msg', 'state Deleted Successfully.');

            redirect('admin/state');
        } else {

            $this->session->set_flashdata('msg', 'state Not Deleted Successfully.');

            redirect('admin/sales_manager');
        }
    }

    public function state_edit($id) {

        if ($id != '') {
            $state = $this->db->query("SELECT * FROM sales_manager WHERE state_id = '" . $id . "'");
            $data['state'] = $state->row_array();
//            print_r($data['state']['sm_name']);die;
            $this->load->view('admin/header');
            $this->load->view('admin/state/add_state', $data);
            $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('msg', 'Select state To Edit.');
            redirect('admin/sales_manager');
        }
    }

    public function state_update() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('sm_name', 'state Name', 'required');
            $this->form_validation->set_rules('state_id', 'state Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/header');
                $this->load->view('admin/state/add_state');
                $this->load->view('admin/footer');
            } else {
                $values = array(
                    'sm_name' => $this->input->post('sm_name'),
                    'state_id' => $this->input->post('state_id')
                );
                $this->db->where('state_id', $values['state_id']);
                $this->db->update('sales_manager', $values);
                $this->session->set_flashdata('msg', 'state Updated');
                redirect('admin/sales_manager');
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
        $this->db->update('sales_manager', array('sm_status' => $status), "state_id =" . $id);
        $this->session->set_flashdata('msg', 'state Status Updated.');
        redirect('admin/sales_manager');
    }

}

?>
