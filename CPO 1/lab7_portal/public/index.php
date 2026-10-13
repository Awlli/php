<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/csrf.php';
require_once __DIR__ . '/../src/database.php';
require_once __DIR__ . '/../src/uploader.php';

initUserSession();

$action = $_GET['action'] ?? 'index';

if ($action === 'upload' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'] ?? null)) {
        $_SESSION['flash_error'] = 'Ошибка безопасности: невалидный CSRF-токен.';
        header('Location: index.php');
        exit;
    }

    if (isset($_FILES['lab_file'])) {
        $err = handleFileUpload($_FILES['lab_file']);
        if ($err) {
            $_SESSION['flash_error'] = $err;
        } else {
            $_SESSION['flash_success'] = 'Файл успешно прошел валидацию и сохранен!';
        }
    }

    header('Location: index.php');
    exit;
}

if ($action === 'download') {
    $id = $_GET['id'] ?? '';
    foreach (getAllSubmissions() as $sub) {
        if ($sub['id'] === $id && $sub['ownerId'] === getCurrentUserId()) {
            $path = __DIR__ . '/../var/uploads/' . $sub['serverName'];
            if (file_exists($path)) {
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . addslashes($sub['originalName']) . '"');
                header('Content-Length: ' . filesize($path));
                readfile($path);
                exit;
            }
        }
    }
    http_response_code(404);
    echo "Доступ запрещен либо файл отсутствует.";
    exit;
}

$submissions = getAllSubmissions();

require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/upload_form.php';
require_once __DIR__ . '/../templates/list.php';
require_once __DIR__ . '/../templates/footer.php';