<?php

namespace Ladevs\Orientdb\Queue;

use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Queue\Connectors\ConnectorInterface;
use Illuminate\Support\Arr;

class OrientConnector implements ConnectorInterface
{
    /**
     * Database connections.
     *
     * @var \Illuminate\Database\ConnectionResolverInterface
     */
    protected $connections;

    /**
     * Create a new connector instance.
     *
     * @param  \Illuminate\Database\ConnectionResolverInterface  $connections
     */
    public function __construct(ConnectionResolverInterface $connections)
    {
        $this->connections = $connections;
    }

    /**
     * Establish a queue connection.
     *
     * @param  array $config
     * @return OrientQueue|\Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new OrientQueue(
            $this->connections->connection(Arr::get($config, 'connection')),
            $config['table'],
            $config['queue'],
            Arr::get($config, 'expire', 60)
        );
    }
}