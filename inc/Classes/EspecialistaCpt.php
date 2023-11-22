<?php
namespace Inc_GDA\Classes;
use WP_Query;
use Error;

class EspecialistaCpt{

    function register(){
        add_action('init', array($this,'register_especialista_post_type'));
        add_action('admin_menu', array($this, 'add_submenu_page'));

        add_action('add_meta_boxes', array($this, 'add_custom_fields_meta_box'));
        add_action('save_post', array($this, 'save_custom_fields_data'));

        // add_action('admin_menu', array($this, 'remove_default_fields'));
        add_action('post_edit_form_tag', array($this,'update_edit_form'));

        add_shortcode('shortcode_especialista', array($this,'shortcode_especialista'));

    }

    function register_especialista_post_type() {
        $labels = array(
            'name'               => _x('Especialista', 'post type general name', 'starpoint-review-manager'),
            'singular_name'      => _x('Especialista', 'post type singular name', 'starpoint-review-manager'),
            'menu_name'          => _x('Especialista', 'admin menu', 'starpoint-review-manager'),
            'menu_icon' => 'dashicons-admin-post',
            'name_admin_bar'     => _x('Especialistas', 'add new on admin bar', 'starpoint-review-manager'),
            'add_new'            => _x('Add New', 'especialista', 'starpoint-review-manager'),
            'add_new_item'       => __('Add New Especialista', 'starpoint-review-manager'),
            'new_item'           => __('New Especialista', 'starpoint-review-manager'),
            'edit_item'          => __('Edit Especialista', 'starpoint-review-manager'),
            'view_item'          => __('View Especialista', 'starpoint-review-manager'),
            'all_items'          => __('All Especialista', 'starpoint-review-manager'),
            'search_items'       => __('Search Especialista', 'starpoint-review-manager'),
            'parent_item_colon'  => __('Parent Especialista:', 'starpoint-review-manager'),
            'not_found'          => __('No especialista found.', 'starpoint-review-manager'),
            'not_found_in_trash' => __('No especialista found in Trash.', 'starpoint-review-manager')
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => false,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'especialista-cpt'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title', 'thumbnail',),
            'with_front' => true
            
        );

        register_post_type('especialista-cpt', $args);
    }


    public function add_submenu_page() {
        add_submenu_page(
            'gerenciador_de_avaliacoes',
            'Especialistas', 
            'Especialistas', 
            'manage_options', 
            'edit.php?post_type=especialista-cpt',
            '',
            100
        );
    }


    public function add_custom_fields_meta_box() {
        add_meta_box(
            'especialista_custom_fields', 
            'Especialista',
            array($this, 'render_custom_fields_meta_box'), 
            'especialista-cpt', 
            'normal', 
            'high' 
        );
    }

    public function render_custom_fields_meta_box($post) {
        $nome = get_post_meta($post->ID, '_nome', true);
        $especialidade = get_post_meta($post->ID, '_especialidade', true);
        $descricao = get_post_meta($post->ID, '_descricao', true);

        echo '<div class="form-wide">';
            echo '<label for="nome"><strong>Nome:</strong></label><br/>';
            echo '<input type="text" id="nome" name="nome" value="' . esc_attr($nome) . '" /><br><br/>';
        echo '</div>';
        echo '<div class="form-wide">';
            echo '<label for="descricao"><strong>Descrição:</strong></label><br/>';
            echo '<textarea  id="descricao" name="descricao" rows="5" cols="33" value="' . esc_attr($descricao) . '" />' . esc_attr($descricao) . '</textarea><br><br/>';
        echo '</div>';
        echo '<label for="especialidade"><strong>Especialidade:</strong></label><br/>';
        echo '<input type="text" id="especialidade" name="especialidade" value="' . esc_attr($especialidade) . '" /><br/><br/>';
        echo '<span>SHORTCODE: [shortcode_especialista id='.$post->ID.']</span>';
    }

    public function save_custom_fields_data($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
        if ($post_id) {
            if (isset($_POST['nome'])) {
                $nome = sanitize_text_field($_POST['nome']);
                update_post_meta($post_id, '_nome', $nome);
            }

            if (isset($_POST['descricao'])) {
                $descricao = sanitize_text_field($_POST['descricao']);
                update_post_meta($post_id, '_descricao', $descricao);
            }
    
            if (isset($_POST['especialidade'])) {
                $especialidade = sanitize_text_field($_POST['especialidade']);
                update_post_meta($post_id, '_especialidade', $especialidade);
            }
        }
    }
    
    
    function update_edit_form() {
        echo ' enctype="multipart/form-data"';
    }

   

    /*
    ** @PARAM[$atts : id do cpt]
    ** SHORTCODE INDIVIDUAL 
    */
    function shortcode_especialista($atts) {
        $atts = shortcode_atts(
            array(
                'id'             => null,
                'posts_per_page' => 5,
            ),
            $atts,
            'cpt_shortcode_com_id'
        );
    
        if (empty($atts['id'])) {
            return 'O parâmetro "id" é obrigatório para este shortcode.';
        }
    
        $query_args = array(
            'post_type'      => 'especialista-cpt',
            'posts_per_page' => 1,
            'p'              => $atts['id'],
        );
    
        $especialista_posts = new WP_Query($query_args);
        ob_start();
        $ajax = new Ajax();
        $args = array(
            'post_type' => 'especialista-cpt',
            'posts_per_page' => -1,
        );
        
        if ($especialista_posts->have_posts()):?>
    
            <?php while ($especialista_posts->have_posts()):
                $especialista_posts->the_post();
                $id = get_the_ID();
                $id = get_the_ID();
                $nome = get_post_meta($id, '_nome', true);
                $thumbnail = get_the_post_thumbnail_url($id);
                $especialidade = get_post_meta($id, '_especialidade', true);
                $descricao = get_post_meta($id, '_descricao', true);
                $avaliacao = get_post_meta($id, '_avaliacao', true); 
                $numeroAvaliacoes = get_post_meta($id, '_numero_avaliacoes', true)
            ?>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            </head>
            <body>
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <img src="<?= $thumbnail ?>" class="rounded float-start" alt="..." width="100%">
                    </div>
                    <div class="col">
                        <h5> <?=$nome?> </h5>
                        <p> <?= $especialidade ." – ". $descricao ?> </p>
                        <div class="input-group mb-3">
                            <label class="label_ratting">Fale um pouco sobre você</label>    
                        </div>
                        <form action="" id="especialista-avaliacao-form">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="avaliador-nome" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="avaliador-email"  placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="avaliador-telefone"  placeholder="Telefone" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        
                            <div class="input-group mb-3 ratting">
                            <label class="label_ratting">Avaliação Geral: </label>    
                            <div class="rating">
                                <input type="radio" id="star5" name="avaliacao" value="5">
                                <label for="star5"></label>
                                <input type="radio" id="star4" name="avaliacao" value="4">
                                <label for="star4"></label>
                                <input type="radio" id="star3" name="avaliacao" value="3">
                                <label for="star3"></label>
                                <input type="radio" id="star2" name="avaliacao" value="2">
                                <label for="star2"></label>
                                <input type="radio" id="star1" name="avaliacao" value="1">
                                <label for="star1"></label>
                            </div>
                            
                            </div>
                            <p>De 1 a 5 estrelas, como avalia a experiência?</p>
                            <div class="input-group">
                                <textarea class="form-control" aria-label="With textarea" name="avaliador-comment"></textarea>
                            </div>
                            <input type="hidden" id="especialista-id" value="<?=$id?>">
                            <center><button type="submit" class="btn btn-success">Enviar</button><center>
                        </form>
                    </div>
                </div>
            </div>
            </body>
            
            <?php endwhile;?>
                <style>
                    .checked {
                        color: orange;
                    }
                    .logo{
                        height: 80px;
                        width: auto;
                        height: 70px;
                        display: block;
                    }
                    header {
                        padding: 30px;
                        margin: 0px 0px 10px 0px;
                        background-color: white;
                        margin: 15px;
                        border-radius: 10px;
                        display:flex;
                        justify-content: space-between;
                    }
                    body {
                        background-image: url(https://realortopediacto.com.br/wp-content/uploads/2023/08/1920X1200-EQUIPE-2-DIREITA.png);
                        background-size: cover;
                        background-repeat: no-repeat;
                        /* background-position: right; */
                        min-height: 100vh;
                    }
                    body .is-layout-constrained > :where(:not(.alignleft):not(.alignright):not(.alignfull)){
                        max-width: 1100px;
                    }
                    span.fa.fa-star {
                        font-size: 35px;
                        margin: 0 15px;
                    }
                    .label_ratting{
                        font-size: 24px;
                        margin-right: 15px;
                    }
                    .row {
                        text-align: left;
                    }
                    textarea.form-control {
                        min-height: 100px;
                    }
                    a {
                        text-decoration: none;
                    }

                    li {
                        text-decoration: none;
                        list-style: none;
                        font-size: 15px;
                    }
                    ul {
                        margin:0;
                    }
                    .menu, .socialicons {
                        max-height: 25px;
                        padding: 30px;
                    }
                    .menu a, .socialicons a {
                        font-size: 18px;
                        color: black;
                        font-weight: 500;

                    }
                    .menu li a, .socialicons li a {
                        margin: 0px 16px;
                    }
                    span.fa.fa-star:hover {
                        color: gold;
                        transition: all 500ms linear;
                    }
                    .input-group.mb-3.ratting {
                        margin: 0!important;
                    }
                    .rating {
                        unicode-bidi: bidi-override;
                        direction: rtl;
                        text-align: left;
                    }

                    .rating input {
                        display: none;
                    }

                    .rating label {
                        display: inline-block;
                        font-size: 25px;
                        cursor: pointer;
                    }

                    .rating label::before {
                        content: '\2605';
                        color: #ccc;
                    }

                    .rating input:checked ~ label::before,
                    .rating label:hover ~ label::before {
                        color: #ffcc00;
                    }
                    button.btn.btn-success {
                        width: 200px;
                        margin: 15px 8px;
                    }
                    footer {
                        position: fixed;
                        bottom: 0;
                        background-color: #f0fdfb;
                        width: 100%;
                        padding: 15px 40px;
                    }
                    footer .col {
                        text-align: center;
                    }
                    @media only screen and (max-width:600px){
                        .menu, .socialicons{
                            display: none;
                        }
                        img.rounded.float-start {
                            width: 100%;
                            margin-bottom: 10px;
                        }
                        .row {
                            display: block;
                            text-align: center;
                        }
                        footer {
                            position: relative;
                        }
                    }
                    </style>

                    <script>
                        const ratingInputs = document.querySelectorAll('.rating input');
                        const ratingValue = document.getElementById('ratingValue');

                        for (let i = 0; i < ratingInputs.length; i++) {
                            ratingInputs[i].addEventListener('change', function () {
                                ratingValue.textContent = this.value;
                            });
                        }

                        jQuery(document).ready(function($) {
                            $("#especialista-avaliacao-form").submit(function(e) {
                                e.preventDefault();

                                var form = $(this);
                                var avaliacao = $('input[name="avaliacao"]:checked').val();
                                var especialistaID = $("#especialista-id").val();
                                var avaliadorNome = $("input[name='avaliador-nome']").val();
                                var avaliadorEmail = $("input[name='avaliador-email']").val();
                                var avaliadorTelefone = $("input[name='avaliador-telefone']").val();
                                var avaliadorComment = $("textarea[name='avaliador-comment']").val();

                                if (!avaliacao || !avaliadorNome || !avaliadorEmail || !avaliadorTelefone || !avaliadorComment) {
                                    alert('Preencha todos os campos.');
                                    return;
                                }

                                $.ajax({
                                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                    type: 'POST',
                                    data: {
                                        action: 'submit_avaliacao',
                                        avaliacao: avaliacao,
                                        especialista_id: especialistaID,
                                        'avaliador-nome': avaliadorNome,
                                        'avaliador-email': avaliadorEmail,
                                        'avaliador-telefone': avaliadorTelefone,
                                        'avaliador-comment': avaliadorComment,
                                    },
                                    success: function(response) {
                                        console.log(response)
                                        if (response.success) {
                                            alert('Avaliação enviada com sucesso!');
                                            form.hide();
                                        } else {
                                            alert('Error: ' + response);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        alert('AJAX Error: ' + error);
                                    }
                                });
                            });
                        });

                    </script>

       <?php endif;
        wp_reset_postdata();
    
        return ob_get_clean();
    }
    
}




