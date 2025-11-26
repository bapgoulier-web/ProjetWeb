<?php
$this->layout('template', ['title' => 'Connexion']);
?>

<style>
    /* ===== PAGE CONNEXION – AURA GAMING ===== */
    .login-page {
        position: relative;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .login-page::before,
    .login-page::after {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(160,120,255,0.9), transparent 60%);
        opacity: 0.4;
        filter: blur(4px);
        animation: floatAura 14s infinite alternate ease-in-out;
        pointer-events: none;
    }

    .login-page::after {
        background: radial-gradient(circle at 70% 70%, rgba(80,200,255,0.8), transparent 60%);
        animation-delay: -6s;
    }

    @keyframes floatAura {
        from { transform: translate(-80px, -40px) scale(1); }
        to   { transform: translate(80px, 40px) scale(1.1); }
    }

    /* ===== CARD ===== */
    .login-card {
        position: relative;
        background: rgba(20, 20, 40, 0.92);
        padding: 34px 36px 30px;
        border-radius: 22px;
        max-width: 460px;
        width: 100%;
        box-shadow:
                0 0 35px rgba(120, 80, 255, 0.7),
                0 0 90px rgba(0, 0, 0, 0.9);
        border: 1px solid rgba(160,130,255,0.8);
        backdrop-filter: blur(12px);
        animation: cardFloat 0.8s ease-out;
        overflow: hidden;
        isolation: isolate;
    }

    .login-card::before {
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
        animation: rotateBorder 10s linear infinite;
    }

    .login-card::after {
        content: "";
        position: absolute;
        inset: 2px;
        border-radius: 20px;
        background: radial-gradient(circle at top, rgba(255,255,255,0.06), transparent 55%),
        radial-gradient(circle at bottom, rgba(140,100,255,0.18), transparent 60%),
        rgba(15, 15, 30, 0.98);
        z-index: -1;
    }

    @keyframes rotateBorder {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    @keyframes cardFloat {
        from { opacity: 0; transform: translateY(22px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ===== HEADER ===== */
    .login-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }

    .login-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        background: radial-gradient(circle at 30% 30%, #ffe9b8, #ff9f4a);
        box-shadow: 0 0 12px rgba(255,180,80,0.9);
    }

    .login-header-text h1 {
        margin: 0;
        color: #e6ddff;
        font-size: 1.9rem;
        text-shadow: 0 0 12px rgba(180,140,255,0.9);
    }

    .login-header-text p {
        margin: 2px 0 0;
        color: #b3a7ff;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .login-divider {
        height: 1px;
        margin: 14px 0 22px;
        background: linear-gradient(90deg,
        transparent,
        rgba(160,130,255,0.9),
        rgba(100,220,255,0.9),
        rgba(160,130,255,0.9),
        transparent
        );
        box-shadow: 0 0 10px rgba(140,110,255,0.7);
        opacity: 0.9;
    }

    /* ===== FORM ===== */
    .login-group { margin-bottom: 18px; }

    .login-label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 6px;
        font-weight: 600;
        color: #e7ddff;
        font-size: 0.95rem;
        text-shadow: 0 0 6px rgba(200,160,255,0.6);
    }

    .login-input-wrapper input {
        width: 100%;
        padding: 11px 12px;
        border-radius: 12px;
        border: none;
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        font-size: 0.98rem;
        outline: none;
        border: 1px solid rgba(150,120,255,0.5);
        box-shadow: 0 0 8px rgba(140,100,255,0.35) inset;
        transition: 0.22s;
        color-scheme: dark;
    }

    .login-input-wrapper input::placeholder {
        color: rgba(220, 210, 255, 0.4);
    }

    .login-input-wrapper input:focus {
        background: rgba(255,255,255,0.12);
        box-shadow: 0 0 14px rgba(150,120,255,0.85);
        border-color: rgba(190,160,255,0.95);
    }

    .login-options {
        margin-top: 4px;
        font-size: 0.82rem;
        color: #9b90ff;
        opacity: 0.9;
    }

    /* ===== BUTTON ===== */
    .login-submit { text-align: center; margin-top: 24px; }

    .login-submit button {
        padding: 11px 46px;
        border-radius: 999px;
        font-size: 1.05rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        background: linear-gradient(135deg, #6e44ff, #b368ff, #5ff3ff);
        color: white;
        box-shadow:
                0 0 18px rgba(180,140,255,0.9),
                0 0 35px rgba(120,200,255,0.8);
        transition: 0.2s ease-out;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .login-submit button:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow:
                0 0 24px rgba(200,160,255,1),
                0 0 50px rgba(120,220,255,0.95);
    }

    .login-error {
        margin-top: 18px;
        padding: 9px 11px;
        border-radius: 10px;
        background: rgba(255, 70, 70, 0.09);
        border: 1px solid rgba(255,100,120,0.7);
        color: #ff9c9c;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 0 10px rgba(255,90,90,0.5);
    }

    @media (max-width: 600px) {
        .login-card { padding: 26px 20px; margin: 40px 14px; }
        .login-header-text h1 { font-size: 1.6rem; }
    }
</style>

<div class="login-page">
    <div class="login-card">
        <div class="login-header">
            <div class="login-icon">🔒</div>
            <div class="login-header-text">
                <h1>Connexion</h1>
                <p>Accédez au panneau de contrôle du Projet Mihoyo</p>
            </div>
        </div>

        <div class="login-divider"></div>

        <form method="POST" action="index.php?action=login">

            <div class="login-group">
                <label class="login-label" for="username">👤 Nom d’utilisateur</label>
                <div class="login-input-wrapper">
                    <input type="text"
                           name="username"
                           id="username"
                           placeholder="Votre identifiant"
                           required>
                </div>
            </div>

            <div class="login-group">
                <label class="login-label" for="password">🔑 Mot de passe</label>
                <div class="login-input-wrapper">
                    <input type="password"
                           name="password"
                           id="password"
                           placeholder="Mot de passe secret"
                           required>
                </div>
            </div>

            <div class="login-submit">
                <button type="submit">Se connecter</button>
            </div>
        </form>

        <?php if (!empty($message)): ?>
            <div class="login-error">
                ⚠️ <?= $this->e($message) ?>
            </div>
        <?php endif; ?>
    </div>
</div>
