<?php
require_once APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php'; // Sesuaikan dengan pathmu


class Email_SMTP{

  public function smtp_mail($to, $subject, $message, $from_name, $from, $cc, $bcc, $debug=true) {
  $mail = new PHPMailer;
  $mail->SMTPDebug = $debug; // Ubah menjadi true jika ingin menampilkan sistem debug SMTP Mailer
  $mail->isSMTP();
  
  // Hapus Semua Tujuan, CC dan BCC
  $mail->ClearAddresses();  
  $mail->ClearCCs();
  $mail->ClearBCCs();

  /* -------------------------- Konfigurasi Dasar SMTP ---------------------------------- */
  
  $mail->SMTPAuth 	= true;                        				
  $mail->Host 		  = 'honest.jagoanhosting.id';  
  $mail->Port 		  = 465;                                     
  $mail->SMTPSecure = 'ssl';                                   
  $mail->Username 	= 'admin@laqueeninternational.id';               
  $mail->Password 	= 'G00gle123!@#';        						        
  $default_email_from       = 'admin@laqueeninternational.id';      
  $default_email_from_name  = 'LaQueen International';           
  
  /* -------------------------- Konfigurasi Dasar SMTP ---------------------------------- */
  
  if(empty($from)) $mail->From = $default_email_from;
  else $mail->From = $from;
  
  if(empty($from_name)) $mail->FromName = $default_email_from_name;
  else $mail->FromName = $from_name;
  
  // Set penerima email
  if(is_array($to)) {
    foreach($to as $k => $v) {
      $mail->addAddress($v);
    }
  } else {
    $mail->addAddress($to);
  }
  
  // Set email CC ( optional )
  if(!empty($cc)) {
    if(is_array($cc)) {
      foreach($cc as $k => $v) {
        $mail->addCC($v);
      }
    } else {
      $mail->addCC($cc);
    }
  }
  
  // Set email BCC ( optional )
  if(!empty($bcc)) {
    if(is_array($bcc)) {
      foreach($bcc as $k => $v) {
        $mail->addBCC($v);
      }
    } else {
      $mail->addBCC($bcc);
    }
  }
  
  // Set isi dari email
  $mail->isHTML(true);
  $mail->Subject 	= $subject;
  $mail->Body 	  = $message;
  $mail->AltBody	= $message;
  if(!$mail->send())
  return 1;
else
    return 0;
}

}
?>