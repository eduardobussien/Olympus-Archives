// js/trivia.js

const allQuestions = [
  // 1
  {
    question: "Who is the king of the gods?",
    options: ["Poseidon", "Zeus", "Apollo"],
    answerIndex: 1
  },
  // 2
  {
    question: "Which goddess was born from Zeus's head?",
    options: ["Athena", "Hera", "Artemis"],
    answerIndex: 0
  },
  // 3
  {
    question: "Who is the god of the Underworld?",
    options: ["Ares", "Hades", "Dionysus"],
    answerIndex: 1
  },
  // 4
  {
    question: "What creature has the body of a lion and the head of a woman?",
    options: ["Hydra", "Sphinx", "Harpy"],
    answerIndex: 1
  },
  // 5
  {
    question: "Who flew too close to the sun?",
    options: ["Odysseus", "Icarus", "Theseus"],
    answerIndex: 1
  },
  // 6
  {
    question: "What titan is the father of Zeus?",
    options: ["Atlas", "Kronos", "Prometheus"],
    answerIndex: 1
  },
  // 7
  {
    question: "Who is the messenger of the gods?",
    options: ["Hermes", "Hephaestus", "Apollo"],
    answerIndex: 0
  },
  // 8
  {
    question: "What is the name of the winged horse?",
    options: ["Arion", "Pegasus", "Chiron"],
    answerIndex: 1
  },
  // 9
  {
    question: "Who killed Medusa?",
    options: ["Perseus", "Heracles", "Achilles"],
    answerIndex: 0
  },
  // 10
  {
    question: "Which hero completed 12 labors?",
    options: ["Heracles", "Jason", "Ajax"],
    answerIndex: 0
  },
  // 11
  {
    question: "What was the weakness of Achilles?",
    options: ["His shoulder", "His heel", "His chest"],
    answerIndex: 1
  },
  // 12
  {
    question: "Who is the goddess of love and beauty?",
    options: ["Hera", "Aphrodite", "Demeter"],
    answerIndex: 1
  },
  // 13
  {
    question: "Who built the Labyrinth?",
    options: ["Daedalus", "Minos", "Hermes"],
    answerIndex: 0
  },
  // 14
  {
    question: "What monster did Theseus defeat?",
    options: ["Chimera", "Minotaur", "Nemean Lion"],
    answerIndex: 1
  },
  // 15
  {
    question: "Who stole fire from the gods for humans?",
    options: ["Prometheus", "Epimetheus", "Atlas"],
    answerIndex: 0
  },
  // 16
  {
    question: "Who is the goddess of the hunt?",
    options: ["Athena", "Hera", "Artemis"],
    answerIndex: 2
  },
  // 17
  {
    question: "What river must souls cross in the Underworld?",
    options: ["Lethe", "Styx", "Acheron"],
    answerIndex: 1
  },
  // 18
  {
    question: "Who led the Argonauts?",
    options: ["Jason", "Theseus", "Odysseus"],
    answerIndex: 0
  },
  // 19
  {
    question: "What creature grows two more heads when one is cut off?",
    options: ["Chimera", "Hydra", "Cerberus"],
    answerIndex: 1
  },
  // 20
  {
    question: "Who is the god of wine and theater?",
    options: ["Dionysus", "Apollo", "Hermes"],
    answerIndex: 0
  }
];

let quizQuestions = [];
let currentIndex = 0;
let score = 0;
let selectedOptionIndex = null;

document.addEventListener("DOMContentLoaded", () => {
  const questionText   = document.getElementById("question-text");
  const optionsContainer = document.getElementById("options-container");
  const nextBtn        = document.getElementById("next-btn");
  const restartBtn     = document.getElementById("restart-btn");
  const questionCounter = document.getElementById("question-counter");
  const scoreCounter   = document.getElementById("score-counter");
  const feedback       = document.getElementById("trivia-feedback");
  const resultSection  = document.getElementById("trivia-result");
  const resultText     = document.getElementById("result-text");

  function shuffle(array) {
    const arr = array.slice();
    for (let i = arr.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
  }

  function startGame() {

    quizQuestions = shuffle(allQuestions).slice(0, 5); 
    currentIndex = 0;
    score = 0;
    selectedOptionIndex = null;
    scoreCounter.textContent = `Score: ${score}`;
    resultSection.style.display = "none";
    restartBtn.style.display = "none";
    nextBtn.style.display = "inline-block";
    nextBtn.disabled = true;
    feedback.textContent = "";
    showQuestion();
  }

  function showQuestion() {
    const q = quizQuestions[currentIndex];
    questionText.textContent = q.question;
    questionCounter.textContent = `Question ${currentIndex + 1} of ${quizQuestions.length}`;
    optionsContainer.innerHTML = "";
    feedback.textContent = "";
    selectedOptionIndex = null;
    nextBtn.disabled = true;

    q.options.forEach((optionText, index) => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "trivia-option-btn";
      btn.textContent = optionText;
      btn.addEventListener("click", () => selectOption(index));
      optionsContainer.appendChild(btn);
    });

    nextBtn.textContent = currentIndex === quizQuestions.length - 1 ? "Show Results" : "Next";
  }

  function selectOption(index) {
    const q = quizQuestions[currentIndex];
    selectedOptionIndex = index;
    nextBtn.disabled = false;

    const optionButtons = optionsContainer.querySelectorAll(".trivia-option-btn");
    optionButtons.forEach(btn => btn.classList.remove("selected", "correct", "incorrect"));

    const selectedBtn = optionButtons[index];
    const correctIndex = q.answerIndex;

    if (index === correctIndex) {
      selectedBtn.classList.add("correct");
      feedback.textContent = "Correct!";
    } else {
      selectedBtn.classList.add("incorrect");
      optionButtons[correctIndex].classList.add("correct");
      feedback.textContent = "Not quite!";
    }
  }

  function nextQuestion() {
    if (selectedOptionIndex === null) return; 

    const q = quizQuestions[currentIndex];
    if (selectedOptionIndex === q.answerIndex) {
      score++;
      scoreCounter.textContent = `Score: ${score}`;
    }

    currentIndex++;
    if (currentIndex < quizQuestions.length) {
      showQuestion();
    } else {
      finishQuiz();
    }
  }

  function finishQuiz() {
    nextBtn.disabled = true;
    nextBtn.style.display = "none";
    restartBtn.style.display = "inline-block";
    resultSection.style.display = "block";

    const total = quizQuestions.length;
    resultText.textContent = `You scored ${score} out of ${total}.`;

    if (score === total) {
      resultText.textContent += " The gods are impressed!";
    } else if (score >= Math.ceil(total * 0.6)) {
      resultText.textContent += " A worthy demigod of knowledge.";
    } else {
      resultText.textContent += " The Muses suggest a bit more study.";
    }
  }

  nextBtn.addEventListener("click", nextQuestion);
  restartBtn.addEventListener("click", startGame);

  startGame();
});
