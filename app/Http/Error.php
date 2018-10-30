<?php

namespace App\Http;

class Error {
    public function __construct($response, $error)
    {
        // $error = [ "statusCode" => 404, "" ]
       var_dump($response);
       
    }
};