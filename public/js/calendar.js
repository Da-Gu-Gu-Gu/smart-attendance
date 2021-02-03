var current = new Date();
let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
    'October', 'November', 'December'
];
let currentDay = current.getDay();
let currentDate = current.getDate();
let currentYear = current.getFullYear();
let currentMonth = current.getMonth();
let Month = current.getMonth();
let minus = 1;

let events = [];

//day in month


let day = new Date(currentYear, currentMonth + 1, 0);

let firstday = new Date(currentYear, Month, 1); //first day of month get day moh +1 ma lo





document.getElementById("pre").onclick = (function prevmonth() {


    if (currentMonth <= 0) {
        currentMonth = currentMonth + 12;
        currentYear = currentYear - minus;
        console.log("changeYear" + currentYear);
        console.log("adsfasdf" + currentMonth)
    }
    currentMonth = currentMonth - minus;
    day = new Date(currentYear, currentMonth + 1, 0);
    firstday = new Date(currentYear, currentMonth, 1);
    console.log('preMonth' + currentMonth);
    titleDate();
    days();

});



function nextmonth() {
    currentMonth = currentMonth + minus;
    if (currentMonth >= 12) {
        currentMonth = currentMonth % 12;
        currentYear = currentYear + minus;
    }

    day = new Date(currentYear, currentMonth + 1, 0);
    firstday = new Date(currentYear, currentMonth, 1);

    titleDate();
    days();


};

function titleDate() {
    document.getElementById("month").innerHTML = months[currentMonth] + ' ';
    document.getElementById("year").innerHTML = currentDate + ' ' + currentYear;
}
titleDate();





function days() {
    document.getElementById("days").innerHTML = "";
    for (let j = 0; j < firstday.getDay(); j++) {
        var blank = document.createElement("div");
        document.getElementById('days').appendChild(blank);
    }


    for (let i = 0; i < day.getDate(); i++) {
        let br = document.createElement("br");
        let number = document.createElement("div");
        number.setAttribute("class", "btn");
        number.setAttribute("data-toggle", "modal");
        number.setAttribute("data-target", "#calendar_event");
        number.setAttribute("id", (i + 1) + "-" + (currentMonth + 1) + "-" + currentYear);
        // number.setAttribute("onclick", "aa(this)");
        number.setAttribute("date", (i + 1) + "-" + (currentMonth + 1) + "-" + currentYear);
        number.innerHTML = i + 1;
        if (currentDate - 1 == i) {
            number.classList.add('background');
        }
        document.getElementById('days').appendChild(number);

    }



};

days();

// function aa(e) {
//     console.log(e.getAttribute("date"));
//     events[e.getAttribute("date")] = prompt("Add Event", '');
//     e.style.backgroundColor = '#' + Math.floor(Math.random() * 1000);
//     console.log('#' + Math.floor(Math.random() * 1000));
// }