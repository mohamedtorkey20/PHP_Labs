<?php

require 'vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

class MySQLHandler implements DbHandler {

     private $capsule; 
     

     function  __construct()
     {
        $this->capsule = new Capsule;
           $this->connect();
     }

    public function connect(){
     
        try {
          
            $this->capsule->addConnection([
                "driver" => "mysql",
                "host" => __HOST__,
                "database" => __DB__,
                "username" => __USERNAME__,
                "password" => __PASSWORD__
            ]);
            $this->capsule->setAsGlobal();
            $this->capsule->bootEloquent();
        } catch (Exception $ex) {
            die("ERROR:" . $ex->getMessage());
        }
    }

    public function disconnect(){
        $this->capsule->getConnection()->disconnect();
    }
    
    
}


class User extends Model {
    protected $table = TABLE;
}

?>