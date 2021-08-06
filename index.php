<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "components/head.php"; ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    include_once "components/navbar.php";
    include_once "components/sidebar.php";
    ?>
    <div class="content-wrapper">
      <?php include_once "routes/routes.php" ?>
    </div>
    <?php include_once "components/footer.php" ?>
  </div>
</body>

</html>