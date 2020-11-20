<?php

namespace Source\Core;

/**
 * Class Route
 * @author Danilo Nunes de Andrade
 * @package Source\Core
 */
class Route
{
    /** @var string */
    private $controller;

    /** @var string */
    private $method;

    /** @var object */
    private $newController;
    
    /**
     * 
     * @return void
     */
    public function run(): void
    {
        $this->getUrl();
        $this->instanceController();
        $this->actionMethod();
    }
    
    /**
     * Faz a captura da url amigável
     * @return void
     */
    private function getUrl(): void
    {        
        if (!empty($_GET['url'])) {
            $url = array_filter(explode('/', $_GET['url']));
        
            $this->controller = $url[0];
        
            if (!empty($url[1])) {
                $this->method = $url[1];
            } else {
                $this->method = "index";
            }
        } else {
            $this->controller = "people";
            $this->method = "index";   
        }
    }
        
    /**
     * Faz instancia do controller
     * Sempre necessário que exista um controller notFound
     * @return void
     */
    private function instanceController(): void
    {
        if (!$this->controller || !$this->validateController()) {
            $this->controller = "notFound";
        }
        $namespace = "Source\App\Controllers\\". $this->controller . "Controller";
        $this->newController = new $namespace();
    }
    
    /**
     *  Aciona o método validando antes se existe no seu controller
     *  Sempre necessário que exista um método index em cada controller
     * @return void
     */
    private function actionMethod(): void
    {
        if (!$this->method || !$this->validateMethod()) {
            $this->method = "index";
        }
        $method = $this->method;
        $this->newController->$method();
    }
        
    /**
     * Valida se o arquivo controller existe em Source/App/Controllers
     * @return bool
     */
    private function validateController() : bool
    {
        if (file_exists(CONF_URL_BASE . "/Source/App/Controllers/" . $this->controller . "Controller.php")) {
            return true;
        }
        return false;
    }
        
    /**
     * Valida se o método existe na classe instanciada
     * @return bool
     */
    private function validateMethod(): bool
    {
        if (method_exists($this->newController, $this->method)) {
            return true;
        }
        return false;
    }
}
