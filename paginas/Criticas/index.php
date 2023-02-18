<?php
session_start();
if(!isset($_SESSION['idUsuarioLogin']))
{
  header('location:../Login/index.php');
}?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel ="stylesheet" href="../../css/css.css"/>

    <script type="module" src="../../js/componentes.js"></script>

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
    <h1>Críticas</h1>
    <button class="button btnVoltar button-go-return"><span class="material-icons button-go-return">reply</span><a class="button-go-return" href="../index.php">Voltar</a></button><br/>
    <?php
		if($_SESSION['tipoLogin'] == 2 || $_SESSION['administradorLogin']){
			echo '<button class="button btnCadastrar" id="btnCadastrarCriticas"><a href="./Cadastrar/cadastrar.php">Cadastrar crítica</a></button> <br/>';
			echo '<button class="button btnAlterar" id="btnAlterarCriticas"><a href="./Alterar/alterar.php">Alterar crítica</a></button> <br/>';
			echo '<button class="button btnConsultar" id="btnConsultarCriticas"><a href="./Consultar/consultar.php">Consultar críticas realizadas por alunos</a></button> <br/>';
		}
		if($_SESSION['tipoLogin']==1 || $_SESSION['administradorLogin']){
			echo '<button class="button btnConsultar2" id="btnConsultarCriticas2"><a href="./ConsultarDisciplina/consultar.php">Consultar críticas sobre disciplina</a></button> <br/>';}
		if($_SESSION['administradorLogin'] || $_SESSION['tipoLogin']==1){
			echo '<button class="button btnEstatisticas" id="btnEstatisticas"><a href="./Estatisticas/estatisticas.php">Estatísticas</a></button> <br/>';}
    ?>
    <div id="footer"></div>    
</body>
</html>