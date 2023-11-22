<?php
namespace Inc_GDA\Classes;
use WP_Query;
use Error;

class Ajax{

    function register(){
        add_action('wp_ajax_submit_avaliacao',  array($this,'submit_avaliacao'));
        add_action('wp_ajax_nopriv_submit_avaliacao',  array($this,'submit_avaliacao'));
        add_action('wp_ajax_deny_evaluation', array($this,'deny_evaluation_callback'));
        add_action('wp_ajax_nopriv_deny_evaluation', array($this,'deny_evaluation_callback'));
        add_action('wp_ajax_approve_evaluation', array($this,'approve_evaluation'));
        add_action('wp_ajax_nopriv_approve_evaluation', array($this,'approve_evaluation'));
    }

    function submit_avaliacao() {
        try {
            $avaliacao = floatval($_POST['avaliacao']);
            $especialista_id = intval($_POST['especialista_id']);

            
            // Avaliador
            global $wpdb;
            $table_name = $wpdb->prefix . 'gda_avaliacoes';
            $avaliador_nome = sanitize_text_field($_POST['avaliador-nome']);
            $avaliador_email = sanitize_email($_POST['avaliador-email']);
            $avaliador_telefone = sanitize_text_field($_POST['avaliador-telefone']);
            $avaliador_comment = sanitize_textarea_field($_POST['avaliador-comment']);
            
        
            $wpdb->insert(
                $table_name,
                array(
                    'especialista_id' => $especialista_id,
                    'avaliador_nome' => $avaliador_nome,
                    'avaliador_email' => $avaliador_email,
                    'avaliador_telefone' => $avaliador_telefone,
                    'avaliacao' => $avaliacao,
                    'avaliador_comment' => $avaliador_comment,
                )
            );
            wp_send_json_success('Avaliação enviada com sucesso!');

        } catch (\Throwable $th) {
            wp_send_json_error('Error: Something went wrong.');
        }
    }
    

    function approve_evaluation() {
        try{
            $evaluationId = isset($_POST['evaluation_id']) ? intval($_POST['evaluation_id']) : 0;
            $especialista_id = isset($_POST['especialista_id']) ? intval($_POST['especialista_id']) : 0;

            $numeroAvaliacoes = get_post_meta($especialista_id, '_numero_avaliacoes', true);
            $pontuacao = get_post_meta($especialista_id, '_avaliacao', true);
        
            if (!empty($numeroAvaliacoes)) {
                $numeroAvaliacoes = intval($numeroAvaliacoes) + 1;
            } else {
                $numeroAvaliacoes = 1;
            }
            update_post_meta($especialista_id, '_numero_avaliacoes', $numeroAvaliacoes);
        
            global $wpdb;
            $query = $wpdb->prepare("SELECT avaliacao FROM {$wpdb->prefix}gda_avaliacoes WHERE id = %d", $evaluationId);
    
            $avaliacao = $wpdb->get_var($query);   

            if (!empty($pontuacao)) {
                $pontuacao = floatval($pontuacao) + $avaliacao;
            } else {
                $pontuacao = $avaliacao;
            }
            update_post_meta($especialista_id, '_avaliacao', $pontuacao);

            $wpdb->update(
                "{$wpdb->prefix}gda_avaliacoes",
                array('aprovado' => true),
                array('id' => $evaluationId),
                array('%d'),
                array('%d') 
            );
            
        
            wp_send_json_success("Aprovado com sucesso");
        } catch (\Throwable $th) {
            wp_send_json_error('Error:' . $th);
        }
    }



    function deny_evaluation_callback() {
        $evaluationId = intval($_POST['evaluation_id']);
        global $wpdb;


        $wpdb->update(
            "{$wpdb->prefix}gda_avaliacoes",
            array('aprovado' => false),
            array('id' => $evaluationId),
            array('%d'),
            array('%d') 
        );

        wp_send_json_success("Negado com sucesso");
    }


}