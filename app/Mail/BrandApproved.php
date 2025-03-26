<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class BrandApproved extends Mailable
{
    public $email;
    public $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your Brand Has Been Approved')
                    ->view('emails.brand_approved');
    }
}
