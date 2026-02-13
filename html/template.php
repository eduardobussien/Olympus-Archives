<!-- template.php by Eduardo Bussien-->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Page'; ?></title>

    <link rel="stylesheet" href="../css/styles.css" />
  </head>

  <body>
    <header>
        <?php include 'nav.php'; ?> 

    <main>
      <section class="page-title">
        <h2>
          <?php 
            if (isset($pageHeading)) {
              echo htmlspecialchars($pageHeading);
            } elseif (isset($pageTitle)) {
              echo htmlspecialchars($pageTitle);
            } else {
              echo 'Page Title';
            }
          ?>
        </h2>
      </section>

      <section class="content">
      </section>
    </main>

<?php include 'footer.php'; ?>
    
    <script src="../js/scripts.js"></script>
  </body>
</html>

