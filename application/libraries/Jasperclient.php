<?php
require_once APPPATH."third_party/jasper/vendor/autoload.php";
 
use Jaspersoft\Client\Client;

class Jasperclient extends Client{
	function __construct(){
		parent::__construct("http://localhost:8080/jasperserver","jasperadmin","jasperadmin");
	}
 
}
?>