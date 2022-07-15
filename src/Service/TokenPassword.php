<?php 

namespace App\Service;

class TokenPassword {

    private $password;

    public function __construct()
    {
    }

    public function getMd5Password(string $password) : string{
        return md5($password);
    }

}



?>