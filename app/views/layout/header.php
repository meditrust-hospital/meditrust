<?php
// Basic layout wrapper - you can customize this navbar later.
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo htmlspecialchars(APP_NAME); ?></title>
  <meta name="csrf-token" content="<?php echo htmlspecialchars(csrf_token()); ?>">
  <script>
    window.__CSRF_TOKEN__ = document.querySelector('meta[name=csrf-token]').content;
    window.__BASE_URL__ = <?php echo json_encode(BASE_URL); ?>;
  </script>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/main.css">
  <?php if (!empty($pageCss)): ?>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/<?php echo htmlspecialchars($pageCss); ?>">
  <?php endif; ?>
</head>
<body>
  <header class="topbar">
    <div class="container">
      <div class="brand"><?php echo htmlspecialchars(APP_NAME); ?></div>
      <nav class="nav">
        <?php if (empty($_SESSION["user_id"])): ?>
          <a href="<?php echo BASE_URL; ?>/login">Login</a>
        <?php else: ?>
        <a href="<?php echo BASE_URL; ?>/">Home</a>
        <a href="<?php echo BASE_URL; ?>/emr">EMR</a>
        <a href="<?php echo BASE_URL; ?>/notifications">Notifications</a>
        <a href="<?php echo BASE_URL; ?>/reports">Reports</a>
        <a href="<?php echo BASE_URL; ?>/telemedicine">Telemedicine</a>
        <a href="<?php echo BASE_URL; ?>/feedback">Feedback</a>
                <a href="<?php echo BASE_URL; ?>/logout">Logout</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
  <main class="container">
