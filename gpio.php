<?php

if (isset ( $_GET["pin"] )) {
	$channels = array(
		0 => 15,
		1 => 16,
		2 => 1,
		3 => 4,
		4 => 5,
		5 => 6,
		6 => 10,
		7 => 11
		);
	$sound = array(
		"data/sfx/beep_pulse.wav",
		"data/sfx/LivRoomLight_D.wav", //Channel 1 Off
		"data/sfx/LivRoomLight_A.wav", //Channel 1 On
		"data/sfx/UC_D.wav", //Channel 2 Off
		"data/sfx/UC_A.wav", //Channel 2 On
		"data/sfx/UC_D.wav",
		"data/sfx/UC_A.wav", //Channel 3 On
		"data/sfx/UC_D.wav",
		"data/sfx/UC_A.wav", //Channel 4 On
		"data/sfx/UC_D.wav",
		"data/sfx/UC_A.wav", //Channel 5 On
		"data/sfx/UC_D.wav",
		"data/sfx/UC_A.wav", //Channel 6 On
		"data/sfx/UC_D.wav",
		"data/sfx/UC_A.wav", //Channel 7 On
		"data/sfx/UC_D.wav",
		"data/sfx/UC_A.wav", //Channel 8 On
		);
	$channel = strip_tags ($_GET["pin"]);
	$pin = $channels[$channel];
	$channel++;

	//test if value is a number
	if ( (is_numeric($channel)) && ($channel < 9) && ($channel >= 1) ) {
		
		system("gpio mode ".$pin." out");
		//reading pin's status
		exec ("gpio read ".$pin, $status, $return );

		//set the gpio to high/low
		if ($status[0] == "0") { $status[0] = "1"; }
		else { $status[0] = "0"; }
		system("gpio write $pin $status[0]");

		exec ("gpio read ".$pin, $status, $return );
		//print it to the client on the response
		echo $status[0];

		//play sound effect
		exec ("aplay ".$sound[($channel * 2) - $status[0]]);
	}
	else { echo ("fail"); }
} //print fail if cannot use values
else { echo ("fail"); }
?>
