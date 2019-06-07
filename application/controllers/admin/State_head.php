<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class State_head extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index($zone_id) {
// print_r($zone_id);die;
        $qry = "SELECT state_head.*,zone_list.name as zone_name FROM state_head JOIN zone_list ON state_head.zone_id = zone_list.id WHERE zone_id = '".$zone_id."'  order by state_id desc";
        $states = $this->db->query($qry);
        // print_r($states->result());die;
        $config = array();
        $config["base_url"] = base_url() . "admin/state/index";
        $config["total_rows"] = $states->num_rows();
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
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['per_page'] = 20;
        $data['offset'] = $page;
        $data["total_rows"] = $states->num_rows();
        $data["curr_page"] = $this->pagination->cur_page;

        $states = $this->db->query("$qry limit {$config['per_page']} offset {$page}");
        if($states->num_rows() > 0){
            foreach ($states->result_array() as $key => $state) {
            $statesAll = $this->db->query("SELECT name FROM state_list WHERE id IN(" . $state['state_name'] . ")");
            $state_names = $statesAll->result_array();
            $stArr = array();
            $state['statesAll_name'] = '';
            foreach ($state_names as $state_key => $state_name) {
                array_push($stArr, $state_name['name']);
            }
            $sts = implode(',', $stArr);
           $state['statesAll_name'] = $sts;
            $allStates[] = $state;
            
        }
        }else{
             $allStates[] = '';
        }
        
        $data['states'] = $allStates;
        $data['num'] = $states->num_rows();

        $data['zone_idd'] = $zone_id;

        $this->load->view('admin/header');
        $this->load->view('admin/state/index', $data);
        $this->load->view('admin/footer');
    }

// Show registration page 
    public function add_state($zone_id) {
        if(!empty($zone_id)){
            if (!empty($this->input->post() && $this->input->post('states') !== NULL)) {
                // print_r($this->input->post());die;
                // $this->form_validation->set_rules('zone_id', 'Zone', 'required');
                // $this->form_validation->set_rules('states', 'states', 'required');
                $this->form_validation->set_rules('state_head_name', 'State Head Name', 'required');
                // $this->form_validation->set_rules('state_cities', 'state cities', 'required');
                $this->form_validation->set_rules('designation', 'Designation', 'required');
                $this->form_validation->set_rules('state_code', 'State Code', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                if ($this->form_validation->run() == FALSE) {
                    // echo '<pre>';
                    // print_r($this->form_validation);die;

                   $states = $this->db->query("SELECT * FROM state_list WHERE z_id='".$zone_id."' AND state_user='0'");
                   $data['statesAll'] = $states->result_array();
                   $data['zone_idd'] = $zone_id;
                   $this->load->view('admin/header');
                   $this->load->view('admin/state/add_state', $data);
                   $this->load->view('admin/footer');
               } else {



            $states_array = implode(',', $this->input->post('states'));

               
                $values = array(
                    'zone_id' => $zone_id,
                    'state_name' => $states_array,
                    'state_head_name' => $this->input->post('state_head_name'),
                    // 'state_cities' => $this->input->post('state_cities'),
                    'designation' => $this->input->post('designation'),
                    'state_code' => $this->input->post('state_code'),
                    'state_status' => 'A',
                    'created_at' => date('Y-m-d H:i:s')
                );
                $u_values = array(
                    'name' => $values['state_head_name'],
                    'emp_id' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'user_type' => '2'
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
// print_r($user_id);die;
                foreach ($this->input->post('states') as $key => $value) {
                     $this->db->update('state_list', array('state_user' => $user_id), "id =" . $value);
                }


                    $query = $this->db->insert('state_head', $values);
                    $this->session->set_flashdata('msg', 'state Added');
                    redirect('admin/state_head/index/'.$zone_id);
                
            }
        } else {

            $states = $this->db->query("SELECT * FROM state_list WHERE z_id='".$zone_id."' AND state_user='0'");
            $data['statesAll'] = $states->result_array();
            $data['zone_idd'] = $zone_id;
            $this->load->view('admin/header');
            $this->load->view('admin/state/add_state', $data);
            $this->load->view('admin/footer');
        }
    }else{
         $states = $this->db->query("SELECT * FROM state_list WHERE z_id='".$zone_id."' AND state_user='0'");
            $data['statesAll'] = $states->result_array();
            $data['zone_idd'] = $zone_id;
            $this->load->view('admin/header');
            $this->load->view('admin/state/add_state', $data);
            $this->load->view('admin/footer');
    }
}

// Show registration page 

public function state_del($id) {

    $states = $this->db->query("SELECT * FROM state_head WHERE state_id='" . $id . "'");
    $a = $states->row_array();
    $user = $this->db->query("UPDATE state_list SET state_user='0' WHERE id IN(".$a['state_name'].")");

    if ($this->db->delete("state_head", "state_id=" . $id)) {

        $this->session->set_flashdata('msg', 'state Deleted Successfully.');

//            redirect('admin/state');
        redirect($_SERVER['HTTP_REFERER']);
    } else {

        $this->session->set_flashdata('msg', 'state Not Deleted Successfully.');
        redirect($_SERVER['HTTP_REFERER']);
//            redirect('admin/state_head');
    }
}

public function state_edit($id) {

    if ($id != '') {
        $state = $this->db->query("SELECT * FROM state_head WHERE state_id = '" . $id . "'");
        $data['states'] = $state->row_array();
//            print_r($data);die;

        $zones = $this->db->query("SELECT * FROM zones WHERE zone_status='A'");
        $data['zones'] = $zones->result_array();
//            print_r($data);die;
        $this->load->view('admin/header');
        $this->load->view('admin/state/add_state', $data);
        $this->load->view('admin/footer');
    } else {
        $this->session->set_flashdata('msg', 'Select state To Edit.');
        redirect($_SERVER['HTTP_REFERER']);
//            redirect('admin/state_head/index');
    }
}

public function state_update() {
    if (!empty($this->input->post())) {
        $this->form_validation->set_rules('zone_id', 'Zone', 'required');
        $this->form_validation->set_rules('state_name', 'state Name', 'required');
        $this->form_validation->set_rules('state_head_name', 'State Head Name', 'required');
        $this->form_validation->set_rules('state_cities', 'state cities', 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'required');
        $this->form_validation->set_rules('state_code', 'State Code', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('state_id', 'state Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $zones = $this->db->query("SELECT * FROM zones WHERE zone_status='A'");
            $data['zones'] = $zones->result_array();

            $this->load->view('admin/header');
            $this->load->view('admin/state/add_state', $data);
            $this->load->view('admin/footer');
        } else {
            $values = array(
                'zone_id' => $this->input->post('zone_id'),
                'state_name' => $this->input->post('state_name'),
                'state_head_name' => $this->input->post('state_head_name'),
                'state_cities' => $this->input->post('state_cities'),
                'designation' => $this->input->post('designation'),
                'state_code' => $this->input->post('state_code'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'state_id' => $this->input->post('state_id')
            );
            $this->db->where('state_id', $values['state_id']);
            $this->db->update('state_head', $values);
            $this->session->set_flashdata('msg', 'state Updated');
            redirect('admin/state_head/');
        }
    } else {
        redirect($_SERVER['HTTP_REFERER']);
    }
}

public function state_update_status($id, $status) {
//        echo 'Id ->'.$id,'<br>';
//        echo 'status ->'.$status;die;
    $this->db->update('state_head', array('state_status' => $status), "state_id =" . $id);
    $this->session->set_flashdata('msg', 'state Status Updated.');
//        redirect('admin/state_head');
    redirect($_SERVER['HTTP_REFERER']);
}

}

?>
