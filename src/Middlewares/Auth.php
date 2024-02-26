<?php
namespace src\Middlewares;
class Auth {

    //Just Stimulating behaviour as a sample no complex logic implemented for token generation & validation
    public static function verify($loginHeader) {
            if($loginHeader != 'allowed') 
            throw new \Exception("un-authorized request");
         return true;
     }
 }
?>