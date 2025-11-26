<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route\ProtectedRoute;
use Helpers\Logger;
use Controllers\MainController;

class RouteLogs extends ProtectedRoute
{
    /**
     * Constructeur de la route des logs.
     * Initialise la route protégée avec l'action et le contrôleur principal.
     *
     * @param string $action Nom de l'action.
     * @param MainController $controller Contrôleur responsable.
     */
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    /**
     * Gère la requête GET : affiche la liste des fichiers log
     * et le contenu d'un fichier si un paramètre 'file' est fourni.
     *
     * @param array $params Paramètres de la requête.
     */
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

    /**
     * Gère la requête POST.
     * Aucun traitement POST n'est effectué pour cette route.
     *
     * @param array $params Paramètres de la requête.
     */
    public function post(array $params = []): void
    {
        // Aucun traitement POST ici
    }
}
