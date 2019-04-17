<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 16/04/2019
 * Time: 10:54
 */
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class User extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('The_Model');
    }

    function simpanUserData_post(){
        $data = $this->input->post();
        $this->The_Model->user_simpan($data);
        $this->response($data, 200);
    }


    function login_post(){
        $data = $this->input->post();

        $username = $data['username'];
        $password = $data['password'];

        $cek = $this->db->get_where('users',array('username'=>$username))->num_rows();

        if ($cek > 0){
            $result = $this->db->get_where('users',array('username'=>$username))->result();

            if ($password == $result[0]->password){
                //print_r("login berhasil");
                $this->response("sukses login", 200);
            }else{
                //print_r("login gagal");
                $this->response("gagal login", 500);
            }

        }else{
            $this->response("gagal login username ga ditemukan",500);
        }

    }



}