function printGreeting() {
    var message;
    var time = new Date().getHours();
    if(time<12) {
        message="Good Morning!";
    } else if (time < 20) {
        message="Good Afternoon!"
    } else {
        message="Good Evening!"
    }
    document.getElementById("greeting").innerHTML=message;
}

function getDate() {
    let today = new Date().toLocaleDateString();
    document.getElementById("date").innerHTML=today;
}

var hr=0;
var min=0;
var sec=0;
var stopped=true;


function startTimer() {
    if(stopped) {
        stopped=false;
        timer();
    }
}

function stopTimer() {
    if(!stopped) {
        stopped=true;
    }
}

function timer() {
    const timerElement = document.getElementById('timer');
    if(!stopped) {
        hr= parseInt(hr);
        min=parseInt(min);
        sec=parseInt(sec);
        sec++;

        if(sec==60) {
            min++;
            sec=0;
        }
        if(min==60) {
            hr++;
            min=0;
            sec=0;
        }

        if(sec<10 || sec==0) {
            sec='0'+sec;
        }

        if(min<10 || min==0) {
            min='0'+min;
        }

        if(hr < 10 || hr==0) {
            hr='0'+hr;
        }

        timerElement.innerHTML=hr+':'+min+':'+sec;
        setTimeout("timer()", 1000);
    }
}

function enableAddButton() {
    if($("#edd").val() !== "default" && $("#typedropdown").val() !== "default") {
        $("#addButton").replaceWith('<button type="submit" form="form" class="btn btn-success" name="add" id="addButton">Add Workout</button>');
    }else{
        $("#addButton").replaceWith('<button type="submit" form="form" class="btn btn-success"  name="add" id="addButton" disabled>Add Workout</button>');
    }
}

function changeToTextBox(data) {
    if(data=='new') {
        $("#edd").replaceWith('<input class="form-control" id="exerciseDropdown" placeholder="Exercise" autocomplete="off">');
    }
}

function addRepSelector(data) {
    if(data=='Sets') {
        $("#hide").show();
        $("#hide2").show();
    }else{
        $("#hide").hide();
        $("#hide2").hide();
    }
}

//need ajax call to handle for addworkoutbutton

function changeType(data) {
    alert(data);
    $.ajax({
        type: 'POST',
        url: 'addworkoututils.php',
        data: {type: data},
        success: isSame(data),
        dataType: 'text',
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        },
    });
}


$(document).ready(function() {
    $("#start-workout").hide();
    $("#toggle").click(function () {
        $("#welcome").hide();
        $("#start-workout").show();
        $("#hide").hide();
        $("#hide2").hide();
    });
});
