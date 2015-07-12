<?php

/*

* The MIT License (MIT)

* Copyright (c) 2014 <T.H.M Kothalawala>

* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:

* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.

* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*/
?>

<?php

Class Extras_Model extends CI_Model{
function setemail(){
	$email="xyz@gmail.com";
	$subject="some text";
	$message="some text";
	$this->sendEmail($email,$subject,$message);
}
function sendEmail($email,$subject,$message,$attach=null){
	//var_dump($email);
	$config = Array(
		'protocol' => 'smtp',
		//'smtp_host' => 'ssl://smtp.googlemail.com',
		'smtp_host' => 'localhost',
		//'smtp_port' => 465,
		'smtp_port' => 25,
		'smtp_user' => 'fdcas@mail.cbsl.lk', 
		'smtp_pass' => 'test', 
		'mailtype' => 'html',
		'charset' => 'utf-8',
		'wordwrap' => TRUE
	);


	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");
	$this->email->from('fdcas@mail.cbsl.lk');
	$this->email->to($email);
	$this->email->subject($subject);
	$this->email->message($message);
	$this->email->attach($attach);
	if($this->email->send()){
		//echo 'Email sent.'; 
	}
	else{
		//show_error($this->email->print_debugger());
	}

}



}