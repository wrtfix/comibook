<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once "Mail.php";

class Email
{
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->config('email');
    }

    public function send($protocolo,$puerto, $from='<wrtfix@gmail.com>', $to='<wrtfix@gmail.com>', $subject='No subject', $body='No body', $username, $password)
    {
        $headers = array('MIME-Version' => '1.0rn',
        'Content-Type' => "text/html; charset=ISO-8859-1rn",
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );

        $smtp = Mail::factory('smtp', array(
                'host' => $protocolo,
                'port' => $puerto,
                'auth' => true,
                'username' => $username,
                'password' => $password
            ));

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            print_r($mail->getMessage());
            return false;
        } else {
            return true;
        }
    }
    
}