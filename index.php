<!DOCTYPE html>
<html>
<head>
  <title>RPi Controller</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
  <body onload="startTime()">
    <div id="sidebar">
      <div id="current_time">
        <h2>Welcome, Alex</h2>
        <div id="current_day"></div>
        <div id="current_date"></div>
        <div id="current_time_now"></div>
      </div>
      <?php
        $check_temp = "/opt/vc/bin/vcgencmd measure_temp";
        $temp = substr(shell_exec($check_temp), 5);
        echo ("<div id='rpi_temp'>RPi Temperature<div>$temp</div></div>");
      ?>
      <?php
        $url = $_SERVER['SERVER_ADDR'];# + ":8081";
        echo ("<iframe src='http://$url:8081' scrolling='no' frameborder='0'></iframe>");
      ?>
    </div>

    <div id="buttons">
    <?php
      $channels = array(15, 16, 1, 4, 5, 6, 10, 11);
      $descriptions = array(
        "Living Room Light",
        "Inactive channel",
        "Inactive channel",
        "Inactive channel",
        "Inactive channel",
        "Inactive channel",
        "Inactive channel",
        "Inactive channel",
      );

      for ($i=0; $i<8; $i++) {
        $value = shell_exec("gpio read $channels[$i]");
        if ($value == 1) {
          echo ("
          <div class='button' id='button_$i' onclick='change_pin($i);' style='background-color: #ed3038;'>
            <p>$descriptions[$i]</p>
            <p>is off</p>
          </div>
          ");
        } else {
          echo ("
          <div class='button' id='button_$i' onclick='change_pin($i);' style='background-color: #197b30;'>
            <p>$descriptions[$i]</p>
            <p>is on</p>
          </div>
          ");
        }
      }
      echo ("<div class='button' id='button_8' onClick='change_pin(8)'><p>Reset</p><p>Relay</p></div>");
    ?>
    </div>

    <script src="script.js"></script>
    <script src="date_time.js"></script>
  </body>
</html>
