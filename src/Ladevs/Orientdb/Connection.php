<?php

namespace Ladevs\Orientdb;

use Illuminate\Database\Connection as BaseConnection;
use Illuminate\Database\ConnectionInterface;
use PhpOrient\PhpOrient;

class Connection extends BaseConnection implements ConnectionInterface
{
    /**
     * The OrientDB database handler.
     *
     * @var
     */
    protected $db;

    /**
     * The active OrientDB connection.
     *
     * @var PhpOrient|\Closure
     */
    protected $connection;

    /**
     * The active OrientDB connection used for reads.
     *
     * @var PhpOrient|\Closure
     */
    protected $readConnection;


    /**
     * Create a new database connection instance.
     *
     * @param  array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;

        // You can pass options directly to the MongoDB constructor
        $options = array_get($config, 'options', []);

        // Create the connection
        $this->createConnection($config);

        // Select database
        $this->db = $this->getConnection()->dbOpen($config['database']);

//        $this->useDefaultPostProcessor();
//        $this->useDefaultSchemaGrammar();
    }

    protected function createConnection($config)
    {
        $this->setConnection(new PhpOrient());
        $this->getConnection()
            ->configure([
                'username' => $config['username'],
                'password' => $config['password'],
                'hostname' => $config['host'],
                'port'     => $config['port'],
            ])
        ;
    }

    /**
     * @return \Closure|PhpOrient
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param \Closure|PhpOrient $connection
     */
    protected function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    protected function setDb($db)
    {
        $this->db = $db;
    }
}