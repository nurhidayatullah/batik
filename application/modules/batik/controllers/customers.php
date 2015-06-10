<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends Admin_Controller {
	var $page = "Data Customers";
	function __construct(){
        parent::__construct();
		$this->load->model('batik/customers_model');
	}
	function index($menu='',$msg=''){
		$data['menu']=$menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['msg'] = $msg;
		$data['customers'] = $this->customers_model->All();
	//	print_r($data['customers']);
		$this->load->view('batik/customers/page',$data);
	}
	
	public function hapus($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$foto = $this->customers_model->get_foto($this->my_encrypt->decode($id));
			if(isset($foto)){
				unlink('./assets/upload/cust/'.$foto);
			}
			$result = $this->customers_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = 1;
				redirect(base_url('batik/customers/index/'.$menu.'/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('batik/customers/index/'.$menu.'/'.$pesan));
			}
		}
	}
	function new_data($menu=''){
		$data['menu'] = $menu;
		$data['msg'] = '';
		$this->load->view('batik/customers/new',$data);
	}
	function edit($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$data['menu'] = $menu;
			$data['customers'] = $this->customers_model->find($this->my_encrypt->decode($id));
			$this->load->view('batik/customers/edit',$data);
		}
	}
	public function update($id){
		$id = $this->my_encrypt->decode($id);
		if($this->security->xss_clean($id)){
			$f = $this->customers_model->get_foto($id);
			if(isset($_FILES['foto']) && !empty($_FILES['foto']['name'])){
				unlink('./assets/upload/cust/'.$f);
				$config['upload_path'] = './assets/upload/cust/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$this->load->library('upload', $config);
				if( ! $this->upload->do_upload('foto')){
					$data['msg'] = $this->upload->display_errors();
					$data['menu'] = $this->input->post('menu');
					$data['customers'] = $this->customers_model->find($this->my_encrypt->decode($id));
					$this->load->view('batik/customers/edit',$data);
				}else{
					$upload = $this->upload->data();
					$data['foto'] = $upload['file_name'];
				}
			}else{
				$data['foto'] = $f;
			}
			$this->load->library('form_validation'); 
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
			$this->form_validation->set_rules('kota', 'Kota', 'required|trim|xss_clean');
			$this->form_validation->set_rules('telp', 'Telepon', 'trim|xss_clean');
			$menu = $this->input->post('menu');
			if ($this->form_validation->run() == FALSE) { 
				$data['msg'] = "".validation_errors();
				$data['menu'] = $this->input->post('menu');
				$data['customers'] = $this->customers_model->find($this->my_encrypt->decode($id));
				$this->load->view('batik/customers/edit',$data);
			}else{
				$data['id_cust'] = $id;
				$data['nama_cust'] = $this->input->post('nama');
				$data['alamat'] = $this->input->post('alamat');
				$data['kota'] = $this->input->post('kota');
				$data['telp'] = $this->input->post('telp');
				$data['update_at'] = date("Y-m-d H:s:i");
				$result = $this->customers_model->update($data); 
				if($result){
					$res = 1;
					redirect(base_url('batik/customers/index/'.$menu.'/'.$res));
				}else{
					$res = 0;
					redirect(base_url('batik/customers/index/'.$menu.'/'.$res));
				}
			}
		}
	}
	function save(){
		$config['upload_path'] = './assets/upload/cust/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$this->load->library('upload', $config);
		if( ! $this->upload->do_upload('foto')){
			$data['msg'] = $this->upload->display_errors();
			$data['menu'] = $this->input->post('menu');
			$this->load->view('batik/customers/new',$data);
		}else{
			$upload = $this->upload->data();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
			$this->form_validation->set_rules('kota', 'Kota', 'required|trim|xss_clean');
			$this->form_validation->set_rules('telp', 'Telepon', 'trim|xss_clean');
			$url = $this->input->post('menu');
			if ($this->form_validation->run() == FALSE) { 
				$data['msg'] = "".validation_errors();
				$data['menu'] = $this->input->post('menu');
				$this->load->view('mangga/master-mangga/new',$data);
			}else{
				$data['nama_cust'] = $this->input->post('nama');
				$data['alamat'] = $this->input->post('alamat');
				$data['kota'] = $this->input->post('kota');
				$data['telp'] = $this->input->post('telp');
				$data['foto'] = $upload['file_name'];
				$data['create_at'] = date("Y-m-d H:s:i");
				$menu = $this->input->post('menu');
				$result = $this->customers_model->add($data);
				if($result){
					$res = 1;
					redirect(base_url('batik/customers/index/'.$menu.'/'.$res));
				}else{
					$res = 0;
					redirect(base_url('batik/customers/index/'.$menu.'/'.$res));
				}
			}
		}
	}
}
?>