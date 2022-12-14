<?php

namespace app\controllers;

use app\core\Controller;
session_start();

class FinalizarController extends Controller{
     public function index(){
        session_destroy();
        header("Location: ". URL_BASE);
     }
 }
