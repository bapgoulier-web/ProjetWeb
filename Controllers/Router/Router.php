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
 * Classe Router : gère les routes et leur exécution
 */
class Router
{
    private array $routeList;
    private array $ctrlList;
    private string $actionKey;

    public function __construct(string $name_of_action_key = 'action')
    {
        $this->actionKey = $name_of_action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Liste des contrôleurs disponibles
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
     * Liste des routes disponibles
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
     * Fonction principale du routeur
     */
    public function routing(array $get, array $post): void
    {
        // 🧭 Récupération de l’action
        $action = $get[$this->actionKey] ?? "index";

        // 🔍 Récupération de la route correspondante
        $route = $this->routeList[$action] ?? $this->routeList["index"];

        // 🧠 Détermination du type de requête
        $method = $_SERVER['REQUEST_METHOD'];

        try {
            // 🛡️ Vérifie si la route est protégée
            if (method_exists($route, 'isRouteProtected') && $route->isRouteProtected()) {
                $route->protectRoute(); // appelle la méthode de sécurité
            }

            // 🏁 Appel de la bonne méthode (GET ou POST)
            if (!empty($post)) {
                $route->action($post, "POST");
            } else {
                $route->action($get, $method);
            }

        } catch (\Exception $e) {
            // 🚫 Gestion de l’accès interdit
            $message = urlencode("⚠️ Accès refusé : " . $e->getMessage());
            header("Location: index.php?action=login&message=$message");
            exit;
        }
    }


}
