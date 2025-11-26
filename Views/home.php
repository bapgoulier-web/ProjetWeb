<?php
$this->layout('template', ['title' => 'Accueil Mihoyo']);
?>

<?php
/**
 * Affichage du message global (objet Message ou simple texte)
 */
if (isset($message)) {
    if (is_object($message)) {
        echo $this->insert('message', [
                'message' => $message->getMessage(),
                'color'   => $message->getColor(),
                'title'   => $message->getTitle()
        ]);
    } else {
        echo "<div class='message' style='color:green; font-weight:bold; margin:10px 0;'>$message</div>";
    }
}
?>

<div class="container-collection">
    <h1>Personnages Genshin Impact</h1>
    <div class="title-divider"></div>

    <?php if (!empty($listPersonnage)): ?>
        <div class="cards-grid">

            <?php foreach ($listPersonnage as $p): ?>
                <div class="card">

                    <!-- Image du personnage -->
                    <div class="card-img">
                        <img src="<?= $this->e($p->getUrlImg()) ?>" alt="<?= $this->e($p->getName()) ?>">
                    </div>

                    <!-- Informations du personnage -->
                    <div class="card-content">
                        <h3><?= $this->e($p->getName()) ?></h3>
                        <p>🔥 <strong>Élément :</strong> <?= $this->e($p->getElement()?->getName() ?? 'Inconnu') ?></p>
                        <p>⚔️ <strong>Classe :</strong> <?= $this->e($p->getUnitclass()?->getName() ?? 'Inconnue') ?></p>
                        <p>🌍 <strong>Origine :</strong> <?= $this->e($p->getOrigin()?->getName() ?? 'Inconnue') ?></p>
                        <p>⭐ <strong>Rareté :</strong> <?= $this->e($p->getRarity()) ?></p>
                    </div>

                    <!-- Boutons de modification -->
                    <div class="btn-group">
                        <a href="index.php?action=update-perso&idPerso=<?= $this->e($p->getId()) ?>" class="btn btn-edit">
                            Modifier
                        </a>
                        <a href="index.php?action=del-perso&idPerso=<?= $this->e($p->getId()) ?>" class="btn btn-delete">
                            Supprimer
                        </a>
                    </div>

                    <!-- Bouton pour ajouter ou retirer de la collection -->
                    <form method="POST"
                          action="index.php?action=<?= in_array($p->getId(), $ownedIds ?? []) ? 'remove-from-collection' : 'add-to-collection' ?>">

                        <input type="hidden" name="id_perso" value="<?= $this->e($p->getId()) ?>">

                        <button type="submit"
                                class="<?= in_array($p->getId(), $ownedIds ?? []) ? 'btn-minus' : 'btn-plus' ?>">
                            <?= in_array($p->getId(), $ownedIds ?? []) ? '– Retirer de la collection' : '+ Ajouter à la collection' ?>
                        </button>
                    </form>

                </div>
            <?php endforeach; ?>

        </div>

    <?php else: ?>
        <p>Aucun personnage disponible.</p>
    <?php endif; ?>
</div>
