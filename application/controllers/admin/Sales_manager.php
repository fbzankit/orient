<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_manager extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index($am_id) {

        $qry = "SELECT sales_manager.*,area_manager.am_name FROM sales_manager JOIN area_manager ON sales_manager.am_id = area_manager.am_id WHERE sales_manager.am_id = '".$am_id."' order by sm_id desc"; 
        // $area_managers = $this->db->query($qry);
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
        $sales_managers = $this->db->query($qry);
        $data['sales_managers'] = $sales_managers->result();
        // $data['num'] = $area_managers->num_rows();

        $area_managers = $this->db->query("SELECT * FROM area_manager WHERE am_id = '".$am_id."'");
        $data['area_managers'] = $area_managers->result();
        $data['am_idd'] = $am_id;
// echo "<pre>"; print_r($data);die;
        $this->load->view('admin/header');
        $this->load->view('admin/sales_manager/index', $data);
        $this->load->view('admin/footer');
    }

// Show registration page 
    public function add_sm($am_id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('am_id', 'Area Manager', 'required');
            $this->form_validation->set_rules('sm_name', 'Sales Manager Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {

                $area_manager = $this->db->query("SELECT * FROM area_manager WHERE am_status='A' AND am_id='".$am_id."'");
                $data['area_manager'] = $area_manager->row_array();

                $this->load->view('admin/header');
                $this->load->view('admin/sales_manager/add_sm',$data);
                $this->load->view('admin/footer');
            } else {
   //             print_r($this->input->post());die;
                $values = array(
                    'am_id' => $this->input->post('am_id'),
                    'sm_name' => $this->input->post('sm_name'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'sm_status' => 'A',
                    'created_at' => date('Y-m-d H:i:s')
                );
//                print_r($values);die;
                $sales_manager = $this->db->query("SELECT * FROM sales_manager WHERE sm_name='" . $values['sm_name'] . "'");
                $a = $sales_manager->result();
                $url = 'admin/sales_manager/index/'. $values['am_id'];
                if (empty($a)) {
                    $query = $this->db->insert('sales_manager', $values);
                    $this->session->set_flashdata('msg', 'SM Added');

                    redirect($url);
                } else {
                    $this->session->set_flashdata('msg', 'SM Already Exist');
                    redirect($url);
                }
            }
        } else {

            $area_manager = $this->db->query("SELECT * FROM area_manager WHERE am_status='A' AND am_id='".$am_id."'");
            $data['area_manager'] = $area_manager->row_array();

            $this->load->view('admin/header');
            $this->load->view('admin/sales_manager/add_sm',$data);
            $this->load->view('admin/footer');
        }
    }// Show registration page 
    
    public function am_del($id) {
        if ($this->db->delete("area_manager", "sm_id=" . $id)) {
            $this->session->set_flashdata('msg', 'Sales manager Deleted Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('msg', 'Sales manager Not Deleted Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function sm_edit($id) {
        if ($id != '') {
            $sales_manager = $this->db->query("SELECT * FROM sales_manager WHERE sm_id = '" . $id . "'");
            $data['sales_managers'] = $sales_manager->row_array();
        
            $area_manager = $this->db->query("SELECT * FROM area_manager WHERE am_id = '" . $data['sales_managers']['am_id'] . "'");
            $data['area_manager'] = $area_manager->row_array();
//            print_r($data['state']['am_name']);die;
            $this->load->view('admin/header');
            $this->load->view('admin/sales_manager/add_sm', $data);
            $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('msg', 'Select SM To Edit.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function sm_update() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('sm_name', 'SM Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('sm_id', 'SM Id', 'required');
            $this->form_validation->set_rules('am_id', 'AM Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                $area_manager = $this->db->query("SELECT * FROM area_manager WHERE am_status='A' AND am_id='".$this->input->post('am_id')."'");
            $data['area_manager'] = $area_manager->row_array();

            $this->load->view('admin/header');
            $this->load->view('admin/sales_manager/add_sm',$data);
            $this->load->view('admin/footer');
            } else {
                $values = array(
                    'sm_name' => $this->input->post('sm_name'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'sm_id' => $this->input->post('sm_id')
                );
                $this->db->where('sm_id', $values['sm_id']);
                $this->db->update('sales_manager', $values);
                $this->session->set_flashdata('msg', 'SM Updated');
                redirect('admin/sales_manager/index/'.$this->input->post('am_id'));
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


}

?>
