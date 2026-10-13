<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вариант 7 — Портал сдачи ЛР</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Портал сдачи лабораторных работ</h1>
        <p>Пользователь: <strong><?= htmlspecialchars($_SESSION['user_id'] ?? 'Вход не выполнен') ?></strong></p>
    </div>
</header>
<main class="container">