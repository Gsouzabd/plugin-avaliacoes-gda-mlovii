<?php

namespace Inc_GDA\Base;

class Functions{
    
    public function register(){

        add_action('wp_enqueue_scripts', array($this,'enqueue_my_scripts'));
        add_action('wp_enqueue_scripts', array($this,'enqueue_datatables'));

    }


	function enqueue_my_scripts() {
        wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    }
    function enqueue_datatables() {
        wp_enqueue_script('datatables', 'https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js', array('jquery'), '1.10.24', true);
        wp_enqueue_style('datatables-style', 'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css', array(), '1.10.24');
    }
    
}