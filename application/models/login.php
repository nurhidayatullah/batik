<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model {
	function ceck_login(){
		$this->load->library('session');
        $user_id = $this->session->userdata('kode_user');
		if($user_id){
             return TRUE;
		}else{
             return FALSE;
		}
	}
	function do_login($data){
		$this->db->select('a.*,b.nama_group');
		$this->db->where('a.email',$data['email']);
		$this->db->where('a.password',$data['password']);
		$this->db->where('a.active',1);
		$this->db->join('group_user as b','a.kode_group=b.kode_group');
		$user = $this->db->get('user as a');
		if($user->num_rows() ==1){
			return $user->result_array();
		}
		return NULL;
	}
}
?>