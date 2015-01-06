<?php
	require_once('neat_get_file_contents.php');

	
	class timer
	{
		var $start;
		var $pause_time;
 
		function timer($start = 0){	//Start the timer
			if($start)	$this->start();
		}
 
		function start(){	//Start the timer
			$this->start = $this->get_time();
			$this->pause_time = 0;
		}
 
		function pause(){	//Pause the timer
			$this->pause_time = $this->get_time();
		}
 
		function unpause(){	//Unpause the timer
			$this->start += ($this->get_time() - $this->pause_time);
			$this->pause_time = 0;
		}
 
		function get($decimals = 8){	//Get the current timer value
			return round(($this->get_time() - $this->start),$decimals);
		}
 
		function get_time(){	//Format the time in seconds
			list($usec,$sec) = explode(' ', microtime());
			return ((float)$usec + (float)$sec);
		}
	}


	//Test getting contents from google....
	$result1_me = 0;
	$result1_php = 0;
	
	$timer3 = new timer();
	$timer3->start();
	$data =	neat_get_file_content('https://wikileaks.org/');
	$timer3->pause();
	
	$result1_me = $timer3->get();
	

	$timer3->start();
		file_get_contents('https://wikileaks.org/');
	$timer3->pause();
	
	$result1_php = $timer3->get();
	
	echo 'NEAT: '.$result1_me.'<br/>';
	echo 'PHP: '.$result1_php.'<br/>';
	
	if($result1_me > $result1_php)
	{
		echo 'PHP won!';	
	}
	else
	{
		echo 'I won!';
	}
	
	
	print $data;
?>