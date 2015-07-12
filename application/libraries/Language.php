<?php
class Language extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
 
    function lang($language = "") {
        $language = ($language != "") ? $language : "message";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }
}