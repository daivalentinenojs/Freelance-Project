<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Email extends Model
{
    public function PostEmail(Request $Request)
    {
        header('Content-type: application/json');
    	$status = array(
    		'type'=>'success',
    		'message'=>'Thank you for contact us. As early as possible  we will contact you '
    	);

        $name       = @trim(stripslashes($Request->get('name')));
        $email      = @trim(stripslashes($Request->get('email')));
        $subject    = @trim(stripslashes($Request->get('subject')));
        $message    = @trim(stripslashes($Request->get('message')));

        $email_from = $email;
        $email_to = 'daivalentinenojs@gmail.com';//replace with your email

        $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;

        $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

        return $status;
    }
}
