<?php

require_once "vendor/autoload.php";
  

   $obj_visitor=new visitor();

   // call add_of_visitor function to add one visitor
   $obj_visitor->add_of_visitor();
  $Counter=$obj_visitor->get_count_of_visitors();


  echo "Counted Unique Visitors:".$Counter;

?>