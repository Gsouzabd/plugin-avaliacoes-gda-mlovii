<?php

namespace Inc_GDA;

final class Init{


    /**
     * Store all the classes inside an array
     */
    public static function get_services(){
        return[
            Base\Functions::class,
            Base\SettingsLinks::class,
            Base\Database::class,
            Pages\Admin::class,
            Classes\EspecialistaCpt::class,
            Classes\Ajax::class
        ];
    }

    /**
     * Loop throug the classes, 
     * initialize them and call the register() method if it exists
     */
    public static function register_services(){

        foreach(self::get_services() as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }
        }

    }

    /**
     * Initialize the class
     */
    private static function instantiate($class){
        $service = new $class();
         return $service;
    }
}



