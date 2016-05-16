var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var dayOfWeek = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];
function startTime() {
  var date = new Date();
  var t = setTimeout(function(){startTime()},500);
  var month = months[date.getMonth()];
  var day = dayOfWeek[date.getDay()];
  var hour = date.getHours();

  //Format minutes if less than 10
  var minute;
  if (date.getMinutes() < 10) { minute = "0" + date.getMinutes(); }
  else { minute = date.getMinutes(); }

  //Format seconds if less than 10
  var seconds;
  if (date.getSeconds() < 10) { seconds = "0" + date.getSeconds(); }
  else { seconds = date.getSeconds(); }

  document.getElementById('current_day').innerHTML = "Today is " + day;
  document.getElementById('current_date').innerHTML = month + " " + date.getDate() + ", " + date.getFullYear();
  document.getElementById('current_time_now').innerHTML = hour + ":" + minute + ":" + seconds;
}
