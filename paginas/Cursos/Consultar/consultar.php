<?php
session_start();
if(!isset($_SESSION['idUsuarioLogin']))
{
  header('location:../../Login/index.php');
}?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel ="stylesheet" href="../../../css/css.css"/>

    <script type="module" src="../../../js/componentes.js"></script>
	
	<script src="../../../js/sorttable.js"></script>

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
    <?php
		if(isset($_SESSION['mensagemFinalizacao'])){
			echo "<p class='mensagemFinalizacao'>".$_SESSION['mensagemFinalizacao']."</p>";
			unset($_SESSION['mensagemFinalizacao']);
		}
		if(isset($_SESSION['mensagemErro'])){
			echo "<p class='mensagemErro'>".$_SESSION['mensagemErro']."</p>";
			unset($_SESSION['mensagemErro']);
		}
    ?>
    <h1>Consultar curso</h1>
    <?php
    if($_SESSION['administradorLogin']){
      echo '<h2>Consulta por nome possui prioridade</h2>';
      echo '<h2>Para listar todos os cursos, deixe os dois campos em branco</h2>';}
	else{
	  echo '<h2>Para listar todos os cursos, deixe o campo nome em branco</h2>';
	}
    ?>
    <button class="button btnVoltar button-go-return"><span class="material-icons button-go-return">reply</span><a class="button-go-return" href="../index.php">Voltar</a></button><br/>
    <form action="php.php" method="POST">
        <label for="nome">Nome: </label><input id="nome" name="nome" type="text" placeholder="Digite o nome" maxlength="100"> <br/>
        <?php
          if($_SESSION['administradorLogin']){
          echo '<label for="id">Id: </label><input id="id" name="id" type="number" placeholder="Digite o id" min="1" max="99999999999"> <br/>';}
        ?>
        <button type="submit" name="submit" class="button-search" value="Enviar"><span class="material-icons button-search">search</span>Pesquisar</button>
    </form>
	<br/>
    <?php
		if(isset($_SESSION['queryCurso1'])){
            echo "<table class='sortable'>";
            echo "<thead>";
                echo"<tr>";
				if($_SESSION['administradorLogin']){
					echo"<th >Id</th>";}
                echo"<th >Nome</th>";
				if($_SESSION['administradorLogin']){
					echo"<th> </th>";}
                echo"</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach($_SESSION['queryCurso1'] as $linha_array) {
                echo "<tr>";
				if($_SESSION['administradorLogin']){
					echo "<td>". $linha_array['idCurso'] ."</td>";}        
                echo "<td>". $linha_array['Nome'] ."</td>";
				if($_SESSION['administradorLogin']){
					echo "<td>".'<button value="Alterar" onclick="editar('.$linha_array['idCurso'].')" class="button-go-update"><span class="material-icons button-go-update">edit</span>Alterar</button>' ."</td>";
				}				
                echo "</tr>";}
            echo  "</tbody>";
            echo "</table>";
            unset($_SESSION['queryCurso1']);
		}
		if($_SESSION['administradorLogin']){
			echo "<form id='formConsultarAlterar' method='POST' action='../Alterar/php1.php'>";
				echo '<input type="hidden" id="id2" name="id2" value="" />';
				echo '<input style="display:none;" type="submit" name="submit2" value="Enviar">';
			echo "</form>";}
		?>
    <div id="push"></div>
    <div id="footer"></div> 
	<script>
		function editar(id){
			var hiddenId = document.getElementById('id2')
			hiddenId.value = id
			form = document.getElementById('formConsultarAlterar').submit();
		}
	</script>	
</body>
</html>