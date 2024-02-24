<?php
namespace src\Middlewares;

use src\Utilities\SqlInjectionChecker;

class SqlInjection {
   public static function verify($queryString) {
        try{
            $queryParams = [];
            parse_str($queryString, $queryParams);
            // var_dump($queryParams);
            SqlInjectionChecker::checkQueryParams($queryParams);
        } catch(\Exception $e) {
            http_response_code(400);
            echo json_encode([
                'statusCode' => 400,
                'Message' => 'Malicious Request'
            ]);
        }
    }
}




