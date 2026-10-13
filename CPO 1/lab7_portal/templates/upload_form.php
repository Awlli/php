<div class="card">
    <h2>Загрузить новый отчет PDF</h2>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['flash_error']) ?></div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash_success']) ?></div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <form action="index.php?action=upload" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()) ?>">
        <div class="form-group">
            <label for="lab_file">Выберите файл (макс. 5 МБ):</label>
            <input type="file" name="lab_file" id="lab_file" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn">Загрузить работу</button>
    </form>
</div>