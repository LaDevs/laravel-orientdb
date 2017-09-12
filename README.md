# laravel-orientdb
An Eloquent model and Query builder with support for OrientDB, using the original Laravel API


## Configuration in config/database.php

    'orientdb' => [
        'driver'   => 'orientdb',
        'host'     => env('DB_HOST', 'localhost'),
        'port'     => env('DB_PORT', 2480),
        'database' => env('DB_DATABASE'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'serverUsername' => env('DB_SERVER_USERNAME'),
        'serverPassword' => env('DB_SERVER_PASSWORD')
    ], 

Remember that in OrientDB, unless you're using the root user, you'll need two sets
of credentials to access y dour database. One set of credentials for the 
server user: http://orientdb.com/docs/2.2.x/Server-Security.html. 
And one for the database user: 
http://orientdb.com/docs/2.2.x/Database-Security.html. If you've never
used OrientDB in production and need to read up on it's security, see 
http://orientdb.com/docs/2.2.x/Database-Security.html.