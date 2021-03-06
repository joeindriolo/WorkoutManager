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
var resume=false;


function startTimer() {
    if(stopped) {
        stopped=false;
        timer();
    }
}

function resumeTimer() {
    resume =true;
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
        $("#addButton").replaceWith('<button type="button" form="form" class="btn btn-success" name="add" id="addButton" onclick="addWorkout()"><i class="fas fa-plus"></i> Add Workout</button>');
    }else{
        $("#addButton").replaceWith('<button type="button" form="form" class="btn btn-success"  name="add" id="addButton" disabled><i class="fas fa-plus"></i> Add Workout</button>');
    }
}

function changeToTextBox(data) {
    if(data=='new') {
        $("#edd").replaceWith('<input class="form-control" id="edd" placeholder="Exercise" autocomplete="off">');
    }
}

function addRepSelector(data) {
    if(data=='Sets') {
        $("#ofText").show();
        $("#setAmount").show();
    }else{
        $("#ofText").hide();
        $("#setAmount").hide();
    }
}


    function addWorkout() {
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "php/addworkout.php",
            data: {exer: $('#edd').val(), number: $('#number').val(), type: $('#typedropdown').val(), reps: $('#reps').val(), lbs: $('#lbs').val() },
            success: function () {
                $("#exerciseDropdown").load(location.href+ " #exerciseDropdown");
                $("#currentWorkout").load(location.href+ " #currentWorkout");
            },
            error : function(resp) {
                console.log('error');
            }
        });
    });
}

function endWorkout() {
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "php/endworkout.php",
            data: {date: new Date().toLocaleDateString(), timer: hr+':'+min+':'+sec},
            success: function(resp) {
                $("#endWorkout").append(resp);
            },
            error: function () {
                alert('err');
            }
        });
        $.ajax({
            type: "POST",
            url: "php/displayqueue.php",
            data: '',
            success: function(res) {
                //var h = $('currentWorkout').replaceWith($('currentWorkout').load('displayqueue.php'));
                $("#endWorkout").append(res);
            }
        });
    });
}

function addWorkoutType() {
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "php/addtype.php",
            data: {type: $("#addType").val()},
            success: function(resp) {
                alert(resp);
            }
        });
    });
}

$(document).ready(function() {
    $("#start-workout").hide();
    $("#endWorkout").hide();
    $("#history").hide();
    $("#typeList").hide();
    $("#cal").hide();
    $("#calDetails").hide();
    $("#toggle").on("click" ,function () {
        $("#welcome").hide();
        $("#start-workout").show();
        $("#ofText").hide();
        $("#setAmount").hide();
    });
    $("#endButton").on("click",function() {
        $("#start-workout").hide();
        $("#endWorkout").show();
    });
    $("#past").on("click",function() {
        $("#welcome").hide();
        $("#history").show();
        $("#typeList").hide();
        $("#cal").hide();
        $("calDetails").hide();
    });
    $("#home").on("click",function() {
        $("#history").hide();
        $("#start-workout").hide();
        $("#typeList").hide();
        $("#cal").hide();
        $("#endWorkout").hide();
        $("#calDetails").hide();
        $("#welcome").show();

    });
    $("#type").on("click",function () {
        $("#history").hide();
        $("#welcome").hide();
        $("#start-workout").hide();
        $("#cal").hide();
        $("#calDetails").hide();
        $("#typeList").show();
    });
    $("#calendar").on("click", function () {
        $("#welcome").hide();
        $("#start-workout").hide();
        $("#history").hide();
        $("#typeList").hide();
        $("#cal").show();
        $("#calDetails").show();
    });
});
