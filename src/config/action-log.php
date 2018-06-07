<?php
	return [
		//填写要记录的日志的模型名称
		'models' => [
			'\App\models\User',
		],


		// 填写监视类别, 默认为admin 该参数为auth相关
		'guards' => [
			'admin'
		]
	];