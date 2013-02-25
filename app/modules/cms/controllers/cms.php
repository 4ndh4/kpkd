<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller {

	function __construct(){
		parent::__construct();
        
        $this->load->model('model_cms');
	}
	
	public function index()
	{
		$this->load->view('cms');
	}
    
    function test(){
        echo base_url().'<br>';
        echo $this->model_cms->test();
    }
    
}
