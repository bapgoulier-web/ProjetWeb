<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route\ProtectedRoute;
use Helpers\Logger;
use Controllers\MainController;

class RouteLogs extends ProtectedRoute
{
    public function __construct(string $action, MainController $controller)
    {
        // ✅ Appel du constructeur parent avec les deux paramètres
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        $logger = new Logger();
        $files = $logger->listLogs();

        $content = null;
        if (isset($params['file'])) {
            $content = $logger->readLog($params['file']);
        }

        echo (new \League\Plates\Engine('Views'))->render('logs', [
            'files' => $files,
            'content' => $content
        ]);
    }

    public function post(array $params = []): void
    {
        // Aucun traitement POST ici
    }
}
