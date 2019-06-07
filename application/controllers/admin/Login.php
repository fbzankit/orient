<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();

        $this->load->model('login_database');
    }

    public function index() {
        
        $this->load->view('admin/login');
    }

// Show registration page
    public function user_registration_show() {
        $this->load->view('admin/register');
    }

// Validate and store registration data in database
    public function new_user_registration() {

// Check validation for user input in SignUp form
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/register');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            $result = $this->login_database->registration_insert($data);
            if ($result == TRUE) {
                $data['message_display'] = 'Registration Successfully !';
                $this->load->view('admin/login', $data);
            } else {
                $data['message_display'] = 'Email already exist!';
                $this->load->view('admin/register', $data);
            }
        }
    }

// Check for user login process
    public function user_login_process() {

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                $this->load->view('admin/dashboard');
            } else {
                $this->load->view('admin/login');
            }
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            $result = $this->login_database->login($data);
            if ($result == TRUE) {

                $email = $this->input->post('email');
                $result = $this->login_database->read_user_information($email);
                if ($result != false) {
                    $session_data = array(
                        'name' => $result[0]->name,
                        'email' => $result[0]->email,
                    );
// Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    redirect('/admin/dashboard', 'refresh');
//                    $this->load->view('admin/header');
//                    $this->load->view('admin/dashboard');
//                    $this->load->view('admin/footer');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Email or Password'
                );
                $this->load->view('admin/login', $data);
            }
        }
    }

// Logout from admin page
    public function logout() {

// Removing session data
        $sess_array = array(
            'email' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('admin/login', $data);
    }

}

?>
