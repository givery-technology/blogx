<?php 

/**
 * post csv template genre Layout
 *
 * @package  Csv.Layout
 * @author   ddnb_admin <admin@ddnb.info>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.ddnb.info
 */
 	
 	// header
 	$datetime = date('Y-m-d_H_i', strtotime('now'));
	$filename = $datetime .'_' .'POST_CSV_TEMPLATE_GENRE' .'.csv';
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=$filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	// content
	 echo $this->fetch('content');
?>
