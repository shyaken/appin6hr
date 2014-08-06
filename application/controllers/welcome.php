<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$url = "http://appvn.com/ios";
		echo $this->gethtml($url);
	}

	public function process($url) {
		if($url === 'ajax') {
			if ($_POST['mode'] === "load_data") {
				$ourl = "http://appvn.com/ios/home/load_data/".$_POST['value'];
				$html = $this->gethtml($ourl,false);
				$response = json_decode($html,true);
				$response['html'] = '<div class="browse-carousel">
            <div class="carousel-mini">
                <div class="carousel-pages"> 
                <div id="country1" class="tabcontent" style="display: block;">
                    <div id="upload_time-show" style="display: block;">'.$response['html'].'</div></div></div></div></div>';
				echo $response['html'];
			}
		} else {
			$url = "http://appvn.com/".$url;
			echo $this->gethtml($url);
		}
	}

	private function gethtml($url, $addjs = true) {
		$html = file_get_contents($url);
		$html = preg_replace('/<a(.*?)href="http:\/\/appvn.com\/(.*?)"(.*?)>/','<a${1}href="'.base_url().'${2}"${3}>',$html);
		$html = preg_replace('/src="\/(.*?)"/','src="http://appvn.com/$1"',$html);
		if($addjs) {
			$html = $html . "<script src='".base_url()."js/local.js'></script>";
		}
		return $html;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */