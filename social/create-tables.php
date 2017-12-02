<html>
<body>
<?php
	$conexao = mysqli_connect("localhost", "root", "","redeSocial");

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$query="CREATE TABLE perfil (idPerfil INT NOT NULL AUTO_INCREMENT
								, nome VARCHAR(50) NOT NULL
								, sobrenome VARCHAR(100)
								, sexo VARCHAR(10)
								, email VARCHAR(100)
								, nomeUsuario VARCHAR(50)
								, senha VARCHAR (255)
								, datanasc date
								, PRIMARY KEY(idPerfil) )";
								

	if (mysqli_query($conexao,$query)===TRUE){
		echo "Tabela perfil criada!";
	} else {
		echo "Error criando testTable. Listando erros ... <br>";
		echo "<pre>";
		print_r(mysqli_error_list($conexao));
		echo "</pre>";
	}
	
	$query="CREATE TABLE amigo (idAmigo INT NOT NULL
								, idPerfil INT NOT NULL
								, PRIMARY KEY(idAmigo, idPerfil)
								,FOREIGN KEY (idPerfil) REFERENCES perfil (idPerfil)
								,FOREIGN KEY (idAmigo) REFERENCES perfil (idAmigo))";
								

	if (mysqli_query($conexao,$query)===TRUE){
		echo "Tabela perfil criada!";
	} else {
		echo "Error criando testTable. Listando erros ... <br>";
		echo "<pre>";
		print_r(mysqli_error_list($conexao));
		echo "</pre>";
	}

	mysqli_close($conexao);
?>
</body>
</html>



