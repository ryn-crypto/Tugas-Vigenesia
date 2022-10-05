<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


use Restserver\Libraries\REST_Controller;

class User extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

    //Menampilkan hasil loping login akun user
    function index_get()
    {
        $id = $this->get('iduser');
        if ($id == '') {
            $api = $this->db->get('user')->result();
        } else {
            $this->db->where('iduser', $id);
            $api = $this->db->get('user')->result();
        }
        $this->response($api, 200);
    }
}
