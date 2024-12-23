<?php
require 'C:/xampp/htdocs/heals_project/application/third_party/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/heals_project/application/third_party/PHPMailer/src/SMTP.php';
require 'C:/xampp/htdocs/heals_project/application/third_party/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email_library extends PHPMailer {
    public function __construct() {
        parent::__construct();

        // Your SMTP configuration
        $this->IsSMTP();
        $this->Host = "smtp-relay.brevo.com";
        $this->SMTPAuth = true;
        $this->Username = 'afifasyraf52@gmail.com';
        $this->Password = 'fSrwyFE7GgdcOp4H';
        $this->Port = 587; // Use the appropriate port
        $this->SMTPSecure = 'tls'; // Use 'tls' or 'ssl' depending on your server
    }
}
