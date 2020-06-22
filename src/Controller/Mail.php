<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	class Mail{

		private $mail;

		function __construct()
		{

			require 'Lib/PHPMailer/Exception.php';
			require 'Lib/PHPMailer/PHPMailer.php';
			require 'Lib/PHPMailer/SMTP.php';
		
			$defaultSender = 'Hififutár';
		
			$this->mail = new PHPMailer();
			$this->mail->isSMTP();
			$this->mail->Host       = 'server.hifi-station.hu';
			$this->mail->SMTPAuth   = true;
			$this->mail->Username   = 'noreply@hifi-station.hu';
			$this->mail->Password   = '5KTAejjJqa#G2';
			$this->mail->CharSet = 'UTF-8';
			$this->mail->Port       = 465;
			$this->mail->SMTPSecure = "ssl";
			$this->mail->setFrom('noreply@hifi-station.hu', $defaultSender);	
			$this->mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);			
		}

		private function MessageGenerator($to,$subject,$message){
			$this->mail->addAddress($to);
			$this->mail->addReplyTo('bolt@hifi-station.hu', 'Hifi Station Kft');
		    $this->mail->isHTML(true);
		    $this->mail->Subject = $subject;
		    $this->mail->Body    = $message;
		    $this->mail->AltBody = $message;
		    try {
		    	$this->mail->send();
		    } catch (Exception $e) {
		    	echo "Az üzenetet nem lehetett elküldeni, kérjük mielőbb tájékoztassa az oldal adminisztrátorát. Hibüzenet: {$this->mail->ErrorInfo}";
		    }
		}

		static function SendMail($to,$subject,$message){
			$mail = new mail();
			$mail->MessageGenerator($to,$subject,$message);
		}
	}
?>