<?php
namespace App\Traits;

trait ManagerObject {
   function getProperties($class) {

    //Instantiate the reflection object
    $reflector = new \ReflectionClass($class);

    //Now get all the properties from class A in to $properties array
    $properties = $reflector->getProperties();

   $tabProperties = array();

    foreach($properties as $protertie) {
    
      $tabProperties[] =  $protertie->name;
    }

    return $tabProperties;
   }
}