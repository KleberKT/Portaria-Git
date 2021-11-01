<?php
	@$ordem = $_GET["ordem"]?$_GET["ordem"]:0;
?>

<h2>PORTARIA</h2>

<div class="formulario-cab"></div>

<div class="lista">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php
			$total = numrows("portaria");
			$lpp = NRLINHAS;
			$inicio = @$ordem * $lpp;
			$sql 	= "SELECT * FROM portaria ORDER BY data_che DESC";
			$portarias = selectsql($sql . " LIMIT $inicio, $lpp");
			$cont = 0;

			echo "<div class='paginacao'>";
			echo mostraPaginacao("first.php?link=2", $ordem, $lpp, $total);
			echo "</div>";
			
			echo "<div class='but-cadastro'>
			<a href='first.php?link=22&acao=Cadastrar'>Cadastrar</a>
			</div>";


			if ($portarias) {
		?>
		<tr class="titulo">
			<!--<td align="center">Id</td>-->
			<td align="left">Empresa</td>
			<td align="left">Docto</td>
			<td align="center">Pre</td>
			<td align="center">PQ</td>
			<td align="center">Chegada</td>
			<td align="center">Entrada</td>
			<td align="center">Saída</td>
			<td colspan="4" width="20%" align="center">Opção</td>
		</tr>
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
		<tr>
			<!--<td align="center"><?php echo str_pad($linha["id"], 6, "0", STR_PAD_LEFT) ?></td>-->
			<td align="left"><?php echo $linha["nome"] ?></td>
			<td align="left"><?php echo $linha["docto"] ?></td>
			<td align="center"><?php echo $linha["lancado"] ?></td>
			<td align="center"><?php echo $linha["porte_peq"] ?></td>
			<td align="center"><?php echo $data_cheLb ?></td>
			<td align="center"><?php echo $data_entLb ?></td>
			<td align="center"class="<?php echo $status ?>"><?php echo $data_saiLb ?></td>
			<td><span class="but-acao"><a href="index.php?link=22&id=<?php echo $linha["id"] ?>&acao=Editar&ordem=<?php echo $ordem ?>">Editar</a></span></td>
			<td><span class="but-acao"><a href="index.php?link=22&id=<?php echo $linha["id"] ?>&acao=Excluir&ordem=<?php echo $ordem ?>">Excluir</a></span></td>
			<td><span class="but-acao"><a href="index.php?link=23&id=<?php echo $linha["id"] ?>&acao=Entrada&ordem=<?php echo $ordem ?>">Entrada</a></span></td>
			<td><span class="but-acao"><a href="index.php?link=23&id=<?php echo $linha["id"] ?>&acao=Saida&ordem=<?php echo $ordem ?>">Saída</a></span></td>
		</tr>
		<?php } ?>
	</table>

	<div class="paginacao">
		<?php echo mostraPaginacao("first.php?link=2", $ordem, $lpp, $total); ?>
		<?php } ?>
	</div>

</div>