<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
/**
* 全て半角
* @param object $model
* @param array $check 値
* @author lecaoquochung@gmail.com
*/

	function hanKaku($check) {
		$value = array_values($check);
		$value = $value[0];
		return preg_match('/^[a-zA-Z0-9ぁ-んァ-ヶ亜-黑ー中「」【】不乳井一級事 ]+$/u', $value);
	}

/**
* check unique
* @param object $model
* @author lecaoquochung@gmail.com
*/

	public function checkUnique($ignoredData, $fields, $or = True) {
		return $this->isUnique($fields, $or);
	}

/**
* before save callback function
* @param 
* @author lecaoquochung@gmail.com
*/

	public function beforeSave($options = array()) {
		// Link
		if (!empty($this->data['Link']['keyword']) && !empty($this->data['Link']['url'])) {
			$this->data['Link']['keyword'] = trim($this->data['Link']['keyword'], ' ');
			$this->data['Link']['url'] = urldecode(trim($this->data['Link']['url'], ' '));
		}
		
		// LinkContent
		if (!empty($this->data['LinkContent']['title'])) {
			$this->data['LinkContent']['title'] = trim($this->data['LinkContent']['title']);
		}
		
		if (!empty($this->data['LinkContent']['meta_keyword'])) {
			$this->data['LinkContent']['meta_keyword'] = trim($this->data['LinkContent']['meta_keyword']);
		}
		
		if (!empty($this->data['LinkContent']['meta_description'])) {
			$this->data['LinkContent']['meta_description'] = trim($this->data['LinkContent']['meta_description']);
		}

		if (!empty($this->data['LinkContent']['h1_tag'])) {
			$this->data['LinkContent']['h1_tag'] = trim($this->data['LinkContent']['h1_tag']);
		}
		
		return true;
	}

}
