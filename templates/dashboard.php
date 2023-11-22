<?php
    $args = array(
        'post_type' => 'especialista-cpt',
        'posts_per_page' => -1, 
    );
    $especialistas = new WP_Query($args);
    ?>
    
    <div class="wrap">
    <h2>Painel de Avaliações</h2>
    <table id="especialistas-table" class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Pontuação</th>
                <th>Ações</th>
            </tr>
        </thead>
            <tbody>
            <?php
            while ($especialistas->have_posts()):
                $especialistas->the_post();
                $id = get_the_ID();
                $nome = get_post_meta($id, '_nome', true);
                $thumbnail = get_the_post_thumbnail($id);
                $especialidade = get_post_meta($id, '_especialidade', true);
                $avaliacao = get_post_meta($id, '_avaliacao', true); 
                $numeroAvaliacoes = get_post_meta($id, '_numero_avaliacoes', true);

                if(!empty($numeroAvaliacoes) && !empty($avaliacao)){
                    $pontuacaoGeral = ($avaliacao / $numeroAvaliacoes);
                }else{
                    $pontuacaoGeral = "Ainda não há média disponível";
                }
                ?>
                <tr>
                    <td data-order="<?= $id ?>"><?= $id ?></td>
                    <td data-order="<?= $nome ?>"><?= $nome ?></td>
                    <td data-order="<?= $especialidade ?>"><?= $especialidade ?></td>
                    <td>
                        <?= number_format((float)$pontuacaoGeral, 2, '.', '');?>
                    </td>
                    <td><a href="<?php echo admin_url('admin.php?page=avaliacoes_gda&id=' . $id); ?>">Avaliações</a></td>

                </tr>
                <?php
            endwhile;?>
        </tbody>
    </table>
    <script>
        jQuery(document).ready(function ($) {
            $('#especialistas-table').DataTable();
        });
    </script>
    </div>

