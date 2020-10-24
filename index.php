<?php
//connection
include_once 'php_action/db_connect.php';

//header
include_once 'includes/header.php';
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h3>Dados das Pessoas</h3>
        <form action="php_action/select.php">
            <p>
            <label>
                <input class="with-gap" name="altura" type="radio"/ value="3">
                <span>Altos</span>
            </label>
            <label>
                <input class="with-gap" name="altura" type="radio" value="2"/>
                <span>Medianos</span>
            </label>
            <label>
                <input class="with-gap" name="altura" type="radio" value="1"/>
                <span>Baixos</span>
            </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="peso" type="radio" value="3"/>
                    <span>Acima do Peso</span>
                </label>
                <label>
                    <input class="with-gap" name="peso" type="radio" value="2"/>
                    <span>Peso Ideal</span>
                </label>
                <label>
                    <input class="with-gap" name="peso" type="radio" value="1"/>
                    <span>Abaixo do Peso</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="intolerancia" type="radio" value="2"/>
                    <span>Intolerante</span>
                </label>
                <label>
                    <input class="with-gap" name="intolerancia" type="radio" value="1"/>
                    <span>Não Intolerante</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="atleta" type="radio" value="2"/>
                    <span>É atleta</span>
                </label>
                <label>
                    <input class="with-gap" name="atleta" type="radio" value="1"/>
                    <span>Não é Atleta</span>
                </label>
            </p>
            <button type="submit" class="waves-effect waves-light btn">Aplicar</button>
        </form>

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



