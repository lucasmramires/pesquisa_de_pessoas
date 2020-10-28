<?php
//connection
include_once 'php_action/db_connect.php';

//header
include_once 'includes/header.php';
?>

<form class="filters">
    <p>
    <div>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-filter" aria-hidden="true">Filtros</i></a>
        <button class="btn btn-warning" type="submit">Limpar Filtros</button>
    </div>
    </p>
    <div class="collapse filter_types" id="collapseExample">
        <span><b>Altura: </b></span>
        <div class="form-check form-check-inline ind_form">
            <input class="form-check-input" type="radio" name="altura" id="alt_alto" value="alto" >
            <label class="form-check-label" for="alt_alto">Alto</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="altura" id="alt_medio" value="medio">
            <label class="form-check-label" for="alt_medio">Média Estatura</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="altura" id="alt_baixo" value="baixo">
            <label class="form-check-label" for="alt_baixo">Baixo</label>
        </div>
        <p>
        </p>
        <span><b>Peso: </b></span> 
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="peso" id="acima_peso" value="acima_peso" >
            <label class="form-check-label" for="acima_peso">Acima do Peso</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="peso" id="peso_ideal" value="peso_ideal">
            <label class="form-check-label" for="peso_ideal">Peso Ideal</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="peso" id="abaixo_peso" value="abaixo_peso">
            <label class="form-check-label" for="baixo_peso">Abaixo do Peso</label>
        </div>        
        <p>
        </p>
        <span><b>Intolerância a Lactose: </b></span>
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="intolerancia" id="intolerante" value="intolerante" >
            <label class="form-check-label" for="intolerante">Intolerante</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="intolerancia" id="nao_intolerante" value="nao_intolerante">
            <label class="form-check-label" for="nao_intolerante">Não Intolerante</label>
        </div>
        <p>
        </p>
        <span><b>Atleta: </b></span>
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="atleta" id="atleta" value="atleta" >
            <label class="form-check-label" for="atleta">Atleta</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input with-gap" type="radio" name="atleta" id="nao_atleta" value="nao_atleta">
            <label class="form-check-label" for="nao_atleta">Não Atleta</label>
        </div>
        </p>
        <button class="btn btn-info" type="submit">Aplicar</button>
    </div>
</form>
<p>
<form action="index.php" class="form-inline mt-2 mt-md-0" id="search_box">
    <div class="container">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="nome">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
        <button class="btn btn-primary my-2 my-sm-0 add_person" type="submit">Adicionar Pessoa</button>
    </div>
</form>
</p>
<div class="row" id="background">
    <div class="col s12 m6 push-m3">
        <table class="table table-hover table-borderless table-xl">
            <thead class="thead-light">
                <tr>
                    <th class="coluna2"><input type="checkbox" onClick="toggle(this)" /> Sel. Tudo<br/></th>
                    <th class="coluna">Nome</th>
                    <th class="coluna2">Altura (m)</th>
                    <th class="coluna2">Intolerância a Lactose</th>
                    <th class="coluna">Peso (kg)</th>
                    <th class="coluna">Atleta</th>
                    <th class="coluna2">Ações </th>
                </tr>
            </thead>
            <tbody>

                <?php
                $resultado = filtro($connect, $_GET);
                while($dados = mysqli_fetch_array($resultado)):
                ?>
                <tr class="shadow-lg p-3 mb-5 bg-white rounded">
                    <td class="coluna2"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="check"></td>
                    <td class="coluna "><?php echo $dados['nome']; ?></td>
                    <td class="coluna2"><?php echo $dados['altura']; ?></td>
                    <td class="coluna2"><?php echo ($dados['intolerancia'] == 0) ? "Não" : "Sim"; ?></td>
                    <td class="coluna2"><?php echo $dados['peso']; ?></td>
                    <td class="coluna2"><?php echo ($dados['atleta'] == 0) ? "Não" : "Sim"; ?></td>
                    <td><a class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil-square-o" aria-hidden="true"> Editar</i></a>
                    <a class="btn btn-danger" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-times" aria-hidden="true"></i> Deletar</i></a></td>
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

    if(isset($parametros['nome'])):

        $sql.=" and nome like '%" . $parametros['nome'] . "%'";

    endif;

endif;
return mysqli_query($connect, $sql);
}
?>

<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('check');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>