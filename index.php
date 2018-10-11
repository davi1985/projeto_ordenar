<!-- Ordenando resultados vindos do servidor -->
<?php 
// Conectando ao database
try {
	$pdo = new PDO("mysql:dbname=projeto_ordenar;host=localhost","root","");
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "ERRO AO CONECTA".$e->getMessage();
}

// Verificando se houve opção selecionado no form acima
if (isset($_GET['ordem']) && !empty($_GET['ordem'])) {
	// Fazendo a requisição ao database;
	$ordem = addslashes($_GET['ordem']);
	// Ordenando os pela opção enviada pelo form;
	$sql = "SELECT * FROM usuarios ORDER BY ".$ordem;
} else {
	$ordem = '';
	$sql = "SELECT * FROM usuarios";
}

 ?>


<!-- Select HTML com as opções de ordenação -->
<form method="GET">
	Ordenar resultados:
	<!-- onchange="this.form.submit() - recarregando o form quando selecionada o option  -->
	<select name="ordem" onchange="this.form.submit()">
		<option></option>
		<option value="nome" <?php echo ($ordem == "nome")?'selected="selected"':''; ?>>pelo nome</option>
		<option value="idade" <?php echo ($ordem == "idade")?'selected="selected"':''; ?>>pela idade</option>
	</select>
</form>


<!-- Tabela HTML com os dados do database -->
<table border="1" width="400px">
	<tr>
		<th>Nome</th>
		<th>Idade</th>
	</tr>

	<?php

		$sql = $pdo->query($sql);
		//Verificando se encontrou resultados;			
		if ($sql->rowCount() > 0) {	
			//Listando resultados encontrados; 
			foreach($sql->fetchAll() as $usuario):
 			// Montando a tabela com os dados do database
 			?>
			<tr>
				<td><?php echo $usuario['nome']; ?></td>
				<td><?php echo $usuario['idade']; ?></td>
			</tr>
 			<?php
			endforeach;
		}
	 ?>	
</table> 