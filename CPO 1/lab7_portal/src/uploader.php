<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/database.php';

function handleFileUpload(array $fileInfo): ?string {
    if ($fileInfo['error'] !== UPLOAD_ERR_OK) {
        return 'Ошибка загрузки. Код: ' . $fileInfo['error'];
    }

    // 5 MiB лимит
    $maxSize = 5 * 1024 * 1024;
    if ($fileInfo['size'] > $maxSize) {
        return 'Размер файла превышает лимит в 5 MiB.';
    }

    // Проверка расширением Fileinfo (оно в XAMPP включено по умолчанию)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($fileInfo['tmp_name']);
    if ($mimeType !== 'application/pdf') {
        return 'Разрешены только документы формата PDF.';
    }

    $uploadDir = __DIR__ . '/../var/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $serverName = bin2hex(random_bytes(16)) . '.pdf';
    $destination = $uploadDir . $serverName;

    if (!move_uploaded_file($fileInfo['tmp_name'], $destination)) {
        return 'Не удалось переместить файл в хранилище.';
    }

    $metaData = [
        'id' => bin2hex(random_bytes(8)),
        'ownerId' => getCurrentUserId(),
        'originalName' => basename($fileInfo['name']),
        'serverName' => $serverName,
        'size' => $fileInfo['size'],
        'uploadedAt' => date('Y-m-d H:i:s')
    ];

    if (!saveSubmission($metaData)) {
        unlink($destination);
        return 'Ошибка записи метаданных.';
    }

    return null;
}