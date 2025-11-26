<?php
//Je n'utilise pas cette classe j'ai deja ELement et Personnage.

$this->layout('template', ['title' => 'Ajouter un attribut']); ?>

<section class="add-attribute-container">

    <h1>➕ Ajouter un attribut</h1>

    <!-- Formulaire d’ajout -->
    <form action="index.php?action=add-attribute" method="POST" class="attribute-form">

        <!-- Choix du type -->
        <div class="form-group">
            <label for="type">Type d’attribut</label>
            <select id="type" name="type" required>
                <option value="">-- Choisir le type --</option>
                <option value="origin">🌍 Origine</option>
                <option value="element">🔥 Élément</option>
                <option value="unitclass">⚔️ Classe</option>
            </select>
        </div>

        <!-- Nom -->
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="ex : Mondstadt" required>
        </div>

        <!-- Image -->
        <div class="form-group">
            <label for="urlImg">URL de l’image</label>
            <input type="url" id="urlImg" name="urlImg" placeholder="https://exemple.com/image.png">
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <button type="submit">✅ Ajouter</button>
            <a href="index.php?action=index">↩️ Retour</a>
        </div>

    </form>

</section>
