<?php
// 404.php by Eduardo Bussien
http_response_code(404);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="The page you sought has been lost to the ages - return to Olympus Archives." />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | Lost in the Ages</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <style>
      body.error-bg {
        background:
          linear-gradient(180deg,
            rgba(15, 12, 8, 0.35) 0%,
            rgba(15, 12, 8, 0.55) 100%),
          url('../img/back/404.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        min-height: 100vh;
        color: #f4f0e8;
      }

      .error-main {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8rem 1.5rem 4rem;
      }

      /* Centered glass-parchment overlay card */
      .error-card {
        max-width: 640px;
        width: 100%;
        text-align: center;
        padding: 3rem 2.6rem 3rem;
        background: rgba(15, 12, 8, 0.78);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(212, 175, 55, 0.55);
        box-shadow:
          0 30px 60px rgba(0, 0, 0, 0.6),
          0 0 0 1px rgba(255, 230, 150, 0.18) inset;
        position: relative;
        border-radius: 4px;
      }

      /* Inner gold border accent */
      .error-card::before {
        content: "";
        position: absolute;
        inset: 8px;
        border: 1px solid rgba(212, 175, 55, 0.35);
        pointer-events: none;
      }

      .error-eyebrow {
        font-family: 'Cinzel', serif;
        font-size: 0.8rem;
        letter-spacing: 0.5em;
        text-transform: uppercase;
        color: #EFBF04;
        display: inline-flex;
        align-items: center;
        gap: 0.9rem;
        margin-bottom: 1.4rem;
      }
      .error-eyebrow::before,
      .error-eyebrow::after {
        content: "";
        width: 38px;
        height: 1px;
        background: rgba(239, 191, 4, 0.85);
      }

      .error-code {
        font-family: 'Cinzel', serif;
        font-size: clamp(5rem, 12vw, 8rem);
        font-weight: 700;
        line-height: 1;
        margin: 0;
        color: #fffaf0;
        letter-spacing: 0.04em;
        text-shadow: 0 8px 36px rgba(0, 0, 0, 0.85);
      }

      .error-code::after {
        content: "";
        display: block;
        width: 110px;
        height: 2px;
        margin: 1.4rem auto 1.6rem;
        background: linear-gradient(to right,
          transparent, #EFBF04, transparent);
      }

      .error-title {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.3rem, 2.4vw, 1.7rem);
        letter-spacing: 0.16em;
        text-transform: uppercase;
        margin: 0 0 1rem;
        color: #fffaf0;
      }

      .error-message {
        font-family: 'GFS Neohellenic', serif;
        font-size: 1.08rem;
        font-style: italic;
        color: #d8d0bf;
        line-height: 1.75;
        max-width: 460px;
        margin: 0 auto 2rem;
      }

      .error-actions {
        display: flex;
        gap: 0.9rem;
        flex-wrap: wrap;
        justify-content: center;
      }

      .error-actions .btn,
      .error-actions .btn-ghost {
        padding: 11px 24px;
        font-family: 'Cinzel', serif;
        font-weight: 700;
        font-size: 0.82rem;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.25s ease,
                    color 0.25s ease,
                    transform 0.25s ease,
                    border-color 0.25s ease;
        display: inline-block;
      }

      .error-actions .btn {
        background: #EFBF04;
        color: #1E1E1E;
        border: 1px solid #EFBF04;
      }
      .error-actions .btn:hover {
        background: #ffda3d;
        transform: translateY(-2px);
      }

      .error-actions .btn-ghost {
        background: transparent;
        color: #fffaf0;
        border: 1px solid rgba(255, 250, 240, 0.7);
      }
      .error-actions .btn-ghost:hover {
        background: rgba(255, 250, 240, 0.12);
        border-color: #EFBF04;
        color: #EFBF04;
      }

      @media (max-width: 600px) {
        .error-card { padding: 2rem 1.4rem; }
        .error-eyebrow { font-size: 0.7rem; letter-spacing: 0.36em; }
        .error-eyebrow::before,
        .error-eyebrow::after { width: 24px; }
      }
    </style>
  </head>

  <body class="error-bg">
    <?php include 'nav.php'; ?>

    <main class="error-main">
      <section class="error-card">
        <span class="error-eyebrow">Lost to the Ages</span>
        <h1 class="error-code">404</h1>
        <h2 class="error-title">The Path is Broken</h2>
        <p class="error-message">
          The scroll you sought has crumbled to dust, or perhaps the gods have hidden it away.
          Whatever the cause - this page does not exist within the archives.
        </p>
        <div class="error-actions">
          <a href="../index.php" class="btn">Return to Olympus</a>
          <a href="characters.php" class="btn-ghost">Browse Characters</a>
        </div>
      </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>
