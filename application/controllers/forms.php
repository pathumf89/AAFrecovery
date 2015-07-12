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
* Description of forms
*
* @author T.H.M. Kothalawala
*/
class Forms extends CI_Controller{

	function __construct(){
		parent::__construct();
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}
	}

	public function index(){
		redirect('/');
	}

	public function add(){

		if($this->input->post()){

			$formdata = $this->input->post();
			$this->load->model('form_model');
			$this->load->model('user_model');
			$formdata['DeptId']=$this->user_model->get_group();
			unset($formdata['MajorGroupId']);
			unset($formdata['SubGroupId1']);
			unset($formdata['SubGroupId2']);
			unset($formdata['SubGroupId3']);
			unset($formdata['SubGroupId4']);
			unset($formdata['SubGroupId5']);
			unset($formdata['Description2']);
			unset($formdata['Min']);
			unset($formdata['Max']);
			unset($formdata['isTotal']);
			//unset($formdata['TimePeriod']);
			//$formdata['Status']='active';
			#$res=false;
			$res=$this->form_model->add($formdata, $this->input->post('MajorGroupId'), $this->input->post('SubGroupId1', true), $this->input->post('SubGroupId2', true), $this->input->post('SubGroupId3', true), $this->input->post('SubGroupId4', true), $this->input->post('SubGroupId5', true), $this->input->post('Istotal', true), $this->input->post('Min', true), $this->input->post('Max', true), $this->input->post('Description2'));
			//redirect('FormManager/AddForm', 'refresh');
                       
			if($res){
				$script="alert('Financial Statement was Successfully Saved.');";
				//echo $script;
			}
			else{
				$script="alert('ERROR: Unable to Save the Financial Statement.');";
			}
		}
		@$data['script']=$script;
		$data['main_content'] = 'forms/add';
		$this->load->view('layout', $data);
	}
    
	public function all(){
		$this->load->model('form_model');
		$data['res']=$this->form_model->getForm();
		$data['main_content'] = 'forms/list';
		$this->load->view('layout', $data);
	}
	
	public function dataentry(){
		$this->load->model('form_model');
		$data['res']=$this->form_model->getForm();
		$data['main_content'] = 'forms/dataentry';
		$this->load->view('layout', $data);
	}
	
	public function view($id=-1){
		$this->load->model('form_model');
		$form=$this->form_model->getForm($id);
		$fields=$this->form_model->getRows($id);
		foreach($form as $row){
			echo "<h1>".$row->Heading."</h1>";
			echo '<div class="alert alert-info"><ul><li>'.$row->SubHeading1."</li>";
			echo "<li>".$row->SubHeading2."</li></div>";
			echo "<div class='alert alert-warning'>You are entering data as ".$this->aauth->get_user()->name." to ".$this->aauth->get_group_name($this->aauth->get_company())."</li></div>";
			echo "<p>".$row->Description."</p>";
			//echo $row->SubHeading1;
			
		}?>
		
		<div class="widget-box" style="margin: 5px;">
			<div class="widget-title">
				<span class="icon">
					<i class="fa fa-th"></i>
				</span>
				<h5><?=$row->FormCode;?></h5>
			</div>
			
			<div class="widget-content nopadding">
				<form action="<?=base_url()?>forms/save/<?=$id?>" id="ajaxform">
				
					<?php
					if($row->TimePeriod=="Y" || $row->TimePeriod=="M" || $row->TimePeriod=="W"){
					
				
						?>
						<div class="form-group">
							<label class="control-label">Select Year</label>
							<div class="">
								<select name="Y">
									<?php for($count=2000;$count<=2014;$count++){
						
										?>
										<option value="<?=$count?>"><?=$count?></option>
										<?php } ?>
								</select>
							</div>
						</div>
									
						<?php } ?>
						<?php
					if($row->TimePeriod=="M"){
					
				
						?>
						<div class="form-group">
							<label class="control-label">Select Month</label>
							<div class="">
								<select name="M">
									<?php for($count=1;$count<=12;$count++){
						
										?>
										<option value="<?=$count?>"><?=$count?></option>
										<?php } ?>
								</select>
							</div>
						</div>
									
						<?php } ?>
						<?php
					if($row->TimePeriod=="W"){
					
				
						?>
						<div class="form-group">
							<label class="control-label">Select Week</label>
							<div class="">
								<select name="W">
									<?php for($count=1;$count<=52;$count++){
						
										?>
										<option value="<?=$count?>"><?=$count?></option>
										<?php } ?>
								</select>
							</div>
						</div>
									
						<?php } ?>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Input Ref Number</th>
								<th>Description</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>

							<?php
							foreach($fields as $frow){
								echo "<tr>";
								echo "<td>".$frow->MajorGroupId.".".$frow->SubGroupId1.".".$frow->SubGroupId2.".".$frow->SubGroupId3.".".$frow->SubGroupId4.".".$frow->SubGroupId5.'</td>';
								echo '<td>'.$frow->Description.'</td>';
								echo '<td><input name="'.$frow->Id.'" type="text"></td>';
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<div class="modal-footer">
        
			
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" onclick="saveform()" class="btn btn-primary">Save changes</button>
		</div>
		<?
	}

	public function preview($id=-1,$view=FALSE){
		$this->load->model('form_model');
		$form=$this->form_model->getForm($id);
		$fields=$this->form_model->getRows($id);
		foreach($form as $row){
			echo "<h1>".$row->Heading."</h1>";
			echo '<div class="alert alert-info"><ul><li>'.$row->SubHeading1."</li>";
			echo "<li>".$row->SubHeading2."</li></div>";
			echo "<p>".$row->Description."</p>";
			//echo $row->SubHeading1;
			
		}?>
		<div class="widget-box" style="margin: 5px;">
			<div class="widget-title">
				<span class="icon">
					<i class="fa fa-th"></i>
				</span>
				<h5><?=$row->FormCode;?></h5>
			</div>
			<div class="widget-content nopadding">
				
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Input Ref Number</th>
							<th>Description</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>

						<?php
						foreach($fields as $frow){
							echo "<tr>";
							echo "<td>".$frow->MajorGroupId.".".$frow->SubGroupId1.".".$frow->SubGroupId2.".".$frow->SubGroupId3.".".$frow->SubGroupId4.".".$frow->SubGroupId5.'</td>';
							echo '<td>'.$frow->Description.'</td>';
							echo '<td><input name="'.$frow->Id.'" type="text" value="'.@$this->form_model->get_sigle_row($view,$frow->Id)->value.'"></td>';
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
				</form>
			</div>
		</div>
		<?
	}

	public function save($id=-1){
		$res=false;
		$this->load->model('form_model');
		$post=$this->input->post();
		$Y=null;
		$M=null;
		$W=null;
		
		if(isset($post['Y'])){
			$Y=$post['Y'];
			unset($post['Y']);
		}
		if(isset($post['M'])){
			$M=$post['M'];
			unset($post['M']);
		}
		if(isset($post['W'])){
			$Y=$post['W'];
			unset($post['W']);
		}
	
		
		
		$cntrl_form_data_master_id=$this->form_model->get_master_id($id);
		//echo $cntrl_form_data_master_id;
		//die();
		//var_dump($post);
		while( $x = current($post)){
			if($Y!=null){
				$row['Y']=$Y;
			}
			if($M!=null){
				$row['M']=$M;
			}
			if($W!=null){
				$row['W']=$W;
			}
			
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

	public function delete($id=-1){
		$this->load->model('form_model');
		$this->form_model->deleteForm($id);
		redirect('/forms/all');
	}

	
}

