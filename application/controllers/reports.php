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
class Reports extends CI_Controller{

	function __construct(){
		parent::__construct();
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}}
	
	public function index(){
		$this->load->model('form_model');
		$data['res']=$this->form_model->getForm2(null,true);
		$data['main_content'] = 'reports/reports';
		$this->load->view('layout', $data);
	}
	public function jasper(){
		$this->load->model('form_model');
		//$data['res']=$this->form_model->getForm();
		$data['main_content'] = 'reports/jasper';
		$this->load->view('layout', $data);
	}
	public function view($FormCode,$id=-1){
		$this->load->model('report_model');
		$this->load->model('form_model');
		//$config['first_url'] = base_url().'/reports/view/'.$id;
		//$config['uri_segment']       = 3;
		//$config['full_tag_open'] = '<div class="fdcas-link" style="float: left">';
		//$config['cur_tag_close'] = '</div>'; 
		//$config['uri_segment'] = '4'; 
		//$config['base_url']          = base_url();
		//$config['base_url'] = site_url('controlpanel');
		$limit2=$this->form_model->getRowCount($FormCode);
		//$config['per_page'] = $this->report_model->getFeildCount($id);
		//$config['total_rows'] = $limit2;
		$res=$this->report_model->getReport($id);
		$ds=$this->form_model->getForm($FormCode);
		$data['res']=$res;
		$data['ds']=$ds;
		//$this->load->library('pagination');
		//$config['base_url'] = base_url().'/reports/view/'.$id;
		//var_dump($config['total_rows']);
		//exit();
		//var_dump($this->report_model->getFeildCount($id));
		
		
		//$this->pagination->initialize($config); 
		//$data['links']=$this->pagination->create_links();
		//$data['main_content'] = 'reports/template';
		$data['main_content'] = 'reports/template';
		$this->load->view('layout', $data);
	}
	
	public function download($uri,$name,$type=null){
		$uri="/CBSL/".$uri; 
		$name=(($name));
		//echo $uri;
		if($type==null){
			$type='pdf';
		}
		$this->load->library('jasperclient');
		$c=new jasperclient();
		
		//var_dump($c->repositoryService('resources/reports/samples'));
		$report = $c->reportService()->runReport($uri,$type);
 		if($type!='html')
 		{
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename='.$name.".".$type);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . strlen($report));
		header('Content-Type: application/'.$type);
		}
		
 		echo $report;	//*/
	}
	
	public function listall(){

		$opts = array (
			'http' => array (
				'method' => "GET",
				'header' => "Authorization: Basic " . base64_encode ( "jasperadmin:jasperadmin" ) .
				"\r\n" 
			) 
		);

		$context = stream_context_create ( $opts );

		//read the feed
		$fp = fopen ( 'http://localhost:8080/jasperserver/rest/resources/CBSL', 'r', false, $context );

		//here you got the content
		$context = stream_get_contents ( $fp );

		fclose ( $fp );

		$doc = new DOMDocument ();

		//load the content
		$doc->loadXML ( $context );
		
		$employees = $doc->getElementsByTagName( "resourceDescriptor" );
		
		$res=array();
		$i=0;
		foreach( $employees as $employee ){
			$res[$i]['uri']=$employee->getAttribute('uriString');
			$res[$i]['name']=$employee->getAttribute('name');
			$res[$i]['ctime']=$employee->getAttribute('creationDate');
			$i++;
			//$names = $employee->getElementsByTagName( "namාe" );
			//$name = $names->item(0)->nodeValue;ි
	
		}
		
		
		$data['res']=$res;
		$data['main_content'] = 'reports/dynamic';
		$this->load->view('layout', $data);

	}
}