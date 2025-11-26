<?php
/* Chargement du template principal + définition du titre de la page */
$this->layout('template', ['title' => 'Ajouter un élément']);
?>

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

    /* Animation d’apparition */
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

    /* Bloc d’un champ du formulaire */
    .form-group {
        margin-bottom: 18px;
    }

    /* Label des champs */
    .form-group label {
        color: #e2d9ff;
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
    }

    /* Champs texte et sélecteurs */
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
    }

    /* Options de la liste déroulante */
    .form-group select option {
        background-color: rgba(40, 40, 60, 0.95);
        color: #fff;
    }

    /* Effet focus */
    .form-group input:focus,
    .form-group select:focus {
        box-shadow: 0 0 12px rgba(150,120,255,0.8);
        border-color: rgba(180,150,255,0.9);
        background: rgba(255, 255, 255, 0.12);
    }

    /* Zone contenant les boutons */
    .form-actions {
        text-align: center;
        margin-top: 25px;
    }

    /* Style des boutons */
    .form-actions .btn-submit,
    .form-actions .btn-cancel {
        display: inline-block;
        padding: 12px 30px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: 0.25s;
        text-decoration: none;
    }

    /* Bouton de validation */
    .form-actions .btn-submit {
        background: linear-gradient(135deg, #6e44ff, #b368ff);
        color: white;
        box-shadow: 0 0 15px rgba(170,120,255,0.7);
        margin-right: 10px;
    }

    /* Effet hover */
    .form-actions .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 0 25px rgba(200,150,255,0.9);
    }

    /* Bouton de retour */
    .form-actions .btn-cancel {
        background: rgba(255,255,255,0.1);
        color: #d4c8ff;
        border: 1px solid rgba(200,150,255,0.4);
    }

    /* Hover bouton retour */
    .form-actions .btn-cancel:hover {
        background: rgba(200,150,255,0.2);
        box-shadow: 0 0 15px rgba(200,150,255,0.4);
    }
</style>

<div class="form-container">
    <!-- Titre principal -->
    <h1>⚡ Ajouter un élément</h1>

    <!-- Formulaire d'ajout d'un élément -->
    <form action="index.php?action=add-perso-element" method="POST">

        <!-- Champ : nom -->
        <div class="form-group">
            <label for="name">Nom de l’élément</label>
            <input type="text" id="name" name="name" placeholder="ex : Pyro" required>
        </div>

        <!-- Champ : type d’élément -->
        <div class="form-group">
            <label for="type">Type d’élément</label>
            <select id="type" name="type" required>
                <option value="">-- Choisir un type --</option>
                <option value="Feu">🔥 Feu</option>
                <option value="Eau">💧 Eau</option>
                <option value="Électricité">⚡ Électricité</option>
                <option value="Glace">❄️ Glace</option>
                <option value="Vent">🌪️ Vent</option>
                <option value="Terre">🪨 Terre</option>
                <option value="Nature">🌿 Nature</option>
            </select>
        </div>

        <!-- Champ : image -->
        <div class="form-group">
            <label for="urlImg">Image (URL)</label>
            <input type="url" id="urlImg" name="urlImg" placeholder="https://exemple.com/image.png">
        </div>

        <!-- Boutons valider / annuler -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">✅ Créer l’élément</button>
            <a href="index.php?action=index" class="btn-cancel">↩️ Retour à l’accueil</a>
        </div>
    </form>
</div>
