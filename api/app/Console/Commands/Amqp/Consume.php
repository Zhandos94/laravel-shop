<?php

namespace App\Console\Commands\Amqp;

use Illuminate\Console\Command;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Consume extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consume';

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
        echo 'Start Consume' . PHP_EOL;

        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'rabbitmq', 'rabbitmq', '/');
        $channel = $connection->channel();

        $exchange = 'notification';
        $queue = 'message';

        $channel->queue_declare($queue, false, false, false, true);
        $channel->exchange_declare($exchange, 'fanout', false, false, true);
        $channel->queue_bind($queue, $exchange);


        $consumerTag = 'consumer_' . getmypid();

        $callback0 = function ($message) {
            print_r(json_decode($message->body));
            /** @var AMQPChannel $channel */
            $channel = $message->delivery_info['channel'];
            $channel->basic_ack($message->delivery_info['delivery_tag']);
        };

        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
            $body = json_decode($msg->body, true);

            if (isset($body['command'])) {
                $output = null;
                echo ' [x] Command ', $body['command'], "\n";
                exec($body['command'], $output);
            }
        };


        $channel->basic_consume($queue, $consumerTag, false, false, false, false, $callback);

        register_shutdown_function(function (AMQPChannel $channel, AMQPStreamConnection $connection) {
            $channel->close();
            $connection->close();
        }, $channel, $connection);

        while (\count($channel->callbacks)) {
            $channel->wait();
        }

        echo 'End Consume' . PHP_EOL;
    }
}
