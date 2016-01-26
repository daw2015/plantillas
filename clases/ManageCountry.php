<?php

class ManageCountry {
    
    private $bd = null;
    private $tabla = "country";
    
    function __construct($bd) {
        $this->bd = $bd;
    }

    function get($Code) {
        $parametros = array();
        $parametros["Code"] = $Code;
        $this->bd->select($this->tabla, "*", "Code =:Code", $parametros);
        $fila = $this->bd->getRow();
        $country = new Country();
        $country->set($fila);
        return $country;
    }
    
    function delete($Code) {
        //borrar por id
        //borrar por id
        $parametros = array();
        $parametros["Code"] = $Code;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
        function forzarDelete($Code) {
        $parametros = array();
        $parametros['CountryCode'] = $Code;
        $gestor = new ManageCity($this->bd);
        $gestor->deleteCities($parametros);
        $this->bd->delete("countrylanguage", $parametros);
        $parametros = array();
        $parametros["Code"] = $Code;
        return $this->delete($this->tabla, $parametros);
    }
    
    function erase(City $city) {
        //borrar por nombre
        //dice ele numero de filas borratas
        return $this->delete($city->getID());
    }
    
    function set(Country $country, $pkCode/*vieja*/) {
        //update de todos los campos 
        //pasamos el codigo que tenia y como en este si se puede cambiar el codigo, cambiamos todos los campos
        //dice el numero de filas modificades
        $parametros = $country->getArray();
        $parametrosWhere = array();
        $parametrosWhere["Code"] = $pkCode;
        $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
    
    function insert(Country $country) {
        //se le pasa un objeto City y lo inserta en la tabla
        //dice el numero de filas insertadas;
        //En este momento es donde se validan los datos;
        $parametros = $country->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getList() {
        $this->bd->select($this->tabla, "*", "1=1", array(), "Name, Continent, Code");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $country = new Country();
            $country->set($fila);
            $r[] = $country;
        }
        return $r;
    }
    
    function getValuesSelect() {
        $this->bd->query($this->tabla, "Code, Name", array(), "Name");
        $array = array();
        while ($fila = $this->bd->getRow()){
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
    

}
