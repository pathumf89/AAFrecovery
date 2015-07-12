<?php

if(!defined('BASEPATH'))
exit('No direct script access allowed');
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

if(!defined('BASEPATH'))
exit('No direct script access allowed');

class Approve extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if(!$this->aauth->is_loggedin()&&$this->aauth->is_loggedin()){
			redirect('/');
		}
		$this->load->model('approval_model');
	}
		
	function index(){
		
		$data=$this->approval_model->getQueue();
		$data['main_content'] = 'admin/approval_queue';
		$this->load->view('layout',$data);
		
		
	}
	
	function approveForm($id=-1){
		$res=$this->approval_model->approveForm($id);
		if($res){
			?>
			<div class="alert alert-block alert-success">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Form <?=$id?> Approval Success!</h4>
				We have succesfully saved your data
			</div>
			<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			<div id="refresh"></div>
			<?
		}
		else{ ?>
			<div class="alert alert-block alert-warning">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Form <?=$id?> Approval Failed!</h4>
				Sorry We cannot save your data.
			</div>
			<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			<?
		}
	}
	function approveStandard($rowid=-1,$id=-1,$min=null,$max=null){
		$res=$this->approval_model->approveStandard($rowid,$id,$min,$max);
		if($res){
			?>
			<div class="alert alert-block alert-success">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Standard <?=$id?> Approval Success!</h4>
				We have succesfully saved your data
			</div>
			<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			<div id="refresh"></div>
			<?
		}
		else{ ?>
			<div class="alert alert-block alert-warning">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Standard <?=$id?> Approval Failed!</h4>
				Sorry We cannot save your data.
			</div>
			<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			<?
		}
		}
		
		function approveAlert($id){
		$res=$this->approval_model->approveAlert($id);
		if($res){
			?>
			<div class="alert alert-block alert-success">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Alert <?=$id?> Approval Success!</h4>
				We have succesfully saved your data
			</div>
			<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			<div id="refresh"></div>
			<?
		}
		else{ ?>
			<div class="alert alert-block alert-warning">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Alert <?=$id?> Approval Failed!</h4>
				Sorry We cannot save your data.
			</div>
			<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			<?
		}

	}
	
	function reject($type=null,$uid=null,$id=null)
	{
		if($this->input->post())
		{
			var_dump($this->input->post());
		
		}
		else {
			
		$this->load->model('approval_model');
		switch($type)
		{
			case "Alert" :
			$data['msg']="Rejecting Alert ID ".$id;
			$data['uid']=$uid;
			$this->approval_model->rejectAlert($id);
			break;
			
			case "Form" :
			$data['msg']="Rejecting Form ID ".$id;
			$data['uid']=$uid;
			//var_dump($data);
			$this->approval_model->rejectForm($id);
			break;
			
			case "Standard" :
			$data['msg']="Rejecting Standard ID ".$id;
			$data['uid']=$uid;
			$this->approval_model->rejectStandard($id);
			break;
		}
		$this->load->view('user/pm_direct',$data);
		echo '<div id="refresh"></div>';
		}
	}
		
}
