<?php
class FckHelper extends Helper { 

	public $helpers = Array('Html', 'Js');

	public function js(){
		return $this->Html->script(array(
			'ckeditor/ckeditor',
			// 'ckfinder/ckfinder'
		));
	}
	
    public function load($id, $format_tag = false) {
        $did = '';
        foreach (explode('.', $id) as $v) {
            $did .= ucfirst($v);
        } 

        $code = "var editor = CKEDITOR.replace( '".$did."' );";
		if($format_tag){
			$code .="CKEDITOR.config.format_tags = ''";
		}
		
		//$code .= "CKFinder.SetupCKEditor( editor, '".$this->webroot."js/ckfinder/' ) ;";
		//$code .= "CKFinder.SetupCKEditor( editor, { BasePath :  '".$this->webroot."js/ckfinder/', RememberLastFolder : false } ) ;";
		
        return $this->Html->scriptBlock($code); 
    }
}
?>