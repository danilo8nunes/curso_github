<?php

namespace Source\App\Controllers;
use Source\Core\Controller;

class notFoundController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Contatos | 404",
            "alert" => ""
        ];
        $this->loadTemplate("404", $data);
    }
}