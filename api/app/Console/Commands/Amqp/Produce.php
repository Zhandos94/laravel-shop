<?php

namespace App\Console\Commands\Amqp;

use Illuminate\Console\Command;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Produce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'produce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'Start Produce'. PHP_EOL;

        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'rabbitmq', 'rabbitmq', '/');
        $channel = $connection->channel();

        $exchange = 'notification';
        $queue = 'message';

        $channel->queue_declare($queue, false, false, false, true);
        $channel->exchange_declare($exchange, 'fanout', false, false, true);
        $channel->queue_bind($queue, $exchange);

        $data = [
            'type' => 'notification',
            'message' => 'Date time ' . date('Y-m-d H:i:s'),
            'command' => 'php artisan produce;',
        ];

        $message = new AMQPMessage(
            json_encode($data),
            ['content_type' => 'text/plain']
        );

        $channel->basic_publish($message, $exchange);

        register_shutdown_function(function (AMQPChannel $channel, AMQPStreamConnection $connection) {
            $channel->close();
            $connection->close();
        }, $channel, $connection);

        echo 'End Produce'. PHP_EOL;
    }
}
