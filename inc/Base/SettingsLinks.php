<?php

namespace Inc_GDA\Base;


class SettingsLinks{

    protected $plugin;

    public function __construct()
    {
        $this->plugin = GDA_BASENAME;
    }

    public function register(){

        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));

    }

    public function settings_link($links){
        $settings_link = '<a href="admin.php?page=gerenciador_de_avaliacoes">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }


}