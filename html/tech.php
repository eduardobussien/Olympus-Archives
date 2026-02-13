<!-- tech.php by Eduardo Bussien-->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico" />
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="../img/favicon/site.webmanifest" />

    <title>Olympus Archives | Technology Used</title>
    <link rel="stylesheet" href="../css/styles.css" />
  </head>

  <body class="tech-bg">
    <?php include 'nav.php'; ?>

    <main>
      <section class="tech-page">
        <h1 class="fade-up">Technologies Used</h1>

        <div class="tech-section">
          <h2>XHTML</h2>
          <p>
            Pages were written with XHTML-style discipline: lowercase tags, proper nesting, and
            explicit closing tags. The structure is designed so that the markup can pass the
            W3C XHTML validator.
          </p>
        </div>

        <div class="tech-section">
          <h2>HTML5</h2>
          <p>
            The site uses the HTML5 doctype and semantic elements such as
            <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, <code>&lt;main&gt;</code>,
            and <code>&lt;section&gt;</code> to organize content across Olympus Archives.
          </p>
        </div>

        <div class="tech-section">
          <h2>HTML5 Canvas Element</h2>
          <p>
            A dedicated page uses the HTML5 <code>&lt;canvas&gt;</code> element together with
            JavaScript drawing commands to render interactive myth-inspired visuals,
            such as an Olympian family tree diagram.
          </p>
        </div>

        <div class="tech-section">
          <h2>HTML5 Video Element</h2>
          <p>
            The project is set up to embed mythology-related clips with the HTML5
            <code>&lt;video&gt;</code> tag so videos can play directly in the browser
            with native controls on the About page.
          </p>
        </div>

        <div class="tech-section">
          <h2>CSS</h2>
          <p>
            Custom stylesheets define the Olympus color palette, typography, grid layouts,
            navigation bars, character cards, hover states, and responsive behavior for
            different screen sizes.
          </p>
        </div>

        <div class="tech-section">
          <h2>JavaScript</h2>
          <p>
            Client-side JavaScript powers features such as the homepage animations,
            simple form checks, and other interactive UI behavior shared across pages.
          </p>
        </div>

        <div class="tech-section">
          <h2>Dynamic JavaScript</h2>
          <p>
            More dynamic scripts are used for game logic, including the trivia challenge
            and “Which God Are You?” quiz. These scripts update scores, check answers,
            and show feedback without reloading the page.
          </p>
        </div>

        <div class="tech-section">
          <h2>PHP</h2>
          <p>
            PHP is used for server-side logic throughout the site. It handles sessions
            for login and profile pages, includes shared components such as
            <code>nav.php</code> and <code>footer.php</code>, and renders character
            profiles based on database data.
          </p>
        </div>

        <div class="tech-section">
          <h2>Database</h2>
          <p>
            A MySQL database stores structured information about gods, heroes, and
            monsters. Scripts such as <code>seed_characters.php</code> populate the
            <code>characters</code> table, and pages like <code>characters.php</code>
            and <code>character.php</code> read from it.
          </p>
        </div>

        <div class="tech-section">
          <h2>SVG Logo</h2>
          <p>
            Olympus Archives uses a custom SVG logo inspired by Greek coins, laurel
            wreaths, and the omega symbol. Being vector-based, the SVG scales cleanly
            from a small favicon to a large page header without losing quality.
          </p>
        </div>

        <section class="svg-logo-section">
          <div class="svg-logo-row">
            <div class="svg-logo-block">
              <h3>Large Logo</h3>
              <img
                src="../img/olympus-logo.svg"
                class="svg-logo-large"
                style="max-width:250px;"
                alt="Olympus Archives SVG logo large"
              />
            </div>

            <div class="svg-logo-block">
              <h3>Small Icon</h3>
              <img
                src="../img/olympus-logo.svg"
                class="svg-logo-small"
                style="max-width:80px;"
                alt="Olympus Archives SVG logo small"
              />
            </div>
          </div>
        </section>

        <div class="tech-section">
          <h2>Web Server</h2>
          <p>
            Development runs on the XAMPP stack, using Apache as the web server and MySQL
            as the database engine. This setup provides a full local environment for
            testing PHP pages and database queries.
          </p>
        </div>

        <div class="tech-section">
          <h2>XHTML Validation</h2>
          <p>
            Public-facing pages are checked with the W3C validation tools to reduce
            markup errors, improve accessibility, and ensure consistent behavior across
            modern browsers.
          </p>
        </div>
      </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>
