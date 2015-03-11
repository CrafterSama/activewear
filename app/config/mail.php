<?php


return array(
'driver' => 'smtp',
'host' => 'smtp.gmail.com',
'port' => 587,
'from' => array('address' => Configuration::getServiceEmail(), 'name' => Configuration::getCompanyName()),
'encryption' => 'tls',
'username' => 'cariocamailservice@gmail.com',
'password' => 'carioca123456',
'sendmail' => '/usr/sbin/sendmail -bs',
'pretend' => false,
);

/*return array(

	'driver' => 'sendmail',
	'host' => 'smtp.gmail.com',
	'port' => 587,
	'from' => array('address' => Configuration::getServiceEmail(), 'name' => Configuration::getCompanyName()),
	'encryption' => 'tls',
	'username' => 'cariocamailservice@gmail.com',
	'password' => 'carioca123456',
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,
);*/