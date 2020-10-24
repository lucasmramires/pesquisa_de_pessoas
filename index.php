<?php
//connection
include_once 'php_action/db_connect.php';

//header
include_once 'includes/header.php';
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h3>Dados das Pessoas</h3>
        <table class="striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Altura</th>
                    <th>Intolerância a Lactose</th>
                    <th>Peso</th>
                    <th>Atleta</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $sql = "SELECT * FROM pessoas";
                $resultado = mysqli_query($connect, $sql);
                while($dados = mysqli_fetch_array($resultado)):
                ?>
                <tr>
                    <td><?php echo $dados['nome']; ?></td>
                    <td><?php echo $dados['altura']; ?></td>
                    <td><?php echo $dados['intolerancia']; ?></td>
                    <td><?php echo $dados['peso']; ?></td>
                    <td><?php echo $dados['atleta']; ?></td>
                </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
    </div>
</div>

<?php
//footer
include_once 'includes/footer.php';
?>



