<?php
defined('BASEPATH') OR exit('No direct vntipt access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
ini_set('display_errors', '1');
error_reporting( E_ALL & ~E_NOTICE & ~E_WARNING);
require '/var/www/html/ElecNet/vendor/autoload.php';
use Mailgun\Mailgun;
class Mail extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		// $this->s = $this -> session -> userdata();		
		// if(!isset($this->s['usuario']))			
			// redirect(base_url());	
		// $this -> db = $this -> load -> database($this->s["db"], TRUE);
		// $this->load->model('ventas_model','vnt');
	}
			
	function send_central(){
		
		$mgClient = new Mailgun('key-ef770b20d62f9b6835ddc2a3cae7b175');
		$domain = "centralgps.com.mx";
		
		# Make the call to the client.
		$result = $mgClient->sendMessage($domain, array(
		    'from'    => 'Contacto centralGPS <humberto.guzman@centralgps.com.mx>',
		    'to'      => '<humden_58@hotmail.com>,<yy61637@gmail.com>',
		    'subject' => 'Hello',
		    'text'    => 'Testing some Mailgun awesomness!'
		));
		echo "<pre>";
		print_r($result);
		
	}	
			
	function send_elecnet(){		
				
		
		$mgClient = new Mailgun('5a42c51441529c5ecd79a98823ff314c-c8e745ec-ee39d9db');
		$domain = "elecnet.mx";
		
		# Make the call to the client.
		$result = $mgClient->sendMessage($domain, array(
		    'from'    => 'Contacto Elecnet <elecnet.mx@gmail.com>',
		    'to'      => 'Humberto <humden_58@hotmail.com>',
		    'subject' => 'Hello',
		    'text'    => 'Testing some Mailgun awesomness!'
		));
		echo "<pre>";
		print_r($result);	
	}
	
	
}
