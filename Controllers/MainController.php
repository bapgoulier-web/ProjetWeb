<?php
namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;

class MainController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine('Views');
    }

    public function index(): void
    {
        $dao = new PersonnageDAO();
        $listPersonnage = $dao->getAll();

        // envoie 3 variables à la vue home
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
        ]);
    }
}
