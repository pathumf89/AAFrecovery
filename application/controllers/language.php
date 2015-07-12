<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Language extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function lang($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect(@$_SERVER['HTTP_REFERER']) or redirect(base_url()) ;
    }

}
