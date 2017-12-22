<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pdf {
	function pdf(){
		$CI = & get_instance();
		log_message('Debug', 'mPDF class is loaded.');
	}
	function load($mode='utf-8',$format=array(216,279.4),$default_font_size=0,$default_font=NULL,$mLeft=5,$mRight=5,$mTop=5,$mBottom=5,$mHeader=6,$mFooter=3,$orientation="P"){
		include_once APPPATH.'/third_party/mpdf/mpdf.php';		
		return new mPDF($mode,$format,$default_font_size,$default_font,$mLeft,$mRight,$mTop,$mBottom,$mHeader,$mFooter,$orientation);
	}
}
