<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class PUTmotivasi extends REST_Controller
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
        $this->load->model('motivasi');
    }

    function index_put()
    {
        $id = $this->put('id');

        // Get the post data
        $isi_motivasi = strip_tags($this->put('isi_motivasi'));




        // Validate the post data
        if (!empty($isi_motivasi)) {
            // Update motivasi's 
            $Data = array();
            if (!empty($isi_motivasi)) {
                $Data['isi_motivasi'] = $isi_motivasi;
            }


            $update = $this->motivasi->update($Data, $id);

            // Check if the user data is updated
            if ($update) {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'user berhasil updated postingan.'
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
