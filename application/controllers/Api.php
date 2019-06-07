<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public $requestParams;

	public function __construct() {
        parent::__construct();

        $this->requestParams = ($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post(); 
        
    }
    
    public function getRootCat(){
		$query = $this->db->query('SELECT category.*, CONCAT("' . base_url() . 'uploads/category/", category.cat_id, "/", category.cat_image) as icon FROM `category` WHERE parent_cat_id = 0');

        if ($query->num_rows() > 0) {
            $result['message'] = 'category List.';
            $result['category'] = $query->result();

            header('HTTP/1.1 200 OK');
            echo json_encode($result);
        } else {
            $result['message'] = "category List Not Available.";
            $result['category'] = array();

            header('HTTP/1.1 400 Bad Request');
            echo json_encode($result);
        }
	}
	
	public function getChildCatByParentId() {

        extract($this->requestParams);

        if (!isset($parent_cat_id)) {
            $arr = array('message' => 'parameter missing.');

            header('HTTP/1.1 400 Bad Request');
            echo json_encode($arr);
        } else {
            $query = $this->db->query('SELECT category.*, CONCAT("' . base_url() . 'includes/img/category", "/", category.cat_image) as icon, category.cat_image as Image FROM `category` WHERE parent_cat_id = ' . $parent_cat_id . ' ORDER By cat_id ASC');

            if ($query->num_rows() > 0) {
                $result['message'] = 'category Fethed Sucessfully.';
                $result['category'] = $query->result();


                header('HTTP/1.1 200 OK');
                echo json_encode($result);
            } else {

                    $result['message'] = "No category Found For Your Area.";
                    $result['category'] = null;

                    $query = $this->db->query('SELECT Product.*, CONCAT("' . base_url() . 'includes/img/product/", Image) as icon FROM `Product` WHERE CatId = ' . $parent_cat_id . ' ORDER By CatId ASC');
                    if ($query->num_rows() > 0) {
                        $result['Product'] = $query->result();

                    header('HTTP/1.1 200 OK');
                    echo json_encode($result);
                } else {
                    $result['message'] = "No Product Found For Your Area.";

                    header('HTTP/1.1 400 Bad Request');
                    echo json_encode($result);
                }
            }
        }
    }
 
    public function getProductByCatId() {

        extract($this->requestParams);

        if (!isset($cat_id)) {
            $arr = array('message' => 'parameter missing.');

            header('HTTP/1.1 400 Bad Request');
            echo json_encode($arr);
        } else {
            $query = $this->db->query('SELECT Product.*, CONCAT("' . base_url() . 'includes/img/product/", Image) as icon FROM `Product` WHERE CatId = ' . $cat_id . ' ORDER By CatId ASC');
            if ($query->num_rows() > 0) {
                $result['message'] = 'Product Fethed Sucessfully.';
                $result['Product'] = $query->result();


                header('HTTP/1.1 200 OK');
                echo json_encode($result);
            } else {

                $result['message'] = "No Product Found For Your Area.";

                header('HTTP/1.1 400 Bad Request');
                echo json_encode($result);
            }
        }
    }


    public function getProductById() {

        extract($this->requestParams);

        if (!isset($id)) {
            $arr = array('message' => 'parameter missing.');

            header('HTTP/1.1 400 Bad Request');
            echo json_encode($arr);
        } else {
            $query = $this->db->query('SELECT Product.*, CONCAT("' . base_url() . 'includes/img/product/", Image) as icon FROM `Product` WHERE id = ' . $id);
            if ($query->num_rows() > 0) {
                $result['message'] = 'Product Fethed Sucessfully.';
                $result['Product'] = $query->row();

                header('HTTP/1.1 200 OK');
                echo json_encode($result);
            } else {

                $result['message'] = "No Product Found For Your Area.";

                header('HTTP/1.1 400 Bad Request');
                echo json_encode($result);
            }
        }
    }

    public function getBanners() {

        
            $query = $this->db->query('SELECT banner.*, CONCAT("' . base_url() . 'includes/img/banner/", image) as icon FROM `banner`');
            if ($query->num_rows() > 0) {

                $result['message'] = "Banners Found.";
              $result['Banners'] = $query->result();

                header('HTTP/1.1 200 OK');
                echo json_encode($result);
            } else {

                $result['message'] = "No Banner Found For Your Area.";

                header('HTTP/1.1 400 Bad Request');
                echo json_encode($result);
            }
        
    }

    public function getContactUs() {

        
        $query = $this->db->query('SELECT contact_us.* FROM `contact_us`');
        if ($query->num_rows() > 0) {

            $result['message'] = "Contact_us Found.";
          $result['ContactUs'] = $query->row();

            header('HTTP/1.1 200 OK');
            echo json_encode($result);
        } else {

            $result['message'] = "No Result Found.";

            header('HTTP/1.1 400 Bad Request');
            echo json_encode($result);
        }
    
    }


    public function getAboutUs() {

        
        $query = $this->db->query('SELECT about_us.* FROM `about_us`');
        if ($query->num_rows() > 0) {

            $result['message'] = "About Us Found.";
          $result['AboutUs'] = $query->row();

            header('HTTP/1.1 200 OK');
            echo json_encode($result);
        } else {

            $result['message'] = "No Result Found.";

            header('HTTP/1.1 400 Bad Request');
            echo json_encode($result);
        }
    
    }


    public function loginDistributor() {

        extract($this->requestParams);

        if (!isset($username) || !isset($password)) {
            $arr = array('message' => 'parameter missing.');

            header('HTTP/1.1 400 Bad Request');
            echo json_encode($arr);
        } else {
            $query = $this->db->query('SELECT * FROM `users` WHERE email = "' . $username. '" AND password = "'. $password.'"');
            if ($query->num_rows() > 0) {
                $result['message'] = 'User Fethed Sucessfully.';
                $result['User'] = $query->row();

                header('HTTP/1.1 200 OK');
                echo json_encode($result);
            } else {

                $result['message'] = "No Product Found For Your Area.";

                header('HTTP/1.1 400 Bad Request');
                echo json_encode($result);
            }
        }
    }

    public function placeOrder() {

        extract($this->requestParams);

        if (!isset($distributor_id) || !isset($order_detail ) || !isset($order_amount) ) {
            $arr = array('message' => 'parameter missing.');

            header('HTTP/1.1 400 Bad Request');
            echo json_encode($arr);
        } else {

            $values = array(
                    'user_id' => $distributor_id,
                    'order_detail' => $order_detail,
                    'order_amount' => $order_amount
                );

            if ($this->db->insert('orders', $values)) {
                $result['message'] = 'Order Created Sucessfully.';
                $result['OrderId'] = $this->db->insert_id();;

                header('HTTP/1.1 200 OK');
                echo json_encode($result);
            } else {

                $result['message'] = "There is some technical in our database, Please try again.";

                header('HTTP/1.1 400 Bad Request');
                echo json_encode($result);
            }
        }
    }
    

	
}
