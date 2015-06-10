<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transaksi_model extends CI_Model {
	function All(){
		$this->db->select('transaksi.id_transaksi,transaksi.tgl_transaksi,customers.nama_cust,batik.nama_batik,transaksi.ukuran,transaksi.jumlah,transaksi.keterangan');
		$this->db->join('customers','transaksi.id_cust=customers.id_cust');
		$this->db->join('batik','transaksi.id_batik=batik.id_batik');
		$query = $this->db->get('transaksi');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
    }
	function detail($cust){
		$this->db->select('transaksi.id_transaksi,transaksi.tgl_transaksi,batik.nama_batik,transaksi.ukuran,transaksi.jumlah,transaksi.keterangan');
		$this->db->where('transaksi.id_cust',$cust);
		$this->db->join('batik','transaksi.id_batik=batik.id_batik');
		$query = $this->db->get('transaksi');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function keterangan($id){
		$this->db->select('keterangan,id_cust');
		$this->db->where('id_transaksi',$id);
		$query = $this->db->get('transaksi');
		if($query->row_array()>0){
			$result = array();
			foreach($query->result_array() as $data){
				$this->db->select('foto');
				$this->db->where('id_cust',$data['id_cust']);
				$q = $this->db->get('customers');
				$result['keterangan'] = $data['keterangan'];
				foreach($q->result_array() as $d){
					$result['foto'] = $d['foto'];
				}
				return $result;
			}
		}
		return NULL;
	}
	function add($data) {
        $this->db->insert('transaksi', $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
    }
	function delete($id){
		$this->db->where('id_transaksi',$id);
		$this->db->delete('transaksi'); 
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function get_foto($id){
		$this->db->select('foto');
		$this->db->where('id_batik',$id);
		$query = $this->db->get('batik');
		if($query->row_array()>0){
			foreach($query->result_array() as $data){
				$foto = $data['foto'];
			}
			return $foto;
		}
		return NULL;
	}
	function update($data){
		$value = array('nama_batik'=>$data['nama_batik'],'keterangan'=>$data['keterangan'],'foto'=>$data['foto'],'update_at'=>$data['update_at']);
		$this->db->where('id_batik',$data['id_batik']);
		$this->db->update('batik',$value);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function find($id){
		$this->db->where('id_batik',$id);
		$query = $this->db->get('batik');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
}
?>