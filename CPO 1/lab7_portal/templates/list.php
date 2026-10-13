<div class="card">
    <h2>Ваша история отправленных работ</h2>
    <?php if (empty($submissions)): ?>
        <p>Список пуст.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Файл отчета</th>
                    <th>Размер</th>
                    <th>Дата отправки</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $sub): ?>
                    <?php if ($sub['ownerId'] === $_SESSION['user_id']): ?>
                        <tr>
                            <td><?= htmlspecialchars($sub['originalName']) ?></td>
                            <td><?= round($sub['size'] / 1024, 2) ?> KB</td>
                            <td><?= htmlspecialchars($sub['uploadedAt']) ?></td>
                            <td>
                                <a href="index.php?action=download&id=<?= urlencode($sub['id']) ?>" class="btn-download">Скачать файл</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>