<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_cms extends CI_Model{
	
    function __construct(){
		parent::__construct();
	}
    
    function test(){
        return "Model Module CMS Test";    
    }
    
}
