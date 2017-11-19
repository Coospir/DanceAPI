<?php
/**
 * Created by PhpStorm.
 * User: COOSPIR-PC
 * Date: 19.11.2017
 * Time: 10:51
 */
//https://toys.lerdorf.com/archives/55-Writing-an-OAuth-Provider-Service.html
include_once __DIR__ . '/../config/database.php';

function new_consumer_key() {
    echo 1;
    $fp = fopen('/dev/urandom','rb');
    echo 2;
    $entropy = fread($fp, 32);
    echo 3;
    fclose($fp);
    echo 4;
    $entropy = uniqid(mt_rand(), true);
    echo 5;
    $hash = sha1($entropy);
    echo 6;
    return array(substr($hash, 0, 30), substr($hash, 30, 10));
}

function lookupConsumer($provider){
    $database = new Database();
    $db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');
    $query = "SELECT * FROM consumer WHERE id = :consumer_key";
    $stmt = $db->prepare($query);
    $stmt -> bindValue(":consumer_key", $provider->consumer_key);
    $stmt->execute();
    $row = $stmt->fetch(PDO::ASSOC);
    if(!$row){
        return OAUTH_CONSUMER_KEY_UNKNOWN;
    } else {
        extract($row);
        if($status != 0){
            return OAUTH_CONSUMER_KEY_REFUSED;
        }
    }
    $provider->consumer_secret = $secret;
    return OAUTH_OK;
}

function timestampNonceChecker(){
    echo 123;
    return OAUTH_OK;
}