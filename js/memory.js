/* memory.js by Eduardo Bussien */

(function () {
  const board = document.getElementById("memory-board");
  if (!board) return;

  const movesEl = document.getElementById("memory-moves");
  const pairsEl = document.getElementById("memory-pairs");
  const totalEl = document.getElementById("memory-total");
  const timeEl = document.getElementById("memory-time");
  const winPanel = document.getElementById("memory-win");
  const winMovesEl = document.getElementById("memory-win-moves");
  const winTimeEl = document.getElementById("memory-win-time");
  const restartBtn = document.getElementById("memory-restart");
  const winRestartBtn = document.getElementById("memory-win-restart");

  const pool = (window.MEMORY_POOL && window.MEMORY_POOL.length)
    ? window.MEMORY_POOL
    : [
        { slug: "zeus", name: "Zeus" },
        { slug: "hera", name: "Hera" },
        { slug: "poseidon", name: "Poseidon" },
        { slug: "athena", name: "Athena" },
        { slug: "apollo", name: "Apollo" },
        { slug: "artemis", name: "Artemis" },
        { slug: "ares", name: "Ares" },
        { slug: "hermes", name: "Hermes" },
      ];

  let firstTile = null;
  let secondTile = null;
  let lock = false;
  let moves = 0;
  let matchedPairs = 0;
  let totalPairs = 0;
  let timerId = null;
  let elapsed = 0;
  let started = false;

  function pad(n) {
    return n < 10 ? "0" + n : "" + n;
  }

  function formatTime(seconds) {
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    return pad(m) + ":" + pad(s);
  }

  function startTimer() {
    if (started) return;
    started = true;
    timerId = setInterval(() => {
      elapsed += 1;
      timeEl.textContent = formatTime(elapsed);
    }, 1000);
  }

  function stopTimer() {
    if (timerId) {
      clearInterval(timerId);
      timerId = null;
    }
  }

  function shuffle(arr) {
    for (let i = arr.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
  }

  function buildBoard() {
    // Reset state
    firstTile = null;
    secondTile = null;
    lock = false;
    moves = 0;
    matchedPairs = 0;
    elapsed = 0;
    started = false;
    stopTimer();

    movesEl.textContent = "0";
    pairsEl.textContent = "0";
    timeEl.textContent = "00:00";
    winPanel.hidden = true;
    board.classList.remove("locked");
    board.innerHTML = "";

    // Use up to 8 chars for 16 tiles
    const chars = pool.slice(0, 8);
    totalPairs = chars.length;
    totalEl.textContent = String(totalPairs);

    // Duplicate each char into two tiles
    const tiles = [];
    chars.forEach((c) => {
      tiles.push({ slug: c.slug, name: c.name });
      tiles.push({ slug: c.slug, name: c.name });
    });
    shuffle(tiles);

    tiles.forEach((tile, i) => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "memory-tile";
      btn.dataset.slug = tile.slug;
      btn.setAttribute("aria-label", "Memory tile " + (i + 1));

      btn.innerHTML =
        '<div class="memory-tile-inner">' +
        '  <div class="memory-face memory-back" aria-hidden="true">' +
        '    <span class="memory-back-glyph">⚡</span>' +
        '  </div>' +
        '  <div class="memory-face memory-front">' +
        '    <img src="../img/gods/' + tile.slug + '.png" alt="' + tile.name + '" loading="lazy" />' +
        '    <span class="memory-front-name">' + tile.name + '</span>' +
        '  </div>' +
        '</div>';

      btn.addEventListener("click", () => onTileClick(btn));
      board.appendChild(btn);
    });
  }

  function onTileClick(btn) {
    if (lock) return;
    if (btn.classList.contains("flipped") || btn.classList.contains("matched")) return;

    startTimer();
    btn.classList.add("flipped");

    if (!firstTile) {
      firstTile = btn;
      return;
    }

    secondTile = btn;
    moves += 1;
    movesEl.textContent = String(moves);

    if (firstTile.dataset.slug === secondTile.dataset.slug) {
      // Match
      firstTile.classList.add("matched");
      secondTile.classList.add("matched");
      firstTile = null;
      secondTile = null;
      matchedPairs += 1;
      pairsEl.textContent = String(matchedPairs);

      if (matchedPairs === totalPairs) {
        stopTimer();
        setTimeout(showWin, 600);
      }
    } else {
      // No match - flip back after a beat
      lock = true;
      board.classList.add("locked");
      setTimeout(() => {
        firstTile.classList.remove("flipped");
        secondTile.classList.remove("flipped");
        firstTile = null;
        secondTile = null;
        lock = false;
        board.classList.remove("locked");
      }, 900);
    }
  }

  function showWin() {
    winMovesEl.textContent = String(moves);
    winTimeEl.textContent = formatTime(elapsed);
    winPanel.hidden = false;
    winPanel.scrollIntoView({ behavior: "smooth", block: "nearest" });
  }

  if (restartBtn) restartBtn.addEventListener("click", buildBoard);
  if (winRestartBtn) winRestartBtn.addEventListener("click", buildBoard);

  buildBoard();
})();
