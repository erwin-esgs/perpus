<?php
	class Config {
		public $base_url;
		function __construct() {
			$this->base_url = 'http://localhost/perpus';
		}
		
		function baseUrl($uri = NULL){
			$url_site = $this->base_url; 
			if($uri == NULL){
				$url = $url_site.'/';
			}
			else{
				$url = $url_site."/".$uri;
			}
			return $url;
		}
		
		function redirectUrl($uri = ""){
			$url_site = $this->base_url;
			if($uri == "")
			{
				$url = $url_site.'/';
			}
			else
			{
				$url = $url_site."/".$uri;
			}
			header("location: $url");
		}
	}
?>