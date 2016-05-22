var button_0 = document.getElementById("button_0");
var button_1 = document.getElementById("button_1");
var button_2 = document.getElementById("button_2");
var button_3 = document.getElementById("button_3");
var button_4 = document.getElementById("button_4");
var button_5 = document.getElementById("button_5");
var button_6 = document.getElementById("button_6");
var button_7 = document.getElementById("button_7");

//Create an array for easy access later
var Buttons = [ button_0, button_1, button_2, button_3, button_4, button_5, button_6, button_7 ];
var Channels = [ 15, 16, 1, 4, 5, 6, 10, 11, ];


//This function is utilizes gpio.php for receiving data and updating the index.php file
function change_pin ( pin ) {
  var data = 0;
  var request = new XMLHttpRequest();
  request.open( "GET" , "gpio.php?pin=" + pin, true);
  var channel = Channels[pin];
  console.log("channel: " + pin);
  console.log("pin: " + channel);
//  pin = channel;
  request.send(null);
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      data = request.responseText;
      //Update the index pin
      if ( !(data.localeCompare("1")) ) {
        Buttons[pin].style.backgroundColor = "#ed3038";
        Buttons[pin].children[1].innerHTML = "is off";
      }
      else if ( !(data.localeCompare("0")) ) {
        Buttons[pin].style.backgroundColor = "#197b30";
        Buttons[pin].children[1].innerHTML = "is on";
      }
      else if ( !(data.localeCompare("fail"))) {
        console.log("Something went wrong!" );
        return ("fail");
      }
      else {
        console.log("data: " + data);
        console.log("Something went wrong!" );
        return ("fail");
      }
      console.log("data: " + data);
    }
    else if (request.readyState == 4 && request.status == 500) {
      alert ("Server error!");
      return ("fail");
    }
    else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) {
      alert ("Something went wrong!");
      return ("fail"); }
    }

  return 0;
}
