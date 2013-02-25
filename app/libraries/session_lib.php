<?php
class Session_lib {
	function __construct() {
		session_start();
	}
	
	function set_userdata($data, $val = '') {
		if(is_array($data)) {
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
		} else {
			$_SESSION[$data] = $val;
            return $val;            
		}
	}
	
	function userdata($key) {
		return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
	}
	
	function unset_userdata($key = '') {
		if(!empty($key)) {
			$_SESSION[$key] = '';
			return TRUE;
		}
		return session_destroy();
	}
}
