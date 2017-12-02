<?php
	session_start();
	if(isset($_SESSION['id'])){
			
			$id=$_SESSION['id'];

	}
	$fotoSelecionada=false;
	$conexao = mysqli_connect("localhost", "root", "","redeSocial");

			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
		

	
		
	?>

<!doctype html>  
<html>
	<head>
		<meta charset="utf-8"/>	
		<title>Página inicial </title>
		<link rel="stylesheet" href="./css/perfil.css"/>
		<style type="text/css">
		body{
			background-image:  (<?php echo '"dados/'. $sql['nomeUsuario'] .'/fundo.jpg"'?>);
		}
	</style>
		</head>
	<body>
<?php
		if(isset($_SESSION['nomeUsuario'])){
			$conexao = mysqli_connect("localhost", "root", "","redeSocial");

			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
				echo "2";
			}
			$select = mysqli_query ($conexao,"SELECT * FROM perfil where idPerfil=$id");

			
			$sql= mysqli_fetch_array($select);
?>
				
		<div class="all">
		<div class="botao">
			<a id="voltar" href="signout.php">Sign Out</a>
		</div>
			<div class="basic">
				<img class="fperfil" src=<?php echo '"dados/'.$sql['nomeUsuario'].'/perfil.jpg"'?>/>
				<h1><?php echo $sql["nomeUsuario"]; ?></h1>
				<div class="info">
					<ul class="menu">
					<div id="pagina-inicial">
						<div id="dados">
							<p id="dado-nome"> <?php echo $sql['nome']." ".$sql['sobrenome']; ?></p>
							<p id="dado-email"> <?php echo $sql['email']; ?></p>
							<p id="dado-sexo"> Sexo: <?php echo $sql['sexo']; ?></p>
							<p id="dado-data"> Data de nascimento: <?php echo $sql['datanasc'];?></p>
							
						</div>
					</div>
<?php
		
		}else{	echo "string1";
?>
			<!--<p> Você ainda não está cadastrado </p>
			<a href="index.html"> Fazer login </a>-->
<?php
		}
?>
	
		
	</body>
</html>