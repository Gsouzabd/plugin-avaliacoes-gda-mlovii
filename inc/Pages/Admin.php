<?php

namespace Inc_GDA\Pages;

class Admin {

    public function register() {
        add_action('admin_menu', array($this, 'add_admin_pages'), 20);
    }

    public function add_admin_pages() {
        add_menu_page(
            'Gerenciador de Avaliações',
            'Gerenciador de Avaliações',
            'manage_options',
            'gerenciador_de_avaliacoes',
            array($this, 'admin_index'),
            'dashicons-star-half',
            null
        );
    
        // Add a submenu page
        add_submenu_page(
            'gerenciador_de_avaliacoes', 
            'Painel de Avaliações', 
            'Painel de Avaliações', 
            'manage_options', 
            'dashboard_gda', 
            array($this, 'load_dashboard_template'),
            5
        );


        // Add a submenu page
        add_submenu_page(
            'gerenciador_de_avaliacoes', 
            'Avaliações', 
            null, 
            'manage_options', 
            'avaliacoes_gda', 
            array($this, 'load_avaliacoes_template') 
        );
    }

    public function load_dashboard_template() {
        include_once plugin_dir_path(__FILE__) . '../../templates/dashboard.php';
    }

    public function load_avaliacoes_template() {
        include_once plugin_dir_path(__FILE__) . '../../templates/avaliacoes.php';
    }
    
    
}
