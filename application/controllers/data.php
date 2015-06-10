<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Controller {

	function __construct(){
        parent::__construct();
	}
	function get_cust(){
		$this->load->model('batik/customers_model');
		$data['q']= $this->input->get('term');
		$data['cust'] = $this->customers_model->get_json($data);
		echo json_encode($data['cust']);
	}
	function get_batik(){
		$this->load->model('batik/batik_model');
		$data['q']= $this->input->get('term');
		$data['batik'] = $this->batik_model->get_json($data);
		echo json_encode($data['batik']);
	}
	function detail($cust){
		$this->load->helper('url');
		$this->load->library('my_encrypt');
		$this->load->helper('security');
		if($this->security->xss_clean($cust)){
			$cust = $this->my_encrypt->decode($cust);
			$this->load->model('batik/transaksi_model');
			$data['detail'] = $this->transaksi_model->detail($cust);
			$this->load->view('batik/customers/detail',$data);
		}
	}
	function galery($id=''){
		$this->load->library('my_encrypt');
		$this->load->helper('security');
		if($this->security->xss_clean($id)){
			$id = $this->my_encrypt->decode($id);
			$this->load->model('batik/batik_model');
			$data['detail'] = $this->batik_model->find($id);
			$this->load->view('batik/batik/detail',$data);
		}
	}
	function ket($id=''){
		$this->load->model('batik/transaksi_model');
		$data['keterangan'] = $this->transaksi_model->keterangan($id);
		$this->load->view('batik/customers/keterangan',$data);
	}
}
?>