<?php

class Core{
    private $controller;
    private $metodo;
    private $parametros = array();
    
    public function __construct() {
        $this->verificaUri();
    }
    
    public function run(){
        $controllerCorrente = $this->getController();        
        
       $c = new $controllerCorrente;
       call_user_func_array(array($c, $this->getMetodo()), $this->getParametros());      
    //    echo "Dentro do core no instanciação do controller";
    //    echo "<hr>";
    }
    public function verificaUri(){
        $url =explode("index.php", $_SERVER["PHP_SELF"]);
        $url = end($url);

      //  echo "Dentro do core verificando Url";
    //    echo "<hr>";
      
        if($url!=""){
            $url = explode('/', $url);
            array_shift($url);
            
            //Pega o Controller
            $this->controller = ucfirst($url[0]) ."Controller";
      //      echo "Dentro do core pegando o controller ".$this->controller;
    //        echo "<hr>";

            array_shift($url);
            //Pega o Método
            if(isset($url[0])){
                $this->metodo = $url[0];
      //          echo "Dentro do core pegando o método ".$this->método;
     //            echo "<hr>";

                array_shift($url);
            }
            
            //Pegar os parâmetros
            if(isset($url[0])){
                $this->parametros= array_filter($url);
                
       //         echo "Vou dar um exit dentro do core pegando os parâmetros ".$this->parametros;
        //        echo "<hr>";
         //       exit;
            }
        }else{
            $this->controller = ucfirst(CONTROLLER_PADRAO) ."Controller";
            
           //     echo "Dentro do core no else pegando controller padrão ".$this->controller;
             //   echo "<hr>";
                //exit;

        }       
       
    }    
    public function getController() {
        if(class_exists(NAMESPACE_CONTROLLER .$this->controller)){
            return NAMESPACE_CONTROLLER .$this->controller;
        }
        return NAMESPACE_CONTROLLER .ucfirst(CONTROLLER_PADRAO) ."Controller";
    }

    public function getMetodo() {
        if(method_exists(NAMESPACE_CONTROLLER .$this->controller, $this->metodo)){
            return $this->metodo;            
        }
        
        return METODO_PADRAO;      
    }

    public function getParametros() {
        return $this->parametros;
    }


}
