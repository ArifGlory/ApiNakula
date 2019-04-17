<?php

/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 17/04/2019
 * Time: 13:51
 */
class Testing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('The_Model');
    }

    function emailVerification($idUser){

        $this->The_Model->sendEmailVerification($idUser);

    }

    function testEmail(){
        $this->load->view('user_verification');
    }

    function getEmailVerification($idPelanggan){
        $dataUbahPublish = array(
            'publish'=>"T"
        );
        $this->db->where('idPelanggan',$idPelanggan);
        $this->db->update("tb_pelanggan",$dataUbahPublish);

        echo "Akun anda diaktifkan, silahkan login di aplikasi";
    }

}