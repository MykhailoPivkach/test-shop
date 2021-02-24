<?php
declare(strict_types=1);

namespace Core;

/**
 * Class App
 * @package Core
 */
class App
{
    public static function getAppDir(): string
    {
        return ROOT . DS . 'app';
    }

    public static function getLayoutDir(): string
    {
        return self::getAppDir() . DS . 'layouts';
    }
    /**
     *
     */
    public static function run(): void
    {
        Route::init();

        $controllerClass = '\\Controllers\\' . ucfirst(Route::getController()) . 'Controller';
        $controllerClassFile = self::getAppDir() . str_replace('\\', DS, $controllerClass) . '.php';
        if (!file_exists($controllerClassFile)) {
            $controllerClass = '\\Controllers\\ErrorController';
        }
        $action = Route::getAction() . 'Action';
        $controller = new $controllerClass();
        if (!method_exists($controller, $action)) {
            $controller = new \Controllers\ErrorController();
            $action = 'error404Action';
        }

        $result = $controller->$action();
        if ($result instanceof View) {
            $data = $result->getData();
            $data['content'] = $result;
            $layout = $controllerClass === "\\Controllers\\ErrorController"
                ? self::getLayoutDir() . DS. 'layout_404.php'
                : self::getLayoutDir() . DS. 'layout.php';

            // render default page layout
            $pageView = new View($data, $layout);
            echo $pageView->render();
        }
    }
}
