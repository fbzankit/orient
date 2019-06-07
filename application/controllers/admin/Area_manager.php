<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Area_manager extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index($state_id) {
// print_r($state_id);die;
        $qry = "SELECT area_manager.*, state_head.state_head_name as state_name FROM area_manager JOIN state_head ON area_manager.state_id = state_head.state_id  order by am_id desc";
        $area_managers = $this->db->query($qry);
        // print_r($area_managers->result());die;
        // $config = array();
        // $config["base_url"] = base_url() . "admin/area_manager/index".$state_id;
        // $config["total_rows"] = $area_managers->num_rows();
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
        // $data["total_rows"] = $area_managers->num_rows();
        // $data["curr_page"] = $this->pagination->cur_page;
        // $area_managers = $this->db->query("$qry limit {$config['per_page']} offset {$page}");
        // $area_managers = $this->db->query($qry);
        // $data['area_managers'] = $area_managers->result_array();


        //////////
// print_r($area_managers->result_array());die;
        $allAreas = array();
        if($area_managers->num_rows() > 0){
            foreach ($area_managers->result_array() as $key => $area) {
                $areaAll = $this->db->query("SELECT name FROM area_list WHERE id IN(" . $area['am_name'] . ")");
                $area_names = $areaAll->result_array();
                $stArr = array();
                $area['areasAll_name'] = '';
                foreach ($area_names as $area_key => $area_name) {
                    array_push($stArr, $area_name['name']);
                }
                $sts = implode(',', $stArr);
                $area['areasAll_name'] = $sts;
                $allAreas[] = $area;

            }
        }else{
            $allAreas[] = '';
        }
        $data['areas'] = $allAreas;
        $data['state_idd'] = $state_id;

        // $data['num'] = $area_managers->num_rows();
        
        $this->load->view('admin/header');
        $this->load->view('admin/area_manager/index', $data);
        $this->load->view('admin/footer');
    }

// Show registration page 
    public function add_am($state_id) {
        if(!empty($state_id)){
            if (!empty($this->input->post() && $this->input->post('areas') !== NULL)) {
            // $this->form_validation->set_rules('state_id', 'State', 'required');
            // $this->form_validation->set_rules('am_name', 'Area Name', 'required');
                $this->form_validation->set_rules('am_head_name', 'Head Area Manager Name', 'required');
            // $this->form_validation->set_rules('am_areas', 'Areas', 'required');
                $this->form_validation->set_rules('designation', 'Designation', 'required');
                $this->form_validation->set_rules('am_code', 'Code', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                if ($this->form_validation->run() == FALSE) {

                    $states = $this->db->query("SELECT state_name FROM state_head WHERE state_id='".$state_id."'");
                    $statesIds = $states->row_array();
                    if(!empty($statesIds['state_name'])){
                        $areas = $this->db->query("SELECT * FROM area_list WHERE state_id IN(".$statesIds['state_name'].") AND area_user='0'");
                        $data['areasAll'] = $areas->result_array();
                    }else{
                        $data['areasAll'] = array();
                    }
                    $data['state_idd'] = $state_id;
                    
                    $this->load->view('admin/header');
                    $this->load->view('admin/area_manager/add_am', $data);
                    $this->load->view('admin/footer');
                } else {
               // print_r($this->input->post());
                    $areas_array = implode(',', $this->input->post('areas'));

                    $values = array(
                        // 'state_id' => $this->input->post('state_id'),
                        'state_id' => $state_id,
                        'am_name' => $areas_array,
                        'am_head_name' => $this->input->post('am_head_name'),
                        // 'am_areas' => $this->input->post('am_areas'),
                        'designation' => $this->input->post('designation'),
                        'am_code' => $this->input->post('am_code'),
                        'am_status' => 'A',
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $u_values = array(
                        'name' => $values['am_head_name'],
                        'emp_id' => $this->input->post('username'),
                        'password' => $this->input->post('password'),
                        'user_type' => '3'
                    );
// print_r($values);die;
                    $user = $this->db->query("SELECT * FROM users WHERE emp_id='" . $u_values['emp_id'] . "' OR email= '".$u_values['emp_id']."'");
                    $u = $user->row_array();
                // print_r($u);die;
                    if (empty($u)) {
                        $query = $this->db->insert('users', $u_values);
                        $user_id = $this->db->insert_id();
                    }else{
                        $user_id = $u['id'];
                    }

                    foreach ($this->input->post('areas') as $key => $value) {
                       $this->db->update('area_list', array('area_user' => $user_id), "id =" . $value);
                   }

                   $query = $this->db->insert('area_manager', $values);
                   $this->session->set_flashdata('msg', 'AM Added');                        
                   redirect('admin/area_manager/index/'.$state_id);

               }
           } else {

            $data['state_idd'] = $state_id;
            $states = $this->db->query("SELECT state_name FROM state_head WHERE state_id='".$state_id."'");
            $statesIds = $states->row_array();
            // print_r($statesIds);die;
            if(!empty($statesIds['state_name'])){
                $areas = $this->db->query("SELECT * FROM area_list WHERE state_id IN(".$statesIds['state_name'].") AND area_user='0'");
           $data['areasAll'] = $areas->result_array();
            }else{
                $data['areasAll'] = array();
            }
           // $areas = $this->db->query("SELECT * FROM area_list WHERE state_id IN(".$statesIds['state_name'].") AND area_user='0'");
           // $data['areasAll'] = $areas->result_array();
           $this->load->view('admin/header');
           $this->load->view('admin/area_manager/add_am', $data);
           $this->load->view('admin/footer');
        }
    }else{

       $data['state_idd'] = $state_id;
       $areas = $this->db->query("SELECT * FROM area_list WHERE state_id='".$state_id."' AND area_user='0'");
       $data['areasAll'] = $areas->result_array();

       $this->load->view('admin/header');
       $this->load->view('admin/area_manager/add_am', $data);
       $this->load->view('admin/footer');
   }
}


// Show registration page 

public function am_del($id) {

    if ($this->db->delete("area_manager", "am_id=" . $id)) {

        $this->session->set_flashdata('msg', 'Aream manager Deleted Successfully.');

//            redirect('admin/state');
        redirect($_SERVER['HTTP_REFERER']);
    } else {

        $this->session->set_flashdata('msg', 'Area manager Not Deleted Successfully.');

//            redirect('admin/area_manager');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

public function am_edit($id) {

    if ($id != '') {
        $area_manager = $this->db->query("SELECT * FROM area_manager WHERE am_id = '" . $id . "'");
        $data['area_managers'] = $area_manager->row_array();
//            print_r($data['state']['am_name']);die;           

        $states = $this->db->query("SELECT * FROM state_head WHERE state_status='A'");
        $data['states'] = $states->result_array();

        $this->load->view('admin/header');
        $this->load->view('admin/area_manager/add_am', $data);
        $this->load->view('admin/footer');
    } else {
        $this->session->set_flashdata('msg', 'Select Area manager To Edit.');
//            redirect('admin/area_manager');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

public function am_update() {
    if (!empty($this->input->post())) {
//            print_r($this->input->post());die;
        $this->form_validation->set_rules('am_id', 'Area Manager Id', 'required');
        $this->form_validation->set_rules('state_id', 'State', 'required');
        $this->form_validation->set_rules('am_name', 'Area Name', 'required');
        $this->form_validation->set_rules('am_head_name', 'Head Area Manager Name', 'required');
        $this->form_validation->set_rules('am_areas', 'Areas', 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'required');
        $this->form_validation->set_rules('am_code', 'Code', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {

           redirect($_SERVER['HTTP_REFERER']);
       } else {
        $values = array(
            'state_id' => $this->input->post('state_id'),
            'am_name' => $this->input->post('am_name'),
            'am_head_name' => $this->input->post('am_head_name'),
            'am_areas' => $this->input->post('am_areas'),
            'designation' => $this->input->post('designation'),
            'am_code' => $this->input->post('am_code'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'am_id' => $this->input->post('am_id')
        );
        $this->db->where('am_id', $values['am_id']);
        $this->db->update('area_manager', $values);
        $this->session->set_flashdata('msg', 'Area manager Updated');
        redirect('admin/area_manager/index');
    }
} else {
    redirect($_SERVER['HTTP_REFERER']);
}
}

}

?>
