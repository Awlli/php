<?php
declare(strict_types=1);

define('DATA_FILE', __DIR__ . '/../var/data/submissions.json');

function getAllSubmissions(): array {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $content = file_get_contents(DATA_FILE);
    if (!$content) {
        return [];
    }
    return json_decode($content, true) ?? [];
}

function saveSubmission(array $newRecord): bool {
    $dir = dirname(DATA_FILE);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $fp = fopen(DATA_FILE, 'c+');
    if (!$fp) {
        return false;
    }

    if (flock($fp, LOCK_EX)) {
        $size = filesize(DATA_FILE);
        $data = [];
        if ($size > 0) {
            rewind($fp);
            $content = fread($fp, $size);
            $data = json_decode($content, true) ?? [];
        }

        $data[] = $newRecord;

        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
        return true;
    }

    fclose($fp);
    return false;
}