<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function __construct($config = 'rest') {
         parent::__construct($config);
         $this->load->database();
     }

     function index_get() {
         $id = $this->get('API_ID');
         if ($id == '') {
             $data = $this->db->get('api_table')->result();
         } else {
             $this->$db->where('API_ID',$id);
						 $data = $this->db->get('api_table')->result();
         }
				 $this->response($data, 200);
     }

     function index_post() {
        $data = array('API_ID' => $this->post('id'),
											'API' 	 => $this->post('api'),
											'API2'	 =>	$this->post('api2'));

         $insert = $this->db->insert('api_table',$data);

         if ($insert) {
             $this->response($data, 200);
         } else {
             $this->response(array('status' => 'fail', 502));
         }
     }

     function index_put() {
         $id 	= $this->put('id');
         $data = array('API_ID' => $this->put('id'),
				 							 'API'		=> $this->put('api'),
											 'API2'		=> $this->put('api2'));

	       $this->db->where('api_id',$id);
         $update = $this->db->update('api_table',$data);
         if ($update) {
             $this->response($data, 200);
         } else {
             $this->response(array('status' => 'fail', 502));
         }
     }

     function index_delete() {
         $id = $this->delete('id');
         $this->db->where('api_id', $id);
         $delete = $this->db->delete('api_table');
         if ($delete) {
             $this->response(array('status' => 'success'), 201);
         } else {
             $this->response(array('status' => 'fail', 502));
         }
     }

 }
