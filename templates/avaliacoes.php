<?php
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        global $wpdb;

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $args = array(
            'post_type'      => 'especialista-cpt',
            'posts_per_page' => -1,
            'p'              => $id,
        );


        $specialista_query = new WP_Query($args);
        while ($specialista_query->have_posts()) :
            $specialista_query->the_post();
            $especialista_id = get_the_ID();
            $evaluations = $wpdb->get_results($wpdb->prepare(
                "SELECT * FROM wp_gda_avaliacoes WHERE especialista_id = %d",
                $especialista_id
            ));

            if ($evaluations) :
            ?>
                <h2><?php the_title(); ?> - Avaliações</h2>
                <table id="avliacoes-table" class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Nota</th>
                            <th>Commentário</th>
                            <th> Nome</th>
                            <th> Email</th>
                            <th> Telefone</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($evaluations as $evaluation) :
                            ?>
                            <tr>
                                <td><?php echo $evaluation->avaliacao; ?></td>
                                <td><?php echo $evaluation->avaliador_comment; ?></td>
                                <td><?php echo $evaluation->avaliador_nome; ?></td>
                                <td><?php echo $evaluation->avaliador_email; ?></td>
                                <td><?php echo $evaluation->avaliador_telefone; ?></td>
                                <td>
                                    <?php if(is_null($evaluation->aprovado)):?>
                                        <span>Aguardando</span>
                                    <?php endif;?>

                                    <?php if($evaluation->aprovado == 1):?>
                                        <span> Aprovado</span>
                                    <?php elseif($evaluation->aprovado == 0 && !is_null($evaluation->aprovado)):?>
                                        <span> Negado</span>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if($evaluation->aprovado === null):?>
                                        <button onclick="approveEvaluation(<?=$evaluation->id;?>, <?=$evaluation->especialista_id;?>)">Aprovar</button>
                                        <button onclick="denyEvaluation(<?=$evaluation->id;?>)">Negar</button>
                                    <?php else:?>
                                        <span>Já realizada</span>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        <?php
            endif;
        endwhile;
        ?>
    </main>
</div>

<script>
        jQuery(document).ready(function ($) {
            $('#avaliacoes-table').DataTable();
        });
    function approveEvaluation(evaluationId, especialistaId) {
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: { 
                action: 'approve_evaluation',
                evaluation_id: evaluationId,
                especialista_id: especialistaId
            },
            success: function(response) {
                console.log(response)
                if (response.success) {
                    alert('Avaliação aprovada com sucesso!');
                    form.hide();
                } else {
                    alert('Error: ' + response);
                }
            },
            error: function(xhr, status, error) {
                alert('AJAX Error: ' + error);
            }
        });
    }

    function denyEvaluation(evaluationId) {
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: { action: 'deny_evaluation', evaluation_id: evaluationId },
            success: function(response) {
                console.log(response);
            }
        });
    }
</script>

