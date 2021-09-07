<?php
	require("include/config.php");	
	require("include/crud.php");	
	require("include/biblio.php");	

	date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html>

	<head>
		<title>SysPot</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>

<body>
	<div class="conteudo">
		<div class="topo2">
			<a href="#" class="logo-home"></a>
			<div class="w">
				Empresa Teste<br>SysPot<br><?php echo(date("d/m/Y")); ?>
			</div>
		</div>

		<div class="menu">
			<h2>MENU</h2>
			<ul>
				<li><a href="index.php?link=1">HOME</a></li>
				<li><a href="index.php?link=2">PORTARIA</a></li>
				<li><a href="index.php?link=3">RELATÓRIO</a></li>
			</ul>
		</div>

		<div class="corpo">
			<?php
				$link 	= @$_GET["link"];
				$id 	= @$_GET["id"];

				$pag[1] = "home.php";
				$pag[2] = "lst_portaria.php";
				$pag[22]= "portaria.php";
				$pag[23]= "portaria_data.php";
				$pag[3] = "relatorio.php";
				$pag[4] = "excel.php";

				if (!empty($link)) {
					if (file_exists($pag[$link])) {
						include $pag[$link];
					} else {
						include "home.php";
					}
				} else {
					include "home.php";
				}?>
		</div>

		<div class="limpar"></div>

		<div class="rodape">
			<a href="#" class="logo-rodape"></a>
		</div>

	</div>
</body>
</html>