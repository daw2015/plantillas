<?php


class ManageCity {
    
    private $bd = null;
    private $tabla = "city";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($ID){
        //devuelve un objeto de la clase city
        $parametros = array();
        $parametros['ID'] = $ID;
        $this->bd->select($this->tabla, "*", "id=:ID", $parametros);
        $fila=$this->bd->getRow();
        $city = new City();
        $city->set($fila);
        return $city;
    }
    
    function delete($ID){
        $parametros = array();
        $parametros['ID'] = $ID;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    
    function deleteCities($parametros){
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(City $city){
        return $this->delete($city->getID());
    }
    
    function set(City $city){
        //Update de todos los campos menos el id, el id se usara como el where para el update numero de filas modificadas
        $parametrosSet=array();
        $parametrosSet['Name']=$city->getName();
        $parametrosSet['CountryCode']=$city->getCountryCode();
        $parametrosSet['District']=$city->getDistrict();
        $parametrosSet['Population']=$city->getPopulation();
        
        $parametrosWhere = array();
        $parametrosWhere['ID'] = $city->getID();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
        
    }
    
    function insert(City $city){
        //Se pasa un objeto city y se inserta, se devuelve el id del elemento con el que se ha insertado
        $parametrosSet=array();
        $parametrosSet['Name']=$city->getName();
        $parametrosSet['CountryCode']=$city->getCountryCode();
        $parametrosSet['District']=$city->getDistrict();
        $parametrosSet['Population']=$city->getPopulation();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }
    
    function getList($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        
        $ordenPredeterminado = "$orden, Name, CountryCode, ID";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "Name, CountryCode, ID";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", $condicion, $parametros , $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $city = new City();
             $city->set($fila);
             $r[]=$city;
         }
         return $r;
    }
    
    function getListJson($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        $lista = $this->getList($pagina, $orden, $nrpp, $condicion, $parametros);
        $r = "[ ";
        foreach ($lista as $objeto){
            $r .= $objeto->getJson() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }
    
     function getValuesSelect(){
        $this->bd->query($this->tabla, "ID, Name", array(), "Name");
        $array = array();
        while($fila=$this->bd->getRow()){
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
    
    function count($condicion="1 = 1", $parametros = array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

}
