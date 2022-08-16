<?php
namespace Juventud\Core\utils;

use Juventud\Core\conf\JuventudConfig;

use Cose\Security\model\Usergroup;
use Cose\Security\model\User;

use Cose\utils\Logger;

/**
 * Utilidades para el proyecto.
 *
 * @author Marcos
 * @since 15-02-2017
 */
class JuventudUtils {

	const DATE_FORMAT = 'd/m/Y';
	const DATETIME_FORMAT = 'd/m/y H:i:s';
	const TIME_FORMAT = 'H:i';
	
	//números
	const DECIMALES = '2';
	const SEPARADOR_DECIMAL = ',';
	const SEPARADOR_MILES = '.';

	//moneda.
	const MONEDA_SIMBOLO = '$';
	const MONEDA_ISO = 'ARS';
	const MONEDA_NOMBRE = 'Pesos Argentinos';
	const MONEDA_POSICION_IZQ = 1;

	const EMAIL_NOTIFICACIONES = "ber.iribarne@gmail.com";
	const NOMBRE_EMAIL_NOTIFICACIONES = "Bernardo";
	
	const USERGROUP_ADMIN = 1;
	
	public static function isAdmin( User $user ){
	
		$usergroup = new Usergroup();
		$usergroup->setOid(self::USERGROUP_ADMIN);
		return $user->hasUsergroup( $usergroup );
			
	}
		
	/**
	 * se formatea un monto a visualizar
	 * @param $monto
	 * @return string
	 */
	public static function formatMontoToView( $monto ){
	
		if( empty($monto) )
		$monto = 0;

		$res = $monto;
		//si es negativo, le quito el signo para agregarlo antes de la moneda.
		if( $monto < 0 ){
			$res = $res * (-1);
		}
			
		$res = number_format ( $res ,  self::DECIMALES , self::SEPARADOR_DECIMAL, self::SEPARADOR_MILES );



		if( self::MONEDA_POSICION_IZQ ){
			$res = self::MONEDA_SIMBOLO . $res;
				
		}else
		$res = $res. self::MONEDA_SIMBOLO ;

		//si es negativo lo mostramos rojo y le agrego el signo.
		if( $monto < 0 ){
			$res = "<span style='color:red;'>- $res</span>";
		}

		return $res;
	}


	//Formato fecha yyyy-mm-dd
	public static function differenceBetweenDates($fecha_fin, $fecha_Ini, $formato_salida = "d") {
		$valueFI = str_replace('/', '-', $fecha_Ini);
		$valueFF = str_replace('/', '-', $fecha_fin);
		$f0 = strtotime($valueFF);
		$f1 = strtotime($valueFI);
		if ($f0 < $f1) {
			$tmp = $f1;
			$f1 = $f0;
			$f0 = $tmp;
		}
		return date($formato_salida, $f0 - $f1);
	}

	
	public static function formatMesToView( $mes ){
	
		$meses = array (
			"1" => "Enero",
			"2" => "Febrero",
			"3" => "Marzo",
			"4" => "Abril",
			"5" => "Mayo",
			"6" => "Junio",
			"7" => "Julio",
			"8" => "Agosto",
			"9" => "Septiembre",
			"10" => "Octubre",
			"11" => "Noviembre",
			"12" => "Diciembre"
		);
		
		return $meses[$mes];
	}
	
	public static function formatDateToView($value, $format=self::DATE_FORMAT) {
		
		$res = "";
		if( !empty( $value) )
			$res = $value->format($format);
		else $res = "";
		
		$meses = array (
			"January" => "Enero",
			"Febraury" => "Febrero",
			"March" => "Marzo",
			"April" => "Abril",
			"May" => "Mayo",
			"June" => "Junio",
			"July" => "Julio",
			"August" => "Agosto",
			"September" => "Septiembre",
			"October" => "Octubre",
			"November" => "Noviembre",
			"December" => "Diciembre",
			"Jan" => "Ene",
			"Feb" => "Feb",
			"Mar" => "Mar",
			"Apr" => "Abr",
			"May" => "May",
			"Jun" => "Jun",
			"Jul" => "Jul",
			"Aug" => "Ago",
			"Sep" => "Sep",
			"Oct" => "Oct",
			"Nov" => "Nov",
			"Dec" => "Dic"
		);
		
		$dias = array(
			'Monday' => 'Lunes',
			'Tuesday' => 'Martes',
			'Wednesday' => 'Miércoles',
			'Thursday' => 'Jueves',
			'Friday' => 'Viernes',
			'Saturday' => 'Sábado',
			'Sunday' => 'Domingo',
			'Mon' => 'Lun',
			'Tue' => 'Mar',
			'Wed' => 'Mie',
			'Thu' => 'Jue',
			'Fri' => 'Vie',
			'Sat' => 'Sab',
			'Sun' => 'Dom',
		);
		foreach ($meses as $key => $value) {
			$res = str_replace($key, $value, $res);
		}
		foreach ($dias as $key => $value) {
			$res = str_replace($key, $value, $res);
		}
		
		return $res ;
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date($format, strtotime($value));
		}else
		$dt = "";

		return $dt;
		*/
	}

	public static function formatDateToPersist($value) {

		return $value->format("Y-m-d");
		
		/*		
		$value = str_replace('/', '-', $value);
		
		if (!empty($value))
		$dt = date("Y-m-d", strtotime($value));
		else
		$dt = "";
		return $dt;*/
	}

	public static function formatDateTimeToView($value, $format="") {
		
		if(empty($format))
			$format = self::DATETIME_FORMAT;
		if(!empty($value))
			return $value->format( $format );
		else
			return "";
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date(self:DATE_FORMAT, strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function formatDateTimeToPersist($value) {
		
		return $value->format("Y-m-d H:i:s");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value))
		$dt = date("Y-m-d H:i:s", strtotime($value));
		else
		$dt = "";

		return $dt;*/
	}

	
	public static function addDays($date, $dateFormat="", $days){

		$date->modify("+$days day");
		return $date;
		/*
		$newDate = strtotime ( "+$days day" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );
		
		return $newDate;
		*/
	}

	public static function substractDays($date, $dateFormat, $days){

		$date->modify("-$days day");
		return $date;
		/*
		$newDate = strtotime ( "-$days day" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );

		return $newDate;
		*/
	}

	public static function addMinutes($date, $dateFormat, $minutes){
		
		//$date->modify("+$minutes minutes");
		//return $date;
		
		$newDate = strtotime ( "+$minutes minutes" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );
		
		return $newDate;
	}
	
	public static function isSameDay( $dt_date, $dt_another){

		return $dt_date->format("Ymd") == $dt_another->format("Ymd");
		 
		/*
		$dt_dateAux = strtotime ( $dt_date ) ;
		$dt_dateAux = date ( "Ymd" , $dt_dateAux );

		$dt_anotherAux = strtotime ( $dt_another ) ;
		$dt_anotherAux = date ( "Ymd" , $dt_anotherAux );

		return $dt_dateAux == $dt_anotherAux ;*/
	}


	public static function formatTimeToView($value, $format=self::TIME_FORMAT) {
		
		if(!empty($value))
		
			return $value->format($format);

		else return "";	
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date(self:TIME_FORMAT, strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function getHorasItems() {
		
		$desde = new \DateTime();
		$desde->setTime(0,0,0);
		$duracion = 15;
		$i=0;
		while( $i<97 ){
			
			$items[$desde->format("H:i")] = $desde->format("H:i");
			
			$desde->modify("+$duracion minutes");
			
			$i++;	
			
		}
		
		return $items;
		
	}

	public static function formatEdad( $edad ){
	
		if( !empty($edad) ){
		
			if( $edad > 1)
				return "$edad años";
			else
				return "$edad año";
		}return "";
	}
	
	public static function getEdad( $fecha ){

		$fechaNac = $fecha;
		
		if ($fechaNac != null ){
			
			$hoy = new \DateTime();
			
			$dia = $hoy->format("d");
			$mes = $hoy->format("m");
			$anio = $hoy->format("Y");
			 
			//fecha de nacimiento
			$dia_nac = $fechaNac->format("d");
			$mes_nac = $fechaNac->format("m");
			$anio_nac = $fechaNac->format("Y");
			
			//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
			 
			if (($mes_nac == $mes) && ($dia_nac > $dia)) {
				$anio=($anio-1); 
			}
			 
			//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
			 
			if ($mes_nac > $mes) {
				$anio=($anio-1);
			}
			 
			//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
			 
			$edad=($anio-$anio_nac);    	    
				
		}
		else
			$edad = "";
		
    	return $edad;
	}
	
	

	
	public static function dayOfDate(\DateTime $value) {
		
		return $value->format("d");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("d", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function monthOfDate($value) {
		
		return $value->format("m");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("m", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}
	
	public static function yearOfDate($value) {
		
		return $value->format("Y");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("Y", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}
	
	public static function strtotime($value) {
		
		$value = str_replace('/', '-', $value);
		
		return strtotime($value);
	}


	public static function newDateTime($value) {
		
		$value = str_replace('/', '-', $value);
		$time = strtotime($value);
		
		$dateTime = new \DateTime();
		$dateTime->setDate(date("Y", $time), date("m", $time), date("d", $time));
		
		return $dateTime;
	}
	
	
	public static function localize($keyMessage){
	
		return Locale::localize( $keyMessage );
	}
	
	
	public static function localizeEntities($enumeratedEntities){
		
		$items = array();
		
		foreach ($enumeratedEntities as $key => $keyMessage) {
			$items[$key] = self::localize($keyMessage);
		}
		
		return $items;
	}
	
	public static function formatMessage($msg, $params){
		
		if(!empty($params)){
			
			$count = count ( $params );
			$i=1;
			while ( $i <= $count ) {
				$param = $params [$i-1];
				
				$msg = str_replace('$'.$i, $param, $msg);
				
				$i ++;
			}
			
		}
		return $msg;
		
	
	}

	public static function getNewDate($dia,$mes,$anio){
	
		$date = new \DateTime();
		$date->setDate($anio, $mes, $dia);
		return $date;
	}
	
	
	public static function getFirstDayOfWeek(\Datetime $fecha){
	
		$f = new \Datetime();
		$f->setTimestamp( $fecha->getTimestamp() );
    	
		//si es lunes, no hacemos nada, sino, buscamos el lunes anterior.
		if( $f->format("N") > 1 )
			$f->modify("last monday");
    	
    	return $f;
	}
	
	
	public static function getLastDayOfWeek(\Datetime $fecha){
	
		$f = new \Datetime();
		$f->setTimestamp( $fecha->getTimestamp() );
    	$f->modify("next monday");
    	
    	//si no es lunes, restamos un día.
    	if( $fecha->format("N") > 1 )
			$f->sub(new \DateInterval('P1D'));
    	
    	return $f;
	}
	
	public static function getFirstDayOfMonth(\Datetime $fecha){
	
		
		$f = self::getNewDate( 1, $fecha->format("m"), $fecha->format("Y"));
    	return $f;
	}
	
	
	public static function getLastDayOfMonth(\Datetime $fecha){
	
		//me paro en el primer día del mes siguiente y resto un día.
		
		$f = self::getFirstDayOfMonth($fecha);
		$f->modify("+1 month");
    	$f->modify("-1 day");
    	
    	return $f;
	}
	
	public static function getFirstDayOfYear(\Datetime $fecha){
	
		$f = self::getNewDate( 1, 1, $fecha->format("Y"));
    	return $f;
	}
	
	
	public static function getLastDayOfYear(\Datetime $fecha){
	
		//me paro en el primer día del anio siguiente y resto un día.
		
		$f = self::getFirstDayOfYear($fecha);
		$f->modify("+1 year");
    	$f->modify("-1 day");
    	
    	return $f;
	}

	public static function fechasIguales(\Datetime $fecha1, \Datetime $fecha2){
		return $fecha1->format("Ymd") == $fecha2->format("Ymd");
	}
	
	
	public static function getUserByUsername( $username ){
		return \Cose\Security\service\ServiceFactory::getUserService()->getUserByUsername($username);
	}
	
	

    public static function enviarEmail($nombreDestinatario, $destinatario, $asunto, $mensaje, $attachments = array(), $remitente=null) {

    	if(empty($remitente))
    		$remitente = JuventudConfig::MAIL_FROM;
    	
    	//para tests redireccionamos el envío de emails.
    	if( CuentasConfig::TEST_MODE ){
    		$destinatario = JuventudConfig::TEST_MAIL_TO;
    		$nombreDestinatario = "Test Mode";
    	}
    	
        	
        //para que no de la salida del mailer.
        ob_start();
			
        $fromName = JuventudConfig::MAIL_FROM_NAME;
	    if(!empty($fromName) )
	    	$remitente = "$fromName <$remitente>";

		if(count($attachments) > 0 ){
            
            	self::log_debug("con attachments " . count($attachments), __CLASS__);
            	
            	$cabeceras .="X-Mailer:PHP/".phpversion()."\n";
				$cabeceras .="Mime-Version: 1.0\n";
				$cabeceras .= "From: $from \r\n";
				$cabeceras .= "Content-type: multipart/mixed; ";
				$cabeceras .= "boundary=\"Message-Boundary\"\n";
				$cabeceras .= "Content-transfer-encoding: 7BIT\n";

				$body_top = "--Message-Boundary\n";
				$body_top .= "Content-type: text/html; charset=iso-8859-1\n";
				$body_top .= "Content-transfer-encoding: 7BIT\n";
				$body_top .= "Content-description: Mail message body\n\n";
				
                $adjuntos = "";
	            foreach ($attachments as $filename) {

	            	$file = fopen($filename, "r"); //dir es el path
					$contenido = fread($file, filesize($filename));
					$encoded_attach = chunk_split(base64_encode($contenido));
					fclose($file);
					$adjuntos .= "\n\n--Message-Boundary\n";
					$adjuntos .= "Content-type: Binary; name=\"". basename($filename) ."\"\n";
					$adjuntos .= "Content-Transfer-Encoding: BASE64\n";
					$adjuntos .= "Content-disposition: attachment; filename=\"". basename($filename) ."\"\n\n";
					$adjuntos .= "$encoded_attach\n";

		        }
                
                $shtml = $body_top. " $mensaje";
				$shtml .= $adjuntos;
              
                $to = $nombreDestinatario . " <" . $destinatario . ">";
                
                mail($to,$asunto,$shtml,$cabeceras);
            	
            	
          }else{
            	
	            $to = $nombreDestinatario . " <" . $destinatario . ">";
	            $headers = 'MIME-Version: 1.0' . "\r\n";
	            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	            $headers .= "From: $remitente \r\n";
	             
	            	
	
	            if (!mail($to, $asunto, $mensaje, $headers)){
	            	throw new GenericException("Ocurrió un error en el envío del mail a $to");
	            }
          }
          //para que no de la salida del mailer.
          ob_end_clean();
    }
    
    public static function log($msg, $clazz=__CLASS__){
    	Logger::log($msg, $clazz);
    }

    public static function logObject($object, $clazz=__CLASS__){
    	Logger::logObject($object, $clazz);
    }
    
	
}