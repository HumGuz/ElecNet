<?php
class App {
	public static function dateFormat($date,$op=0){
		if(date('Y-m-d',strtotime($date)) == '1969-12-31' ||  $date =='' || $date == '0000-00-00')    
                return "";			
			$dias =  array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sabado');
			$dias_short =  array('Dom','Lun','Mar','Mié','Jue','Vie','Sab');
			$meses_short = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
			$dia = date("d", strtotime($date));
			$mes = $meses_short[intval(date("m", strtotime($date)))];
			$ano = date("Y", strtotime($date));
			if($op==0)
				return $dia.' '.$mes.' '.$ano;			
			if($op==1)
				return $dia.' '.$mes;			
			if($op==2)
				return $dia.' '.$mes.' '.$ano.' '.date('H:i',strtotime($date));						
			if($op==3)
				return $dia.' '.$mes.' '.date('H:i:s',strtotime($date));
			if($op==4)
				return $dia.' '.$mes.' '.date('y',strtotime($date));
			if($op==5)
				return $dia.' '.$mes.' '.date('y',strtotime($date)).' '.date('H:i',strtotime($date));
			if($op==6)
				return $dia.' '.$mes.' '.date('H:i:s',strtotime($date));
	}	
	
	
	public static function dateDiff($interval, $datefrom, $dateto, $using_timestamps = false) {
				if (!$using_timestamps) {
					$datefrom = strtotime($datefrom, 0);
					$dateto = strtotime($dateto, 0);
				}
				$difference = $dateto - $datefrom;
				switch($interval) {	
					case "m": // Number of full months			
						$months_difference = floor($difference / 2678400);
						while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
							$months_difference++;
						}
						$months_difference--;
						$datediff = $months_difference;
						break;			
					case "d": // Number of full days			
						$datediff = floor($difference / 86400);
					break;
					case "h": // Number of full hours			
						$datediff = floor($difference / 3600);
					break;			
					case "n": // Number of full minutes			
						$datediff = floor($difference / 60);
					break;			
					default: // Number of full seconds (default)			
						$datediff = $difference;
					break;
				}			
				return $datediff;			
	} 
	
	
	public static function fulldatediff($datefrom, $dateto = null,$op=0){
	        $return="";
			if($datefrom && $dateto){
				$datefrom = strtotime($datefrom, 0);
		        $dateto = strtotime($dateto, 0);			
		        $timestamp = $dateto - $datefrom;
			}else{
				$timestamp = $datefrom;
			}
	        $monts= floor($timestamp / 2678400);
	        if($monts>0){            
	            $timestamp-=$monts*2678400;
	            $return.=$monts." meses ";
	        }        
	        # Obtenemos el numero de dias
	        $days=floor((($timestamp/60)/60)/24);
	        if($days>0){
	            $timestamp-=$days*24*60*60;
	            $return.=$days." días ";
	        }       
	            # Obtenemos el numero de horas
	            $hours=floor(($timestamp/60)/60);
	            if($hours>0){
	                $timestamp-=$hours*60*60;
	                $return.=str_pad($hours, 2, " ", STR_PAD_LEFT)." hrs ";
	            }
	            $minutes=floor($timestamp/60);
	            if($minutes>0){
	                $timestamp-=$minutes*60;
	                $return.=str_pad($minutes, 2, " ", STR_PAD_LEFT)." min ";
	            }				
					# Obtenemos el numero de segundos
				if($op==0)			
    				$return.=str_pad($timestamp, 2, " ", STR_PAD_LEFT)." seg ";
	        
	        return $return;
    }
	
	public static function upload($data,$files){    	    	
			if($files['imagen']){
				$img = 	$files['imagen'];		
				$uploads_dir = './application/views/img/uploads';
				if ($img['error'] == UPLOAD_ERR_OK) {
				        $tmp_name = $img["tmp_name"];
				        $name = basename($img["name"]);
				        $data['imagen'] = 'uploads/'.$name;
				        if(move_uploaded_file($tmp_name, "$uploads_dir/$name")===FALSE)
							return array('status'=>2,'err'=>'no se subio la imagen','img'=>$name);
				 }else{
						return array('status'=>2,'err'=>'no se subio la imagen');
				}
			} else {
				unset($data['imagen']);
			}
			$data['status'] = 1;
			return $data;
	}
		
		
	public static function saveUriImg($data){
		if($data['imagen']){			
			$img = 'img-'.$data['uniqueid'].(self::getCode()).".png";			
			if(file_put_contents('./application/views/img/uploads/'.$img, file_get_contents($data['imagen']))){				
				$data['imagen'] = $img;
				$data['status']=1;
			}else{
				return array('status'=>2,'err'=>'no se subio la imagen');
			}					
		}else{
			$data['status']=1;
		}
		return $data;	
	}	
			
	public static function getCode($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
	}
                
        public static function cell($data){   
            //col =  ASCCI para la letra de la columna A-Z = 65-90
            //level rango de caracteres sencillo o doble A = sencillo AA = doble   
            $char = chr($data['col']);
            $lvl = "";
            if($data['level']>1){    
                if($data['level']==2)
                    $lvl =  'A';
                if($data['level']==3)
                    $lvl =  'B';
                if($data['level']==4)
                    $lvl =  'C';
                if($data['level']==5)
                    $lvl =  'D';
                if($data['level']==6)
                    $lvl =  'E';
                if($data['level']==7)
                    $lvl =  'F';
                if($data['level']==8)
                    $lvl =  'G';
                if($data['level']==9)
                    $lvl =  'H';
                if($data['level']==10)
                    $lvl =  'I';
            }

            $data['cell'] = $lvl.$char.$data['row'];
            $data['column'] = $lvl.$char;

            if($data['col']==90){
                $data['col'] = 65;
                $data['level']++;
            }else{
                $data['col']++;
            }
            return $data;   
        }

	public static function folio($tipo,$id){	
		$id = strval($id);		 	
		$pre = $tipo.'000000';
		return substr($pre, 0,(strlen($pre)-strlen($id))).(intval($id));
	}
	
}
?> 
