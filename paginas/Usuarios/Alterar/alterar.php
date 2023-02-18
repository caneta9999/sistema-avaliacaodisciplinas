<?php
session_start();
if(!isset($_SESSION['idUsuarioLogin']))
{
  header('location:../../Login/index.php');
}?>
<?php
    require '../../../camadaDados/conectar.php';
    require '../../../camadaDados/tabelas.php';
    $result = "SELECT Nome FROM $db.$TB_CURSO";
    $select = $conx->prepare($result);
    $select->execute();
    $_SESSION['queryPessoaCursos1'] = $select->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../../css/bootstrap-4.6.1-dist/bootstrap-4.6.1-dist/css/bootstrap.css">
	<link rel ="stylesheet" href="../../../css/bootstrap-select-1.13.14/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css"/>
	<script src="../../../js/jquery-3.6.0.min.js"></script>
	<script src="../../../js/jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>
    <link rel ="stylesheet" href="../../../css/css.css"/>

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
    <h1>Alterar usuário</h1>
	<?php
		if($_SESSION['administradorLogin']){
			echo '<button class="button btnVoltar button-go-return"><span class="material-icons button-go-return">reply</span><a class="button-go-return" href="../index.php">Voltar</a></button><br/>';
			echo '<form action="php1.php" method="POST">';
			echo '<label for="id">Id: </label><input id="id" name="id" type="number" placeholder="Digite o id de usuário" min="1" max="99999999999" required> <br/>';
			echo '<button type="submit" name="submit" class="button-search" value="Enviar"><span class="material-icons button-search">search</span>Pesquisar</button>';
			echo '</form>';
			echo '<hr/>';
		}
		else{
			echo '<button class="button btnVoltar button-go-return"><span class="material-icons button-go-return">reply</span><a class="button-go-return" href="../index.php">Voltar</a></button><br/>';
		}
        if(isset($_SESSION['queryUsuario3'])){
            $nome = 'André';
            $id = -1;
            $senha = 'senha';
			if($_SESSION['administradorLogin']){
				$cpf = 0;
				$login = 'login';
				$administrador = 0;
				$tipo = 0;
				$curso = 0;
				$matricula = 0;
				$nomeCursoSelecionado = 0;
				$ativo = 0;}
            foreach($_SESSION['queryUsuario3'] as $linha_array){
                $nome = $linha_array['Nome'];
                $id = $linha_array['idUsuario'];
                $senha = $linha_array['Senha'];
				if($_SESSION['administradorLogin']){
					$cpf = $linha_array['Cpf'];
					$login = $linha_array['Login'];
					$administrador = $linha_array['Administrador'];       
					$tipo = $linha_array['Tipo'];
					$ativo = $linha_array['Ativo'];
					if($tipo == 2){
						$curso = $linha_array['Curso_idCurso'];
						$matricula = $linha_array['Matricula'];
						$nomeCursoSelecionado = $linha_array['NomeCurso'];
					}
					$_SESSION['tipoAlteracao'] = $tipo;
				}
                $_SESSION['idAlteracao2'] = $id;
            }
            echo '<form method="POST" action="php2.php">';
            echo '<label for="id">Id:</label> <input value='.$id.' id="id" name="id" type="number" placeholder="Id do usuário" min="1" max="99999999999" required readonly="readonly"/> <br/>';
            if($_SESSION['administradorLogin']){
				echo '<label for="login">Login:</label> <input value='."'$login'".' id="login" name="login" type="email" placeholder="Login do usuário" maxlength="100" required /> <br/>';
			}
            echo '<label for="senha">Senha:</label> <input value='."'$senha'".' id="senha" name="senha" type="text" placeholder="Senha do usuário" maxlength="100" required /> <br/>';
            echo '<label for="nome">Nome:</label> <input pattern="[^0-9]*" value='."'$nome'".' id="nome" name="nome" type="text" placeholder="Nome do usuário" maxlength="100" required /> <br/>';
			if($_SESSION['administradorLogin']){
				$mask = '000.000.000-00';
				echo '<label for="cpf">Cpf:</label> <input onchange="digitarCpf()" onkeypress="$(this).mask(\''.$mask.'\');"  id="cpf" name="cpf" type="text" placeholder="000.000.000-00" required> <br/>';
				echo '<script>$(document.getElementById("cpf")).val(\''.$cpf.'\').mask(\''.$mask.'\')</script>';
				if($ativo){
					echo '<input type="checkbox" id="ativo" name="ativo" checked> <label for="ativo">Ativo</label> <br/>';
				}else{
					echo '<input type="checkbox" id="ativo" name="ativo"> <label for="ativo">Ativo</label> <br/>';
				}
				if($tipo == 0){
					$tipoString = 'Nenhum';
				}else if($tipo == 1){
					$tipoString = 'Professor';
				}else{
					$tipoString = 'Aluno';
				}
				if($administrador){
					echo '<input type="checkbox" id="administrador" name="administrador" checked> <label for="administrador">Administrador</label> <br/>';
				}else if($tipo != 2){
					echo '<input type="checkbox" id="administrador" name="administrador"> <label for="administrador">Administrador</label> <br/>';
				}
				echo '<label for="tipo">Tipo:</label> <input id="tipo" name="tipo" type="text" placeholder="" value='."'$tipoString'".' maxlength="10" readonly="readonly">';
				echo ' <br/>';
				if($tipo ==2){
					echo '<label id="labelCurso" for="cursoSelect"> Curso do usuário: </label>';
					echo '<select id="cursoSelect" class="selectpicker" data-size="10" data-live-search="true" onchange="mudaCurso()">';
					foreach($_SESSION['queryPessoaCursos1'] as $linha_array) {
						$nomeCurso = $linha_array['Nome'];
						if($nomeCurso == $nomeCursoSelecionado){
							echo '<option value='."'$nomeCurso'"." selected>".$nomeCurso."</option>";
						}else{
							echo '<option value='."'$nomeCurso'".">".$nomeCurso."</option>";                    
						}
					} 
					foreach($_SESSION['queryPessoaCursos1'] as $linha_array) {
						echo '<input type="hidden" id="curso" name="curso" value='."'$nomeCursoSelecionado'"."/>";
						break;
					}  
					echo '</select>';
					echo '<br/><br/>';
					echo '<label id="labelMatricula" for="matricula">Matricula: </label><input value='."'$matricula'".' id="matricula" name="matricula" type="number" placeholder="Digite a matricula" min="1" max="99999999"> <br/>';
				}
				echo '<button name="submit" onclick="return confirmarSubmit('."'Você realmente deseja excluir esse registro? Não será possível reverter sua ação!'".')" type="submit" class="button-delete" value="Excluir" /><span class="material-icons button-delete">delete</span>Excluir</button>';
			}				
			echo '<button name="submit" onclick="return confirmarSubmit('."'Você realmente deseja cancelar a alteração? Não será possível reverter sua ação!'".')" type="submit" value="Cancelar" class="button-cancel"><span class="material-icons button-cancel">close</span>Cancelar</button>';
			echo '<button name="submit" type="submit" class="button-confirm" value="Alterar" /><span class="material-icons button-confirm">done</span>Confirmar</button>';
            echo '</form>';
            unset($_SESSION['queryUsuario3']);}
    ?>
    <script>
		function digitarCpf(){
			$(document.getElementById("cpf")).val(document.getElementById("cpf").value).mask('000.000.000-00');
		}
        function mudaCurso(){
            document.getElementById('curso').value = document.getElementById('cursoSelect').value;
        }
		function confirmarSubmit(mensagem){
			var confirmar=confirm(mensagem);
			return confirmar? true:false
		}		
    </script>
	<script src="../../../js/node_modules/popper.js/dist/umd/popper.js"></script>
	<script src="../../../css/bootstrap-4.6.1-dist/bootstrap-4.6.1-dist/js/bootstrap.min.js"></script>
	<script src="../../../css/bootstrap-select-1.13.14/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js"></script>
    <div id="push"></div>
    <div id="footer"></div>    
</body>
</html>