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
  
  public function __construct($file_name) {
    $this->_file_name   = $file_name;
    
    if ( !file_exists($file_name) ) {
      Logger::log("Config file doesn't exists", $file_name, LOGGER_ERROR);
      return false;
    }
    
    if( !$this->_config = @ parse_ini_file($file_name, true) ) {
      Logger::log("Couldn't load config file", $file_name, LOGGER_ERROR);
      return false;
    }
    
    $this->id           = substr(basename($file_name), 0, -4);
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
      foreach($items AS $item) {
        $id = substr(basename($item), 0, -4);
        $Item = new ItemModel($item);
        self::$__Items[$id] = $Item;  
      }
    }
    return self::$__Items;   
  }
  
  
}