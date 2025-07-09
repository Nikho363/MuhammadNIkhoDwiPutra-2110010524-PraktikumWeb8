<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan_model extends CI_Model {
	protected $_table = 'satuan';
    protected $primary = 'id';

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

}
