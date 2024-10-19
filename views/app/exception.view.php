<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Error</title>
</head>
<style>
    body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<body>
<div class="container">
    <div class="alert alert-danger" role="alert">
        <?= $message ?>
    </div>
    <div class="alert alert-secondary" role="alert">
       <pre><?= $trace ?></pre>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>