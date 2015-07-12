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

/**
* Description of Standards
*
* @author T.H.M. Kothalawala
*/
class Standards extends CI_Controller{

	function __construct(){
		parent::__construct();
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}
	}

	public function index(){
		redirect('/');
	}
    
	public function add($FormCode=-1,$RowId=-1,$Min=null,$Max=null){
		$this->load->model('form_model');
		$data['FormCode']=$FormCode;
		$data['RowId']=$RowId;
		$data['Min']=$Min;
		$data['Max']=$Max;
		@$data['rows']=$this->form_model->getRows($FormCode);
		@$data['forms']=$res=$this->form_model->getForm();
		$this->load->view('standards/bs_add',$data);
		
	}
	
	public function update($Id=-1){
		//if(!$this->input->post()) { redirect('/');}
		if(empty($this->input->post('Min')) && empty($this->input->post('Max'))){
			$this->load->model('form_model');
			$data['Id']=$Id;
			$data['Description']=$this->form_model->getRow($Id)->Description;
			@$data['Min']=$this->form_model->getRow($Id)->Min;
			@$data['Max']=$this->form_model->getRow($Id)->Max;
			$this->load->view('standards/bs_update',$data);
		}
		elseif(!empty($this->input->post('Min')) && !empty($this->input->post('Max'))){
			$this->load->model('standard_model');
			$res=$this->standard_model->updateStandard($Id,$this->input->post());
			$data['res']=$res;
			$data['save']=true;
			$this->load->view('standards/bs_update',$data);
		}
		echo '<div id="refresh"></div>';
	}
	
	public function all(){
		
		$this->load->model('standard_model');
		$data['res']=$this->standard_model->listeStandards();
		$data['main_content'] = 'standards/list';
		$this->load->view('layout', $data);
	
	}
	
	public function delete($id=-1){
		$this->load->model('standard_model');
		$this->standard_model->resetStandard($id);
		redirect('/standards/all');
	}
}
