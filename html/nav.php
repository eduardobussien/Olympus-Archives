<?php
// nav.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
  <nav class="navbar">
    <div class="nav-left">
      <img src="../img/olympuslogo.png" alt="Olympus Archives Logo" class="logo" />
      <h1 class="site-title"><a href="../index.php">Olympus Archives</a></h1>
    </div>

    <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="primary-nav">
      <span class="nav-toggle-bar"></span>
      <span class="nav-toggle-bar"></span>
      <span class="nav-toggle-bar"></span>
    </button>

    <ul class="nav-links" id="primary-nav">
      <li><a href="../index.php">Home</a></li>

      <li class="dropdown">
        <a href="characters.php">Characters</a>
        <ul class="dropdown-content">
          <li><a href="gods.php">Gods</a></li>
          <li><a href="titans.php">Titans</a></li>
          <li><a href="heroes.php">Heroes</a></li>
          <li><a href="monsters.php">Monsters</a></li>
          <hr>
          <li><a href="characters.php"><strong>View All</strong></a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="myths.php">Myths</a>
        <ul class="dropdown-content">
          <li><a href="myths.php?category=Creation">Creation Stories</a></li>
          <li><a href="myths.php?category=Quest">Famous Quests</a></li>
          <li><a href="myths.php?category=Tragedy">Tragedies</a></li>
          <hr>
          <li><a href="myths.php"><strong>View All</strong></a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="games.php">Games</a>
        <ul class="dropdown-content">
          <li><a href="which-god.php">Which God Are You?</a></li>
          <li><a href="trivia.php">Trivia Challenge</a></li>
          <li><a href="memory.php">Memory of the Gods</a></li>
          <hr>
          <li><a href="games.php"><strong>View All</strong></a></li>
        </ul>
      </li>
    </ul>

    <div class="nav-right">
      <div class="nav-search">
        <button type="button" class="nav-search-toggle" aria-label="Search the archives" aria-expanded="false">
          <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false">
            <circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2"/>
            <line x1="16.5" y1="16.5" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
        <form class="nav-search-panel" action="search.php" method="get" role="search">
          <input
            type="text"
            name="q"
            placeholder="Search gods, myths, heroes..."
            autocomplete="off"
            aria-label="Search query"
          />
          <button type="submit" aria-label="Submit search">
            <svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false">
              <circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2"/>
              <line x1="16.5" y1="16.5" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
        </form>
      </div>

      <div class="dropdown more-dropdown">
        <a href="#">More ▾</a>
        <ul class="dropdown-content">
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>

      <!-- Profile dropdown -->
      <div class="dropdown profile-dropdown">
        <?php if (isset($_SESSION['username'])): ?>
          <img
            src="<?php echo '../' . htmlspecialchars($_SESSION['profile_pic'] ?? 'img/placeholder.png'); ?>"
            alt="Profile"
            class="profile-pic"
          />
          <ul class="dropdown-content profile-menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        <?php else: ?>
          <img src="../img/placeholder.png" alt="Profile" class="profile-pic" />
          <ul class="dropdown-content profile-menu not-logged-in">
            <li><a href="login.php">Log In</a></li>
            <li><a href="register.php">Register</a></li>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>