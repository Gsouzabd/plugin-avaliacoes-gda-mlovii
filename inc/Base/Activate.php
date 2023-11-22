<?php
namespace Inc_GDA\Base;

class Activate{
    public static function activate(){
        flush_rewrite_rules();
    }


}