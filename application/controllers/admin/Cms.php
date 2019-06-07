<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login');
		}
		$this->load->library("pagination");
	}
	
	function aboutus(){
		if (!empty($this->input->post())) {
			$this->form_validation->set_rules('content_value', 'Content', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array();
				
					$get_event_det = $this->db->query("SELECT * FROM tbl_cms where content_key = 'about_us'");
					$data['page_det'] = $get_event_det->row();
					$data['page'] = 'aboutus';
					$data['title'] = $data['page_det']->page;
				$this->load->view('admin/template/template_start');
				$this->load->view('admin/template/page_header', $data);
				$this->load->view('admin/about_add', $data);
				$this->load->view('admin/template/page_footer');
				$this->load->view('admin/template/template_end');
			}
			else{
				
				$event_status = ($this->input->post('event_status') == 'on') ? 1 : 0;
					$values = array(
						'content_value' => $this->input->post('content_value')
					);
					$this->db->update('tbl_cms', $values, array('content_key' => 'about_us'));
					$this->session->set_flashdata('success_msg', 'Updated Successfully.');
					redirect('admin/cms/aboutus/'.$this->input->post('event_id'));
				
				
			}
		} else {
			$data = array();
			$get_event_det = $this->db->query("SELECT * FROM tbl_cms where content_key = 'about_us'");
			$data['page_det'] = $get_event_det->row();
			$data['page'] = 'aboutus';
			$data['title'] = $data['page_det']->page;
			$this->load->view('admin/template/template_start');
			$this->load->view('admin/template/page_header', $data);
			$this->load->view('admin/about_add', $data);
			$this->load->view('admin/template/page_footer');
			$this->load->view('admin/template/template_end');
		}
	}
	
	function terms(){
		if (!empty($this->input->post())) {
			$this->form_validation->set_rules('content_value', 'Content', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array();
				
					$get_event_det = $this->db->query("SELECT * FROM tbl_cms where content_key = 'terms'");
					$data['page_det'] = $get_event_det->row();
					$data['page'] = 'terms';
					$data['title'] = $data['page_det']->page;
				$this->load->view('admin/template/template_start');
				$this->load->view('admin/template/page_header', $data);
				$this->load->view('admin/about_add', $data);
				$this->load->view('admin/template/page_footer');
				$this->load->view('admin/template/template_end');
			}
			else{
				
				$event_status = ($this->input->post('event_status') == 'on') ? 1 : 0;
					$values = array(
						'content_value' => $this->input->post('content_value')
					);
					$this->db->update('tbl_cms', $values, array('content_key' => 'terms'));
					$this->session->set_flashdata('success_msg', 'Updated Successfully.');
					redirect('admin/cms/aboutus/'.$this->input->post('event_id'));
				
				
			}
		} else {
			$data = array();
			$get_event_det = $this->db->query("SELECT * FROM tbl_cms where content_key = 'terms'");
			$data['page_det'] = $get_event_det->row();
			$data['page'] = 'terms';
			$data['title'] = $data['page_det']->page;
			$this->load->view('admin/template/template_start');
			$this->load->view('admin/template/page_header', $data);
			$this->load->view('admin/about_add', $data);
			$this->load->view('admin/template/page_footer');
			$this->load->view('admin/template/template_end');
		}
	}
	
	public function contactus()
	{		
		if (!empty($this->input->post()))
		{
				foreach($this->input->post() as $key => $value){				
					$data = array('content_value' => $value);
					$this->db->where('page', 'Contact Us');
					$this->db->where('content_key', $key);
					if($this->db->update('tbl_cms', $data))
					{
						$this->session->set_flashdata($key.'_err', $key.' changed successfully.');
						
					} else {
						$this->session->set_flashdata($key.'_err', 'Error in updating '.$key);
						
					}
				}
				redirect('admin/cms/contactus');
		}
		else
		{	
			$admin= $this->db->query("SELECT * FROM tbl_cms WHERE page = 'Contact Us'");
			$data['page_det']=$admin->result();
			
			$this->load->view('admin/template/template_start');
			$this->load->view('admin/template/page_header');
			$this->load->view('admin/contact_us', $data);
			$this->load->view('admin/template/page_footer');
			$this->load->view('admin/template/template_end');
		}
		
	}

	public function marquee()
	{		
		if (!empty($this->input->post()))
		{
				foreach($this->input->post() as $key => $value){				
					$data = array('content_value' => $value);
					$this->db->where('page', 'Marquee');
					$this->db->where('content_key', $key);
					if($this->db->update('tbl_cms', $data))
					{
						$this->session->set_flashdata($key.'_err', $key.' changed successfully.');
						
					} else {
						$this->session->set_flashdata($key.'_err', 'Error in updating '.$key);
						
					}
				}
				
				redirect('admin/cms/marquee');
		}
		else
		{	
			$admin= $this->db->query("SELECT * FROM tbl_cms WHERE page = 'Marquee'");
			$data['page_det']=$admin->result();
			
			$this->load->view('admin/template/template_start');
			$this->load->view('admin/template/page_header');
			$this->load->view('admin/marquee', $data);
			$this->load->view('admin/template/page_footer');
			$this->load->view('admin/template/template_end');
		}
		
	}

	
	public function team($id = ""){
		if(!empty($this->input->post('vname')))
		{
			$off=$this->db->query("SELECT * FROM  tbl_team WHERE  member_name LIKE  '%".$this->input->post('vname')."%'" );
		}
		else
		{
			$off=$this->db->query("SELECT * FROM tbl_team" );
		}
		$config = array();
        $config["base_url"] = base_url() . "admin/cms/team";
        $config["total_rows"] = $off->num_rows();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		if($id!='')
		{
			$this->db->query("UPDATE  tbl_team SET  status = 1 WHERE  id=".$id);
		}
		
		if(!empty($this->input->post()))
		{
			if(!empty($this->input->post('vname')))
			{
				$sql = $this->db->query("SELECT * FROM  tbl_team WHERE member_name LIKE  '%".$this->input->post('vname')."%' ORDER BY  id DESC" );
				$data['members'] = $sql->result();
				$data['vname']=$this->input->post('vname');
			}
		}
		else
		{
			$sql = $this->db->query("SELECT * FROM tbl_team ORDER BY tbl_team.id DESC limit {$config['per_page']} offset {$page} " );
			$data['members'] = $sql->result();
		}
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;      
		$data['offset'] = $page ;
		$data["total_rows"] = $off->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		
		//get cat data
		// $cat = $this->db->query("SELECT * FROM tbl_categories" );
		// $data['cat'] = $cat->result();
		
		$this->load->view('admin/template/template_start');
		$this->load->view('admin/template/page_header', $data);
		$this->load->view('admin/team', $data);
		$this->load->view('admin/template/page_footer');
		$this->load->view('admin/template/template_end');
	}

	public function team_add($id=''){
		
		if (!empty($this->input->post())) {
			$this->form_validation->set_rules('member_name', 'Member Name', 'required');
			$this->form_validation->set_rules('member_desc', 'Member Description', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array();
				if($id!=''){
					$get_event_det = $this->db->query("SELECT * FROM tbl_team where id = ".$id."" );
					$data['member_det'] = $get_event_det->row();
				}
				$this->load->view('admin/template/template_start');
				$this->load->view('admin/template/page_header', $data);
				$this->load->view('admin/team_add', $data);
				$this->load->view('admin/template/page_footer');
				$this->load->view('admin/template/template_end');
			}
			else{
				if($this->input->post('member_id') == "")
				{
					$off_status = ($this->input->post('member_status') == 'on') ? 1 : 0;				
					$values = array(
						'member_name' => $this->input->post('member_name'),
						'member_desc' => $this->input->post('member_desc')
					);
					$query = $this-> db->insert('tbl_team', $values);
					$last_id = $this->db->insert_id() ;
					//$this->sendNotification($this->input->post('event_name'), $this->input->post('event_desc'));
					if(!is_dir($_SERVER['DOCUMENT_ROOT'] .'/includes/team_imgs/'.$last_id))
						{
						mkdir($_SERVER['DOCUMENT_ROOT'] .'/includes/team_imgs/'.$last_id);
						}
						$uploaddir = $_SERVER['DOCUMENT_ROOT'] .'/includes/team_imgs/'.$last_id.'/';
						//$storeFolder = 'uploads';
						if (!empty($_FILES)) {			 
							$tempFile = $_FILES['file']['tmp_name'];               
							$targetPath = $uploaddir; 
							$targetFile =  $targetPath. $_FILES['file']['name'];  
							move_uploaded_file($tempFile,$targetFile); 
							$values = array(
								'member_img' => $_FILES['file']['name']
							);
							$this->db->update('tbl_team', array('member_img' => $_FILES['file']['name']), array('id' => $last_id));
							//$last_id = $id;	
						}
					$this->session->set_flashdata('success_msg', 'Continue with Upload Images.');
					redirect('admin/cms/team_add/'.$last_id);
				} else {
				
				$member_status = ($this->input->post('member_status') == 'on') ? 1 : 0;
					if(!is_dir($_SERVER['DOCUMENT_ROOT'] .'/includes/team_imgs/'. $this->input->post('member_id')))
						{
						mkdir($_SERVER['DOCUMENT_ROOT'] .'/includes/team_imgs/'. $this->input->post('member_id'));
						}
						$uploaddir = $_SERVER['DOCUMENT_ROOT'] .'/includes/team_imgs/'. $this->input->post('member_id').'/';
						//$storeFolder = 'uploads';
						if (!empty($_FILES)) {			 
							$tempFile = $_FILES['file']['tmp_name'];               
							$targetPath = $uploaddir; 
							$targetFile =  $targetPath. $_FILES['file']['name'];  
							move_uploaded_file($tempFile,$targetFile); 
							$values = array(
								'member_name' => $this->input->post('member_name'),
								'member_desc' => $this->input->post('member_desc'),
								'status' => $event_status,
								'member_img' => $_FILES['file']['name']
							);
							$this->db->update('tbl_team', $values, array('id' => $this->input->post('member_id')));
							//$last_id = $id;	
						}else {
								$values = array(
												'member_name' => $this->input->post('member_name'),
												'member_desc' => $this->input->post('member_desc'),
												'status' => $event_status
											);
											$this->db->update('tbl_team', $values, array('id' => $this->input->post('member_id')));
											$this->session->set_flashdata('success_msg', 'Updated Successfully.');
						}
					
					redirect('admin/cms/team_add/'.$this->input->post('member_id'));
				
				}
			}
		} else {
			$data = array();
			if($id!=''){
				$get_event_det = $this->db->query("SELECT * FROM tbl_team where id = ".$id."" );
				$data['member_det'] = $get_event_det->row();
			}
			$this->load->view('admin/template/template_start');
			$this->load->view('admin/template/page_header', $data);
			$this->load->view('admin/team_add', $data);
			$this->load->view('admin/template/page_footer');
			$this->load->view('admin/template/template_end');
		}
	}
	
	public function team_delete($id){
		
		rmdir($_SERVER['DOCUMENT_ROOT'] .'/includes/team_imgs/'.$id);
		
		$cat = $this->db->query("Delete FROM tbl_team where id = ".$id."" );
		$this->session->set_flashdata('success_msg', 'Member Successfully Deleted');
		redirect('admin/cms/team');	
	}
	
	public function bank($id = ""){
		if(!empty($this->input->post('vname')))
		{
			$off=$this->db->query("SELECT * FROM  tbl_bank WHERE  account_name LIKE  '%".$this->input->post('vname')."%'" );
		}
		else
		{
			$off=$this->db->query("SELECT * FROM tbl_bank" );
		}
		$config = array();
        $config["base_url"] = base_url() . "admin/cms/team";
        $config["total_rows"] = $off->num_rows();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		if($id!='')
		{
			$this->db->query("UPDATE  tbl_bank SET  status = 1 WHERE  id=".$id);
		}
		
		if(!empty($this->input->post()))
		{
			if(!empty($this->input->post('vname')))
			{
				$sql = $this->db->query("SELECT * FROM  tbl_bank WHERE member_name LIKE  '%".$this->input->post('vname')."%' ORDER BY  id DESC" );
				$data['members'] = $sql->result();
				$data['vname']=$this->input->post('vname');
			}
		}
		else
		{
			$sql = $this->db->query("SELECT * FROM tbl_bank ORDER BY tbl_bank.id DESC limit {$config['per_page']} offset {$page} " );
			$data['members'] = $sql->result();
		}
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;      
		$data['offset'] = $page ;
		$data["total_rows"] = $off->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		
		//get cat data
		// $cat = $this->db->query("SELECT * FROM tbl_categories" );
		// $data['cat'] = $cat->result();
		
		$this->load->view('admin/template/template_start');
		$this->load->view('admin/template/page_header', $data);
		$this->load->view('admin/bank', $data);
		$this->load->view('admin/template/page_footer');
		$this->load->view('admin/template/template_end');
	}

	public function bank_add($id=''){
		
		if (!empty($this->input->post())) {
			$this->form_validation->set_rules('account_name', 'account_name', 'required');
			$this->form_validation->set_rules('account_no', 'account_no', 'required');
			$this->form_validation->set_rules('bank_name', 'bank_name', 'required');
			$this->form_validation->set_rules('account_no', 'account_no', 'required');
			$this->form_validation->set_rules('branch_name', 'branch_name', 'required');
			$this->form_validation->set_rules('ifsc_code', 'ifsc_code', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array();
				if($id!=''){
					$get_event_det = $this->db->query("SELECT * FROM tbl_bank where id = ".$id."" );
					$data['bank_det'] = $get_event_det->row();
				}
				$this->load->view('admin/template/template_start');
				$this->load->view('admin/template/page_header', $data);
				$this->load->view('admin/bank_add', $data);
				$this->load->view('admin/template/page_footer');
				$this->load->view('admin/template/template_end');
			}
			else{
				if($this->input->post('bank_id') == "")
				{				
					$values = array(
						'account_name' => $this->input->post('account_name'),
						'bank_name' => $this->input->post('bank_name'),
						'account_no' => $this->input->post('account_no'),
						'branch_name' => $this->input->post('branch_name'),
						'ifsc_code' => $this->input->post('ifsc_code'),
						'account_no' => $this->input->post('account_no'),
					);
					$query = $this-> db->insert('tbl_bank', $values);
					$last_id = $this->db->insert_id() ;
					//$this->sendNotification($this->input->post('event_name'), $this->input->post('event_desc'));
					if(!is_dir($_SERVER['DOCUMENT_ROOT'] .'/includes/bank_imgs/'.$last_id))
						{
						mkdir($_SERVER['DOCUMENT_ROOT'] .'/includes/bank_imgs/'.$last_id);
						}
						$uploaddir = $_SERVER['DOCUMENT_ROOT'] .'/includes/bank_imgs/'.$last_id.'/';
						//$storeFolder = 'uploads';
						if (!empty($_FILES)) {			 
							$tempFile = $_FILES['file']['tmp_name'];               
							$targetPath = $uploaddir; 
							$targetFile =  $targetPath. $_FILES['file']['name'];  
							move_uploaded_file($tempFile,$targetFile); 
							$values = array(
								'bank_img' => $_FILES['file']['name']
							);
							$this->db->update('tbl_bank', array('bank_img' => $_FILES['file']['name']), array('id' => $last_id));
							//$last_id = $id;	
						}
					$this->session->set_flashdata('success_msg', 'Continue with Upload Images.');
					redirect('admin/cms/bank_add/'.$last_id);
				} else {
				
					$values = array(
						'account_name' => $this->input->post('account_name'),
						'bank_name' => $this->input->post('bank_name'),
						'account_no' => $this->input->post('account_no'),
						'branch_name' => $this->input->post('branch_name'),
						'ifsc_code' => $this->input->post('ifsc_code'),
						'account_no' => $this->input->post('account_no'),
					); 
					$this->db->update('tbl_bank', $values, array('id' => $this->input->post('bank_id')));
					$this->session->set_flashdata('success_msg', 'Updated Successfully.');
					redirect('admin/cms/bank_add/'.$this->input->post('bank_id'));
				
				}
			}
		} else {
			$data = array();
			if($id!=''){
				$get_event_det = $this->db->query("SELECT * FROM tbl_bank where id = ".$id."" );
				$data['bank_det'] = $get_event_det->row();
			}
			$this->load->view('admin/template/template_start');
			$this->load->view('admin/template/page_header', $data);
			$this->load->view('admin/bank_add', $data);
			$this->load->view('admin/template/page_footer');
			$this->load->view('admin/template/template_end');
		}
	}
	
	public function bank_delete($id){
		
		rmdir($_SERVER['DOCUMENT_ROOT'] .'/includes/bank_imgs/'.$id);
		
		$cat = $this->db->query("Delete FROM tbl_bank where id = ".$id."" );
		$this->session->set_flashdata('success_msg', 'Member Successfully Deleted');
		redirect('admin/cms/bank');	
	}
	
}

?>