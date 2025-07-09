<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kustomer_model extends CI_Model {
	protected $_table = 'kustomer';
    protected $primary = 'id';

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

}
