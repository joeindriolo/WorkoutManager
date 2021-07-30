var events=[];
var settings=[];

function addEvent(eventObj) {
    console.log(eventObj);
    events.push(eventObj);
}

function getEvents() {
    console.log(events);
    return events;
}