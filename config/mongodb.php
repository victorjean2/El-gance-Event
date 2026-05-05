<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use MongoDB\Client;

class MongoConnection
{
    private static ?Client $client = null;

    public static function getClient(): Client
    {
        if (self::$client === null) {
            /*self::$client = new Client('mongodb://root:example@mongodb:27017');*/
            self::$client = new Client(
                'mongodb+srv://victorjean2_db_user:mWZFCGbeCbaELxHQ@cluster0.gnbd7gh.mongodb.net/?appName=Cluster0',
                [
                    'retryWrites' => true,
                    'w' => 'majority',
                ],
                [
                    'typeMap' => [
                        'array' => 'array',
                        'document' => 'array',
                        'root' => 'array',
                    ]
                ]
            );
        }

        return self::$client;
    }

    public static function getDatabase()
    {
        return self::getClient()->selectDatabase('elegance_event');
    }
}
