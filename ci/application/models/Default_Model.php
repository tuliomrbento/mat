<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Default_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #getCount

    function getCount($sql) {
        $query = $this->db->query($sql);
        return $this->db->count_all_results();
    }    
    
    #getRows

    function getRows($sql,$arr = []){
        $query = $this->db->query($sql,$arr); 
        return $query->result();
    }
    
    #getOne

    function getRow($sql,$arr = []) {
        $query = $this->db->query($sql,$arr); 
        return $query->row();
    }

    #execute

    function execute($sql){
        return $this->db->query($sql);
    }

    #delete

    public function delete($table, $where) {
        $this->db->where($where);
        return $this->db->delete($table);
    }
    

    #save

    public function save($table, $data) {

        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
            $data['atualizado_em'] = date('Y-m-d H:i:s');
            //$data['updated_by'] = $_SESSION['user']->id;
            $this->db->where('id', $id);
            $this->db->update($table, $data);
        } else {
            $data['criado_em'] = date('Y-m-d H:i:s');
            //$data['created_by'] = $_SESSION['user']->id;
            $this->db->insert($table, $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }


	public function getWhere($table,$where)
	{
        $query = $this->db->get_where($table, $where);
 
        //row_object() retorna direto o objeto produto e não um array
        return $query->row_object();
	}
}
