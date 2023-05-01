<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    $mail = new PHPMailer();
function replace_in_file($FilePath, $OldText, $NewText)
{
    $Result = ["status" => "error", "message" => ""];
    if (file_exists($FilePath) === true) {
        if (is_writeable($FilePath)) {
            try {
                $FileContent = file_get_contents($FilePath);
                $FileContent = str_replace($OldText, $NewText, $FileContent);
                if (file_put_contents($FilePath, $FileContent) > 0) {
                    $Result["status"] = "success";
                } else {
                    $Result["message"] = "Error while writing file";
                }
            } catch (Exception $e) {
                $Result["message"] = "Error : " . $e;
            }
        } else {
            $Result["message"] = "File " . $FilePath . " is not writable !";
        }
    } else {
        $Result["message"] = "File " . $FilePath . " does not exist !";
    }
    return $Result;
}



function copy_base_crm($company_name,$base_crm_path,$base_path)
{
    ($connection = ssh2_connect("195.20.239.170", 22)) or die("jjjj");
    if (!$connection) {
        die("Connection failed");
    }
    ssh2_auth_password($connection, "root", "!gXW5Q2b!T");

    //$stream = ssh2_exec($connection, 'cd /var/www/html/coniasoft');
    $stream = ssh2_exec(
        $connection,
        "cp -r " .
        $base_crm_path .
            " " .
            $base_path .
            $company_name
    );
    ssh2_exec(
        $connection,
        "sudo chmod -R 777 " .$base_path.
            $company_name .
            "/application/config/app-config.php"
    );
}


function registration_mail($to)
{

    $mail = new PHPMailer();
    // Settings
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Host       = "smtp.ionos.de";    // SMTP server example
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
$mail->Username   = "contact@coniasoft.info";            // SMTP account username example
$mail->Password   = "Imran@2121";            // SMTP account password example

// Content
$mail->setFrom('contact@coniasoft.info');   
$mail->addAddress($to);

$mail->isHTML(true);                       // Set email format to HTML
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}
}