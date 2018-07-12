<?php

// Load Composer's autoloader
require_once 'PHP_Mailer/vendor/autoload.php';


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHP_Mailer_Class
{
    // PHPMailer instance
    private $mail = null;
    // Email Subject
    private $mail_subject = "Shop informations";
    // Answer to e-mail
    private $answer_to_Email = "piotr.murdzia.csharp.testy@gmail.com";
    // Replie to informations
    private $replie_information = "Replie Information";

    /**
     * Class constructor
     */
    public function __construct(){

        $this->mail = new PHPMailer(true);

                                     ###   Server settings   ###

        //$this->mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $this->mail->isSMTP();                                            // Set mailer to use SMTP
        $this->mail->Host = 'smtp.gmail.com;smtp2.example.com';           // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                                     // Enable SMTP authentication
        $this->mail->Username = 'piotr.murdzia.csharp.testy@gmail.com';   ## // SMTP username
        $this->mail->Password = 'takiehaslo123456789';                    ## // SMTP password
        $this->mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587;                                          // TCP port to connect to
    }


    /**
     * Method add adress
     * @param mixed $User_Email - addressee e-mail
     * @param mixed $User_Fullname - addressee fullname
     */
    public function addAddress($User_Email, $User_Fullname){

        try
        {
            // Set addressee info
            $this->mail->addAddress("{$User_Email}","{$User_Fullname}");
        }
        catch (Exception $exception)
        {
            echo "Add_Adress() ERROR";
        }

    }

    /**
     * Method add replie adress
     * @param mixed $email - replie adress
     * @param mixed $information - information
     */
    public function addReplyTo($email, $information = null){

        if($information === null)
            $information = $this->replie_information;

        try
        {
            $this->mail->addReplyTo("{$email}","{$information}");
        }
        catch (Exception $exception)
        {
            echo "add_Replie_To_Adress() ERROR";
        }

    }

    /**
     * Method set Mail_Subject
     * @param mixed $mail_subject
     * @param mixed $answer_to
     */
    public function setFrom($mail_subject = null, $answer_to = null){

        if($mail_subject == null)
            $mail_subject = $this->mail_subject;

        if($answer_to == null)
            $answer_to = $this->answer_to_Email;

        try
        {
            $this->mail->setFrom("{$answer_to}","{$mail_subject}");
        }
        catch (Exception $exception)
        {
        	echo "Set_Email_Subject() ERROR";
        }

    }

    /**
     * Add CC adress
     * @param mixed $email
     */
    public function addCC($email){
        try
        {
            $this->mail->addCC("{$email}");
        }
        catch (Exception $exception)
        {
            echo"add_CC_Email() ERROR ";
        }

    }

    /**
     * Add BCC adress
     * @param mixed $email
     */
    public function addBCC($email){

        try
        {
            $this->mail->addBCC("{$email}");
        }
        catch (Exception $exception)
        {
            echo "add_BCC_Email() ERROR";
        }

    }

    /**
     * Method set email format to HTML
     * @param mixed $body - contents
     * @param mixed $Subejct - e-mail subject
     * @param mixed $alt_body
     */
    public function Set_Email_Message($body, $Subejct = null, $alt_body = null){

        if($Subejct === null)
            $Subejct = $this->mail_subject;

        try
        {
            $this->mail->isHTML(true);
            $this->mail->Subject = "{$Subejct}";
            $this->mail->Body    = "{$body}";
            $this->mail->AltBody = "{$alt_body}";
        }
        catch (Exception $exception)
        {
            echo "Set_Email_Format() ERROR";
        }

    }

    /**
     * Method add attachment in to e-mail message
     * @param mixed $path
     * @param mixed $file_name
     */
    public function Add_Attachment($path, $file_name = null){

        try
        {
            if($file_name = null)
                $this->mail->addAttachment("{$path}");
            else
                $this->mail->addAttachment("{$path}","{$file_name}");
        }
        catch (Exception $exception)
        {
            echo "Add_Attachment() ERROR";
        }

    }

    /**
     * Method send e-mail
     */
    public function Send_Email(){

        try
        {
        	$this->mail->send();

            echo 'Message has been sent';
        }
        catch (Exception $exception)
        {
            echo "Send_Email() ERROR";
        }

    }

    ###   Methods for this program   ###

    /**
     * Method sent e-mail about shopping & payments into admin and buyer
     * @param mixed $User_Email
     * @param mixed $User_Fullname
     * @param mixed $name
     * @param mixed $price
     * @param mixed $razorpay_payment_id
     * @param mixed $quantity
     */
    public function Send_Email_To_Buyer($User_Email, $User_Fullname, $name, $price,$razorpay_payment_id, $quantity){

        self::addReplyTo("piotr.murdzia.csharp.testy@gmail.com","Report about e-mail sent to buyer - copy for admin");
        self::addReplyTo("piterek20000@gmail.com");

        self::addAddress($User_Email, $User_Fullname);

        self::setFrom("Thank you for payment!");
        self::Set_Email_Message("Hello {$User_Fullname}, <br /> You have just payd for {$quantity} <b>{$name}</b> $<b>{$price}</b> <br /> razorpay_payment_id: <b>{$razorpay_payment_id}</b>","The seller has received your payment");
        self::Send_Email();
    }

    /**
     * Method send e-mail about shoppings & order into admin and buyer
     * @param mixed $User_Email
     * @param mixed $User_Fullname
     * @param mixed $name
     * @param mixed $price
     * @param mixed $quantity
     */
    public function Send_Email_To_Buyer_Order($User_Email, $User_Fullname, $name, $price, $quantity){

        self::addReplyTo("piotr.murdzia.csharp.testy@gmail.com","Report about e-mail sent to buyer - copy for admin");
        self::addReplyTo("piterek20000@gmail.com","Report about e-mail sent to buyer - copy for admin");

        self::addAddress($User_Email, $User_Fullname);

        self::setFrom("Thank you for shopping!");
        self::Set_Email_Message("Hello {$User_Fullname}, <br /> You just ordered {$quantity} <b>{$name}</b>, prepare $<b>{$price}</b> <br />","The seller has received your order");
        self::Send_Email();
    }

}