<?php
namespace Inc_GDA\Base;

class Database{
    public function register(){
        register_activation_hook( __FILE__, array($this,'create_avaliacoes_table'));
    }


    public function create_avaliacoes_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'avaliacoes';
    
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            especialista_id mediumint(9) NOT NULL,
            avaliador_nome varchar(255) NOT NULL,
            avaliador_email varchar(255) NOT NULL,
            avaliador_telefone varchar(20) NOT NULL,
            avaliacao int NOT NULL,
            aprovado boolean DEFAULT NULL,
            avaliador_comment text,
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
         dbDelta( $sql );
         echo $sql;
    }
    
}
