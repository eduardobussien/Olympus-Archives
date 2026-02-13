// which-god.js – Personality quiz: Which God Are You?

// Possible gods
const GODS = {
  zeus: {
    name: "Zeus",
    desc: "You are Zeus, ruler of the skies. You’re confident, decisive, and naturally take the lead."
  },
  athena: {
    name: "Athena",
    desc: "You are Athena, goddess of wisdom. You value strategy, learning, and clever solutions over brute force."
  },
  poseidon: {
    name: "Poseidon",
    desc: "You are Poseidon, lord of the seas. Passionate, emotional, and powerful-your moods can stir up storms."
  },
  hades: {
    name: "Hades",
    desc: "You are Hades, ruler of the Underworld. Reserved, focused, and serious, you’re more loyal than people realize."
  },
  artemis: {
    name: "Artemis",
    desc: "You are Artemis, goddess of the hunt. Independent, protective, and at peace in your own space."
  },
  aphrodite: {
    name: "Aphrodite",
    desc: "You are Aphrodite, goddess of love. Charismatic, charming, and deeply tuned into feelings and beauty."
  }
};

// 20 questions, each option gives a point to a god
const wgAllQuestions = [
  {
    question: "How do you usually make decisions?",
    options: [
      { text: "I trust my instincts and take charge.", god: "zeus" },
      { text: "I think through every angle first.", god: "athena" },
      { text: "I go with whatever feels right in the moment.", god: "poseidon" }
    ]
  },
  {
    question: "Where would you most like to spend your time?",
    options: [
      { text: "On a mountain with a great view.", god: "zeus" },
      { text: "In a quiet library or study.", god: "athena" },
      { text: "By the ocean or a stormy sea.", god: "poseidon" }
    ]
  },
  {
    question: "How do friends describe you?",
    options: [
      { text: "Calm, mysterious, and a bit reserved.", god: "hades" },
      { text: "Independent and strong-willed.", god: "artemis" },
      { text: "Warm, charming, and social.", god: "aphrodite" }
    ]
  },
  {
    question: "What role do you take in a group project?",
    options: [
      { text: "Leader – I organize and direct everyone.", god: "zeus" },
      { text: "Planner – I create the strategy and details.", god: "athena" },
      { text: "Support – I quietly handle my part reliably.", god: "hades" }
    ]
  },
  {
    question: "Pick a free day activity:",
    options: [
      { text: "Hiking or exploring nature.", god: "artemis" },
      { text: "Relaxing at the beach.", god: "poseidon" },
      { text: "Going out with friends somewhere beautiful.", god: "aphrodite" }
    ]
  },
  {
    question: "How do you handle conflict?",
    options: [
      { text: "I confront it directly and set things straight.", god: "zeus" },
      { text: "I stay calm and use logic to solve it.", god: "athena" },
      { text: "I withdraw and think before I respond.", god: "hades" }
    ]
  },
  {
    question: "What matters most to you?",
    options: [
      { text: "Power and influence.", god: "zeus" },
      { text: "Knowledge and fairness.", god: "athena" },
      { text: "Loyalty and deep bonds.", god: "hades" }
    ]
  },
  {
    question: "Choose a symbol:",
    options: [
      { text: "Thunderbolt.", god: "zeus" },
      { text: "Owl.", god: "athena" },
      { text: "Trident.", god: "poseidon" }
    ]
  },
  {
    question: "What kind of environment do you prefer?",
    options: [
      { text: "Busy, full of people and energy.", god: "aphrodite" },
      { text: "Quiet, focused, and organized.", god: "athena" },
      { text: "Wild, open, and natural.", god: "artemis" }
    ]
  },
  {
    question: "When someone wrongs you, you…",
    options: [
      { text: "React strongly and make sure they regret it.", god: "poseidon" },
      { text: "Stay cool but never forget.", god: "hades" },
      { text: "Try to move on and keep the peace.", god: "aphrodite" }
    ]
  },
  {
    question: "Which motto fits you best?",
    options: [
      { text: "“Lead, don’t follow.”", god: "zeus" },
      { text: "“Knowledge is power.”", god: "athena" },
      { text: "“Follow your heart.”", god: "aphrodite" }
    ]
  },
  {
    question: "How do you feel about rules?",
    options: [
      { text: "I make them.", god: "zeus" },
      { text: "I respect them if they make sense.", god: "athena" },
      { text: "I ignore them if they limit my freedom.", god: "artemis" }
    ]
  },
  {
    question: "Pick a color that resonates with you:",
    options: [
      { text: "Deep blue.", god: "poseidon" },
      { text: "Dark, shadowy tones.", god: "hades" },
      { text: "Gold or bright white.", god: "zeus" }
    ]
  },
  {
    question: "How social are you?",
    options: [
      { text: "I enjoy attention and being in the spotlight.", god: "aphrodite" },
      { text: "I prefer a small circle of close people.", god: "hades" },
      { text: "I like being around others but also need alone time.", god: "artemis" }
    ]
  },
  {
    question: "What kind of challenges do you enjoy?",
    options: [
      { text: "Strategic puzzles and debates.", god: "athena" },
      { text: "Physical or outdoor challenges.", god: "artemis" },
      { text: "Negotiating relationships and social dynamics.", god: "aphrodite" }
    ]
  },
  {
    question: "If you had a divine power, it would be…",
    options: [
      { text: "Control over storms and lightning.", god: "zeus" },
      { text: "Command over the sea.", god: "poseidon" },
      { text: "Influence over hearts and attraction.", god: "aphrodite" }
    ]
  },
  {
    question: "Choose a pet companion:",
    options: [
      { text: "A loyal three-headed dog.", god: "hades" },
      { text: "A graceful deer or wild animal.", god: "artemis" },
      { text: "A majestic eagle.", god: "zeus" }
    ]
  },
  {
    question: "What do you do when plans suddenly change?",
    options: [
      { text: "Take control and reorganize everyone.", god: "zeus" },
      { text: "Adapt quickly and stay flexible.", god: "poseidon" },
      { text: "Quietly adjust and keep things stable.", god: "hades" }
    ]
  },
  {
    question: "Which of these sounds most like you?",
    options: [
      { text: "I protect those I care about fiercely.", god: "artemis" },
      { text: "I guide others and give advice.", god: "athena" },
      { text: "I bring people together and ease tension.", god: "aphrodite" }
    ]
  },
  {
    question: "How do you recharge?",
    options: [
      { text: "Spending time alone and reflecting.", god: "hades" },
      { text: "Being active and outdoors.", god: "artemis" },
      { text: "Relaxing with people I like in a beautiful place.", god: "aphrodite" }
    ]
  }
];

// State
let wgQuestions = [];
let wgIndex = 0;
let wgScores = {};
let wgSelectedGod = null;

document.addEventListener("DOMContentLoaded", () => {
  const qText = document.getElementById("wg-question-text");
  const qCounter = document.getElementById("wg-question-counter");
  const optionsContainer = document.getElementById("wg-options-container");
  const nextBtn = document.getElementById("wg-next-btn");
  const restartBtn = document.getElementById("wg-restart-btn");
  const feedback = document.getElementById("wg-feedback");
  const resultSection = document.getElementById("wg-result");
  const resultName = document.getElementById("wg-result-name");
  const resultDesc = document.getElementById("wg-result-desc");

  function shuffle(arr) {
    const a = arr.slice();
    for (let i = a.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
  }

  function startQuiz() {
    wgQuestions = shuffle(wgAllQuestions).slice(0, 10); // pick 10 of 20
    wgIndex = 0;
    wgScores = { zeus: 0, athena: 0, poseidon: 0, hades: 0, artemis: 0, aphrodite: 0 };
    wgSelectedGod = null;
    feedback.textContent = "";
    resultSection.style.display = "none";
    nextBtn.style.display = "inline-block";
    nextBtn.disabled = true;
    restartBtn.style.display = "none";
    showQuestion();
  }

  function showQuestion() {
    const q = wgQuestions[wgIndex];
    qText.textContent = q.question;
    qCounter.textContent = `Question ${wgIndex + 1} of ${wgQuestions.length}`;
    feedback.textContent = "";
    wgSelectedGod = null;
    nextBtn.disabled = true;

    optionsContainer.innerHTML = "";
    q.options.forEach((opt) => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "trivia-option-btn";
      btn.textContent = opt.text;
      btn.addEventListener("click", () => selectOption(opt.god, btn));
      optionsContainer.appendChild(btn);
    });

    if (wgIndex === wgQuestions.length - 1) {
      nextBtn.textContent = "See Result";
    } else {
      nextBtn.textContent = "Next";
    }
  }

  function selectOption(godKey, btn) {
    wgSelectedGod = godKey;
    nextBtn.disabled = false;

    // clear selected class
    const buttons = optionsContainer.querySelectorAll(".trivia-option-btn");
    buttons.forEach(b => b.classList.remove("selected"));

    btn.classList.add("selected");
    feedback.textContent = "";
  }

  function nextQuestion() {
    if (!wgSelectedGod) return;

    // add 1 point to the chosen god
    if (wgScores[wgSelectedGod] != null) {
      wgScores[wgSelectedGod] += 1;
    }

    wgIndex++;
    if (wgIndex < wgQuestions.length) {
      showQuestion();
    } else {
      finishQuiz();
    }
  }

  function finishQuiz() {
    nextBtn.disabled = true;
    nextBtn.style.display = "none";
    restartBtn.style.display = "inline-block";

    // find highest scoring god
    let bestGod = null;
    let bestScore = -1;
    for (const key in wgScores) {
      if (wgScores[key] > bestScore) {
        bestScore = wgScores[key];
        bestGod = key;
      }
    }

    if (!bestGod) {
      resultName.textContent = "The Fates are Uncertain";
      resultDesc.textContent = "Try the quiz again to learn which deity you resemble.";
    } else {
      const info = GODS[bestGod];
      resultName.textContent = info.name;
      resultDesc.textContent = info.desc;
    }

    resultSection.style.display = "block";
  }

  nextBtn.addEventListener("click", nextQuestion);
  restartBtn.addEventListener("click", startQuiz);

  startQuiz();
});
