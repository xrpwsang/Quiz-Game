const question =document.getElementById("question");
const choices =Array.from(document.getElementsByClassName("choice-text"));
const progressText = document.getElementById('progressText');
const scoreText = document.getElementById('score');
const progressBarFull = document.getElementById('progressBarFull');
let subject = document.getElementById("subject");

let currentQuestion ={};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuestions = [];

let questions = [];

fetch("englishquestions.json")
    .then(res =>{
        return res.json();
    })
    .then(loadedQuestions =>{
        console.log(loadedQuestions);
        questions = loadedQuestions;
        startGame();
    });

//Consonants
const CORRECT_BONUS = 10;
const MAX_QUESTION = 15;

startGame = () =>{
    questionCounter = 0;
    score = 0;
    availableQuestions = [...questions];
    console.log(availableQuestions);
    getNewQuestion();
};

getNewQuestion = () =>{

    if(availableQuestions.length==0 || questionCounter >= MAX_QUESTION){
       localStorage.setItem("mostRecentScore", score);
        // Goes To end page
        return window.location.assign("end.html");
    };
    questionCounter++;
    progressText.innerText = `Question ${questionCounter}/${MAX_QUESTION}`;

    //Progress Bar
    // console.log((questionCounter/MAX_QUESTION) * 100);
    progressBarFull.style.width = `${(questionCounter/MAX_QUESTION) * 100}%`;

    const questionIndex = Math.floor(Math.random() * availableQuestions.length);
    currentQuestion = availableQuestions[questionIndex];
    question.innerText = currentQuestion.question;

    choices.forEach( choice =>{
        const number = choice.dataset['number'];
        choice.innerText = currentQuestion['choice' + number];
    })

    availableQuestions.splice(questionIndex,1);

    acceptingAnswers = true;
};
 choices.forEach(choice =>{
    choice.addEventListener("click", e=>{
        console.log(e.target);
        if(!acceptingAnswers) return;

        acceptingAnswers = false;
        const selectedChoice = e.target;
        const selectedAnswer = selectedChoice.dataset["number"];

        const classToApply = 
        selectedAnswer == currentQuestion.answer ? 'correct'
        :'incorrect';

        selectedChoice.parentElement.classList.add(classToApply);

        setTimeout(() =>{
            selectedChoice.parentElement.classList.remove(classToApply);
            getNewQuestion();    
        },1000);
        
        
        if(classToApply === "correct"){
            const jsConfetti = new JSConfetti();
            jsConfetti.addConfetti({
                emojis: ["🎉", "🥳", "👏", "⚡", "🎈"],
                emojiSize: 20,
                confettiNumber: 300,
                confettiColors: [
                    "#ff0a54",
                    "#ff477e",
                    "#ff7096",
                    "#ff85a1",
                    "#fbb1bd",
                    "#f9bec7",
                ],
            });
            playAudio('clap.wav');
            incrementScore(CORRECT_BONUS);
        }
        // console.log(classToApply);
        // console.log(selectedAnswer == currentQuestion.answer);   
    });
 });

incrementScore = num =>{
    score +=num;
    scoreText.innerText = score;
};
function playAudio(audio){
    console.log(audio);
    audio = 'music/' + audio;

    // Create an audio context
    var audioContext = new (window.AudioContext || window.webkitAudioContext)();

    // Create an audio element
    var audioElement = new Audio(audio);

    // Create a source node
    var sourceNode = audioContext.createMediaElementSource(audioElement);

    // Connect the source to the audio context's destination (speakers)
    sourceNode.connect(audioContext.destination);

    // Play the audio
    audioElement.play();

    // Pause the audio
    // audioElement.pause();

    // Adjust volume
    // audioElement.volume = 0.5;
}