<?php
namespace app\service;

require_once $_SERVER["DOCUMENT_ROOT"] . '/_asset/_lib/phpMailer/src/Exception.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/_asset/_lib/phpMailer/src/PHPMailer.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/_asset/_lib/phpMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    public function inquirySendMail()
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host        = 'smtps.hiworks.com';
        $mail->SMTPAuth    = true;
        $mail->Username    = 'cp@ct-planet.co.kr';
        $mail->Password    = 'planet88@@';
        $mail->SMTPSecure  = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port        = 465;
        $mail->setFrom('cp@ct-planet.co.kr', '이여곰탕');
        $mail->addAddress('kkt@ct-planet.co.kr');
        $mail->isHTML(true);
        $mail->CharSet    = "UTF-8";
        $mail->Encoding   = "base64";
        $mail->Subject     = '문의글이 등록되었습니다.';
        $mail->Body        = '관리자에서 문의를 확인해주세요.';
        $mail->send();
    }
}
