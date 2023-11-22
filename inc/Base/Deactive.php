<?php
namespace Inc_GDA\Base;


class Deactive{
    public static function deactivate(){

        flush_rewrite_rules();
    }


}