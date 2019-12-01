<?php

namespace common\modules\chat\controllers;

use common\modules\chat\components\Chat;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;

/**
 * Default controller for the `Chat` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8080
        );
        
        $server->loop->addPeriodicTimer(5, function() {
            echo date('H:i:s').PHP_EOL;
        });
            
        echo 'server starting'.PHP_EOL;

        $server->run();
    }
}
