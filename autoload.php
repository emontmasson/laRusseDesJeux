<?php
function my_autoloader($class) {
   
    if(str_contains( $class,"Traits")) {
        include 'src/' . $class . '.trait.php';
    }
    else {
        include 'src/' . $class . '.class.php';
    }
   
    
}

spl_autoload_register('my_autoloader');

