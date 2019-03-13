<?php

class Short_model extends CI_Model {

    public function __construct()
    {


    }
}


/*
class short_url extends CI_Model {

    public function __construct()
    {

    }

    public function check_long($url = '')
    {
        $query = $this->db->get('url');
        return $query->row_array();
    }
    public function set_short($short ='false', $long = 'false')
    {
        $data = array(
        'short' => $short,
        'long' => $long
        );
        $this->db->insert('url', $data);
    }
}*/