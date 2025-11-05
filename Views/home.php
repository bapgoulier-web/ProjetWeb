<?php
$this->layout('template', ['title' => 'Collection Mihoyo']);
?>

<h1>Collection <?= $this->e($gameName) ?></h1>

<section class="personnage-list">

    <?php if (!empty($listPersonnage)): ?>
        <?php foreach ($listPersonnage as $p): ?>
            <div class="card">
                <div class="card-img">
                    <img src="<?= $this->e($p->getUrlImg()) ?>" alt="<?= $this->e($p->getName()) ?>">
                </div>
                <div class="card-content">
                    <h2><?= $this->e($p->getName()) ?></h2>
                    <p><strong>Élément :</strong> <?= $this->e($p->getElement()) ?></p>
                    <p><strong>Classe :</strong> <?= $this->e($p->getUnitclass()) ?></p>
                    <p><strong>Origine :</strong> <?= $this->e($p->getOrigin() ?? 'Inconnue') ?></p>
                    <p><strong>Rareté :</strong> ⭐ <?= $this->e($p->getRarity()) ?></p>
                </div>
                <div class="card-actions">
                    <a href="?page=edit&id=<?= $this->e($p->getId()) ?>" class="btn-edit">✏️ Modifier</a>
                    <a href="?page=delete&id=<?= $this->e($p->getId()) ?>" class="btn-delete">🗑 Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun personnage trouvé.</p>
    <?php endif; ?>

</section>
