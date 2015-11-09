<?php
App::uses('Component', 'Controller');
/**
 * Input Component
 *
 * @package Input.Component
 * @author  ddnb_admin <admin@ddnb.info>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link    http://www.ddnb.info
 * @created	2014-07-03
 */
class InputComponent extends Component {

/**
 * check input method
 *
 * @throws	NotFoundException
 * @param	string $url, $keyword
 * @logic	1. hankaku 2.trim space
 * @return	void
 * @created	2014-07-04
 * @updated
 */
 	function ddnbCheck($string) {
 		// hankaku
		$string = str_replace(array("　"), ' ', $string);
 		// trim
 		$string = trim($string);
		return $string;
	}

}

?>