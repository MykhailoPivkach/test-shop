<?php
namespace Controllers;

use Core\Controller;

/**
 * Class ErrorController
 */
class ErrorController extends Controller
{
    /**
     *
     */
    public function error404Action()
    {
        $this->set("title", "Test shop");
        return $this->renderLayout('app/views/error/error404.php');
    }


}