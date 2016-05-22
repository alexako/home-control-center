<!DOCTYPE html>
<html>
  <head>
    <title>RPi Controller</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body onload="startTime()">

    <div class="container-fluid">
      <div class="row">
        <!--Sidebar -->
        <div class="col-md-4">
          <div id="current_time">
            <h2>Welcome, Alex</h2>
            <div id="current_day" class="text-center"></div>
            <div id="current_date" class="text-center"></div>
            <div id="current_time_now" class="text-center"></div>
          </div>
          <?php
            $check_temp = "/opt/vc/bin/vcgencmd measure_temp";
            $temp = substr(shell_exec($check_temp), 5);
            echo ("<div id='rpi_temp'>RPi Temperature<div>$temp</div></div>");
          ?>

          <!-- Webcam feed -->
          <?php
            $url = $_SERVER['SERVER_ADDR'];# + ":8081";
            echo ("<iframe src='http://$url:8081' scrolling='no' frameborder='0'></iframe>");
          ?>
        </div>

        <!-- Buttons -->
        <div class="col-md-8">
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
            $switch_status = array("is on", "is off");
            $switch_color = array("#197b30", "#ed3038");

            for ($i=0; $i<8; $i++) {
              $c_status = 1;# shell_exec("gpio read $channels[$i]");
              #echo row
              if ($i % 3 == 0) { echo ("<div class='row'>"); }
              echo ("
                <div class='button col-xs-12 col-md-4' id='button_$i' onclick='change_pin($i);' style='background-color: $switch_color[$c_status];'>
                  <p>$descriptions[$i]</p>
                  <p>$switch_status[$c_status]</p>
                </div>
              ");
              if ($i == 2 || $i == 5) { echo ("</div>"); } # close row div

            }
            echo ("<div class='button col-xs-12 col-md-4' id='button_8' onClick='change_pin(8)'><p>Reset</p><p>Relay</p></div>");
            echo ("</div>"); #close last row div
          ?>
        </div>
      </div> <!-- row -->
    </div><!-- container -->

    <script src="assets/js/script.js"></script>
    <script src="assets/js/date_time.js"></script>
  </body>
</html>
