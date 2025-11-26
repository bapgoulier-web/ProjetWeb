<?php
$this->layout('template', ['title' => 'Accueil Mihoyo']);
?>

<?php
// Affichage du message global
if (isset($message)) {
    if (is_object($message)) {
        echo $this->insert('message', [
                'message' => $message->getMessage(),
                'color'   => $message->getColor(),
                'title'   => $message->getTitle()
        ]);
    } else {
        echo "<div class='message-container message-info'>$message</div>";
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

                    <!-- IMAGE -->
                    <div class="card-img">
                        <img src="<?= $this->e($p->getUrlImg()) ?>"
                             alt="<?= $this->e($p->getName()) ?>">
                    </div>

                    <!-- INFOS DU PERSONNAGE -->
                    <h3><?= $this->e($p->getName()) ?></h3>

                    <div class="badges">
                        <div class="badge"><i>🔥</i> Élément : <?= $this->e($p->getElement()?->getName() ?? 'Inconnu') ?></div>
                        <div class="badge"><i>⚔️</i> Classe : <?= $this->e($p->getUnitclass()?->getName() ?? 'Inconnue') ?></div>
                        <div class="badge"><i>🌍</i> Origine : <?= $this->e($p->getOrigin()?->getName() ?? 'Inconnue') ?></div>
                        <div class="badge"><i>⭐</i> Rareté : <?= $this->e($p->getRarity()) ?></div>
                    </div>

                    <!-- BOUTONS EDIT / DELETE -->
                    <div class="btn-group">
                        <a href="index.php?action=update-perso&idPerso=<?= $this->e($p->getId()) ?>"
                           class="btn btn-edit">
                            ✏️ Modifier
                        </a>

                        <a href="index.php?action=del-perso&idPerso=<?= $this->e($p->getId()) ?>"
                           class="btn btn-delete">
                            🗑️ Supprimer
                        </a>
                    </div>

                    <!-- BOUTON COLLECTION (+ / -) -->
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
        <p style="text-align:center; color:#cccdf5; margin-top:20px;">
            Aucun personnage disponible.
        </p>
    <?php endif; ?>

</div>
