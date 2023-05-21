<?php
//фронт-контроллер - контроллер, в котором происходит обработка входящих запросов и создаются другие контроллеры
spl_autoload_register(function (string $className){
    require_once('../src/'.$className.'.php');
});

$route = $_GET['route'] ?? "";
$routes = require_once('../src/routes.php');
$isRouteFound = false;

foreach($routes as $pattern=>$controllerAndAction){

//    $pattern=>$controllerAndAction
//    имеет вид
//    '~^$~' => [Controllers\MainController::class, 'main']


    preg_match($pattern, $route, $matches);
    if (!empty($matches)){
        $isRouteFound = true;
        break;
    }
}
if (!$isRouteFound){
    echo 'Страница не найдена';
    return;
}

unset($matches[0]);
$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

//определяет адрес страницы и вызывает соответствующий метод класса
$controller = new $controllerName;
$controller->$actionName(...$matches);
