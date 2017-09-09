<?php

namespace Ladevs\Orientdb\Queue;

use Carbon\Carbon;
use Illuminate\Queue\DatabaseQueue;
use Ladevs\Orientdb\Connection;


class OrientQueue extends DatabaseQueue
{
    /**
     * The expiration time of a job.
     *
     * @var int|null
     */
    protected $retryAfter = 60;

    /**
     * The connection name for the queue.
     *
     * @var string
     */
    protected $connectionName;

    /**
     * @inheritdoc
     */
    public function __construct(Connection $database, $table, $default = 'default', $retryAfter = 60)
    {
        parent::__construct($database, $table, $default, $retryAfter);
        $this->retryAfter = $retryAfter;
    }

    // TODO - build out queue functionality
}