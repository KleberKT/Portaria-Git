<!DOCTYPE html>
<?php
	require("include/config.php");	
	require("include/crud.php");	
	require("include/biblio.php");	

	date_default_timezone_set('America/Sao_Paulo');
	//date_default_timezone_set('America/Cuiaba');
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

	<h1><span class="blue">&lt;</span>Recebimento<span class="blue">&gt;</span><span class="yellow"><?php echo date("d-m-Y H:i:s") ?></span></h1>
	<h2><a href="legenda.php" target="_blank">Legenda</a></h2>
	
	<table class="container">
		<?php
			$sql 	= "SELECT * FROM portaria WHERE data_sai IS NULL ORDER BY data_che DESC";
			$portarias = selectsql($sql);
			if ($portarias) {
		?>
		<thead>
			<tr>
				<th><h1>NOME</h1></th>
				<th><h1>DOCTO</h1></th>
				<th><h1>PRE</h1></th>
				<th><h1>PP</h1></th>
				<th><h1>CHEGADA</h1></th>
	      		<th><h1>ENTRADA</h1></th>
			</tr>
		</thead>

		<?php
			foreach ($portarias as $linha) {
				$data_cheLb	= (strtotime($linha["data_che"])?date("d-m-y H:i",strtotime($linha["data_che"])):"EM BRANCO");
				$data_entLb	= (strtotime($linha["data_ent"])?date("d-m-y H:i",strtotime($linha["data_ent"])):"EM BRANCO");
				$data_saiLb	= (strtotime($linha["data_sai"])?date("d-m-y H:i",strtotime($linha["data_sai"])):"EM BRANCO");	

				if ($linha["data_sai"] != 0) {
					$status = "stBran";
				} elseif (($linha["lancado"] == "N") && ($linha["data_ent"] == 0)) {
					$status = "stVerm";
				} elseif (($linha["lancado"] == "S") && ($linha["data_ent"] == 0)) {
					$status = "stAmar";
				} elseif (($linha["lancado"] == "N") && ($linha["data_ent"] != 0)) {
					$status = "stLar";
				} elseif (($linha["lancado"] == "S") && ($linha["data_ent"] != 0)) {
					$status = "stVerd";
				} else {
					$status = "stBran";
				}				
		?>

		<tbody><!--
			<tr>
				<td class="<?php echo $status ?>"><?php echo $linha["nome"] ?></td>
				<td class="<?php echo $status ?>"><?php echo $linha["docto"] ?></td>
				<td align="center" class="<?php echo $status ?>"><?php echo $linha["lancado"] ?></td>
				<td align="center" class="<?php echo $status ?>"><?php echo $data_cheLb ?></td>
	      		<td align="center" class="<?php echo $status ?>"><?php echo $data_entLb ?></td>-->

			<tr>
				<td class="<?php if($linha['porte_peq']=='S') echo 'stAzul'; ?>"><?php echo $linha["nome"] ?></td>
				<td class="<?php echo $status ?>"><?php echo $linha["docto"] ?></td>
				<td align="center" class="<?php if($linha['porte_peq']=='S') echo 'stAzul'; ?>"><?php echo $linha["lancado"] ?></td>
				<td align="center" class="<?php if($linha['porte_peq']=='S') echo 'stAzul'; ?>"><?php echo $linha["porte_peq"]; ?></td>
				<td align="center" class="<?php if($linha['porte_peq']=='S') echo 'stAzul'; ?>"><?php echo $data_cheLb ?></td>
	      		<td align="center" class="<?php if($linha['porte_peq']=='S') echo 'stAzul'; ?>"><?php echo $data_entLb ?></td>
			</tr>	      		
			</tr>
		</tbody>
		<?php }} ?>
	</table>

</body>
</html>