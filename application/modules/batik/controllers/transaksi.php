<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends Admin_Controller {
	var $page = "Data Transaksi";
	function __construct(){
        parent::__construct();
		$this->load->model('batik/transaksi_model');
	}
	function index($menu='',$msg=''){
		$data['menu']=$menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['msg'] = $msg;
		$data['transaksi'] = $this->transaksi_model->All();
		$this->load->view('batik/transaksi/page',$data);
	}
	public function hapus($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$result = $this->transaksi_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = 1;
				redirect(base_url('batik/transaksi/index/'.$menu.'/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('batik/transaksi/index/'.$menu.'/'.$pesan));
			}
		}
	}
	function new_data($menu=''){
		$data['menu'] = $menu;
		$data['msg'] = '';
		$this->load->view('batik/transaksi/new',$data);
	}
	function edit($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$data['menu'] = $menu;
			$data['batik'] = $this->batik_model->find($this->my_encrypt->decode($id));
			$this->load->view('batik/batik/edit',$data);
		}
	}
	public function update($id){
		$id = $this->my_encrypt->decode($id);
		if($this->security->xss_clean($id)){
			$f = $this->batik_model->get_foto($id);
			if(isset($_FILES['foto']) && !empty($_FILES['foto']['name'])){
				unlink('./assets/upload/batik/'.$f);
				$config['upload_path'] = './assets/upload/batik/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$this->load->library('upload', $config);
				if( ! $this->upload->do_upload('foto')){
					$data['msg'] = $this->upload->display_errors();
					$data['menu'] = $this->input->post('menu');
					$data['batik'] = $this->batik_model->find($this->my_encrypt->decode($id));
					$this->load->view('batik/batik/edit',$data);
				}else{
					$upload = $this->upload->data();
					$data['foto'] = $upload['file_name'];
				}
			}else{
				$data['foto'] = $f;
			}
			$this->load->library('form_validation'); 
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|xss_clean');
			$menu = $this->input->post('menu');
			if ($this->form_validation->run() == FALSE) { 
				$data['msg'] = "".validation_errors();
				$data['menu'] = $this->input->post('menu');
				$data['batik'] = $this->batik_model->find($this->my_encrypt->decode($id));
				$this->load->view('batik/batik/edit',$data);
			}else{
				$data['id_batik'] = $id;
				$data['nama_batik'] = $this->input->post('nama');
				$data['keterangan'] = $this->input->post('keterangan');
				$data['update_at'] = date("Y-m-d H:s:i");
				$result = $this->batik_model->update($data); 
				if($result){
					$res = 1;
					redirect(base_url('batik/batik/index/'.$menu.'/'.$res));
				}else{
					$res = 0;
					redirect(base_url('batik/batik/index/'.$menu.'/'.$res));
				}
			}
		}
	}
	function save(){
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules('menu', 'Menu', 'required|trim|xss_clean');
		$this->form_validation->set_rules('cust', 'Customers', 'required|trim|xss_clean');
		$this->form_validation->set_rules('batik', 'batik', 'required|trim|xss_clean');
		$this->form_validation->set_rules('ukuran', 'Ukuran', 'required|trim|xss_clean');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|xss_clean');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|xss_clean');
		$menu = $this->input->post('menu');
		if ($this->form_validation->run() == FALSE) { 
			$data['msg'] = "".validation_errors();
			$data['menu'] = $this->input->post('menu');
			$this->load->view('batik/transaksi/new',$data);
		}else{
			list($data['id_cust'],$nama) = explode(' - ',$this->input->post('cust'));
			list($data['id_batik'],$nama) = explode(' - ',$this->input->post('batik'));
			$data['ukuran'] = $this->input->post('ukuran');
			$data['jumlah'] = $this->input->post('jumlah');
			$data['keterangan'] = $this->input->post('keterangan');
			$data['tgl_transaksi'] = date('Y-m-d');
			$result = $this->transaksi_model->add($data);
			if($result){
				$res = 1;
				redirect(base_url('batik/transaksi/index/'.$menu.'/'.$res));
			}else{
				$res = 0;
				redirect(base_url('batik/transaksi/index/'.$menu.'/'.$res));
			} 
		}
	}
}
?>