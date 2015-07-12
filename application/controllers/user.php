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

//User Management Controller

class User extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('form_helper');
		$this->load->library("Aauth");
	}

	function index(){
		redirect('/');
	}

	function login(){
        

		if($this->aauth->login($this->input->post('username'), $this->input->post('password'))){
			redirect('dashboard');
		} else{
			$data['error'] = 'login_error';
			$this->load->view('user/login_view', @$data);
		}
	}
	public function logout(){

		$this->aauth->logout();
		redirect('/');
	}
    
	public function pm(){ 
		if($this->input->post('msg')&&$this->input->post('sendto')&&$this->input->post('subject')){
			//var_dump($this->aauth->get_user()->id.'  '.$sendto);
			$res=$this->aauth->send_pm($this->aauth->get_user()->id,$this->input->post('sendto'),$this->input->post('subject'),$this->input->post('msg'));
			//$res=$this->aauth->send_pm(2,1,'Hi bro. i need you',' can you gimme your credit card?');
			if($res){
				$this->load->view('alerts/success',array('msg'=>'Message Sent'));
				echo '<div id="refresh"></div>';
				//echo $this->aauth->hash_password('Damith', 1);


			}
			else{
				//var_dump();
				$this->load->view('alerts/error',array('msg'=>$this->aauth->get_errors_array()[0]));
				echo '<div id="refresh"></div>';
			}
		}
		else{
			$data['users']=$this->aauth->list_users();
			//var_dump($this->aauth->list_users());
			//$this->aauth->send_pm(2, 3, 'Message subject', 'Msg body');
			$this->load->view('user/pm_compose',$data);					
		}
		
	}
	public function getpm($read=false){
		$data['pms']=$this->aauth->list_pms(50,0,$this->aauth->get_user_id());
		//var_dump($data);
		$this->load->view('user/pm_view',$data);
	}
	public function viewpm($id=1,$delete=false){
		if(!$delete){
			
			echo '<h4>'.$this->aauth->get_pm($id)[0]->title.'</h4>';
			echo $this->aauth->get_pm($id)[0]->message;
		}
		else{
			
			$res=$this->aauth->delete_pm($id);
			if($res){
				$this->load->view('alerts/success',array('msg'=>'Message Deleted<div id="refresh"/>'));
			}
			else{
				$this->load->view('alerts/error',array('msg'=>'Message Delete Failed<div id="refresh"/>'));
			}
		}
		
	}
	
	public function add(){
		if(!$this->input->post()){

			$this->load->view('user/add');
		}
		else{
			$res=@$this->aauth->create_user($this->input->post('email'), $this->input->post('password'), $this->input->post('username'));
			//$this->aauth->add_member();
			if(!$res)
			{
				$data['msg']=$res;
				$this->load->view('alerts/error',$data);
				echo '<div id="refresh"></div>';
			}
			else {
				$data['msg']="User Profile was Successfully Created";
				$this->load->view('alerts/success',$data);
				echo '<div id="refresh"></div>';
			}
			
		}
		
	}
	
	public function assign(){
		if(!$this->input->post()){
			$data['groups']=$this->aauth->list_groups();
			$data['priv']=$this->aauth->list_perms();
			$data['users']=$this->aauth->list_users();
			$this->load->view('user/assign',$data);
			//$this->aauth->add_member(2,2);
			//$this->aauth->add_member(2,1);
		}
		else{
			$exgroups=$this->aauth->get_user_groups($this->input->post('id'));
			foreach($exgroups as $exgroup){
				echo $this->aauth->remove_member($this->input->post('id'),$exgroup->id);
				//echo $exgroup->id;
			}
			$this->aauth->assign_company($this->input->post('id'),$this->input->post('department'));
			
			/*$groups=$this->aauth->get_user_groups($this->input->post('gro'));
			foreach($exgroups as $exroup){
				$this->aauth->remove_member($this->input->post('id'),$exgroup->id);
			}
			*/
			//echo $this->input->post('id')." ".$this->input->post('department');
		//die();
			/*$this->aauth->add_member($this->input->post('id'),$this->input->post('department'));
			//var_dump();*/
			foreach($this->aauth->list_perms() as $experm){
			$query="delete from aauth_perm_to_user where  user_id='".$this->input->post('id')."' and perm_id='".$experm->id."'";
			$this->db->query($query);
			}
			
			foreach($this->input->post('role') as $perm){
				$act=$this->aauth->allow_user($this->input->post('id'),$perm);
				//echo($perm);
				$this->aauth->print_errors();
				if($act)
				{
					$data['msg']=lang('change_permission');
					$this->load->view('alerts/success',$data);
					echo('<div id="refresh"></div>');
				}
				else
				{
					$data['msg']=lang('change_permission');
					$this->load->view('alerts/error',$data);
					echo('<div id="refresh"></div>');
				}
			}
			//var_dump($this->aauth->get_user_groups($this->input->post('id')));
			//var_dump($this->aauth->($this->input->post('id')));
			
		}
	}
	
	public function add_inst(){
		
		
	}
	public function add_perm(){
		
	}
	
	public function delete($uid=FALSE)
	{
		//echo $uid;
		//die();
		if($uid==FALSE||$uid==1)
		{
			redirect("/dashboard?error=Cannot Delete Admin");
			
		}
		else
		{
			$this->aauth->delete_user($uid);
			header('location:'.$_SERVER['HTTP_REFERER']);
		}
	}
	public function test()
	{
		echo $this->aauth->hash_password('ucsc@123',1);
		echo $this->aauth->print_errors();
		echo $this->aauth->print_infos();

	}

}
?>

