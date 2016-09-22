<?php
/**
 * Created by PhpStorm.
 * User: Indra
 * Date: 8/28/2016
 * Time: 4:55 AM
 */

class System{
    public static function sendMail($to, $uname, $from, $subject, $reply, $content, $msg)
    {
        $mailTemplate = ConfigurationManager::getViewsDirectory() . 'mail/';
        //var_dump($defaultTemplate);
        $template = new Template($mailTemplate);

        if ($content == null)
        {
            $content = "";
        }

        $template->set('msg', $msg);
        $template->set('content', $content);
        $template->set('uname', $uname);

        $message = $template->parse();

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        if (mail($to, $subject, $message, $headers))
        {
            return true;
        }
        else
        {
            mail($to, $subject, $message, $headers);
            return false;
        }
    }
}