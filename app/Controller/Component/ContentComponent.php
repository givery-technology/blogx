<?php
/*------------------------------------------------------------------------------------------------------------
 * DDNB Content Component
 *
 * @input		
 * @output		
 * 
 * @author		ddnb_admin <admin@ddnb.info>
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 * @created		2014-08
 -------------------------------------------------------------------------------------------------------------*/
 
App::uses('Component', 'Controller');

class ContentComponent extends Component {

	public function getWebContent($url) {
		if(function_exists('curl_init')) {
			$ch = curl_init();
			// $userAgent = configure::read('BOT.Ver1');
			$userAgent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)";
			curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 300);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$contents = curl_exec($ch);
			curl_close($ch);
		} else {
			$contents = file_get_contents($url);
		}
		return $contents;
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

/**
 * get link contents method
 *
 * @throws	NotFoundException
 * @param	string $url, $keyword
 * @logic
 * @return	void
 * @created	2014-06
 * @updated
 */
	public function getContentLink($url, $keyword) {
		$content = array();
		$content['keywords'] = '';
		$content['description'] = '';
		$html = $this->getWebContent($url);
		$html = mb_convert_encoding($html, "UTF-8", "EUC-JP, UTF-8, ASCII, JIS, eucjp-win, sjis-win");
		$lowercase_html = strtolower($html);
		
		// header
		// $headers = get_headers($url);
		$headers = explode("\r\n\r\n", $html);
		$body = $this->strip_html($headers[1]);
		$headers= explode("\r\n",$headers[0]);
		
		$content['header'] = implode(",", $headers);
		$content['www_redirect'] = $headers[0];
		
		// canonical - one page one canonical
		$content['canonical'] = substr_count($lowercase_html, "canonical");
		
		// keyword - count input keyword matched in url content
		$content['keyword_count'] = $this->keyword_count_special($lowercase_html, $keyword);
		$content['keyword_count_body'] = $this->keyword_count_special($body, $keyword);
		
		// title
		$pattern_title = "/<title([^`]*?)>([^`]*?)<\/title>/";
		preg_match_all($pattern_title, $html, $matches_title);
		if(count($matches_title)>0){
			$content['title'] = mb_convert_encoding(trim(strip_tags($this->noSpace(@$matches_title[2][0]))), "UTF-8", "EUC-JP, UTF-8, ASCII, JIS, eucjp-win, sjis-win");
			$content['title'] = str_replace(array("\r", "\r\n", "\n"," ","　", "\t"), '', $content['title']);
		}
		
		// meta keyword
		$pattern_meta_keyword = '/<meta.*?name=("|\')keywords("|\').*?content=("|\')(.*?)("|\')/i';
		preg_match_all($pattern_meta_keyword, $lowercase_html, $matches_meta_keyword);
		if(count($matches_meta_keyword)>0){
			$content['keywords'] = $this->encode_convert(@$matches_meta_keyword[4][0]);
		}
		
		// meta description
		$pattern_meta_description = '/<meta.*?name=("|\')description("|\').*?content=("|\')(.*?)("|\')/i';
		preg_match_all($pattern_meta_description, $lowercase_html, $matches_meta_description);
		if(count($matches_meta_description)>0){
			$content['description'] = $this->encode_convert(@$matches_meta_description[4][0]);
		}
		
		// h1 tag
		$pattern_h1_tag = "/<h1([^`]*?)>([^`]*?)<\/h1>/";
		preg_match_all($pattern_h1_tag, $html, $matches_h1_tag);
		$content['h1_tag'] = '';
		if(count($matches_h1_tag)>0 && $matches_h1_tag[0] != ''){
			$content['h1_tag'] = $this->encode_convert(@$matches_h1_tag[2][0]);
			$content['h1_tag'] = str_replace(array("\r", "\r\n", "\n"," ","　", "\t"), '', $content['h1_tag']);
		}
		
		// a tag
		$pattern_a_tag = "/<a([^`]*?)>([^`]*?)<\/a>/";
		// $pattern_a_tag = "/<[aA]([^`]*?)>([^`]*?)<\/[aA]>/";
		preg_match_all($pattern_a_tag, $lowercase_html, $matches_a_tag);
		$content['a_tag'] = '';
		$content['a_tag_count'] = '';
		if(count($matches_a_tag)>0){
			$content['a_tag'] = implode(",", $matches_a_tag[0]);
			$content['a_tag'] = str_replace(array("\r", "\r\n", "\n","　", "\t"), '', $content['a_tag']);
			$content['a_tag'] = $this->encode_convert($content['a_tag']);
			$content['a_tag_count'] = count($matches_a_tag[0]);
		}
		
		// html content
		$content['html_content'] = $this->encode_convert($html);
		$content['no_html_content'] = $this->encode_convert($this->strip_html($html));
		
		return $content;
	}

	public function getAttrTag($html, $tag, $attr, $value="(.+?)") {
		$pattern = '<'.$tag.'*'.$attr.'=\x22'.$value.'\x22>';
		preg_match($pattern, $html, $matches);
		return $matches;
	}
		
	public function arrayToUtf8($in) {
		if (is_array($in)) {
			foreach ($in as $key => $value) {
				$out[$this -> arrayToUtf8($key)] = $this -> arrayToUtf8($value);
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
	
/*
 * replace Space Zen & Han kaku method
 * @param: $string
 * @output: $string japanese
 * @logic: 
 */
 
	public function noSpace($string) {
		$string = str_replace(array(" ","　","&nbsp;"), '', $string);
		return $string;
	}
	
	/**
	 * check html no space method
	 *
	 * @input
	 * @output
	 * @logic replace special character: no zenkaku space
	 * @created 2014-07
	 */
	public function check_html_no_space($html) {
		$html = str_replace(array("\r", "\r\n", "\n", "　", "\t"), '', $html);
		return $html;
	}
	
	/*
 * hankaku space method
 * @param: $string
 * @output: $string hankaku space
 * @logic: 
 */
 
	public function hankakuSpace($string) {
		$string = str_replace(array("　"), ' ', $string);
		return $string;
	}
	
/**
 * get remote ip method
 *
 * @throws NotFoundException
 * @param string $url, $keyword
 * @return void
 */

	public function get_remote_ip($domain) {
		$ips = gethostbynamel($domain);
		$ip = $ips[0];
		return $ip;
	}
	
/**
 * keyword count method
 *
 * @throws NotFoundException
 * @param string $html, $keyword
 * @return number of exacty keyword occurence
 * @created 2014-07
 */

	public function keyword_count($html, $keyword) {
		return substr_count($html, strtolower($keyword));
	}
	
/**
 * keyword count special method
 *
 * @throws NotFoundException
 * @param string $html, $keyword
 * @return number of keyword occurence
 * @created 2014-07
 */

	public function keyword_count_special($html, $keyword) {
		$html = $this->noSpace($html);
		$keyword = strtolower($keyword);
		// special check 
		$space = mb_stripos ($keyword, ' '); // check space with bit // debug(mb_strlen($keyword));
		if($space > 0) { // kw with space
			// exactly input
			$count = substr_count($html, $keyword);
			// no space 
			$count = $count + substr_count($html,$this->noSpace($keyword));
			// any character between
			$keyword_explode = explode(' ', $keyword);
			$pattern = '/'; // pattern start
			for($i=0; $i<count($keyword_explode); $i++) {
				if($i==count($keyword_explode)-1) { // last value
					$pattern .= $keyword_explode[$i] .'/u';
				} else {
					$pattern .= $keyword_explode[$i] .'(.)';
				}
			}
			preg_match($pattern, $html, $matches);
			if(count($matches) > 0 ) {
				// $pos = $matches;
				$count = $count + count($matches)/2;
			}
		} else { // no space
			// exactly check with input
			$count = $this->keyword_count($html,$keyword);
		}
		
		// debug($html);
		return $count;
	}

/**
 * encode convert method
 *
 * @throws NotFoundException
 * @param string $string
 * @logic mb_convert_encoding "UTF-8", "EUC-JP, UTF-8, ASCII, JIS, eucjp-win, sjis-win"
 * @return 
 * @created 2014-07
 */

	public function encode_convert($string) {
		 return mb_convert_encoding(trim($string), "UTF-8", "EUC-JP, UTF-8, ASCII, JIS, eucjp-win, sjis-win");
	}
	
/**
 * strip html method
 *
 * @throws NotFoundException
 * @param string $html
 * @logic strip tags & replace special character
 * @return 
 * @created 2014-07
 */

	public function strip_html($html) {
		$html = trim(strip_tags($html));
		$html = str_replace(array("\r", "\r\n", "\n"," ","　", "\t", "&nbsp;"), '', $html);
		return $html;
	}

}
?>