<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="./css/index.css"/>
		<script src="./js/jquery.min.js"></script>
	</head>
	<body>
	<?php
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$c= false;
			$username = $_POST['user'];
			$passw = $_POST['senha'];

			$conexao = mysqli_connect("localhost", "root", "","redeSocial");

			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
		// ve se o usuario ta cadastrado
			$select = mysqli_query ($conexao,'SELECT * FROM perfil');
			$passw = hash("sha512",$passw);
				while($linha = mysqli_fetch_array($select)){
					echo "if";
					if($linha["nomeUsuario"] == $username && $linha["senha"] == $passw){
						$c = true;
						$id= $linha["idPerfil"];
						$username = $linha["nomeUsuario"];
						$nome=$linha["nome"];
						
						break;
					}
				}
				if($c == true){
					if(isset($_SESSION['nomeUsuario'])){
						//session_destroy();
						session_start();
						$_SESSION['idPerfil'] = $id;
						$_SESSION['nomeUsuario'] = $username;
						$_SESSION['nome'] = $nome;
						print_r($_SESSION['nomeUsuario']);
						header ("Location: home.php");
					}
					else{
						session_start();
						$_SESSION['id'] = $id;
						$_SESSION['nomeUsuario'] = $username;
						$_SESSION['nome'] = $nome;
						$iduser = $linha['id'];
						header ("Location: home.php?id=".$nome);
						exit();
					}
				}
				else{
					header ("Location: erro.php");
					exit();
				}
		}
	?>

		<?php
			session_start();
			if(!isset($_SESSION['nomeUsuario'])){
		?>
		<div class="botao">
			<a class="voltar" href="index.html"> VOLTAR </a>
		</div>
		<div class="containerl">
			<div class="boxl">
				<div class="login">
					<form method="post">
						<input name='user' placeholder="Email ou Usuario" type="text"/><br/>
						<input name= 'senha' placeholder="Senha" type="password"/><br/>
						<input class="sub" type="submit" name="Entrar" id="entrar"/><br/>
					</form>
				</div>
			</div>
		</div>
<?php
		}
		else{
			header ("Location: home.php?id=".$username);
		}
		?>
	</body>
</html>
