<?php


class Country {
    private $Code, $Name, $Continent, $Region, $SurfaceArea, $IndepYear, 
            $Population, $LifeExpectancy, $GNP, $GNPOld, $LocalName, 
            $GovernmentForm, $HeadOfState, $Capital, $Code2;
    
    function __construct($Code=null, $Name=null, $Continent=null, 
            $Region=null, $SurfaceArea=null, $IndepYear=null, 
            $Population=null, $LifeExpectancy=null, $GNP=null, $GNPOld=null, 
            $LocalName=null, $GovernmentForm=null, $HeadOfState=null,
            $Capital=null, $Code2=null) {
        $this->Code = $Code;
        $this->Name = $Name;
        $this->Continent = $Continent;
        $this->Region = $Region;
        $this->SurfaceArea = $SurfaceArea;
        $this->IndepYear = $IndepYear;
        $this->Population = $Population;
        $this->LifeExpectancy = $LifeExpectancy;
        $this->GNP = $GNP;
        $this->GNPOld = $GNPOld;
        $this->LocalName = $LocalName;
        $this->GovernmentForm = $GovernmentForm;
        $this->HeadOfState = $HeadOfState;
        $this->Capital = $Capital;
        $this->Code2 = $Code2;
    }

    public function getCode() {
        return $this->Code;
    }

    public function getName() {
        return $this->Name;
    }

    public function getContinent() {
        return $this->Continent;
    }

    public function getRegion() {
        return $this->Region;
    }

    public function getSurfaceArea() {
        return $this->SurfaceArea;
    }

    public function getIndepYear() {
        return $this->IndepYear;
    }

    public function getPopulation() {
        return $this->Population;
    }

    public function getLifeExpectancy() {
        return $this->LifeExpectancy;
    }

    public function getGNP() {
        return $this->GNP;
    }

    public function getGNPOld() {
        return $this->GNPOld;
    }

    public function getLocalName() {
        return $this->LocalName;
    }

    public function getGovernmentForm() {
        return $this->GovernmentForm;
    }

    public function getHeadOfState() {
        return $this->HeadOfState;
    }

    public function getCapital() {
        return $this->Capital;
    }

    public function getCode2() {
        return $this->Code2;
    }

    public function setCode($Code) {
        $this->Code = $Code;
    }

    public function setName($Name) {
        $this->Name = $Name;
    }

    public function setContinent($Continent) {
        $this->Continent = $Continent;
    }

    public function setRegion($Region) {
        $this->Region = $Region;
    }

    public function setSurfaceArea($SurfaceArea) {
        $this->SurfaceArea = $SurfaceArea;
    }

    public function setIndepYear($IndepYear) {
        $this->IndepYear = $IndepYear;
    }

    public function setPopulation($Population) {
        $this->Population = $Population;
    }

    public function setLifeExpectancy($LifeExpectancy) {
        $this->LifeExpectancy = $LifeExpectancy;
    }

    public function setGNP($GNP) {
        $this->GNP = $GNP;
    }

    public function setGNPOld($GNPOld) {
        $this->GNPOld = $GNPOld;
    }

    public function setLocalName($LocalName) {
        $this->LocalName = $LocalName;
    }

    public function setGovernmentForm($GovernmentForm) {
        $this->GovernmentForm = $GovernmentForm;
    }

    public function setHeadOfState($HeadOfState) {
        $this->HeadOfState = $HeadOfState;
    }

    public function setCapital($Capital) {
        $this->Capital = $Capital;
    }

    public function setCode2($Code2) {
        $this->Code2 = $Code2;
    }

    public function getJson() {
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '"' . ':' . '"' . $valor . '"' . ',' ;
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }
    
    function set($valores, $inicio=0) {
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i+$inicio];
            $i++;
        }
    }
    
    public function __toString() {
        $r = '';
        foreach ($this as $key => $valor){
            $r .= "$valor ";
        }
        return $r;
    }
    
    public function getArray($valores=true) {
        $array = array();
        foreach ($this as $key => $valor) {
            if($valores===true){
                $array[$key] = $valor;
            }else{
                $array[$key] = null;
            }
        }
        return $array;
    }
    
    function read() {
        foreach ($this as $key => $valor){
            $this->$key = Request::req($key);
        }
    }

}
