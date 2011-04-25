<?php

class ItemModel {
  
  public static $__Items = array();
  
  protected $_file_name = '';
  protected $_config = array();
  
  public $options = array();
  public $extras = array();
  public $id = '';
  public $name = '';
  public $description = '';
  
  public function __construct($id) {
    $this->_file_name   = "items/$id.ini";
    
    if ( !file_exists($this->_file_name) ) {
      Logger::log("Config file doesn't exists", $this->_file_name, LOGGER_ERROR);
      return false;
    }
    
    if( !$this->_config = @ parse_ini_file($this->_file_name, true) ) {
      Logger::log("Couldn't load config file", $this->_file_name, LOGGER_ERROR);
      return false;
    }
    
    $this->id           = $id;
    $this->name         = $this->_config['main']['name'];
    $this->description  = $this->_config['main']['description'];
       
    foreach($this->_config as $section => $values) {
      if ( strpos($section, ':')!==false ) {
        list($type, $name) = explode(':', $section);
        if ( $type == 'option') {
          $this->options[$name]=$values;
        }
        if ( $type == 'extra') {
          $this->extras[$name]=$values;
        }
      }  
    }
  }
  
  public static function getAllItems() {
    if( !count(self::$__Items) ) {
      $items = Utils::preg_ls('items/', false, "/.*\.ini/i");
      foreach($items AS $file_name) {
        $id = substr(basename($file_name), 0, -4);
        $Item = new ItemModel($id);
        self::$__Items[$id] = $Item;  
      }
    }
    return self::$__Items;   
  }
  
  public function saveContent($content) {
    return file_put_contents($this->_file_name, $content);
  }
  
  public function getContent(){
    return file_get_contents($this->_file_name);
  }
  
}