<?php namespace App\Services;

class SprubixMail {

    public function __construct() {
        $this->$mandrill = new Mandrill(env('MANDRILL_KEY'));
    }

    public function sendEmail() {

    }
}