<?php


require_once "vendor/autoload.php";
   
class visitor implements visitor_interface{

    private $counter;
   
    function  __construct()
    {

      session_start();
      $_SESSION["flag"];

//-------check if counter value----------------------------------
      if(file_exists(COUNTER_FILE))
      {
         $hf=fopen(COUNTER_FILE,"r");
         $this->counter=intval(fgetc($hf));
         
      }else{
         $this->counter=0;
      }
      
      
    }


//----------adding vistor to file counter.txt---------------------
   public function add_of_visitor()
   {
    
     if($_SESSION["flag"]==false)
     {
       $_SESSION["flag"]=true;
     
          $this->counter++;
         $hf=fopen(COUNTER_FILE,"w");
         
            fwrite($hf,$this->counter);
            fclose($hf);
     }else{
      echo "<h2>you are already visitor<h2>";
     }
   }

//-------------get counter of visitors in file counter.txt--------------
   public function get_count_of_visitors()
   {
      if(file_exists(COUNTER_FILE))
      {
         $hf=fopen(COUNTER_FILE,"r");
         return  intval(fgetc($hf));
      }
       die("there aren't visitor yet");
   }

}



?>