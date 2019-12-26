<?php
namespace common\services;


interface EmailServiceInterface
{
    public function send($email, $subj, $views, $data) : bool;
}