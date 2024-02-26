<?php
namespace src\Utilities;

// <!-- Creating this class in Utilities because sqlinjection input can be present in both out site urls and instgram url given as user inputs -->
class SqlInjectionChecker 
{
    public static function checkQueryParams($queryParams)
    {
        foreach ($queryParams as $param => $value) {
            $isSqlInjection = self::detectSqlInjection($value);
            
            if ($isSqlInjection) {
                throw new \Exception("SQL Injection detected in parameter: $param");
            }
        }
    }

    private static function detectSqlInjection($value)
    {
        // echo $value;
        $sqlInjectionPatterns = ['union', 'select', 'insert', 'update', 'delete', 'drop', 'alter'];

        foreach ($sqlInjectionPatterns as $pattern) {
            if (stripos($value, $pattern) !== false) {
                return true;
            }
        }

        return false;
    }
}
