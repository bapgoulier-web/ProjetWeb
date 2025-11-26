<?php
if (isset($message) && $message): ?>
    <div class="message-container <?= isset($color) ? $color : 'light-blue lighten-1' ?>">
        <h3><?= isset($title) ? $this->e($title) : 'Message' ?></h3>
        <p><?= $this->e($message) ?></p>
    </div>
<?php endif; ?>
