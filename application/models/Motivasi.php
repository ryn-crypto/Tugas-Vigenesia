<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class motivasi extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        // Load the database library
        $this->load->database();

        $this->mTbl = 'motivasi';
        $this->muser='user';


    }

    /*
     * Insert motivasi data
     */
    public function insert($data)
    {
        //add created and modified date if not exists
        if (!array_key_exists("tanggal_input", $data)) {
            $data['tanggal_input'] = date("Y-m-d H:i:s");
        }



        //insert motivasi data to motiasi table
        $insert = $this->db->insert($this->mTbl, $data);

        //return the status
        return $insert ? $this->db->insert_id() : false;
    }

    /*
     * Update materi data
     */
    public function update($data, $id)
    {
        //add modified date if not exists
        if (!array_key_exists("tanggal_update", $data)) {
            $data['tanggal_update'] = date("Y-m-d H:i:s");
        }

        //update materi data in materi table
        $update = $this->db->update($this->mTbl, $data, array('id' => $id));

        //return the status
        return $update ? true : false;
    }

    /*
     * Delete materi data
     */
    public function delete($id)
    {
        //update mater from materi table
        $delete = $this->db->delete('materi', array('id' => $id));
        //return the status
        return $delete ? true : false;
    }
}
