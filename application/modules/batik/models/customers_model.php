<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customers_model extends CI_Model {
	function All(){
		$query = $this->db->get('customers');
		$result = array();
		if($query->row_array()>0){
			$i = 0;
			$x = array();
			foreach($query->result_array() as $data){
				$x = $data;
				$this->db->select('count(id_transaksi) as jumlah');
				$this->db->where('id_cust',$data['id_cust']);
				$q = $this->db->get('transaksi');
				if($q->row_array()>0){
					foreach($q->result_array() as $d){
						$x['jumlah']= $d['jumlah'];
					}
				}else{
					$x['jumlah'] = 0;
				}
				array_push($result,$x);
				$i++;
			}
			return $result;
		}
		return NULL;
    }
	function get_json($data){
		$cust = array();
		$this->db->like('nama_cust',$data['q']);
		$query = $this->db->get('customers');
		if($query->num_rows > 0){
			$i = 0;
			foreach($query->result_array() as $data){
				$cust[$i] = $data['id_cust']." - ".$data['nama_cust'];
				$i++;
			}
			return $cust;
		}
		return NULL;
	}
	function add($data) {
        $this->db->insert('customers', $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
    }
	function delete($id){
		$this->db->where('id_cust',$id);
		$this->db->delete('customers'); 
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function get_foto($id){
		$this->db->select('foto');
		$this->db->where('id_cust',$id);
		$query = $this->db->get('customers');
		if($query->row_array()>0){
			foreach($query->result_array() as $data){
				$foto = $data['foto'];
			}
			return $foto;
		}
		return NULL;
	}
	function update($data){
		$value = array('nama_cust'=>$data['nama_cust'],'alamat'=>$data['alamat'],'kota'=>$data['kota'],'telp'=>$data['telp'],'foto'=>$data['foto'],'update_at'=>$data['update_at']);
		$this->db->where('id_cust',$data['id_cust']);
		$this->db->update('customers',$value);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function find($id){
		$this->db->where('id_cust',$id);
		$query = $this->db->get('customers');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
}
?>