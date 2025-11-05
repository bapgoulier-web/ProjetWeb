<?php
namespace Controllers;

use League\Plates\Engine;

/**
 * Classe principale du contrôleur
 * Elle s'occupe de gérer les vues à afficher.
 */
class MainController
{
    private Engine $templates; // Variable qui contiendra le moteur Plates

    // 🔹 Constructeur : il initialise Plates
    public function __construct()
    {
        // On crée une instance du moteur Plates en lui indiquant le dossier des vues
        $this->templates = new Engine('Views');
    }

    // 🔹 Méthode principale : affichage de la page d'accueil
    public function index(): void {
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact'
        ]);
    }
}
