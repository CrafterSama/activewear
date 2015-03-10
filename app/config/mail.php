<?php

return array(

	'driver' => 'mail',
	'host' => 'smtp.gmail.com',
	'port' => 465,
	'from' => array('address' => Configuration::getServiceEmail(), 'name' => Configuration::getCompanyName()),
	'encryption' => 'tls',
	'username' => 'mailerservice2015@gmail.com',
	'password' => '24436525',
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,
);