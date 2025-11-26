<?php $this->layout('template', ['title' => 'Journal des actions']) ?>

<style>
    /* Page principale */
    .logs-page {
        position: relative;
        min-height: 85vh;
        padding-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: hidden;
    }

    .logs-page::before,
    .logs-page::after {
        content: "";
        position: absolute;
        width: 450px;
        height: 450px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(150,120,255,0.85), transparent 60%);
        opacity: 0.35;
        filter: blur(6px);
        animation: logsAura 14s infinite alternate ease-in-out;
        pointer-events: none;
    }
    .logs-page::after {
        background: radial-gradient(circle at 70% 70%, rgba(120,220,255,0.85), transparent 60%);
        animation-delay: -7s;
    }

    @keyframes logsAura {
        from { transform: translate(-80px, -40px) scale(1); }
        to   { transform: translate(80px, 40px) scale(1.1); }
    }

    /* Carte contenant les logs */
    .logs-card {
        width: 95%;
        max-width: 1300px;
        background: rgba(20, 20, 40, 0.92);
        backdrop-filter: blur(10px);
        padding: 30px 35px;
        margin-top: 10px;
        border-radius: 22px;
        border: 1px solid rgba(160,130,255,0.7);
        box-shadow:
                0 0 35px rgba(130, 80, 255, 0.55),
                0 0 90px rgba(0, 0, 0, 0.9);
        position: relative;
        overflow: hidden;
        animation: logsFadeIn 0.8s ease-out;
        isolation: isolate;
    }

    @keyframes logsFadeIn {
        from { opacity: 0; transform: translateY(15px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0)   scale(1); }
    }

    /* Bordure animée */
    .logs-card::before {
        content: "";
        position: absolute;
        inset: -2px;
        background: conic-gradient(
                from 180deg,
                rgba(120, 80, 255, 0.2),
                rgba(80, 220, 255, 0.9),
                rgba(250, 200, 255, 0.85),
                rgba(120, 80, 255, 0.2)
        );
        z-index: -1;
        opacity: 0.5;
        animation: rotateBorderLogs 12s linear infinite;
    }

    @keyframes rotateBorderLogs {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    /* En-tête du bloc */
    .logs-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .logs-icon {
        font-size: 2rem;
        background: radial-gradient(circle at 30% 30%, #ffe9b8, #ff9f4a);
        padding: 10px;
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(255,180,80,0.8);
    }

    .logs-header h1 {
        margin: 0;
        color: #e7ddff;
        text-shadow: 0 0 12px rgba(180,140,255,1);
        font-size: 2rem;
    }

    /* Ligne de séparation */
    .logs-divider {
        height: 2px;
        background: linear-gradient(90deg,
        transparent,
        rgba(140,120,255,1),
        rgba(100,220,255,0.9),
        rgba(140,120,255,1),
        transparent
        );
        margin-bottom: 25px;
        border-radius: 999px;
        box-shadow: 0 0 12px rgba(140,110,255,0.7);
    }

    /* Sélecteur de fichiers */
    .logs-select form {
        margin-bottom: 22px;
    }

    .logs-select label {
        color: #dcd4ff;
        font-weight: 600;
        margin-right: 10px;
        text-shadow: 0 0 6px rgba(200,160,255,0.6);
    }

    .logs-select select {
        padding: 10px 14px;
        border-radius: 12px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(160,130,255,0.4);
        color: #fff;
        font-size: 1rem;
        outline: none;
        box-shadow: 0 0 8px rgba(140,100,255,0.3) inset;
        cursor: pointer;
        transition: 0.3s ease;
        color-scheme: dark;
    }

    .logs-select select option {
        background: rgba(40,40,60,0.95);
        color: #fff;
    }

    .logs-select select:hover {
        background: rgba(255,255,255,0.15);
        box-shadow: 0 0 12px rgba(160,130,255,0.8);
    }

    /* Zone d’affichage des logs */
    .logs-output {
        margin-top: 10px;
    }

    .logs-output pre {
        background: rgba(10, 10, 20, 0.9);
        color: #32ff6a;
        padding: 18px;
        border-radius: 16px;
        border: 1px solid rgba(0,255,120,0.4);
        box-shadow:
                0 0 18px rgba(0,255,150,0.35),
                0 0 35px rgba(0,255,120,0.2) inset;
        font-family: "Consolas", "Fira Code", monospace;
        font-size: 0.95rem;
        overflow-x: auto;
        white-space: pre-wrap;
        line-height: 1.45em;
    }

    /* Pied de page */
    .logs-footer {
        margin-top: 22px;
        text-align: center;
        color: #b4aaff;
        font-size: 0.85rem;
        opacity: 0.8;
    }

</style>

<div class="logs-page">

    <div class="logs-card">

        <!-- En-tête du journal -->
        <div class="logs-header">
            <div class="logs-icon">📰</div>
            <h1>Journal des actions</h1>
        </div>

        <div class="logs-divider"></div>

        <!-- Sélecteur -->
        <div class="logs-select">
            <form method="get" action="index.php">
                <input type="hidden" name="action" value="logs">
                <label for="file">Sélectionnez un fichier :</label>
                <select name="file" id="file" onchange="this.form.submit()">
                    <option value="">-- Choisir un fichier --</option>
                    <?php foreach ($files as $file): ?>
                        <option value="<?= $this->e($file) ?>"
                                <?= isset($_GET['file']) && $_GET['file'] === $file ? 'selected' : '' ?>>
                            <?= $this->e($file) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <!-- Affichage du contenu -->
        <div class="logs-output">
            <?php if ($content): ?>
                <pre><?= $this->e($content) ?></pre>
            <?php endif; ?>
        </div>

    </div>

    <div class="logs-footer">
        © 2025 - Projet Mihoyo
    </div>

</div>
