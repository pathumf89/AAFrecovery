<?php

if (!defined('BASEPATH'))
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
 * Description of dashboard
 *
 * @author T.H.M. Kothalawala
 */
class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->aauth->is_loggedin())
        {
            redirect('/');
        }
        
    }

    public function index() {
    	$land_page=null;
    	//switch($this->aauth->get_group_name($this->aauth->get_group_id($this->aauth->get_user_id())))
    	//{
    	//	case "APP_ADMIN":
    		$land_page='dashboard/APP_ADMIN';
    		$data['USER_LIST']=$this->aauth->list_users();
    	//	break;
    	//	default:
    	//	$this->load->model('report_model');
    	//	$data['reports']=count($this->report_model->jasperList());
    	//	$data['stat']=$this->report_model->system_stat();
    	//	$land_page='dashboard/index';
    	//	break;
    					
		//}
        $data['main_content'] = $land_page;
      	$this->load->view('layout', $data);
    }

}
