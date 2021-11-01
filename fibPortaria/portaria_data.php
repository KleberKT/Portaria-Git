<?php
	@$id 	= $_GET["id"];
	@$acao	= $_GET["acao"];
	@$ordem	= $_GET["ordem"];

	$portaria 	= select("portaria", "id = $id");

	$nome 		= $portaria[0]["nome"];
	$docto 		= $portaria[0]["docto"];
	$data_che	= (strtotime($portaria[0]["data_che"])?date("Y-m-d\TH:i:s",strtotime($portaria[0]["data_che"])):"");
	$data_ent	= (strtotime($portaria[0]["data_ent"])?date("Y-m-d\TH:i:s",strtotime($portaria[0]["data_ent"])):"");
	$data_sai	= (strtotime($portaria[0]["data_sai"])?date("Y-m-d\TH:i:s",strtotime($portaria[0]["data_sai"])):"");

	if ($acao == "Entrada") {
		$entHab = "";
		$saiHab = "readonly";
		if(empty($data_ent)) {
			$data_ent = date("Y-m-d\TH:i");
		}
	} else {
		$entHab = "readonly";
		$saiHab = "";
		if(empty($data_sai)) {
			$data_sai = date("Y-m-d\TH:i");
		}
	}

	if (isset($_POST["enviado"])) {

		@$url_sucesso 	= URL_BASE . "first.php?link=2&ordem=$ordem";

		$op = false;

		$_dtent = strtotime(@$_POST["data_ent"]);
		$_dataent = @$_POST["data_ent"];
		$_dtsai = strtotime(@$_POST["data_sai"]);
		$_datasai = @$_POST["data_sai"];

		$ok = true;
		if ($acao == "Entrada") {
			if (@$_dtent) {
				if ($_dtent < strtotime($data_che)) {
					$ok = false;
					print "<script type = 'text/javascript'> alert('Data INVALIDA - Data ENTRADA deve ser MAIOR que Data chegada !!!') </script>";
				}
			}
			if (@$_dtsai) {
				if ($_dtent > $_dtsai) {
					$ok = false;
					print "<script type = 'text/javascript'> alert('Data INVALIDA - Data SAIDA deve ser MAIOR que Data entrada !!!') </script>";
				}
			}
			if ($ok) {
				$op = update("portaria", array("data_ent" => $_dataent), "id = $id");
			}
		} elseif ($acao == "Saida") {
			if (@$_dtent) {
				if (($_dtent > $_dtsai) && ($_dtsai)) {
					$ok = false;
					print "<script type = 'text/javascript'> alert('Data INVALIDA - Data SAIDA deve ser MAIOR que Data entrada !!!') </script>";
				}
			} else {
				$ok = false;
				print "<script type = 'text/javascript'> alert('Data INVALIDA - Data ENTRADA OBRIGATORIA !!!') </script>";
			}
			if ($ok) {
				$op = update("portaria", array("data_sai" => $_datasai), "id = $id");
			}	
		}
		
		if ($op) {
			print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_sucesso'>";
		} else {
			print "<script type = 'text/javascript'> alert('Operação NÃO REALIZADA !!!') </script>";
		}

	}
?>

<h2>PORTARIA - <?php echo $acao ?></h2>

<div class="formulario">

	<form action="" method="post">

		<div>
			<label>Nome</label><?php echo @$nome ?>
		</div>
		
		<div>
			<label>Docto</label><?php echo @$docto ?>
		</div>

		<div>
			<label>Dt Chegada</label>
			<input class="disabled" type="datetime-local" name="data_che" id="data_che" disabled value="<?php echo @$data_che ?>">			
		</div>

		<div>
			<label>Dt Entrada</label>
			<input class="<?php echo $entHab ?>" type="datetime-local" name="data_ent" id="data_ent" <?php echo $entHab ?> value="<?php echo @$data_ent ?>">
		</div>	

		<div>
			<label>Dt Saída</label>
			<input class="<?php echo $saiHab ?>" type="datetime-local" name="data_sai" id="data_sai" <?php echo $saiHab ?> value="<?php echo @$data_sai ?>">
		</div>

		<input type="hidden" name="enviado" value="ok">
		<input type="submit" value="GRAVAR" class="but-salvar">

		<div class="but-cancelar">
			<a href="first.php?link=2&ordem=<?php echo $ordem ?>">CANCELAR</a>
		</div>

	</form>

</div>