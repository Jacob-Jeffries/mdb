<?php

	$to = 'jjeffrie@nmu.edu';
	$subject = 'test';
	$message = 'test';
	$headers = 'From: webmaster@example.com';

	mail($to, $subject, $message, $headers);
?>
