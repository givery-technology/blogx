<?php
App::uses('Component', 'Controller');
/**
 * Url Component
 *
 * @package  Url.Component
 * @author   ddnb_admin <admin@ddnb.info>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.ddnb.info
 */
class UrlComponent extends Component {

	public function remainUrl($string) {
		$string = trim($string);
		$string = str_replace(' ', '', $string);
		if (substr($string, 0, 4) == "http") {
			$pos = strpos($string, "//") + 2;
			$string = substr($string, $pos);
		}
		if (substr($string, -1) == "/") {
			$string = substr($string, 0, -1);
		}
		return $string;
	}

	public function remainDomain($string) {
		$string = trim($string);
		$string = str_replace(' ', '', $string);
		if (substr($string, 0, 4) == "http") {
			$pos = strpos($string, "//") + 2;
			$string = substr($string, $pos);
		}
		if (($pos = strpos($string, "/")) > 0) {
			$string = substr($string, 0, $pos);
		}
		
		if (substr($string, 0, 4) == "www.") {
			$string = substr($string, 4);
		}
		return $string;
	}

	public function rootDomainSearch($url, $domainArr) {
		foreach ($domainArr as $key => $domain) {
		if ($url === 'tokio910.com') {
			if ($this->remainUrl($domain)==$url) {
				return $key;
			}
		} else {
			if (strpos($domain, $url) !== false) {
				return $key;
			}
		}
		}
		return false;
	}

/**
 * if array is not UTF-8 then convert keys and values to UTF-8
 * method is recursive
 *
 * @param mixed $in
 */
	public function arrayToUtf8($in) {
		if (is_array($in)) {
			foreach ($in as $key => $value) {
				$out[$this->arrayToUtf8($key)] = $this->arrayToUtf8($value);
			}
		} elseif (is_string($in)) {
			if (mb_detect_encoding($in) != "UTF-8")
				return utf8_encode($in);
			else
				return $in;
		} else {
			return $in;
		}
		return $out;
	}
	
	public function allLink($a_tag){
		$links = explode(',', $a_tag);	
		$allLink = array();
		$pattern_a_tag = '#<a\s+.*?href=[\'"]([^\'"]+)[\'"]\s*(?:title=[\'"]([^\'"]+)[\'"])?.*?>((?:(?!</a>).)*)</a>#i';
		foreach($links as $key => $value ):
			preg_match_all($pattern_a_tag, $value, $matches_a_tag);
			$allLink[] = $matches_a_tag;
		endforeach;
		return Hash::filter($allLink);
	}	
	
	function http_response($url, $status = null, $wait = 3) {
		$time = microtime(true); 
		$expire = $time + $wait; 
		
		$ch = curl_init(); 
		$userAgent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)";
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HEADER, TRUE); 
		curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
		$head = curl_exec($ch); 
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
		curl_close($ch); 
		
		if(!$head) { 
			return FALSE; 
		} 
		
		if($status === null) { 
			if($httpCode < 400) { 
		 		return TRUE; 
			} else { 
				return FALSE; 
			} 
		} elseif($status == $httpCode) { 
			return TRUE; 
		} 
		
		return FALSE;
	}	
}

	function Text2Domain($string) {
		$string = ReplaceBold($string);
		return $string;
	}

	function ReplaceBold($string) {
		$string = str_replace('<b>', '', $string);
		$string = str_replace('</b>', '', $string);
		$string = str_replace('<wbr>', '', $string);
		return $string;
	}

?>