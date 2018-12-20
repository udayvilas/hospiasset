<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__) . '/phpmailer/PHPMailerAutoload.php';
class Mailer extends PHPMailer
{
    function __construct()
    {
        parent::__construct();
    }
}