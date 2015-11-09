<?php
App::uses('Helper', 'View');

/**
 * Url Helper
 *
 * @package  Url.Helper
 * @author   ddnb_admin <admin@ddnb.info>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.ddnb.info
 */
class UrlHelper extends Helper {

	public $helpers = array('Html');

	private function _getModel($model = null) {
		return ClassRegistry::init($model);
	}

/*
 * company method
 */

	public function getCompany($field,$conds) {
		$Company = $this->_getModel('Company');
		if(empty($field)){
			$company = $Company->find('first',array('conditions'=>$conds));
			return $company;
		}else{
			$company = $Company->find('first',array('fields'=>array('Company.'.$field),'conditions'=>$conds));
			return $company['Company'][$field];
		}
	}

/*
 * check anchor method
 * @param: $url
 * @output: full a tag, href, anchortext
 */

	public function checkAnchor($content, $keyword) {
		$pattern_a_tag = "/<a([^`]*?)>([^`]*?)<\/a>/";
		preg_match_all($pattern_a_tag, $lowercase_html, $matches_a_tag);
		$pos = strpos($content, $keyword);
		if($pos !== False) { // note for the first position with value = 0
			$pos = $pos+1;
		} else {
			$pos = False;
		}
		return $pos;
	}

/*
 * check outLink method
 * @param: $linkset, $url
 * @output: $outlink_count , $outlink_href, $outlink_anchor
 * @logic: count all link have http & not url
 */
	
	public function countOutlink($links, $url) {
		$pattern_a_tag = '#<a\s+.*?href=[\'"]([^\'"]+)[\'"]\s*(?:title=[\'"]([^\'"]+)[\'"])?.*?>((?:(?!</a>).)*)</a>#i';
		
		for($i=0;$i<=count($links);$i++) {
			preg_match_all($pattern_a_tag, $links, $matches_a_tag);
		}
		
		return $pos;
	}

/*
 * check outLink method
 * @param: $linkset, $url
 * @output: $outlink_count , $outlink_href, $outlink_anchor
 * @logic: count all link have http & not url
 */
 
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

/*
* remainDomain method
* @param: $string
* @output: text label
* @logic: 1: link 2: backlink 3:competitor
*/

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

/*
* outLink method
* @param: $a_tag, $url, $domain
* @output: $outLink array
* @logic: 1: link 2: backlink 3:competitor
*/
	
	public function outLink($a_tag, $url, $domain){
		$links = explode(',', $a_tag);
		$outLink = array();
		$pattern_a_tag = '#<a\s+.*?href=[\'"]([^\'"]+)[\'"]\s*(?:title=[\'"]([^\'"]+)[\'"])?.*?>((?:(?!</a>).)*)</a>#i';
		foreach($links as $key => $value ):
			preg_match_all($pattern_a_tag, $value, $matches_a_tag);
			if(isset($matches_a_tag[1][0])){
				if(strpos(' '.$matches_a_tag[1][0],'http')!=false && strpos($matches_a_tag[1][0],$domain)==false){
					$outLink[] = $matches_a_tag;
				}
			}
		endforeach;
		return $outLink;
	}
	
/*
* onpageLink method
* @param: $a_tag, $url, $domain
* @output: $outLink array
* @logic: 1: link 2: backlink 3:competitor
*/
	
	public function onpageLink($a_tag, $url, $domain){
		$links = explode(',', $a_tag);
		// debug($links);
		$onpageLink = array();
		$pattern_a_tag = '#<a\s+.*?href=[\'"]([^\'"]+)[\'"]\s*(?:title=[\'"]([^\'"]+)[\'"])?.*?>((?:(?!</a>).)*)</a>#i';
		foreach($links as $key => $value ):
			preg_match_all($pattern_a_tag, $value, $matches_a_tag);
			if(isset($matches_a_tag[1][0])){
				// http & domain
				if(strpos(' '.$matches_a_tag[1][0],'http') != False && strpos($matches_a_tag[1][0],$domain) !== False){
					$onpageLink[] = $matches_a_tag[1][0];
				}
				// no http & no domain
				if(strpos(' '.$matches_a_tag[1][0],'http') == False && strpos(' '.$matches_a_tag[1][0], $domain) == False) {
					$onpageLink[] = 'http://' .$domain .'/' .str_replace('./', '', $matches_a_tag[1][0]);
				}
			}
		endforeach;
		return $onpageLink;
	}

/*
* allLink method
* @param: $a_tag
* @output: href & anchor
* @logic: 
*/

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

/*
* http_response method
* @param: $url, $status: http status to check, $wait: TTL
* @output: Boolean
* @logic: 
*/

	function http_response($url, $status = null, $wait = 3) {
		$time = microtime(true); 
		$expire = $time + $wait; 
		
		$ch = curl_init(); 
		$userAgent = configure::read('BOT.Ver1');
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
	
/*
 * http code method
 * @param: $code
 * @output: string $value: check, cross, http code
 * @logic: 
 * @created: 20140702 
*/

	function http_code($www_redirect) {
		if(count($www_redirect) > 1) {
			if($www_redirect[1] == 200) {
				$value = $this->Html->image('tick.png',array('width'=>15));
			} else {
				$value = $www_redirect[1];
			}
		} else {
			$value = $this->Html->image('cross.png',array('width'=>15));
		}
		
		return $value;
	}

/*
 * linkType method
 * @param: $code
 * @output: text label
 * @logic: 1: link 2: backlink 3:competitor
 */
 
	function linkType($code) {
		switch ($code) {
			case 1:
				$type = '<span class="label label-default">'.configure::read('Link.type.1').'</span>';
				break;
			
			case 2:
				$type = '<span class="label label-warning">'.configure::read('Link.type.2').'</span>';
				break;
			
			case 3:
				$type = '<span class="label label-important">'.configure::read('Link.type.3').'</span>';
				break;
			
			default:
				$type = '<span class="label label-success">'.'Auto'.'</span>';
				break;
		}
		return $type;
	}
}
?> 