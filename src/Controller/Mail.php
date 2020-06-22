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
		
			$this->mail = new PHPMailer();
			$this->mail->isSMTP();
			$this->mail->Host       = Config::$Mail_Host;
			$this->mail->SMTPAuth   = true;
			$this->mail->Username   = Config::$Mail_Username;
			$this->mail->Password   = Config::$Mail_Password;
			$this->mail->CharSet = 'UTF-8';
			$this->mail->Port       = 465;
			$this->mail->SMTPSecure = "ssl";
			$this->mail->setFrom(Config::$Mail_Username, Config::$Mail_DefaultSender);
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
			if(Config::$Mail_IsReplyTo){
                $this->mail->addReplyTo(Config::$Mail_AddReplyTo, Config::$Mail_DefaultSender);
            }

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