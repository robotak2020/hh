
<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h3 class="display-3 font-weight-bold text-white">Exam</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="index.html">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Exam</p>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Blog Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5"><span class="px-2">Latest Exam</span></p>
            <h1 class="mb-4">Latest Exam</h1>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="quiz">
        <div class="quiz_header">
            <div class="quiz_user">
                <h4>أهلا وسهلا في امتحان روبوتاك 2021 <span class="name"></span></h4>
            </div>
            <div class="quiz_timer">
                <span class="time">00:00</span>
            </div>
        </div>
        <div class="quiz_body">
            <div id="questions">
                <form method="post" action="" style="width:100%;" id="frmTestQuiz" enctype="multipart/form-data">

                <!--<ul class="option_group">
                <li class="option">option 1</li>
                <li class="option">option 2</li>
                <li class="option">option 3</li>
                <li class="option">option 4</li>
            </ul>-->
                </form>
            </div>

            <button class="btn-next" onclick="next()">السؤال التالي</button>
        </div>
    </div>
</div>
<script>let questions = [{
        id: 1,
        question: "asd",
        answer: "روبوتاك",
        options: [
            "asdsad",
            "روبوsadasdتاك",
            "روبوsdsadتاك",
            "روبوdsadتاك"
        ]
    },
        {
            id: 2,
            question: "روبوتاك",
            answer: "روبوتاك",
            options: [
                "روبوتاك",
                "روبوتاك",
                "روبوتاك",
                "روبوتاك"
            ]
        },
        {
            id: 3,
            question: "روبوتاك",
            answer: "روبوتاك",
            options: [
                "روبوتاك",
                "روبوتاك",
                "روبوتاك",
                "روبوتاك"
            ]
        }
    ];

    let question_count = 0;
    let points = 0;

    window.onload = function() {
        show(question_count);

    };

    function next() {


        // if the question is last then redirect to final page
        if (question_count == questions.length - 1) {
            sessionStorage.setItem("time", time);
            clearInterval(mytime);
            location.href = "end.html";
        }
        console.log(question_count);

        let user_answer = document.querySelector("li.option.active").innerHTML;
        // check if the answer is right or wrong
        if (user_answer == questions[question_count].answer) {
            points += 10;
            sessionStorage.setItem("points", points);
        }
        console.log(points);

        question_count++;
        show(question_count);
    }

    function show(count) {
        let question = document.getElementById("questions");
        let [first, second, third, fourth] = questions[count].options;

        question.innerHTML = `
  <h2>Q${count + 1}. ${questions[count].question}</h2>
   <ul class="option_group">
  <li class="option">${first}</li>
  <li class="option">${second}</li>
  <li class="option">${third}</li>
  <li class="option">${fourth}</li>
</ul>
  `;
        toggleActive();
    }

    function toggleActive() {
        let option = document.querySelectorAll("li.option");
        for (let i = 0; i < option.length; i++) {
            option[i].onclick = function() {
                for (let i = 0; i < option.length; i++) {
                    if (option[i].classList.contains("active")) {
                        option[i].classList.remove("active");
                    }
                }
                option[i].classList.add("active");
            };
        }
    }</script>
