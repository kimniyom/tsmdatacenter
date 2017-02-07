<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			// uncomment the following to provide test database connection
			'db'=>array(
				 'connectionString' => 'mysql:host=172.17.250.7;dbname=takicdb_test',
            'emulatePrepare' => true,
            'username' => 'ssjtak',
            'password' => '63tak00',
            'charset' => 'utf8',
			),
			
		),
	)
);
