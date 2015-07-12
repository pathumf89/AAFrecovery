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

class Dataupload extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}
		$this->load->helper(array('form', 'url'));
	}

	public function index(){
		@$data['FormCode']=$this->input->get('FormCode');
		$data['error']='';
		$this->load->view('dataupload/index',$data);
	}

	function do_upload($FormCode){
		$data['FormCode']=$FormCode;
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'txt';
		$config['max_size']	= '2000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if( ! $this->upload->do_upload()){
			$data['error'] = $this->upload->display_errors();

			$this->load->view('dataupload/index', $data);
		}
		else{
			//var_dump($this->upload->data());
			$file = fopen($this->upload->data()['full_path'],"r");
			$cols=fgetcsv($file,100,',','"');
			$feilds=fgetcsv($file,100,',','"');
			$i=0;
			$post=array();
			foreach($cols as $col)
			{
				$post[explode('|',$col)[0]]=$feilds[$i];
				$i++;
			}
			//($data);
			fclose($file);
			
			$res=false;
		$this->load->model('form_model');
		//$post=$this->input->post();
		
		$cntrl_form_data_master_id=$this->form_model->get_master_id($FormCode);
		//echo $cntrl_form_data_master_id;
		//die();
		//var_dump($post);
		while( $x = current($post)){
			$row['cntrl_form_data_master_id']=$cntrl_form_data_master_id;
			$row['value']=$x;
			$row['rowid']=key($post);
			$this->load->model('user_model');
			$row['companyid']=$this->user_model->get_group();
			//var_dump($row);
			$res=$this->form_model->saveRows($row);
			unset($row);
			next($post);
		}
		if($res){
			?>
			<div class="alert alert-block alert-success">
				
				<h4 class="alert-heading">Form <?=$FormCode?> Save Success!</h4>
				We have succesfully saved your data<br />
				<a  href="#" onclick="window.close();">close</a>
			</div>
			<?
		}
		else{ ?>
			<div class="alert alert-block alert-warning">
				
				<h4 class="alert-heading">Form <?=$FormCode?> Save Faid!</h4>
				Sorry We cannot save your data.<br/>
				
				<a href="#" onclick="window.close();">close</a>
			</div>
			<?
		}
	
			//$this->load->view('dataupload/success', $data);
		}
	}
	
	public function save($id=-1){
		$res=false;
		$this->load->model('form_model');
		$post=$this->input->post();
		
		$cntrl_form_data_master_id=$this->form_model->get_master_id($id);
		//echo $cntrl_form_data_master_id;
		//die();
		//var_dump($post);
		while( $x = current($post)){
			$row['cntrl_form_data_master_id']=$cntrl_form_data_master_id;
			$row['value']=$x;
			$row['rowid']=key($post);
			$this->load->model('user_model');
			$row['companyid']=$this->user_model->get_group();
			//var_dump($row);
			$res=$this->form_model->saveRows($row);
			unset($row);
			next($post);
		}
		if($res){
			?>
			<div class="alert alert-block alert-success">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Form <?=$id?> Save Success!</h4>
				We have succesfully saved your data
			</div>
			<?
		}
		else{ ?>
			<div class="alert alert-block alert-warning">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Form <?=$id?> Save Faid!</h4>
				Sorry We cannot save your data.
			</div>
			<?
		}
	}
	
	
	public function download_template($id=-1,$view=FALSE){
		$this->load->model('form_model');
		$form=$this->form_model->getForm($id);
		//var_dump($form);
		$fields=$this->form_model->getRows($id);
		//echo "test";
		$data="";
		if($form[0]->TimePeriod=="Y"||$form[0]->TimePeriod=="W"||$form[0]->TimePeriod=="M")
		{
			$data.='"Y|Year",';
		}
		if($form[0]->TimePeriod=="W"||$form[0]->TimePeriod=="M")
		{
			$data.='"M|Month",';
		}
		if($form[0]->TimePeriod=="W")
		{
			$data.='"W|Week",';
		}
		
		foreach($fields as $frow){
								
			$data.='"'.$frow->Id.'|'.$frow->Description.'",';
			
		}
		$data=rtrim($data,',');
		$data=ltrim($data,','); 
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename='.$id."_TEMPLATE.txt");
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . strlen($data));
		header('Content-Type: text/plain');
		echo $data;
		
	}


}
?>