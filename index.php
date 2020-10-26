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
                <input class="with-gap" name="altura" type="radio" value="alto">
                <span>Altos</span>
            </label>
            <label>
                <input class="with-gap" name="altura" type="radio" value="medio"/>
                <span>Medianos</span>
            </label>
            <label>
                <input class="with-gap" name="altura" type="radio" value="baixo"/>
                <span>Baixos</span>
            </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="peso" type="radio" value="acima_peso"/>
                    <span>Acima do Peso</span>
                </label>
                <label>
                    <input class="with-gap" name="peso" type="radio" value="peso_ideal"/>
                    <span>Peso Ideal</span>
                </label>
                <label>
                    <input class="with-gap" name="peso" type="radio" value="baixo_peso"/>
                    <span>Abaixo do Peso</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="intolerancia" type="radio" value="intolerante"/>
                    <span>Intolerante</span>
                </label>
                <label>
                    <input class="with-gap" name="intolerancia" type="radio" value="nao_intolerante"/>
                    <span>Não Intolerante</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="atleta" type="radio" value="atleta"/>
                    <span>É atleta</span>
                </label>
                <label>
                    <input class="with-gap" name="atleta" type="radio" value="nao_atleta"/>
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
                    <td><?php echo ($dados['intolerancia'] == 0) ? "Não" : "Sim"; ?></td>
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

            case 'baixo':
                $sql.=" and altura <= 1.59";
            break;

            case 'medio':
                $sql.=" and altura >= 1.60 and altura <= 1.79";
            break;

            case 'alto':
                $sql.=" and altura >= 1.80";
            break;

        endswitch;

    endif;

    if(isset($parametros['peso'])):

        switch($parametros['peso']):

            case 'abaixo_peso':
                $sql.=" and peso < 70";
            break;

            case 'peso_ideal':
                $sql.=" and peso >= 70 and peso <= 89";
            break;

            case 'acima_peso':
                $sql.=" and peso >= 90";
            break;

        endswitch;

    endif;

    if(isset($parametros['intolerancia'])):

        switch($parametros['intolerancia']):

            case 'nao_intolerante':
                $sql.=" and intolerancia = 0";
            break;

            case 'intolerante':
                $sql.=" and intolerancia = 1";
            break;

        endswitch;

    endif;

    if(isset($parametros['atleta'])):

        switch($parametros['atleta']):

            case 'nao_atleta':
                $sql.=" and atleta = 0";
            break;

            case 'atleta':
                $sql.=" and atleta = 1";
            break;

        endswitch;

    endif;

endif;

return mysqli_query($connect, $sql);

}

?>