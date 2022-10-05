<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class PUTprofile extends REST_Controller
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
        $this->load->model('user');
    }

    function index_put()
    {
        $id = $this->put('iduser');

        // Get the post data
        $nama = strip_tags($this->put('nama'));

        $profesi = strip_tags($this->put('profesi'));
        $email = strip_tags($this->put('email'));
        $password = $this->put('password');


        // Validate the post data
        if (!empty($nama)  && !empty($profesi) && !empty($email) && !empty($password)) {
            // Update user's account data
            $userData = array();
            if (!empty($nama)) {
                $userData['nama'] = $nama;
            }

            if (!empty($profesi)) {
                $userData['profesi'] = $profesi;
            }
            if (!empty($email)) {
                $userData['email'] = $email;
            }
            if (!empty($password)) {
                $userData['password'] = md5($password);
            }

            $update = $this->user->update($userData, $id);

            // Check if the user data is updated
            if ($update) {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'user berhasil updated profile baru.'
                ], REST_Controller::HTTP_OK);
            } else {
                // Set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            // Set the response and exit
            $this->response("Provide at least one user info to update.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
