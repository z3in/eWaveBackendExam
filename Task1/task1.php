<?php

class ParseFile extends Exception{
    protected $_data;
    protected $_result = [];

    public function __construct($file){
        try{
            if(!file_exists($file)){
                throw new Error('File not Found!');
            }
            $this->_data = file_get_contents($file);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function getData(): array{
        return $this->_result;    
    }

    public function convertToString(){
        $this->_result = explode("\n",$this->_data);
        return $this;
    }

    public function converToObject(){
        $this->_result = json_decode($this->_data,true);
        return $this;
    }


}
/** extendable to new data type if they want */
class ParseNumberFile extends ParseFile{

    public function convertToInt(){
         $temp = explode("\n",$this->_data);
         foreach ($temp as $val){
            array_push($this->_result,intval($val));
         }
        return $this;
    }
}

$data = new ParseNumberFile('textfile.txt');
echo '<pre>';
var_dump($data->convertToInt()->getData());
echo '</pre>';

$parse = new ParseFile('product.json');
echo '<pre>';
var_dump($parse->converToObject()->getData());
echo '</pre>';