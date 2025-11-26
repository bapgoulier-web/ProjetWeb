<?php
namespace Controllers\Router;

use Controllers\CollectionController;
use Controllers\MainController;
use Controllers\PersoController;
use Controllers\AuthController;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteAddElement;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteLogout;
use Controllers\Router\Route\RouteDeletePerso;
use Controllers\Router\Route\RouteUpdatePerso;
use Controllers\Router\Route\RouteCollection;
use Controllers\Router\Route\RouteAddToCollection;
use Controllers\Router\Route\RouteRemoveFromCollection;

/**
 * Gère l’enregistrement des routes et leur exécution.
 * Analyse l'action demandée et redirige vers la route correspondante.
 */
class Router
{
    /** @var array Liste des routes disponibles */
    private array $routeList;

    /** @var array Liste des contrôleurs instanciés */
    private array $ctrlList;

    /** @var string Nom du paramètre GET contenant l'action */
    private string $actionKey;

    /**
     * Initialise le routeur et prépare les listes de contrôleurs/routes.
     */
    public function __construct(string $name_of_action_key = 'action')
    {
        $this->actionKey = $name_of_action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Crée la liste des contrôleurs utilisés dans l'application.
     */
    private function createControllerList(): void
    {
        $this->ctrlList = [
            "main"   => new MainController(),
            "perso"  => new PersoController(),
            "auth"   => new AuthController(),
            "collec" => new CollectionController()
        ];
    }

    /**
     * Associe chaque action à la route correspondante.
     */
    private function createRouteList(): void
    {
        $this->routeList = [
            "index"             => new RouteIndex("index", $this->ctrlList["main"]),
            "add-perso"         => new RouteAddPerso("add-perso", $this->ctrlList["perso"]),
            "add-perso-element" => new RouteAddElement("add-perso-element", $this->ctrlList["perso"]),
            "logs"              => new RouteLogs("logs", $this->ctrlList["main"]),
            "login"             => new RouteLogin("login", $this->ctrlList["auth"]),
            "logout"            => new RouteLogout("logout", $this->ctrlList["auth"]),
            "del-perso"         => new RouteDeletePerso("delete", $this->ctrlList["perso"]),
            "update-perso"      => new RouteUpdatePerso("update", $this->ctrlList["perso"]),
            "add-to-collection" => new RouteAddToCollection("add-to-collection", $this->ctrlList["collec"]),
            "remove-from-collection" => new RouteRemoveFromCollection("remove-from-collection", $this->ctrlList["collec"]),
            "collection"        => new RouteCollection("collection", $this->ctrlList["collec"]),
        ];
    }

    /**
     * Sélectionne et exécute la route correspondant à l'action demandée.
     *
     * @param array $get  Paramètres GET
     * @param array $post Paramètres POST
     */
    public function routing(array $get, array $post): void
    {
        $action = $get[$this->actionKey] ?? "index";
        $route = $this->routeList[$action] ?? $this->routeList["index"];
        $method = $_SERVER['REQUEST_METHOD'];

        try {
            // Vérification d'accès pour les routes protégées
            if (method_exists($route, 'isRouteProtected') && $route->isRouteProtected()) {
                $route->protectRoute();
            }

            // Exécution de la méthode GET ou POST
            if (!empty($post)) {
                $route->action($post, "POST");
            } else {
                $route->action($get, $method);
            }

        } catch (\Exception $e) {
            // Redirection en cas d'accès refusé
            $message = urlencode("⚠️ Accès refusé : " . $e->getMessage());
            header("Location: index.php?action=login&message=$message");
            exit;
        }
    }
}
