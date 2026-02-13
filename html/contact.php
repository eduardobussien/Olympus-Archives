<!-- template.php by Eduardo Bussien-->
 <?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | Contact </title>
    <link rel="stylesheet" href="../css/styles.css" />
  </head>

  <body class="search-bg">
      <?php include 'nav.php'; ?> 

    <main class="contactmain">
      <section class="contact ">
        <h2>Contact Olympus Archives</h2>
        <p>Have a question, suggestion, or divine revelation? Send your message below... <br>The gods are listening!</p>
  
        <form id="contactForm">
          <label for="name">Your Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your name...">
  
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" placeholder="example@domain.com">
  
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="6" placeholder="Type your message here..."></textarea>
  
          <button type="submit">Send Message</button>
        </form>
  
        <p id="formResponse" style="display: none; font-weight: bold;"></p>
      </section>

      <section class="follow-us">
        <h3>Follow Olympus Archives</h3>
        <p>Join our community of myth-lovers across the realms.</p>
        <div class="social-links">
          <a href="https://www.instagram.com/" target="_blank" aria-label="Instagram">
            <img src="../img/icons/instagram.png" alt="Instagram">
          </a>
          <a href="https://twitter.com/" target="_blank" aria-label="Twitter">
            <img src="../img/icons/twitter.png" alt="Twitter">
          </a>
          <a href="https://www.facebook.com/" target="_blank" aria-label="Facebook">
            <img src="../img/icons/facebook.png" alt="Facebook">
          </a>
          <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube">
            <img src="../img/icons/youtube.png" alt="YouTube">
          </a>
        </div>
      </section>      
    </main>

    <?php include 'footer.php'; ?>
    
    <script src="../js/scripts.js"></script>

  </body>
</html>