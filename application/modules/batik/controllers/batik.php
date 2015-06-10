<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batik extends Admin_Controller {
	var $page = "Data Batik";
	function __construct(){
        parent::__construct();
		$this->load->model('batik/batik_model');
	}
	function index($menu='',$msg=''){
		$data['menu']=$menu;
		$data['priv'] = $this->menu_model->get_priv($menu,$this->session->userdata('kode_group'));
		$data['msg'] = $msg;
		$data['batik'] = $this->batik_model->All();
		$this->load->view('batik/batik/page',$data);
	}
	public function hapus($menu='',$id=''){
		if($this->security->xss_clean($id)){
			$foto = $this->batik_model->get_foto($this->my_encrypt->decode($id));
			if(isset($foto)){
				unlink('./assets/upload/batik/'.$foto);
			}
			$result = $this->batik_model->delete($this->my_encrypt->decode($id));
			if($result){
				$pesan = 1;
				redirect(base_url('batik/batik/index/'.$menu.'/'.$pesan));
			}else{
				$pesan = 0;
				redirect(base_url('batik/batik/index/'.$menu.'/'.$pesan));
			}
		}
	}
	function new_data($menu=''){
		$data['menu'] = $menu;
		$data['msg'] = '';
		$this->load->view('batik/batik/new',$data);
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
		if(isset($_FILES['foto']) && !empty($_FILES['foto']['name'])){
			$config['upload_path'] = './assets/upload/batik/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);
			if( ! $this->upload->do_upload('foto')){
				$data['msg'] = $this->upload->display_errors();
				$data['menu'] = $this->input->post('menu');
				$this->load->view('batik/batik/new',$data);
			}else{
				$upload = $this->upload->data();
				$data['foto'] = $upload['file_name'];
			}
		}
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|xss_clean');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|xss_clean');
		$menu = $this->input->post('menu');
		if ($this->form_validation->run() == FALSE) { 
			$data['msg'] = "".validation_errors();
			$data['menu'] = $this->input->post('menu');
			$this->load->view('batik/batik/new',$data);
		}else{
			$data['nama_batik'] = $this->input->post('nama');
			$data['keterangan'] = $this->input->post('keterangan');
			$data['create_at'] = date("Y-m-d H:s:i");
			$result = $this->batik_model->add($data);
			if($result){
				$res = 1;
				redirect(base_url('batik/batik/index/'.$menu.'/'.$res));
			}else{
				$res = 0;
				redirect(base_url('batik/batik/index/'.$menu.'/'.$res));
			}
		}
	}
	
	function galery($menu='',$num=''){
		$this->page = "Galery";
		$this->load->library('pagination');
		$config['base_url'] = base_url('batik/batik/galery/'.$menu."/");
		$config['total_rows'] = $this->db->get('batik')->num_rows();
		$config['per_page'] = 8;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config['full_tag_open'] = '<div class="box-footer clearfix" id="box"><ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul></div>';
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
		$config['cur_tag_open'] = '<li class="active disabled"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$data['galery'] = $this->batik_model->galery($config['per_page'], $num);
		$this->load->view('batik/batik/galery',$data);
	}
}
?>