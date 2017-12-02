<?php
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$c = false;
			$flag = array();
			$nome = trim($_POST['nome']);
			$snome = trim($_POST['snome']);
			$email = trim($_POST['email']);
			$cemail = trim($_POST['cemail']);
			$username = trim($_POST['user']);
			$passw = trim($_POST['senha']);
			$cpassw = trim($_POST['csenha']);
			$data= trim($_POST['data'])

			$conexao = mysqli_connect("localhost", "root", "","redeSocial");

			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}

			// Verficação de cadastro
			//nome
			if ($nome == ''){
				$flag[0] = "true";
			}
			//sobrenome
			if ($snome == ""){
				$flag[1] = 'true';
			}
			//email
			if (filter_var($email,FILTER_VALIDATE_EMAIL) == false){
				$flag[2] = 'true';
			}
			// Confirmacao de email
			if (filter_var($cemail,FILTER_VALIDATE_EMAIL) == false){
				$flag[3] = 'true';
			}
			// senha
			if ($passw == '' and strlen($passw) >= 5 and strlen($passw) <= 20){
				$flag[5] = 'true';
			}
			//Confirmacao de senha
			if ($cpassw == '' and strlen($passw) >= 5 and strlen($passw) <= 20) {
				$flag[6] = 'true';
			}
			//sexo
			if (isset($_POST['sexo'])){
				$sexo = $_POST['sexo'];
				} else {
				$flag[7] = "true";
			}

			// Verificação de senha e email, verficação de banco
			if($passw == $cpassw && $email == $cemail){
				$select = mysqli_query ($conexao,'SELECT * FROM perfil');

				while($linha = mysqli_fetch_array($select)){
					if($linha["nomeUsuario"] == $username){
						$flag[4] = "true";
						break;
					}
				}
				
					if($username!=''){
						if(!file_exists('dados/'.$_POST['user'])){
							mkdir('dados/'.$_POST['user']);
						}
						move_uploaded_file($_FILES['perfil']['tmp_name'],'dados/'.$_POST['username'].'/perfil.jpg');
						move_uploaded_file($_FILES['fundo']['tmp_name'],'dados/'.$_POST['username'].'/fundo.jpg');
					}
				// Sem erro
				if($c == false){
					$select = mysqli_query ($conexao,'SELECT * FROM perfil');
					$linha = mysqli_fetch_array($select);

					$novoId = mysqli_num_rows($select);
					$novoId++;
					$passw = hash("sha512",$passw);
					//insere dados no Banco de Dados
					$query = "INSERT INTO perfil (idPerfil,nome,sobrenome,sexo,email,nomeUsuario,senha, datanasc)
								VALUES
									('$novoId','$nome','$snome','$sexo','$email','$username','$passw','$data')";
					
					if (mysqli_query($conexao,$query)===TRUE){
						header("Location: index.html");		
					}else {
						var_dump(mysqli_error($conexao));
						die ("Erro ao cadastrar");
					}
					// Mantém na página caso haja erro
					}
					if($flag[4] == true){
						echo "Usuario ". $username ." ja cadastrado";
					}
					else{
						echo"Email ". $email ." esta cadastrado";
					}
				}
				else{
					echo "Confirmacao de email ou senha incorreta";
			}
	}
	?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="./css/index.css"/>
		<script src="./js/jquery.min.js"></script>

	</head>
	<body>
	<div class="botao">
			<a class="voltar" href="index.html">VOLTAR </a>
		</div>
		<div class="container">
			<div class="box">
				<div class="cadastro">
				<form method="post">
					<input name="nome" placeholder="Nome" type="text" required><br/>
					<input name="snome" placeholder="Sobrenome" type="text" required/><br/>
					<input name="email" placeholder="Email" type="email" required/><br/>
					<input name="cemail" placeholder="Confimação de email" type="email" required/><br/>
					<input name="user" placeholder="Username" type="text" minlength="5" required/><br/>
					<input name="senha" placeholder="Senha" type="password" maxlength="20" required/><br/>
					<input name="csenha" placeholder="Confirmação de senha" type="password" maxlength="20" required/><br/>
					<input type="date" name="data"/><br/><br/>

					Masculino<input type="radio" name="sexo" value="M" required><br/>
					Feminino<input type="radio" name="sexo" value="F" required> <br/>
					Outro<input type="radio" name="sexo" value="O" required> <br/>

					<p>perfil</p>
					<input type="file" name="perfil"  /><br/>
					<p>fundo</p>
					<input type="file" name="fundo"/><br/>

					<input class="sub" type="submit" value="Cadastrar"/><br/>
				</form>
			</div>
			</div>
		</div>
		
	</body>
</html>