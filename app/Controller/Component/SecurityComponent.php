<?php
App::uses('Component', 'Controller');
/**
 * Security Component
 *
 * @package  Security.Component
 * @author   ddnb_admin <admin@ddnb.info>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.ddnb.info
 */
class SecurityComponent extends Component {

/**
 * return mac address method
 *
 * @throws	NotFoundException
 * @param	void
 * @logic
 * @return	mac address or false
 * @created	2014-07
 * @updated
 */
	function return_macaddress() {
		// This code is under the GNU Public Licence
		// Written by michael_stankiewicz {don't spam} at yahoo {no spam} dot com
		// Tested only on linux, please report bugs
		 
		// WARNING: the commands 'which' and 'arp' should be executable
		// by the apache user; on most linux boxes the default configuration
		// should work fine
		 
		// get the arp executable path
		$location = 'which arp';
		$location = shell_exec($location);
		// debug($location);
		$location = rtrim($location);
		// Execute the arp command and store the output in $arpTable
		$arpTable = "$location -n";
		debug($arpTable);
		$arpTable = shell_exec($arpTable);
		// debug($arpTable);
		// Split the output so every line is an entry of the $arpSplitted array
		$arpSplitted = split("\n",$arpTable);
		// get the remote ip address (the ip address of the client, the browser)
		$remoteIp = $_SERVER['REMOTE_ADDR'];
		$remoteIp = str_replace(".", "\\.", $remoteIp);
		// Cicle the array to find the match with the remote ip address
		foreach ($arpSplitted as $value) {
			// Split every arp line, this is done in case the format of the arp
			// command output is a bit different than expected
			$valueSplitted = split(" ",$value);
			foreach ($valueSplitted as $spLine) {
				$ipFound = False;
				if (preg_match("/$remoteIp/",$spLine)) {
					$ipFound = true;
				}
				// The ip address has been found, now rescan all the string
				// to get the mac address
				if ($ipFound) {
				// Rescan all the string, in case the mac address, in the string
				// returned by arp, comes before the ip address
				// (you know, Murphy's laws)
					reset($valueSplitted);
					foreach ($valueSplitted as $spLine) {
						if (preg_match("/[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f]/i",$spLine)) {
							return $spLine;
						}
					}
				}
				$ipFound = false;
			}
		}
		return false;
	}
}

?>