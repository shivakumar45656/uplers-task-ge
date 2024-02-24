<?php
namespace src\Models;

//Contains Code thats common to all Model Classes

class BaseModel { 
    protected static $connection;
    protected static $isActive=false;

    function __construct() {
        try {
            if(!self::$isActive) {
                self::$connection = new PDO("mysql:host=127.0.0.1;dbname=multi_tenants", 'root', 'tiger'); //hardcoding values as of now, reading from env file provides better flexibility
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

    }
}

// queries for tables

// create database multi_tenants;

// CREATE TABLE `multi_tenants`.`tenants` (
//     id INT PRIMARY KEY,
//     name VARCHAR(255),
//     created_on DATETIME DEFAULT CURRENT_TIMESTAMP,
//     is_verified BOOLEAN
// );

// CREATE TABLE players (
//     id INT PRIMARY KEY,
//     player_id VARCHAR(1000),
//     xp INT,
//     tenant_id INT,
//     created_on DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_on DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// );



?>