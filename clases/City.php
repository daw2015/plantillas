<?php

//POJO - plana
class City {
    private $ID, $Name, $CountryCode, $District, $Population;
    
    //1º Constructor -> null
    function __construct($ID = null, $Name = null, $CountryCode = null, $District = null, $Population = null) {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->CountryCode = $CountryCode;
        $this->District = $District;
        $this->Population = $Population;
    }
    
    //2º getter y setter
    public function getID() {
        return $this->ID;
    }

    public function getName() {
        return $this->Name;
    }

    public function getCountryCode() {
        return $this->CountryCode;
    }

    public function getDistrict() {
        return $this->District;
    }

    public function getPopulation() {
        return $this->Population;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setName($Name) {
        $this->Name = $Name;
    }

    public function setCountryCode($CountryCode) {
        $this->CountryCode = $CountryCode;
    }

    public function setDistrict($District) {
        $this->District = $District;
    }

    public function setPopulation($Population) {
        $this->Population = $Population;
    }

    //3º getJson
    public function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            //$r .= '"' .$indice . '":"' .$valor. '",';
            //$r .= '"' .$indice . '":"' . json_encode(htmlspecialchars_decode($valor)). '",';
            $r .= '"' .$indice . '":' . json_encode($valor). ','; //Se codifican algunos caracteres
        }
        $r = substr($r, 0,-1);
        $r .='}';
        return $r;
    }
    
    //4º set genérico
    function setOld($valores, $inicio=0){
        $this->ID = $valores[0+$inicio];   
        $this->Name = $valores[1+$inicio];   
        $this->CountryCode = $valores[2+$inicio];   
        $this->District = $valores[3+$inicio];   
        $this->Population = $valores[4+$inicio];   
    }
    
    function set($valores, $inicio=0){
        $i = 0;
        foreach ($this as $indice => $valor) {
           $this->$indice = $valores[$i+$inicio];
           $i++;
        }
    }
    
    public function __toString() {
        $r ='';
        foreach ($this as $key => $valor) { 
            $r .= "$valor ";
        }
        return $r;
    }
    
    function read() {
        foreach ($this as $key => $valor){
            $this->$key = Request::req($key);
        }
    }
}
