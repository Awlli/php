<?php

const UNIVERSITY = "Алматинский технологический университет";
const DISCIPLINE = "Программирование на PHP";

$studentName = "Алия Конысбай";
$group = "ИС24-22";
$course = 3;

$deposit = 5000000;
$interestRate = 12;
$years = 2;

$income = $deposit * $interestRate / 100 * $years;

$result = $deposit + $income;

if ($result > $deposit) {
    $status = "Депозит приносит доход";
} else {
    $status = "Доход отсутствует";
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="UTF-8">

    <title>Лабораторная №1</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #f4f6f8;
        }

        .card {
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .success {
            color: green;
        }

        .warning {
            color: red;
        }

    </style>

</head>

<body>

<div class="card">

    <h1><?= UNIVERSITY ?></h1>

    <h2><?= DISCIPLINE ?></h2>

    <h3>Карточка студента</h3>

    <p>
        <b>Студент:</b> <?= $studentName ?>
    </p>

    <p>
        <b>Группа:</b> <?= $group ?>
    </p>

    <p>
        <b>Курс:</b> <?= $course ?>
    </p>

    <hr>

    <h3>Вариант 9 — Расчёт депозита</h3>

    <h4>Исходные данные:</h4>

    <p>
        Сумма депозита:
        <b><?= $deposit ?> ₸</b>
    </p>

    <p>
        Процентная ставка:
        <b><?= $interestRate ?>%</b>
    </p>

    <p>
        Срок:
        <b><?= $years ?> года</b>
    </p>

    <hr>

    <h4>Результат:</h4>

    <p>
        Доход:
        <b><?= $income ?> ₸</b>
    </p>

    <p>
        Итоговая сумма:
        <b><?= $result ?> ₸</b>
    </p>

    <p class="success">
        <b>Статус:</b> <?= $status ?>
    </p>

    <p>
        <b>Дата формирования:</b>
        <?= date("d.m.Y") ?>
    </p>

</div>

</body>

</html>