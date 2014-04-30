<?php

// Раскомментируйте код ниже дабы добавить алиас
// Yii::setPathOfAlias('local','path/to/local-folder');

// Это основной файл конфигурации Web приложения.
// Тут может быть записано любое CWebApplication свойство.

return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'defaultController' => 'main',
    'layout' => 'main',
    'name' => 'Ticket - Купи билет в кино без проблем!',

    // Предварительная загрузка компанента 'debug'
    'preload' => array('debug'),

    // Автоматически загружаемые компаненты, модели и т.п.
    'import' => array(
        'application.models.*',
        'application.modules.*',
        'application.components.*',
        'application.views.*',
    ),

    'modules'=>array(
    	// Код ниже отвечает за Gii генератор кода
    	/*
        'gii'=>array(
        	'class'=>'system.gii.GiiModule',
        	'password'=>'Enter Your Password Here',
        	// If removed, Gii defaults to localhost only. Edit carefully to taste.
        	'ipFilters'=>array('127.0.0.1','::1'),
        ),
    	*/
    ),

	// Компаненты приложения
	'components' => array(

        // Подключаем Debug от Yii2
        'debug' => array(
            'class' => 'ext.yii2-debug.Yii2Debug'
        ),

		'user' => array(
			// Автоматический вход по cookie
			'allowAutoLogin' => true,
		),

		// Генератор ЧПУ
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
                'main' => 'main/index',
                'movie' => 'movie/index',
                'cinema' => 'cinema/index',
                'ticket' => 'ticket/index',
                '<action:\w+>' => 'main/<action>',
                'main/<action:\w+>' => 'main/<action>',

			),
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/

		// Подключение к MySQL
        // Host: Имя домена в Open Server или localhost
        // Port: 3306
        // Log: root || mysql
        // Pas: ''   || mysql
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=ticket',
			'emulatePrepare' => true,
			'username' => 'mysql',
			'password' => 'mysql',
			'charset' => 'utf8',

            'enableProfiling' => true,
            'enableParamLogging' => true,
		),

		'errorHandler' => array(
			// Вывод ошибок
			'errorAction' => 'main/404',
		),

        // Логирование уровня error и warning
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),

				// Отображение логов на веб странице
				/*
				array(
					'class' => 'CWebLogRoute',
				),
				*/
			),
		),
	),

	// Можно получить доступ к этим данным в процессе работы приложения
	// Использование: Yii::app()->params['Имя_параметра'];
	'params'=>array(
		// Данные формируются подобным образом
		'adminEmail' => 'soadmin@socode.ru',
        'description' => 'Сайт, на котором вы можете купить билет на любой сеанс в кино. Ticket - в кино без проблем!',
        'keywords' => 'Купить, Билеты, Кино, Билеты в кино, В кино без проблем',
	),
);