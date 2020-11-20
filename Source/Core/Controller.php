<?php

namespace Source\Core;

class Controller
{
    public function loadView(string $viewName, array $viewData = array())
    {
        extract($viewData);
        require CONF_URL_BASE . "/Source/App/Views/". $viewName . ".php";
    }

    public function loadTemplate(string $viewName, array $viewData = array())
    {
        extract($viewData);
        require CONF_URL_BASE . "/Source/App/Views/template.php";
    }

    public function loadViewInTemplate(string $viewName, $viewData = array())
    {
        extract($viewData);
        require CONF_URL_BASE . "assets/views/". $viewName . ".php";
    }
}
