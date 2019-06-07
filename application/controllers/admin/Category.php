<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index($catId = 0, $level = 0) {
        $data['catIdUrl'] = $catId;
        $data['levelUrl'] = $level;

        $qry = "SELECT * FROM category where parent_cat_id = $catId order by cat_id desc";
        $category = $this->db->query($qry);
        $data['categories'] = $category->result();
        if ($level > 0) {
            $qryCat = "SELECT * FROM category where cat_id = $catId order by cat_id desc";
            $mainCat = $this->db->query($qryCat);
            $data['mainCat'] = $mainCat->row_array();
        }


        $this->load->view('admin/header');
        $this->load->view('admin/category/index', $data);
        $this->load->view('admin/footer');
    }

    public function category_del($id) {

//        print_r(current_url());die;
        $this->db->where('cat_id', $id);
        $this->db->or_where('parent_cat_id', $id);
        if ($this->db->delete('category')) {

            $this->db->where('CatId', $id);
            $this->db->delete('Product');

            $this->session->set_flashdata('msg', 'Category Deleted Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('msg', 'Category Not Deleted Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function add_category($catId = 0, $level = 0) {
        $data['catIdUrl'] = $catId;
        $data['levelUrl'] = $level;

        if (!empty($this->input->post())) {
//            print_r($this->input->post());
//            die('here');
            $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
//            $this->form_validation->set_rules('parent_cat_id', 'Parent Category', 'required');
            if ($this->form_validation->run() == FALSE) {
                $qry = "SELECT * FROM category order by cat_id desc";
                $category = $this->db->query($qry);
                $data['categories'] = $category->result();
//        print_r($data);die;
                $this->load->view('admin/header');
                $this->load->view('admin/category/add_category', $data);
                $this->load->view('admin/footer');
            } else {
//                print_r($this->input->post());die;
                if (!empty($_FILES['cat_image'])) {
                    $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/includes/img/category';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = time() . $_FILES['cat_image']['name'];
                    $config['file_type'] = $_FILES['cat_image']['type'];
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('cat_image')) {
                        $uploadData = $this->upload->data();
//                print_r($uploadData);die;
                        $picture = $uploadData['file_name'];
                    } else {
                        $picture = '';
                    }
                } else {
                    $picture = '';
                }

                if ($this->input->post('parent_cat_id') != 0) {
                    $parent_cat_id = $this->input->post('parent_cat_id');
                } else {
                    $parent_cat_id = 0;
                }
                $values = array(
                    'cat_name' => $this->input->post('cat_name'),
                    'cat_image' => $picture,
                    'parent_cat_id' => $parent_cat_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

//                print_r($values);die;
                $category = $this->db->query("SELECT * FROM category WHERE cat_name='" . $values['cat_name'] . "'");
                $a = $category->result();
                if (empty($a)) {
                    $query = $this->db->insert('category', $values);
                    $this->session->set_flashdata('msg', 'Category Added');
//                    redirect('admin/category');
                } else {

                    $this->session->set_flashdata('msg', 'Category Already Exist');
                }

                redirect('admin/category/index/' . $catId . '/' . $level);
            }
        } else {
            if ($catId != 0) {
                $qry = "SELECT * FROM category where cat_id= " . $catId . " order by cat_id desc";
                $category = $this->db->query($qry);
                $data['category'] = $category->row_array();
            } else {
                $qry = "SELECT * FROM category where parent_cat_id = 0 order by cat_id desc";
                $category = $this->db->query($qry);
                $data['categories'] = $category->result();
            }


            $this->load->view('admin/header');
            $this->load->view('admin/category/add_category', $data);
            $this->load->view('admin/footer');
        }
    }

    public function category_edit($catId = 0, $level = 0, $id) {
        $data['catIdUrl'] = $catId;
        $data['levelUrl'] = $level;
        if ($id != '') {
            $category = $this->db->query("SELECT * FROM category WHERE cat_id = '" . $id . "'");
            $data['category'] = $category->row_array();
//            print_r($data['zone']['cat_name']);die;
            $this->load->view('admin/header');
            $this->load->view('admin/category/edit_category', $data);
            $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('msg', 'Select Category To Edit.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function category_update($catId = 0, $level = 0) {
//        $data['catIdUrl'] = $catId;
//        $data['levelUrl'] = $level;
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
            $this->form_validation->set_rules('cat_id', 'Category Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                if (!empty($_FILES['cat_image'])) {
                    $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/includes/img/category';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = time() . $_FILES['cat_image']['name'];
                    $config['file_type'] = $_FILES['cat_image']['type'];
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('cat_image')) {
                        $uploadData = $this->upload->data();
//                print_r($uploadData);die;
                        $picture = $uploadData['file_name'];
                    } else {
                        $picture = $this->input->post('cat_image_name');
                    }
                } else {
                    $picture = $this->input->post('cat_image_name');
                }
                $values = array(
                    'cat_name' => $this->input->post('cat_name'),
                    'cat_id' => $this->input->post('cat_id'),
                    'cat_image' => $picture
                );
                $this->db->where('cat_id', $values['cat_id']);
                $this->db->update('category', $values);
                $this->session->set_flashdata('msg', 'Category Updated');
                redirect('admin/category/index/' . $catId . '/' . $level . '');
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function zone_update_status($id, $status) {
//        echo 'Id ->'.$id,'<br>';
//        echo 'status ->'.$status;die;
        $this->db->update('category', array('zone_status' => $status), "zone_id =" . $id);
        $this->session->set_flashdata('msg', 'Category Status Updated.');
        redirect('admin/zone');
    }

}

?>
