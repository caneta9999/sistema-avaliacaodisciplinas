<?php
session_start();
if(!isset($_SESSION['idUsuarioLogin']) || $_SESSION['administradorLogin']!=1)
{
  header('location:../../Login/index.php');
}?>
<?php
    require '../../../camadaDados/conectar.php';
    require '../../../camadaDados/tabelas.php';
    $result = "SELECT nome,idCurso FROM $db.$TB_CURSO";
    $select = $conx->prepare($result);
    $select->execute();
    $_SESSION['queryDisciplinasCursos1'] = $select->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel ="stylesheet" href="../../../css/css.css"/>
	<link rel="stylesheet" href="../../../css/bootstrap-4.6.1-dist/bootstrap-4.6.1-dist/css/bootstrap.css">
	<link rel ="stylesheet" href="../../../css/bootstrap-select-1.13.14/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css"/>
	<script src="../../../js/jquery-3.6.0.min.js"></script>
    <script type="module" src="../../../js/componentes.js"></script>

    <title>sistema-avaliacaodisciplinas</title>
</head>
<body>
    <?php 
      if($_SESSION['administradorLogin']) {
        echo "<div id='menu' class='menu-adm'></div>";
      } else {
        echo "<div id='menu'></div>";
      }
    ?>
    <div id="navbar"></div>
    <h1>Cadastrar disciplina</h1>
    <button class="button btnVoltar button-go-return"><span class="material-icons button-go-return">reply</span><a class="button-go-return" href="../index.php">Voltar</a></button><br/>
    <form action="php.php" method="POST">
        <label for="nome">Nome: </label><input id="nome" name="nome" type="text" placeholder="Digite o nome" maxlength="50" required> <br/>
        <label for="descricao"> Descrição: </label><textarea rows="5" cols="30" id="descricao" name="descricao" placeholder="Digite a descrição da matéria" required maxlength="7200" ></textarea> <br/>
        <label for="codigo">Código: </label><input id="codigo" name="codigo" placeholder="Código da disciplina" type="number" min="1" max="9999" required> <br/>
        <label for="sigla">Sigla: </label><input id="sigla" name="sigla" placeholder="AAA000" type="text" maxlength="6" required> <br/>                     
        <label for="tipoSelect"> Tipo: </label>
        <select id="tipoSelect" class="selectpicker" data-size="10" data-live-search="true" onchange="mudaTipo()">
            <option value="0" selected> Obrigatória </option>
            <option value="1"> Eletiva </option>
            <option value="2"> Escolha </option>
        </select><br/><br/>
        <input id="tipo" name="tipo" type="hidden" placeholder="" value="0">
        <input type="checkbox" id="ativa" name="ativa" checked> <label for="ativa">Ativa</label> <br/>
		 <?php
            echo '<label id="labelCurso" for="cursoSelect"> Curso: </label>';
            echo '<select class="selectpicker" data-size="10" data-live-search="true" id="cursoSelect" onchange="mudaCurso()">';
			$idSelect1 = '';
            foreach($_SESSION['queryDisciplinasCursos1'] as $linha_array) {
				$idCurso = $linha_array['idCurso'];
                if($idSelect1 == ''){
					$idSelect1 = $linha_array['idCurso'];}	
				$nome = $linha_array['nome'];
                echo '<option value='."'$idCurso'".">".$nome."</option>";
            } 
            foreach($_SESSION['queryDisciplinasCursos1'] as $linha_array) {
                echo '<input type="hidden" id="curso" name="curso" value='."'$idSelect1'"."/>";
                break;
            }            
            echo '</select>';
            echo '<br/><br/>';
        ?>
		<button type="submit" name="submit" class="button-create" value="Enviar"><span class="material-icons button-create">add_circle</span>Cadastrar</button>
    </form>
    <script>
        function mudaCurso(){
            document.getElementById('curso').value = document.getElementById('cursoSelect').value;
        }
        function mudaTipo(){
            document.getElementById('tipo').value = document.getElementById('tipoSelect').value;
        }
    </script>
	<script src="../../../js/node_modules/popper.js/dist/umd/popper.js"></script>
	<script src="../../../css/bootstrap-4.6.1-dist/bootstrap-4.6.1-dist/js/bootstrap.min.js"></script>
	<script src="../../../css/bootstrap-select-1.13.14/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js"></script>
    <div id="push"></div>    
	<div id="footer"></div>    
</body>
</html>