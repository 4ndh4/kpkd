<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    var $css;
    var $images;
    var $js;
    var $title;
    var $themes;
    var $themes_url;
    var $themes_default_url;
    
	function __construct()
    {
		parent::__construct();
        
        $this->css = $this->config->item('css_url');   
        $this->images = $this->config->item('img_url');  
        $this->js = $this->config->item('js_url');   
        $this->title = $this->config->item('app_title');   
        $this->themes = $this->config->item('css_themes');   
        $this->themes_url = $this->config->item('css_themes_url');  
        $this->themes_default_url = $this->config->item('css_themes_default_url'); 	
        
        $this->load->model('tabel');
        
        $this->load->library('session_lib');
        //$this->session_lib->userdata('umb_cms_login');	
        
	}
	
	function index()
	{
		//if ($this->session_lib->userdata('username_umbcms')==''){
        //    $this->login();
        //} else {
            $data['user']       = $this->session_lib->userdata('username_umbcms');
            $data['userid']       = $this->session_lib->userdata('userid_umbcms');
            $data['css']        = $this->css;
            $data['images']     = $this->images;
            $data['js']         = $this->js;
            $data['title']      = $this->title;
            $data['themes']     = $this->themes;
            $data['themes_url'] = $this->themes_url;
            $data['themes_default_url'] = $this->themes_default_url;
            $this->load->view('home',$data);
        //}
	}
    
    function login()
    {
        $data['css']        = $this->css;
        $data['images']     = $this->images;
        $data['js']         = $this->js;
        $data['title']      = $this->title;
        $data['themes']     = $this->themes;
        $data['themes_url'] = $this->themes_url;
        $data['themes_default_url'] = $this->themes_default_url;
            
        $this->load->view('login',$data);
    }
    
    function doLogin() {
		$user = $this->input->post('user') == '' ? null : $this->input->post('user');
		$pass = $this->input->post('pass') == '' ? null : md5($this->input->post('pass'));
		
        $query = $this->db->get_where('umb_user',array('u_username'=>$user,'u_password'=>$pass));
        if($query->num_rows() > 0) {
			$row = $query->row();
            $this->db->update('umb_user', array('u_sys_lastlogin_date' => date('Y-m-d h-i-s')), array('u_username' =>$user));
            $arrSession = array(
                'userid_umbcms'=>$row->u_id,
				'username_umbcms'=>$user
			);
			$this->session_lib->set_userdata($arrSession);
            echo "{success:true, Msg:'Sukses login'}";
        }
        else
            echo "{success:false, Msg:'Wrong username / password'}";
    }
    
    function logout(){
        $this->session_lib->unset_userdata('userid_umbcms');
        $this->session_lib->unset_userdata('username_umbcms');
        redirect(base_url());
    }
    
    function js()
    {
        $data['session'] = $this->session_lib->userdata('userid_umbcms');
        $data['themes_url'] = $this->themes_url;
        $js = $this->load->view('js',$data,true);
        $this->load->library('jsmin',$js);
        echo $this->jsmin->min();
        //$this->load->view('js');
    }
    
    function js_fungsi()
    {
        $data['session'] = $this->session_lib->userdata('userid_umbcms');
        $data['images']     = $this->images;
        $js = $this->load->view('page_fungsi_js',$data,true);
        $this->load->library('jsmin',$js);
        echo $this->jsmin->min();
    }
    
    function js_urusan()
    {
        $data['session'] = $this->session_lib->userdata('userid_umbcms');
        $data['images']     = $this->images;
        $js = $this->load->view('page_urusan_js',$data,true);
        $this->load->library('jsmin',$js);
        echo $this->jsmin->min();
    }
    
    function js_skpd()
    {
        $data['session'] = $this->session_lib->userdata('userid_umbcms');
        $data['images']     = $this->images;
        $js = $this->load->view('page_skpd_js',$data,true);
        $this->load->library('jsmin',$js);
        echo $this->jsmin->min();
    }
    
    function js_rekening()
    {
        $data['session'] = $this->session_lib->userdata('userid_umbcms');
        $data['images']     = $this->images;
        $js = $this->load->view('page_rekening_js',$data,true);
        $this->load->library('jsmin',$js);
        echo $this->jsmin->min();
    }
    
    function js_progkeg()
    {
        $data['session'] = $this->session_lib->userdata('userid_umbcms');
        $data['images']     = $this->images;
        $js = $this->load->view('page_progkeg_js',$data,true);
        $this->load->library('jsmin',$js);
        echo $this->jsmin->min();
    }
    
    function page_fungsi(){
        $this->load->view('page_fungsi');
    }
    
    function page_urusan(){
        $this->load->view('page_urusan');
    }
    
    function page_skpd(){
        $this->load->view('page_skpd');
    }
    
    function page_progkeg(){
        $this->load->view('page_progkeg');
    }
    
    function page_rekening(){
        $this->load->view('page_rekening');
    }
    
}
