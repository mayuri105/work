<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Company_model extends CI_Model {

	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'company';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'company_id';

	public function record_count() {
        $company = $this->input->get('company');
        $enabled = $this->input->get('enabled');

        if($company){
            $this->db->like('company_name',$company);
        }
	    if($enabled){
            if ($enabled ==2) {
                 $this->db->where('enabled','0');
            }else{
                 $this->db->where('enabled',1);
            }
           
        } 
        $this->db->order_by(self::PRI_INDEX,'desc');
        $query = $this->db->get(self::TABLE_NAME)->result();

        return count($query);
		
	}

	public function fetch_data($limit, $start) {
        $company = $this->input->get('company');
        $enabled = $this->input->get('enabled');

        if($company){
            $this->db->like('company_name',$company);
        }
        if($enabled){
            if ($enabled ==2) {
                 $this->db->where('enabled','0');
            }else{
                 $this->db->where('enabled',1);
            }
           
        }
		$this->db->limit($limit, $start);
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function insert(Array $data) {
		if ($this->db->insert(self::TABLE_NAME, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function update(Array $data, $where = array()) {
		if (!is_array($where)) {
			$where = array(self::PRI_INDEX => $where);
		}
		$this->db->update(self::TABLE_NAME, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}

	public function getCompanybyid($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$query = $this->db->get(self::TABLE_NAME)->row();
		return $query;
	}
	public function getCompanybyWallet($id) {
		$this->db->where('company_id', $id);
		$query = $this->db->get('company_wallet')->row();
		return $query;
	}
	public function getCompanybyWalletHistry($id) {
		$this->db->where('company_id', $id);
		$query = $this->db->get('company_wallet_history')->result();
		return $query;
	}
	public function getCompanyProfes($id) {
		$this->db->where('company_id', $id);
		$query = $this->db->get('professionals')->result();
		return $query;
	}
}
