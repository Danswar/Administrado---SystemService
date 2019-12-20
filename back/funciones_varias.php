<?php

class Estado{

    public $color = "";
    public $etiq = "";

    function Estado( $stringEstado ){
        switch ($stringEstado) {
            
            case "ENTREGADO":
                $this->color = " style= 'background-color: blue !important;' ";
                $this->etiq ="E";
                break;
            
            case "PENDIENTE":
                $this->color = " style= 'background-color: #6699FF !important;' ";
                $this->etiq ="P";
                break;

            case "OK":
                $this->color = " style= 'background-color: green !important;' ";
                $this->etiq ="OK";
                break;
            
            case "NO":
                $this->color = " style= 'background-color: red !important;' ";
                $this->etiq ="NO";
                break;

            case "DEMORADO":
                $this->color = " style= 'background-color: purple !important;' ";
                $this->etiq ="D";
                break;

            case "CONSULTA":
                $this->color = " style= 'background-color: #FFCC00 !important;' ";
                $this->etiq ="??";
                break;

            case "SERV FORANEO":
                $this->color = " style= 'background-color: rgb(68, 66, 66) !important;' ";
                $this->etiq ="SF";
                break;

            case "CONTINUAR":
                $this->color = " style= 'background-color: #660099 !important;' ";
                $this->etiq ="C";
                break;

            case "HIBERNAR":
                $this->color = " style= 'background-color: rgb(68, 66, 66) !important;' ";
                $this->etiq ="SF";
                break;

            case "VISTO":
                $this->color = " style= 'background-color: green !important;' ";
                $this->etiq ="V";
                break;
                
            
        }
    }

    

}


?>