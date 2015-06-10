<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class batik_model extends CI_Model {
	function All(){
		$query = $this->db->get('batik');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
    }
	function galery($limit,$offset){
        $query=  $this->db->get('batik', $limit, $offset);
        if($query->num_rows()>0){
            return $query->result_array();
        }
		return NULL;
    }
	function add($data) {
        $this->db->insert('batik', $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
    }
	function get_json($data){
		$cust = array();
		$this->db->like('nama_batik',$data['q']);
		$query = $this->db->get('batik');
		if($query->num_rows > 0){
			$i = 0;
			foreach($query->result_array() as $data){
				$cust[$i] = $data['id_batik']." - ".$data['nama_batik'];
				$i++;
			}
			return $cust;
		}
		return NULL;
	}
	function delete($id){
		$this->db->where('id_batik',$id);
		$this->db->delete('batik'); 
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