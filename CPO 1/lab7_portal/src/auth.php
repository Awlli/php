<?php
declare(strict_types=1);

function initUserSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['user_id'])) {
        $_SESSION['user_id'] = 'student_desktop_7'; 
    }
}

function getCurrentUserId(): string {
    initUserSession();
    return $_SESSION['user_id'];
}