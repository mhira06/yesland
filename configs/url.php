<?php
	function redirect($url = null){
		$redirect = "http://".$_SERVER['SERVER_NAME']."/".PROJECT;
		if($url != ""){
			$redirect .= "/".$url;
		}
		
		header("location:".$redirect);
	}
	
	function base_url($url = null){
		$response = "http://".$_SERVER['SERVER_NAME']."/".PROJECT;
		
		if($url != ""){
			$response .= "/".$url;
		}
		
		return $response;
	}
	
	function root_url($url = null){
		$response = $_SERVER['DOCUMENT_ROOT']."/".PROJECT;
		if($url != ""){
			$response .= "/".$url;
		}
		return $response;
	}
?>