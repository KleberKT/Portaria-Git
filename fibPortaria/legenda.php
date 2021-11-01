<!DOCTYPE html>
<?php
	require("include/config.php");	
	require("include/crud.php");	
	require("include/biblio.php");	

	date_default_timezone_set('America/Sao_Paulo');
?>
<html>

	<head>
		<title>Syspot</title>
		<meta charset="utf-8">
		<meta http-equiv="refresh" content="5">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/modal.css">
	</head>

<body>
	
	<h1><span class="blue">&lt;</span>Legenda<span class="blue">&gt;</span></h1>
	<table class="container">

		<thead>
			<tr>
				<th><h1>STATUS</h1></th>
				<th><h1>HISTÓRICO</h1></th>
				
			</tr>
		</thead>

		<tbody>
			<tr>
				<td class="stVerd"></td>
				<td><h3>Liberado pátio</h3></td>
				
			</tr>			
			<tr>
				<td class="stAmar"></td>
				<td><h3>Pré Nota, mas não liberado pátio</h3></td>
				
			</tr>			
			<tr>
				<td class="stLar"></td>
				<td><h3>*** possivel ERRO ***  Liberado pátio SEM Pré Nota</h3></td>
				
			</tr>			
			<tr>
				<td class="stVerm"></td>
				<td><h3>Aguardando na portaria . . . </h3></td>
				
			</tr>
		</tbody>

	</table>

</body>
</html>