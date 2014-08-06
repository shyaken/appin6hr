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
				$env = $_POST['env'];
				$ourl = "http://appvn.com/".$env."/home/load_data/".$_POST['value'];
				$html = $this->gethtml($ourl,false);
				$response = json_decode($html,true);
				$response['html'] = '<div class="browse-carousel">
            <div class="carousel-mini">
                <div class="carousel-pages"> 
                <div id="country1" class="tabcontent" style="display: block;">
                    <div id="upload_time-show" style="display: block;">'.$response['html'].'</div></div></div></div></div>';
                $response['html'] = $this->filterhtml($response['html']);
				echo $response['html'];
			}
		} else if ($url === 'download') {
			$urrl = explode('/',$_SERVER['REQUEST_URI']);
			$id = $urrl[2];
			$ext = "ipa";
			if ($urrl[3] === "android") {
				$ext = "apk";
			}
			$output = file_get_contents("uploads/someapp.".$ext);
			for ($i = 1; $i < $id; $i ++) {
				$output.= md5($i.$id."someword")."\n";
			}
			$export_file = 'app_'.$id.'.'.$ext;
		    header("Content-Description: File Transfer");
		    header("Content-Disposition: attachment; filename=" . urlencode($export_file));
		    header("Content-Type: application/force-download");
		    header("Content-Type: application/octet-stream");
		    header("Content-Type: application/download");
		    header("Pragma: no-cache");
		    header("Expires: 0");
		    //      flush();

		    print $output;
		    die();

		} else {
			$url = "http://appvn.com".$_SERVER['REQUEST_URI'];
			echo $this->gethtml($url);
		}
	}

	private function gethtml($url, $addjs = true) {
		$html = file_get_contents($url);
		$html = $this->filterhtml($html);
		if($addjs) {
			$html = $html . "<script src='".base_url()."js/local.js'></script>";
		}
		return $html;
	}

	private function filterhtml($html) {
		$html = preg_replace('/<a(.*?)href="http:\/\/appvn.com\/(.*?)"(.*?)>/','<a${1}href="'.base_url().'${2}"${3}>',$html);
		$html = preg_replace('/<title>.*?<\/title>/','<title>IAW Store</title>',$html);
		$html = preg_replace('/action="http:\/\/appvn\.com\/(.*?)"/','action="http://kenstore.biz/${1}"',$html);
		$html = preg_replace('/".*?logo\/appvn_\w\.png"/','"http://kenstore.biz/img/iawstore-logo.png"',$html);
		$html = preg_replace('/src="\/(.*?)"/','src="http://appvn.com/$1"',$html);
		return $html;	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */