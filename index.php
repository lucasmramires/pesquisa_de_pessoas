<?php
//connection
include_once 'php_action/db_connect.php';

//header
include_once 'includes/header.php';

?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h3>Dados das Pessoas</h3>
        <form action="index.php">
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
                    <input class="with-gap" name="intolerancia" type="radio" value="1"/>
                    <span>Intolerante</span>
                </label>
                <label>
                    <input class="with-gap" name="intolerancia" type="radio" value="0"/>
                    <span>Não Intolerante</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="atleta" type="radio" value="1"/>
                    <span>É atleta</span>
                </label>
                <label>
                    <input class="with-gap" name="atleta" type="radio" value="0"/>
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
                $resultado = filtro($connect, $_GET);
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

function filtro($connect, $parametros){

$sql = "SELECT * FROM pessoas";

if(!empty($parametros)):

    $sql.=" WHERE 1";

    if(isset($parametros['altura'])):

        switch($parametros['altura']):

            case 1:
                $sql.=" and altura <= 1.59";
            break;

            case 2:
                $sql.=" and altura >= 1.60 and altura <= 1.79";
            break;

            case 3:
                $sql.=" and altura >= 1.80";
            break;

        endswitch;

    endif;

    if(isset($parametros['peso'])):

        switch($parametros['peso']):

            case 1:
                $sql.=" and peso < 70";
            break;

            case 2:
                $sql.=" and peso >= 70 and peso <= 89";
            break;

            case 3:
                $sql.=" and peso >= 90";
            break;

        endswitch;

    endif;

    if(isset($parametros['intolerancia'])):

        switch($parametros['intolerancia']):

            case 0:
                $sql.=" and intolerancia = 0";
            break;

            case 1:
                $sql.=" and intolerancia = 1";
            break;

        endswitch;

    endif;

    if(isset($parametros['atleta'])):

        switch($parametros['atleta']):

            case 0:
                $sql.=" and atleta = 0";
            break;

            case 1:
                $sql.=" and atleta = 1";
            break;

        endswitch;

    endif;

endif;

return mysqli_query($connect, $sql);

}

?>