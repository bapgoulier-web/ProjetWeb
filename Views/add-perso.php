<?php
$this->layout('template', [
        'title' => isset($personnage) ? 'Modifier un personnage' : 'Ajouter un personnage'
]);
?>

<?= $this->insert('message', [
        'message' => isset($message) ? $message->getMessage() : null,
        'color'   => isset($message) ? $message->getColor() : null,
        'title'   => isset($message) ? $message->getTitle() : null
]) ?>


<style>
    /* Conteneur principal du formulaire */
    .form-container {
        background: rgba(30, 30, 50, 0.8);
        padding: 30px;
        border-radius: 20px;
        max-width: 500px;
        margin: 40px auto;
        box-shadow: 0 0 25px rgba(120, 80, 255, 0.5);
        border: 2px solid rgba(140, 100, 255, 0.4);
        backdrop-filter: blur(6px);
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Titre du formulaire */
    .form-container h1 {
        text-align: center;
        color: #c9baff;
        text-shadow: 0 0 8px rgba(160,120,255,0.8);
        margin-bottom: 25px;
        font-size: 2rem;
        letter-spacing: 1px;
    }

    /* Groupes de champs */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        color: #e2d9ff;
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        text-shadow: 0 0 6px rgba(200,160,255,0.5);
    }

    /* Champs du formulaire */
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px;
        border-radius: 12px;
        border: none;
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        font-size: 1rem;
        outline: none;
        box-shadow: 0 0 8px rgba(140,100,255,0.3) inset;
        border: 1px solid rgba(150,120,255,0.4);
        transition: 0.25s;
        color-scheme: dark;
    }

    .form-group select option {
        background-color: rgba(40, 40, 60, 0.95);
        color: #fff;
    }

    .form-group select option:hover {
        background-color: rgba(120, 90, 255, 0.6);
        color: #fff;
    }

    .form-group input:focus,
    .form-group select:focus {
        box-shadow: 0 0 12px rgba(150,120,255,0.8);
        border-color: rgba(180,150,255,0.9);
        background: rgba(255, 255, 255, 0.12);
    }

    /* Aperçu de l'image */
    .preview-image {
        text-align: center;
        margin-top: 15px;
    }

    .preview-image img {
        max-height: 130px;
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(150,120,255,0.6);
    }

    /* Zone du bouton */
    .form-submit {
        text-align: center;
        margin-top: 25px;
    }

    .form-submit button {
        padding: 12px 35px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        background: linear-gradient(135deg, #6e44ff, #b368ff);
        color: white;
        box-shadow: 0 0 15px rgba(170,120,255,0.7);
        transition: 0.25s;
        letter-spacing: 0.5px;
    }

    .form-submit button:hover {
        transform: translateY(-3px);
        box-shadow: 0 0 25px rgba(200,150,255,0.9);
    }
</style>


<div class="form-container">
    <h1><?= isset($personnage) ? 'Modifier un personnage' : 'Ajouter un personnage' ?></h1>

    <form method="POST" action="index.php?action=<?= isset($personnage) ? 'update-perso' : 'add-perso' ?>">

        <?php if (isset($personnage)): ?>
            <input type="hidden" name="id" value="<?= $this->e($personnage->getId()) ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="name">Nom du personnage</label>
            <input type="text" id="name" name="name"
                   value="<?= isset($personnage) ? $this->e($personnage->getName()) : '' ?>"
                   placeholder="Diluc, Hu Tao, Keqing..." required>
        </div>

        <div class="form-group">
            <label for="element">Élément</label>
            <select name="element" id="element" required>
                <?php foreach ($elements as $el): ?>
                    <option value="<?= $el->getId() ?>"
                            <?= isset($personnage) && $personnage->getElement()?->getId() === $el->getId() ? 'selected' : '' ?>>
                        <?= $this->e($el->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="unitclass">Classe</label>
            <select name="unitclass" id="unitclass" required>
                <?php foreach ($unitclasses as $uc): ?>
                    <option value="<?= $uc->getId() ?>"
                            <?= isset($personnage) && $personnage->getUnitclass()?->getId() === $uc->getId() ? 'selected' : '' ?>>
                        <?= $this->e($uc->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="origin">Origine</label>
            <select name="origin" id="origin">
                <option value="">Aucune</option>
                <?php foreach ($origins as $og): ?>
                    <option value="<?= $og->getId() ?>"
                            <?= isset($personnage) && $personnage->getOrigin()?->getId() === $og->getId() ? 'selected' : '' ?>>
                        <?= $this->e($og->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="rarity">Rareté</label>
            <input type="number" id="rarity" name="rarity" min="1" max="5"
                   value="<?= isset($personnage) ? $this->e($personnage->getRarity()) : 1 ?>" required>
        </div>

        <div class="form-group">
            <label for="urlImg">Image (URL)</label>
            <input type="text" id="urlImg" name="urlImg"
                   value="<?= isset($personnage) ? $this->e($personnage->getUrlImg()) : '' ?>"
                   placeholder="https://exemple.com/img.png" required>
        </div>

        <?php if (isset($personnage) && $personnage->getUrlImg()): ?>
            <div class="preview-image">
                <p style="color:#d6c7ff;">Aperçu actuel :</p>
                <img src="<?= $this->e($personnage->getUrlImg()) ?>" alt="Aperçu">
            </div>
        <?php endif; ?>

        <div class="form-submit">
            <button type="submit">
                <?= isset($personnage) ? '💾 Mettre à jour' : '➕ Ajouter' ?>
            </button>
        </div>
    </form>
</div>
