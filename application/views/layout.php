<?php
//This file will merge the header and footer
$this->load->view('includes/header'); // Include Header  
$this->load->view($main_content); // Insert View Content
$this->load->view('includes/footer'); // Include Footer
?>

