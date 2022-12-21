<div class="wrap">
    <div id="welcome-panel" class="welcome-panel">
        <div class="welcome-panel-content">
            <div class="welcome-panel-column-container">
                <h1>Lista dos assinantes</h1>
                <p>Relação dos assinantes que enviaram mensagem pelo formulário para representantes.</p>

                <?php

                global $wpdb;

                $table_name = "{$wpdb->prefix}asswp_assinantes";
                $query = $wpdb->prepare("SELECT * FROM {$table_name}");

                $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
                $total = $wpdb->get_var( $total_query );
                $items_per_page = 10;
                $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
                $offset = ( $page * $items_per_page ) - $items_per_page;
                $latestposts = $wpdb->get_results( $query . " LIMIT ${offset}, ${items_per_page}" );

                if(!empty($_POST['submit'])){

                    $pega_id = $_POST['pega_id'];

                    if (!empty($pega_id)) {

                        $wpdb->delete( $table_name, array( 'id' => $pega_id ) );
                        echo '<div style="padding:15px;background-color: #c9fdbe;"><p>Assinante excluído com sucesso!</p></div>';
                        echo '<meta http-equiv="refresh" content="3">';
                    }
                }

                ?>
                <style>
                    table {
                      font-family: arial, sans-serif;
                      border-collapse: collapse;
                      width: 100%;
                    }

                    td, th {
                      border: 1px solid #dddddd;
                      text-align: left;
                      padding: 8px;
                    }

                    tr:nth-child(even) {
                      background-color: #f2f2f2;
                    }
                    .asswp_paged{
                        margin: 10px 0;
                        text-align: right;
                    }
                    .asswp_paged a{
                        color: black;
                        text-decoration: none;
                    }
                    .asswp_paged .page-numbers{
                        padding: 5px 15px;
                        border: 1px solid;
                        border-color: #cacaca;
                    }
                    .asswp_paged .page-numbers.current{
                        background-color: #dddddd;
                    }
                    form input[type=submit]{
                        cursor: pointer;
                    }
                </style>
                <table>
                    <tr>
                        <th><strong>Data:</strong></th>
                        <th><strong>Nome:</strong></th>
                        <th><strong>E-mail:</strong></th>
                        <th><strong>Telefone:</strong></th>
                        <th><strong>Cidade:</strong></th>
                        <th><strong>Assunto:</strong></th>
                        <th><strong>Mensagem:</strong></th>
                        <th><strong>Qual formulário:</strong></th>
                        <th><strong>Nome do Representante:</strong></th>
                        <th>&nbsp;</th>

                    </tr>

                    <?php

                    if( ! empty ( $latestposts ) ) :

                        foreach($latestposts as $r) :

                            $id      = $r->id;
                            $data    = $r->data;
                            $nome    = $r->nome;
                            $email   = $r->email;
                            $fone    = $r->telefone;
                            $cidade  = $r->cidade;
                            $assunto = $r->assunto;
                            $msg     = $r->mensagem;
                            $form    = $r->form;
                            $name_re = $r->nome_repre;

                        ?>

                            <tr>
                                <td><?php echo $data; ?></td>
                                <td><?php echo $nome; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $fone; ?></td>
                                <td><?php echo $cidade; ?></td>
                                <td><?php echo $assunto; ?></td>
                                <td><?php echo $msg; ?></td>
                                <td><?php echo $form; ?></td>
                                <td><?php echo $name_re; ?></td>
                                <td><form method="post" id="form"><input id="submit" type="submit" name="submit" value="Excluir" onclick="myFunction()"/><input type="hidden" name="pega_id" value="<?php echo $id; ?>"/></form></td>
                            </tr>

                        <?php

                        endforeach;

                    else :
                        echo '<h3>Nenhum cadastro foi realizado!</h3>';
                    endif;

                    ?>
                </table>
                <div class="asswp_paged" >
                <?php
                    echo paginate_links( array(
                        'base' => add_query_arg( 'cpage', '%#%' ),
                        'format' => '',
                        'prev_text' => __('&laquo;'),
                        'next_text' => __('&raquo;'),
                        'total' => ceil($total / $items_per_page),
                        'current' => $page
                    ));
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    function myFunction() {
      let txt;
      let r = confirm("Você tem certeza que deseja excuir?");
      if (r == true) {
        $('#form').submit();
      }
    }
</script>
