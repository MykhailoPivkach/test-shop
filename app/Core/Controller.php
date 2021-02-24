<?php
namespace Core;

/**
 * Class Controller
 */
class Controller
{
    protected $data = [];

    public function __construct() {
        $this->set('menu', $this->getMenu());
    }
    
    public function getBP() {
        return Route::getBP();      
    }

    protected function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    protected function get($key)
    {
        return $this->data[$key];
    }

    public function renderLayout($contentPath = null)
    {
        $data = $this->data;
        $view = new View($data, $contentPath);
        return $view;
    }

     /**
     * @param $name
     * @return mixed
     */
    public function getModel($name)
    {
        $name = '\\Models\\' . ucfirst($name);
        $model = new $name();
        return $model;
    }

     /**
     * @return mixed
     */
     private function getMenu()
     {
        return $this->getModel('menu')
            ->initCollection()
            ->sort(array('sort_order'=>'ASC'))
            ->getCollection()
            ->select();
     }
    
}