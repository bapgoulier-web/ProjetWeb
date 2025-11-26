<?php


namespace Helpers;

class Logger
{
    private string $logDir;

    public function __construct(string $logDir = __DIR__ . '/../../logs/')
    {
        $this->logDir = $logDir;

        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0777, true);
        }
    }

    /**
     * Ajoute une ligne au log
     */
    public function log(string $action, string $message): void
    {
        // Nom du fichier : MIHOYO_MM_YYYY.log
        $fileName = 'MIHOYO_' . date('m_Y') . '.log';
        $filePath = $this->logDir . $fileName;

        // Format du log : [date] [action] message
        $entry = sprintf("[%s] [%s] %s\n", date('d/m/Y H:i:s'), strtoupper($action), $message);

        file_put_contents($filePath, $entry, FILE_APPEND);
    }

    /**
     * Liste les fichiers de log disponibles
     */
    public function listLogs(): array
    {
        return array_values(array_filter(scandir($this->logDir), function ($f) {
            return str_ends_with($f, '.log');
        }));
    }

    /**
     * Lit le contenu d’un fichier log
     */
    public function readLog(string $fileName): string
    {
        $filePath = $this->logDir . $fileName;
        return file_exists($filePath) ? file_get_contents($filePath) : "Fichier introuvable.";
    }
}