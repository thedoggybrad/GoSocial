var currentColor = null
var wrongGuesses = [];
var answer = [];
var guess = [];
var newGuessArray = [];

var colorsCount = 8;
var rowsCount = 10;

const MAX_ROWS = 10;
const MAX_COLORS = 8;

var colors = [
  "#40e0d0",
  "#ffffff",
  "#c11cc1",
  "#000000",
  "#0000ff",
  "#ff0000",
  "#008000",
  "#ffff00"
]

var colorsObject = {
  "#40e0d0": "Turquoise",
  "#ffffff": "White",
  "#c11cc1": "Purple",
  "#000000": "Black",
  "#0000ff": "Blue",
  "#ff0000": "Red",
  "#008000": "Green",
  "#ffff00": "Yellow"
}

function createColorChoiceElement(id,color){
    var c = document.getElementById(id);
    var ctx = c.getContext("2d");
    ctx.beginPath();
    ctx.arc(25,25,25,0,2*Math.PI);
    ctx.fillStyle=color;
    ctx.fill();
    c.setAttribute("onClick","changeCursor(this)");
	if (color == 'none') {
		ctx.clearRect(0, 0, c.width, c.height);
	}
}

function createColorChoiceBoard(col_cnt){
  for (var i = 0; i < col_cnt ; i++){
    createColorChoiceElement("canv" + i, colors[i])
  }
  for (var i = col_cnt; i < 8 ; i++){
    createColorChoiceElement("canv" + i, "none")
  }
}

function createRow() {
  var child = document.createElement("ul");
  child.setAttribute("class", "mastermind-game_row");
  child.innerHTML =
  '<li class="empty pos_0"></li>' +
  '<li class="empty pos_1"></li>' +
  '<li class="empty pos_2"></li>' +
  '<li class="empty pos_3"></li>'
  return child;
}

function createPegs() {
  var pegs = document.createElement("li");
  pegs.setAttribute("class", "peg_list")
  pegs.innerHTML =
  '<div class = "peg"></div>' +
  '<div class = "peg"></div>' +
  '<div class = "peg"></div>' +
  '<div class = "peg"></div>'
  return pegs;
}


function createBoard(rowsCount){
  var empties = document.querySelector("#mastermind-game-row-panel");
  while (empties.firstChild) {
	empties.removeChild(empties.firstChild);
  }
  for (var i = 0; i < rowsCount; ++i) {
    empties.appendChild(createRow());
  }
  
  var my_peg_list = document.getElementById('mastermind-game-row-panel').getElementsByClassName("mastermind-game_row");
  for (var i = 0; i < rowsCount; ++i) {
    my_peg_list[i].appendChild(createPegs());
  }
  var peg_lists   = document.getElementsByClassName("peg_list")
  for (var i = 0; i < rowsCount; ++i) {
    peg_lists[i].setAttribute("id", "peg_list" + i)
  }
}


function addClickHandler(){
  for (var i = 0; i < 4; i++){
    var element = document.getElementsByClassName('empty')[i]
    element.setAttribute("onClick", "changeColor(this)");
    element.classList.add("active")
  }
}

function removeClickHandler(){
  var ball = document.getElementsByClassName('ball')
  for (var i = 0; i < ball.length; i++){
  ball[i].removeAttribute("onClick", "changeColor(this)")
  }
}

function changeCursor(el){
  var mywindow = document.getElementsByTagName('html');
  currentColor = el.getContext("2d").fillStyle;
  var img = el.toDataURL()
  mywindow[0].setAttribute('style', 'cursor: url('+img+') 20 20,auto;');
}

function generateAnswer(){
  while(answer.length < 4){
    var rand = Math.floor(Math.random() * colorsCount);
      answer.push(colors[rand]);
  }
  var stringAnswer = ""
  for (var i = 0; i < answer.length; i++){
    stringAnswer += colorsObject[answer[i]] + " "
  }
  // console.log("Current answer is", stringAnswer);
  return answer;
}

function setAnswer(color_sequence){
	// console.log(color_sequence);
	answer = [];
	var color_sequence_pointer = 0;

	while(answer.length < 4) {
		var color_sequence_part = color_sequence.substring(color_sequence_pointer, color_sequence_pointer + 7);
		// console.log('pointer: ', color_sequence_pointer, ' part: ', color_sequence_part);
		answer.push(color_sequence_part);
		color_sequence_pointer += 7;
	}
	var stringAnswer = ""
	for (var i = 0; i < answer.length; i++){
		stringAnswer += colorsObject[answer[i]] + " "
	}
	// console.log("Current answer is", stringAnswer);
	return answer;
}

function checkWin(){
    if (guess.length === 4){
    var guesses = []
      for (var i = 0; i < guess.length; i++){
        guesses.push(guess[i])
      }
    wrongGuesses.push(guesses)

    newGuessArray = guesses;
    compareToAnswer(answer, guess);
    guess = [];
    addClickHandler()
    removeClickHandler()
  }
};

function changeColor(el){
  if (currentColor){
    el.classList.remove("empty");
    el.classList.remove("active");
    el.classList.add("ball")
    if (el.className === 'pos_0 ball'){
      guess[0] = currentColor;
    } else if (el.className === 'pos_1 ball'){
      guess[1] = currentColor;
    } else if (el.className === 'pos_2 ball'){
      guess[2] = currentColor;
    } else if (el.className === 'pos_3 ball'){
      guess[3] = currentColor;
    }
    el.style.background = currentColor;
  }
}

function compareToAnswer(answer, guess){
  var exactCount = 0;
  var nearCount = 0;
  var dupAnswer = answer.slice();
  var dupGuess = guess.slice();
  for (var i = 0; i < answer.length; i++){
    if (dupAnswer[i] === dupGuess[i]){
      exactCount++;
      dupAnswer[i] = NaN;
      dupGuess[i] = NaN;
    }
  }
  for (var i = 0; i < answer.length; i++){
    for (var j = 0; j < answer.length; j++){
      if (dupAnswer[i] === dupGuess[j]){
        nearCount++
        dupAnswer[i] = NaN;
        dupGuess[j] = NaN;
      }
    }
  }
  checkWinner(exactCount, nearCount)
}

function checkWinner(exactCount, nearCount){
  if (exactCount == 4){
    var stringAnswer = ""
    for (var i = 0; i < answer.length; i++){
      stringAnswer += colorsObject[answer[i]] + " "
    }
	var wonGameBox = 'Mastermind/won?colora=' + answer[0].substring(1) + '&colorb=' + answer[1].substring(1) + '&colorc=' + answer[2].substring(1) + '&colord=' + answer[3].substring(1);
	Ossn.MessageBox(wonGameBox);
    //alert("You WON!");
	startGame();
  } else if (wrongGuesses.length>=rowsCount){
    var stringAnswer = ""
    for (var i = 0; i < answer.length; i++){
      stringAnswer += colorsObject[answer[i]] + " "
    }
	var lostGameBox = 'Mastermind/lost?colora=' + answer[0].substring(1) + '&colorb=' + answer[1].substring(1) + '&colorc=' + answer[2].substring(1) + '&colord=' + answer[3].substring(1);
	Ossn.MessageBox(lostGameBox);
    //alert(`You lost! Here is the code: ${stringAnswer}`);
	startGame();
  } else {
    renderPegs(exactCount, nearCount)
  }
}

function renderPegs(exactCount, nearCount){

  var pegs = document.querySelector("#peg_list" + (wrongGuesses.length - 1));
  for (var i = 0; i < exactCount; i++){
    pegs.children[i].style.background = "red";
    pegs.children[i].style.border = "1px solid red";
  }
  var newCount = nearCount + exactCount
  for (var i = exactCount; i < newCount; i++){
    pegs.children[i].style.background = "white";
    pegs.children[i].style.border = "1px solid white"
  }
  if (nearCount === 0 && exactCount === 0){
      var element = document.getElementById('mastermind-game-box')
      var tl = new TimelineMax();
      tl.to(element, .1, {
        x: "+=10",
        delay: .3
      })
      .to(element, .1, {
        x: "-=20"
      })
      tl.to(element, .1, {
        x: "+=20"
      })
      .to(element, .05, {
        x: "-=15"
      })
      tl.to(element, .05, {
        x: "+=15"
      })
      .to(element, .05, {
        x: "-=10",
      })
  }
}

function openModal() {
  document.getElementById('mastermind-rules').style.display = "block";
}

function closeModal() {
  document.getElementById('mastermind-rules').style.display = "none";
}


function startGame() {
	currentColor = null;
	wrongGuesses = [];
	answer = [];
	guess = [];
	newGuessArray = [];

	createBoard(rowsCount);
	generateAnswer();
	addClickHandler();
	resetCursor();
}

function startDiscloseGame() {
	currentColor = null;
	wrongGuesses = [];
	answer = [];
	guess = [];
	newGuessArray = [];

	createBoard(rowsCount);
	answer = generateAnswer();
	// console.log(answer);
	var discloseGameBox = 'Mastermind/disclose?colora=' + answer[0].substring(1) + '&colorb=' + answer[1].substring(1) + '&colorc=' + answer[2].substring(1) + '&colord=' + answer[3].substring(1);
	Ossn.MessageBox(discloseGameBox);

	addClickHandler();
	resetCursor();
}

function incColors() {
	colorsCount++;
	if (colorsCount == MAX_COLORS + 1) {
		colorsCount = 1;
	}
	createColorChoiceBoard(colorsCount);
	startGame();
}

function decColors() {
	colorsCount--;
	if (colorsCount == 0) {
		colorsCount = MAX_COLORS;
	}
	createColorChoiceBoard(colorsCount);
	startGame();
}

function incRows() {
	rowsCount++;
	if (rowsCount == MAX_ROWS + 1) {
		rowsCount = 1;
	}
	createBoard(rowsCount);
	startGame();
}

function decRows() {
	rowsCount--;
	if (rowsCount == 0) {
		rowsCount = MAX_ROWS;
	}
	createBoard(rowsCount);
	startGame();
}

function resetCursor(){
  var mywindow = document.getElementsByTagName('html');
  mywindow[0].style.cursor = "default";
}

createColorChoiceBoard(colorsCount);
createBoard(rowsCount);
generateAnswer();
addClickHandler();


