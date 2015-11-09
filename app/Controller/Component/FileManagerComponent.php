<?php
App::uses('Component', 'Controller');

class FileManagerComponent extends Component {

	public $controller = null;

	public $optionsFTP = array(
		'host' => '',
		'user' => '',
		'pass' => '',
		'port' => 21,
		'path' => '/'
	);

	public $optionsLocal = array(
		'dir' => WWW_ROOT,
		'url' => FULL_BASE_URL
	);	
	
	/*Local or FTP*/
	public $optionsType = 'local';
	
	public $options = array();

	protected static $mimetypes = array(
		// applications
		'ai'    => 'application/postscript',
		'eps'   => 'application/postscript',
		'exe'   => 'application/x-executable',
		'doc'   => 'application/vnd.ms-word',
		'xls'   => 'application/vnd.ms-excel',
		'ppt'   => 'application/vnd.ms-powerpoint',
		'pps'   => 'application/vnd.ms-powerpoint',
		'pdf'   => 'application/pdf',
		'xml'   => 'application/xml',
		'odt'   => 'application/vnd.oasis.opendocument.text',
		'swf'   => 'application/x-shockwave-flash',
		'torrent' => 'application/x-bittorrent',
		'jar'   => 'application/x-jar',
		// archives
		'gz'    => 'application/x-gzip',
		'tgz'   => 'application/x-gzip',
		'bz'    => 'application/x-bzip2',
		'bz2'   => 'application/x-bzip2',
		'tbz'   => 'application/x-bzip2',
		'zip'   => 'application/zip',
		'rar'   => 'application/x-rar',
		'tar'   => 'application/x-tar',
		'7z'    => 'application/x-7z-compressed',
		// texts
		'txt'   => 'text/plain',
		'php'   => 'text/x-php',
		'html'  => 'text/html',
		'htm'   => 'text/html',
		'js'    => 'text/javascript',
		'css'   => 'text/css',
		'rtf'   => 'text/rtf',
		'rtfd'  => 'text/rtfd',
		'py'    => 'text/x-python',
		'java'  => 'text/x-java-source',
		'rb'    => 'text/x-ruby',
		'sh'    => 'text/x-shellscript',
		'pl'    => 'text/x-perl',
		'xml'   => 'text/xml',
		'sql'   => 'text/x-sql',
		'c'     => 'text/x-csrc',
		'h'     => 'text/x-chdr',
		'cpp'   => 'text/x-c++src',
		'hh'    => 'text/x-c++hdr',
		'log'   => 'text/plain',
		'csv'   => 'text/x-comma-separated-values',
		// images
		'bmp'   => 'image/x-ms-bmp',
		'jpg'   => 'image/jpeg',
		'jpeg'  => 'image/jpeg',
		'gif'   => 'image/gif',
		'png'   => 'image/png',
		'tif'   => 'image/tiff',
		'tiff'  => 'image/tiff',
		'tga'   => 'image/x-targa',
		'psd'   => 'image/vnd.adobe.photoshop',
		'ai'    => 'image/vnd.adobe.photoshop',
		'xbm'   => 'image/xbm',
		'pxm'   => 'image/pxm',
		//audio
		'mp3'   => 'audio/mpeg',
		'mid'   => 'audio/midi',
		'ogg'   => 'audio/ogg',
		'oga'   => 'audio/ogg',
		'm4a'   => 'audio/x-m4a',
		'wav'   => 'audio/wav',
		'wma'   => 'audio/x-ms-wma',
		// video
		'avi'   => 'video/x-msvideo',
		'dv'    => 'video/x-dv',
		'mp4'   => 'video/mp4',
		'mpeg'  => 'video/mpeg',
		'mpg'   => 'video/mpeg',
		'mov'   => 'video/quicktime',
		'wm'    => 'video/x-ms-wmv',
		'flv'   => 'video/x-flv',
		'mkv'   => 'video/x-matroska',
		'webm'  => 'video/webm',
		'ogv'   => 'video/ogg',
		'ogm'   => 'video/ogg'
		);

		
    public function startup(Controller $controller) {
        $this->controller = $controller;
		//pr($this->controller->params);exit();
    }		
		
		
	/**
	 * Return stat for given path.
	 * Stat contains following fields:
	 * - (int)    size    file size in b. required
	 * - (int)    ts      file modification time in unix time. required
	 * - (string) mime    mimetype. required for folders, others - optionally
	 * - (bool)   read    read permissions. required
	 * - (bool)   write   write permissions. required
	 * - (bool)   locked  is object locked. optionally
	 * - (bool)   hidden  is object hidden. optionally
	 * - (string) alias   for symlinks - link target path relative to root path. optionally
	 * - (string) target  for symlinks - link target path. optionally
	 *
	 * If file does not exists - returns empty array or false.
	 *
	 * @param  string  $path    file path 
	 * @return array|false
	 * @author Dmitry (dio) Levashov
	 **/
	protected function stat($path) {
		$stat = array();

		if (!file_exists($path)) {
			return $stat;
		}

		if ($path != $this->root && is_link($path)) {
			if (($target = $this->readlink($path)) == false 
			|| $target == $path) {
				$stat['mime']  = 'symlink-broken';
				$stat['read']  = false;
				$stat['write'] = false;
				$stat['size']  = 0;
				return $stat;
			}
			$stat['alias']  = $this->_path($target);
			$stat['target'] = $target;
			$path  = $target;
			$lstat = lstat($path);
			$size  = $lstat['size'];
		} else {
			$size = @filesize($path);
		}
		
		$dir = is_dir($path);
		
		$stat['mime']  = $dir ? 'directory' : $this->mimetype($path);
		$stat['ts']    = filemtime($path);
		$stat['read']  = is_readable($path);
		$stat['write'] = is_writable($path);
		if ($stat['read']) {
			$stat['size'] = $dir ? 0 : $size;
		}
		
		if (!empty($stat['alias']) && !empty($stat['target'])) {
			$stat['thash'] = $this->encode($stat['target']);
			unset($stat['target']);
		}
		
		return $stat;
	}

	protected function encode($path) {
		if ($path !== '') {

			// cut ROOT from $path for security reason, even if hacker decodes the path he will not know the root
			$p = $path == substr($path, strlen($this->options['path'])+1);
			// if reqesting root dir $path will be empty, then assign '/' as we cannot leave it blank for crypt
			if ($p === '')	{
				$p = DIRECTORY_SEPARATOR;
			}

			// TODO crypt path and return hash
			$hash = $this->crypt($p);
			// hash is used as id in HTML that means it must contain vaild chars
			// make base64 html safe and append prefix in begining
			$hash = strtr(base64_encode($hash), '+/=', '-_.');
			// remove dots '.' at the end, before it was '=' in base64
			$hash = rtrim($hash, '.'); 
			// append volume id to make hash unique
			return $this->id.$hash;
		}
	}

	/**
	 * Decode path from hash
	 *
	 * @param  string  file hash
	 * @return string
	 * @author Dmitry (dio) Levashov
	 * @author Troex Nevelin
	 **/
	protected function decode($hash) {
		if (strpos($hash, $this->id) === 0) {
			// cut volume id after it was prepended in encode
			$h = substr($hash, strlen($this->id));
			// replace HTML safe base64 to normal
			$h = base64_decode(strtr($h, '-_.', '+/='));
			// TODO uncrypt hash and return path
			$path = $this->uncrypt($h); 
			// append ROOT to path after it was cut in encode
			return $this->_abspath($path);//$this->root.($path == DIRECTORY_SEPARATOR ? '' : DIRECTORY_SEPARATOR.$path); 
		}
	}
	
	
	/**
	 * Return file mimetype
	 *
	 * @param  string  $path  file path
	 * @return string
	 * @author Dmitry (dio) Levashov
	 **/
	protected function mimetype($path) {		
		
		$type = $this->mimetypeInternalDetect($path);
		
		$type = explode(';', $type);
		$type = trim($type[0]);
		
		if ($type == 'application/x-empty') {
			// finfo return this mime for empty files
			$type = 'text/plain';
		} elseif ($type == 'application/x-zip') {
			// http://elrte.org/redmine/issues/163
			$type = 'application/zip';
		}
		
		return $type == 'unknown' ? $this->mimetypeInternalDetect($path) : $type;	
	}
	
	/**
	 * Detect file mimetype using "internal" method
	 *
	 * @param  string  $path  file path
	 * @return string
	 * @author Dmitry (dio) Levashov
	 **/
	protected function mimetypeInternalDetect($path) {
		$pinfo = pathinfo($path); 
		$ext   = isset($pinfo['extension']) ? strtolower($pinfo['extension']) : '';
		return isset(elFinderVolumeDriver::$mimetypes[$ext]) ? elFinderVolumeDriver::$mimetypes[$ext] : 'unknown';
		
	}	
	
	/**
	 * Get stat for folder content and put in cache
	 *
	 * @param  string  $path
	 * @return void
	 * @author Dmitry (dio) Levashov
	 **/
	protected function cacheDir($path) {
		$this->dirsCache[$path] = array();

		foreach ($this->_scandir($path) as $p) {
			if (($stat = $this->stat($p)) && empty($stat['hidden'])) {
				$this->dirsCache[$path][] = $p;
			}
		}	
	}
	
	/**
	 * Clean cache
	 *
	 * @return void
	 * @author Dmitry (dio) Levashov
	 **/
	protected function clearcache() {
		$this->cache = $this->dirsCache = array();
	}	
	
}
?>