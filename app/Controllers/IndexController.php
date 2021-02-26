<?php
namespace Controllers;

use Core\Controller;

/**
 * Class IndexController
 */
class IndexController extends Controller
{

    /**
     *
     */
    public function indexAction()
    {
        $this->set("title", "Test shop");
        $this->renderLayout();
    }

    /**
     *
     */
    public function testAction()
    {
        $this->set("title", "testAction");
        echo "hello from testAction";
    }

}