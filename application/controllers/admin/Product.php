<?php

//session_start(); //we need to start session in order to access it through CI

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
//        $qry = "SELECT * FROM product order by product_id desc";
//        $product = $this->db->query($qry);
//        $config = array();
//        $config["base_url"] = base_url() . "admin/product/index";
//        $config["total_rows"] = $product->num_rows();
//        $config["per_page"] = 20;
//        $config["uri_segment"] = 4;
//        $config['full_tag_open'] = '<ul class="pagination">';
//        $config['full_tag_close'] = '</ul><!--pagination-->';
//        $config['first_link'] = '&laquo; First';
//        $config['first_tag_open'] = '<li class="prev page">';
//        $config['first_tag_close'] = '</li>';
//        $config['last_link'] = 'Last &raquo;';
//        $config['last_tag_open'] = '<li class="next page">';
//        $config['last_tag_close'] = '</li>';
//        $config['next_link'] = 'Next &rarr;';
//        $config['next_tag_open'] = '<li class="next page">';
//        $config['next_tag_close'] = '</li>';
//        $config['prev_link'] = '&larr; Previous';
//        $config['prev_tag_open'] = '<li class="prev page">';
//        $config['prev_tag_close'] = '</li>';
//        $config['cur_tag_open'] = '<li class="active"><a href="">';
//        $config['cur_tag_close'] = '</a></li>';
//        $config['num_tag_open'] = '<li class="page">';
//        $config['num_tag_close'] = '</li>';
//        $this->pagination->initialize($config);
//        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
//
//        $data["links"] = $this->pagination->create_links();
//        $data['per_page'] = 20;
//        $data['offset'] = $page;
//        $data["total_rows"] = $product->num_rows();
//        $data["curr_page"] = $this->pagination->cur_page;
//
//        $product = $this->db->query("$qry limit {$config['per_page']} offset {$page}");
//        $data['product'] = $product->result();
//        $data['num'] = $product->num_rows();

        $qry = "SELECT Product.*, category.cat_name as cat_name FROM Product JOIN category ON Product.CatId = category.cat_id order by id desc";
        $product = $this->db->query($qry);
        $data['products'] = $product->result();
//        print_r($data);
//        die;

        $this->load->view('admin/header');
        $this->load->view('admin/product/index', $data);
        $this->load->view('admin/footer');
    }

// Show registration page
    public function add_product() {


        if (!empty($this->input->post())) {
//            print_r($_FILES);
//            print_r($this->input->post());
//            die;
            $this->form_validation->set_rules('name', 'Product Name', 'required');
            $this->form_validation->set_rules('catId', 'Sub Sub Sub Category', 'required');
            $this->form_validation->set_rules('itemCode', 'Item Code', 'required');
            $this->form_validation->set_rules('product_qty', 'Product Quantity', 'required');
            $this->form_validation->set_rules('mrp', 'MRP', 'required');
            $this->form_validation->set_rules('billingPrice', 'Billing Price', 'required');
            $this->form_validation->set_rules('gst', 'GST', 'required');
            $this->form_validation->set_rules('masterPack', 'Master Pack', 'required');
            $this->form_validation->set_rules('weight', 'Weight', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg', validation_errors());
                $qry = "SELECT * FROM Product order by id desc";
                $product = $this->db->query($qry);
                $data['products'] = $product->result();

                $qryCat = "SELECT * FROM category order by cat_id desc";
                $category = $this->db->query($qryCat);
                $data['categories'] = $category->result();
//        print_r($data);die;
                $this->load->view('admin/header');
                $this->load->view('admin/product/add_product', $data);
                $this->load->view('admin/footer');
            } else {
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/includes/img/product';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = time() . $_FILES['image']['name'];
                $config['file_type'] = $_FILES['image']['type'];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
//                print_r($uploadData);die;
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }

                $values = array(
                    'Name' => $this->input->post('name'),
                    'Image' => $picture,
                    'CatId' => $this->input->post('catId'),
                    'ItemCode' => $this->input->post('itemCode'),
                    'product_qty' => $this->input->post('product_qty'),
                    'MRP' => $this->input->post('mrp'),
                    'BillingPrice' => $this->input->post('billingPrice'),
                    'GST' => $this->input->post('gst'),
                    'MasterPack' => $this->input->post('masterPack'),
                    'weight' => $this->input->post('weight'),
                    'created_at' => date('Y-m-d H:i:s')
                );

//                print_r($values);die;
                $product = $this->db->query("SELECT * FROM Product WHERE Name='" . $values['name'] . "'");
                $a = $product->result();
                if (empty($a)) {
                    $query = $this->db->insert('Product', $values);
                    $this->session->set_flashdata('msg', 'Product Added');
                    redirect('admin/product');
                } else {
                    $this->session->set_flashdata('msg', 'Product Already Exist');
                    redirect('admin/product');
                }
            }
        } else {
            $qry = "SELECT * FROM Product order by id desc";
            $product = $this->db->query($qry);
            $data['products'] = $product->result();

            $qryCat = "SELECT * FROM category where parent_cat_id = 0 order by cat_id desc";
            $category = $this->db->query($qryCat);
            $data['categories'] = $category->result();
//            print_r($data);
//            die;
            $this->load->view('admin/header');
            $this->load->view('admin/product/add_product', $data);
            $this->load->view('admin/footer');
        }
    }

    public function product_del($id) {

        if ($this->db->delete("Product", "id=" . $id)) {

            $this->session->set_flashdata('msg', 'Product Deleted Successfully.');

            redirect('admin/product');
        } else {

            $this->session->set_flashdata('msg', 'Product Not Deleted Successfully.');

            redirect('admin/product');
        }
    }

    public function product_edit($id) {

        if ($id != '') {
            $product = $this->db->query("SELECT * FROM Product WHERE id = '" . $id . "'");
            $data['product'] = $product->row_array();
//            print_r($data['product']['Name']);die;
            $this->load->view('admin/header');
            $this->load->view('admin/product/add_product', $data);
            $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('msg', 'Select Product To Edit.');
            redirect('admin/product');
        }
    }

    public function product_update() {
//        print_r($this->input->post());die;
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('name', 'Product Name', 'required');
            $this->form_validation->set_rules('itemCode', 'Item Code', 'required');
            $this->form_validation->set_rules('product_qty', 'Product Quantity', 'required');
            $this->form_validation->set_rules('mrp', 'MRP', 'required');
            $this->form_validation->set_rules('billingPrice', 'Billing Price', 'required');
            $this->form_validation->set_rules('gst', 'GST', 'required');
            $this->form_validation->set_rules('masterPack', 'Master Pack', 'required');
            $this->form_validation->set_rules('weight', 'Weight', 'required');
            $this->form_validation->set_rules('id', 'Product Id', 'required');
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id');
                $product = $this->db->query("SELECT * FROM Product WHERE id = '" . $id . "'");
                $data['product'] = $product->row_array();

                $this->load->view('admin/header');
                $this->load->view('admin/product/add_product', $data);
                $this->load->view('admin/footer');
            } else {
                if(!empty($_FILES['image']['name'])){
                    $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/includes/img/product';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = time() . $_FILES['image']['name'];
                    $config['file_type'] = $_FILES['image']['type'];
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('image')) {
                        $uploadData = $this->upload->data();
    //                print_r($uploadData);die;
                        $picture = $uploadData['file_name'];
                    } else {
                        $picture = '';
                    }
                }else{
                    $picture = $this->input->post('old_image');
                }
                
                
                
                $values = array(
                    'Name' => $this->input->post('name'),
                    'id' => $this->input->post('id'),
                    'ItemCode' => $this->input->post('itemCode'),
                    'product_qty' => $this->input->post('product_qty'),
                    'MRP' => $this->input->post('mrp'),
                    'BillingPrice' => $this->input->post('billingPrice'),
                    'GST' => $this->input->post('gst'),
                    'MasterPack' => $this->input->post('masterPack'),
                    'weight' => $this->input->post('weight'),
                    'Image' => $picture
                );
//                print_r($values);die;
                $this->db->where('id', $values['id']);
                $this->db->update('Product', $values);
                $this->session->set_flashdata('msg', 'Product Updated');
                redirect('admin/product');
            }
        } else {
            $id = $this->input->post('id');
            $product = $this->db->query("SELECT * FROM Product WHERE id = '" . $id . "'");
            $data['product'] = $product->row_array();

            $this->load->view('admin/header');
            $this->load->view('admin/product/add_product', $data);
            $this->load->view('admin/footer');
        }
    }

    public function product_update_status($id, $status) {
//        echo 'Id ->'.$id,'<br>';
//        echo 'status ->'.$status;die;
        $this->db->update('product', array('product_status' => $status), "product_id =" . $id);
        $this->session->set_flashdata('msg', 'Product Status Updated.');
        redirect('admin/product');
    }

    public function getCategories() {
        if (!empty($this->input->post())) {
//            print_r($this->input->post());die;
            $catId = $this->input->post('catId');
            if (!empty($catId)) {
                $qry = "SELECT * FROM category where parent_cat_id = $catId order by cat_id desc";
                $product = $this->db->query($qry);
                $products = $product->result();
                $response = '<option value="" > Select </option>';
//                print_r($products);
//                die;
                foreach ($products as $product) {
//                print_r($product);die;
                    $response .= "<option value='" . $product->cat_id . "'>" . $product->cat_name . "</option>";
                }
                echo $response;
            } else {
                echo $response = '<option value="" > Select </option>';
            }
        }
    }

}

?>
