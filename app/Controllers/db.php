<?php
try {

    if (! @include_once( '../../vendor/autoload.php' )){} // @ - to suppress warnings, 
    // you can also use error_reporting function for the same purpose which may be a better option
     
    // or 
    if (!file_exists('../../vendor/autoload.php' )){}
     // throw new Exception ('functions.php does not exist');
    else{
      require_once('../../vendor/autoload.php' ); 
    }}
    catch(Exception $e) {    
      require_once ('./vendor/autoload.php');
    }
  
use Illuminate\Database\Capsule\Manager as Capsule;
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'final',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        
        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    
