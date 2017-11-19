<?php
    include_once __DIR__ . '/dance_api/api/functions/oauth.php';
    try {
        echo 0;
        var_dump(new_consumer_key());
    }catch (Exception $e) {
        echo $e->getMessage();
    }

