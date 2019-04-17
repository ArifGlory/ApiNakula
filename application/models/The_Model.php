<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 16/04/2019
 * Time: 10:48
 */
class The_Model extends CI_Model
{

    var $tb_paket = "paket";
    var $tb_user = "tb_pelanggan";

        function listPaket(){
        $data = $this->db->get($this->tb_paket);
        return $data;
        }

        function user_simpan($data){
            $this->db->insert($this->tb_user,$data);
            $email = $data['email'];
           //print_r($email);

            $pelanggan = $this->db->get_where('tb_pelanggan',array('email'=>$email))->result();
            $idPelanggan = $pelanggan[0]->idPelanggan;
            $this->The_Model->sendEmailVerification($idPelanggan);
        }

        function sendEmailVerification($idPelanggan){
            $pelanggan = $this->db->get_where('tb_pelanggan',array('idPelanggan'=>$idPelanggan))->result();
            $email = $pelanggan[0]->email;

            $data['idPelanggan'] = $pelanggan[0]->idPelanggan;
            $dataEmail = $this->load->view('user_verification',$data,TRUE);

            $config['protocol'] = "smtp";
            $config['smtp_host'] = "ssl://smtp.gmail.com";
            $config['smtp_port'] = "465";
            $config['smtp_user'] = "tapiskuy6@gmail.com";
            $config['smtp_pass'] = "qwerty12345.";
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";

            $this->email->initialize($config);

            $from_email = "tapiskuy3@gmail.com";
            $to_email = $email;

            $this->email->from($from_email,"Nakula Tour");
            $this->email->to($to_email);
            $this->email->subject('Verifikasi Pendaftaran');
            $this->email->message($dataEmail);
            $this->email->send();


           // $this->load->view('invoice_new',$send);
        }
}