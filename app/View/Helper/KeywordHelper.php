<?php

App::uses('Helper', 'View');

/**
 * Keyword Helper
 *
 * @package  Keyword.Helper
 * @author   ddnb_admin <admin@ddnb.info>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.ddnb.info
 */
class KeywordHelper extends Helper {

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
 * check keyword at first position method
 */

	public function checkKeyword($content, $keyword) {
		// check space inside keyword
		$space = mb_stripos ($keyword, ' ');  // check space with bit // debug(mb_strlen($keyword));
		if($space > 0) { // kw with space
			$keyword_nospace =  str_replace(' ', '', $keyword);
			$pos = strpos($content, $keyword_nospace);
			if($pos !== False) { // content has kw with no space 
				$pos = $pos+1;
			} else { // content has kw with any character between 
				$keyword_explode = explode(' ', $keyword);
				$pos = strpos($content, $keyword_explode[0]);
				if($pos !== False) {
					$pos = $pos+1;
				}
				$pattern = '/'; // pattern start
				for($i=0; $i<count($keyword_explode); $i++) {
					if($i==count($keyword_explode)-1) { // last value
						$pattern .= $keyword_explode[$i] .'/u';
					} else {
						$pattern .= $keyword_explode[$i] .'(.)';
					}
				}
				preg_match($pattern, $content, $matches);
				if(count($matches) > 0 && $pos == 1) {
					// $pos = $matches;
					$pos = 1;
				} else {
					$pos = False;
				}
			}
		} else { // no space
			$pos = strpos($content, $keyword);
			if($pos !== False) { // note for the first position with value = 0
				$pos = $pos+1;
			} else {
				$pos = False;
			}
		}
		
		return $pos;
	}

/*
 * count keyword method
 * @param: $string
 * @output: $string
 * @logic: regex all alphabet, special characters
 */
 
	function countKeyword($string) {
		$string = mb_strlen($string);
		return $string;
	}

/*
 * count keyword method
 * @param: $string
 * @output: $string
 * @logic: regex all alphabet, special characters
 * @created: 2014-07
 * @update:
 * 1. 2014-07-09 Lenght with no spapce
 */
 
	function countLength($string) {
		$string = str_replace(array(" ","　"), '', $string);
		$string = mb_strlen($string);
		return $string;
	}

/*
 * japanese content method
 * @param: $string
 * @output: $string japanese
 * @logic: regex all alphabet, numbers & special characters
 */
 
	function jpnContent($string) {
		$string = preg_replace("/[a-zA-Z0-9.\+*?\[^\]\$\(\){}=!<>\|｜:;、「」_',\/\-&\"・#%〜／【】！。（）※ ]+/u", '', $string);
		return $string;
	}
	
/*
 * replace Space Zen & Han kaku method original keyword
 * @param: $string
 * @output: $string japanese
 * @logic: regex all alphabet, numbers & special characters
 * @created: 2014-07 
 * @updated:
 */
 
	function noSpace($string) {
		$string = str_replace(array(" ","　","&nbsp;"), '', $string);
		return $string;
	}
	
/*
 * return string postion
 * @param: $pos
 * @output: return position
 * @logic: start from 1
 * @created: 2014-07 
 * @updated:
 */
 
	function returnPos($pos) {
		if($pos !== False) {
			$pos = $pos + 1;
		}
		return $pos;
	}

}
?>