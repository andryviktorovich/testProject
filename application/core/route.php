<?php

class Route
{
	static public $routes = null;

	static function start()
	{
		if (self::$routes == null) {
			$url = explode('?', substr(strtolower($_SERVER['REQUEST_URI']), 1));
			self::$routes = explode('/', $url[0]);
		}
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';

		// получаем имя контроллера
		if ( !empty(self::$routes[0]) ) {
			$controller_name = self::$routes[0];
		}
		
		// получаем имя экшена
		if ( !empty(self::$routes[1]) ) {
			$action_name = self::$routes[1];
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path)) {
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path)) {
			include "application/controllers/".$controller_file;
		} else {
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller, $action)) {
			// вызываем действие контроллера
			$controller->$action();
		} else {
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
