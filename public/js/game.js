// Configuración del lienzo y contexto
const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

canvas.width = 800;
canvas.height = 400;

// Cargar efectos de sonido
const bounceSound = new Audio("/pingpong_game/public/sounds/bounce.mp3");
const scoreSound = new Audio("/pingpong_game/public/sounds/score.mp3");

// Configuración de la pelota
let ball = {
  x: canvas.width / 2,
  y: canvas.height / 2,
  radius: 10,
  dx: 4,
  dy: 4,
};

// Configuración de las paletas
let paddle1 = {
  x: 30,
  y: canvas.height / 2 - 50,
  width: 10,
  height: 100,
  speed: 5,
  dy: 0,
};
let paddle2 = {
  x: canvas.width - 40,
  y: canvas.height / 2 - 50,
  width: 10,
  height: 100,
  speed: 5,
  dy: 0,
};

let pointLimit = 10; // Valor por defecto

document.getElementById("startGame").addEventListener("click", function () {
  pointLimit = parseInt(document.getElementById("pointLimit").value);
  startGame();
});

function checkWinner() {
  if (score1 >= pointLimit) {
    alert("¡Jugador 1 gana la ronda!");
    startGame()();
  } else if (score2 >= pointLimit) {
    alert("¡Jugador 2 gana la ronda!");
    startGame()();
  }
}

// Puntuaciones
let score1 = 0;
let score2 = 0;

// Función para actualizar la puntuación en pantalla
function updateScoreDisplay() {
  document.getElementById("score1").textContent = score1;
  document.getElementById("score2").textContent = score2;
}

// Función para actualizar la lógica del juego
function update() {
  ball.x += ball.dx;
  ball.y += ball.dy;

  if (ball.y - ball.radius < 0 || ball.y + ball.radius > canvas.height) {
    ball.dy *= -1;
    bounceSound.play();
  }

  if (
    ball.x - ball.radius < paddle1.x + paddle1.width &&
    ball.y > paddle1.y &&
    ball.y < paddle1.y + paddle1.height
  ) {
    ball.dx *= -1.1;
    bounceSound.play();
  }

  if (
    ball.x + ball.radius > paddle2.x &&
    ball.y > paddle2.y &&
    ball.y < paddle2.y + paddle2.height
  ) {
    ball.dx *= -1.1;
    bounceSound.play();
  }

  if (ball.x - ball.radius < 0) {
    ball.x = canvas.width / 2;
    ball.y = canvas.height / 2;
    ball.dx = -4;
    ball.dy = 4;
    score2++;
    scoreSound.play();
    updateScoreDisplay();
    checkWinner();
  }

  if (ball.x + ball.radius > canvas.width) {
    ball.x = canvas.width / 2;
    ball.y = canvas.height / 2;
    ball.dx = 4;
    ball.dy = 4;
    score1++;
    scoreSound.play();
    updateScoreDisplay();
    checkWinner();
  }

  paddle1.y += paddle1.dy;
  paddle2.y += paddle2.dy;

  // Efecto de teletransporte en las paletas
  if (paddle1.y < 0) paddle1.y = canvas.height - paddle1.height;
  if (paddle1.y + paddle1.height > canvas.height) paddle1.y = 0;

  if (paddle2.y < 0) paddle2.y = canvas.height - paddle2.height;
  if (paddle2.y + paddle2.height > canvas.height) paddle2.y = 0;
}

// Dibujar elementos en el juego
function draw() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Dibujar pelota con resplandor
  ctx.beginPath();
  ctx.arc(ball.x, ball.y, ball.radius, 0, Math.PI * 2);
  ctx.fillStyle = "#FFD700";
  ctx.shadowBlur = 10;
  ctx.shadowColor = "#FF4500";
  ctx.fill();
  ctx.closePath();

  ctx.shadowBlur = 0;

  // Dibujar paletas con resplandor
  ctx.fillStyle = "#00FFCC";
  ctx.shadowBlur = 15;
  ctx.shadowColor = "#0084FF";
  ctx.fillRect(paddle1.x, paddle1.y, paddle1.width, paddle1.height);
  ctx.fillRect(paddle2.x, paddle2.y, paddle2.width, paddle2.height);

  ctx.shadowBlur = 0;
}

// Controles
document.addEventListener("keydown", (e) => {
  if (e.key === "w") paddle1.dy = -paddle1.speed;
  if (e.key === "s") paddle1.dy = paddle1.speed;
  if (e.key === "ArrowUp") paddle2.dy = -paddle2.speed;
  if (e.key === "ArrowDown") paddle2.dy = paddle2.speed;
});

document.addEventListener("keyup", (e) => {
  if (e.key === "w" || e.key === "s") paddle1.dy = 0;
  if (e.key === "ArrowUp" || e.key === "ArrowDown") paddle2.dy = 0;
});

// Loop del juego
function gameLoop() {
  update();
  draw();
  requestAnimationFrame(gameLoop);
}

gameLoop();
