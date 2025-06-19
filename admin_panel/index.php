<?php
  include 'config.php';
  include 'includes/db.php';
  include 'components/header.php';     // <head> with Bootstrap CSS
    include 'components/sidebar.php';
  include 'components/navbar.php';     // Top navbar
    // Side menu
?>

<div class="main-content p-4">
  <?php include 'pages/dashboard.php'; ?>
</div>

<?php include 'components/footer.php'; // JS, closing tags ?>
