<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use MongoDB\Client;

class MongoConnection
{
    private static ?Client $client = null;

    public static function getClient(): Client
    {
        if (self::$client === null) {
            self::$client = new Client('mongodb://root:example@mongodb:27017');
        }

        return self::$client;
    }

    public static function getDatabase()
    {
        return self::getClient()->selectDatabase('elegance_event');
    }
}