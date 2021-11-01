<?php	
	@$ordem	= $_POST["ordem"];

	if(!isset($_POST['inicial'])) {
		@$inicial = date("Y-m-d");
	} else {
		@$inicial = $_POST['inicial'];	
	}

	if(!isset($_POST['final'])) {
		@$final = date("Y-m-d");
	} else {
		@$final = $_POST['final'];
	}
?>

<h2>PORTARIA - RELATÓRIO</h2>

<div class="formulario">

	<form action="" method="POST">

		<div class="col1">
			<label>Dt Inicial</label>
			<input type="date" name="inicial" id="inicial" value="<?php echo @$inicial; ?>" >
		</div>	

		<div class="col2">
			<label>Dt Final</label>
			<input type="date" name="final" id="final" value="<?php echo @$final; ?>">
		</div>

		<div class="col2">
			<label>Tipo</label>
			<select name="tprel" id="tprel">
				<option value="pdf" selected>PDF</option>
				<option value="excel" >Excel</option>
	  		</select>
	  	</div>

		<input type="hidden" name="enviado" value="ok">
		<input type="submit" value="IMPRIMIR" onclick="printpdf()" class="but-salvar">

		<div class="but-cancelar">
			<a href="first.php?link=2&ordem=<?php echo $ordem ?>">CANCELAR</a>
		</div>

	</form>
	<script type="text/javascript">
	
	</script>
	<script type="text/javascript">
		function printpdf() {
			
			var inicial = document.getElementById('inicial').value;
			var final = document.getElementById('final').value;
			var tipo = document.getElementById('tprel').value;
			var url = "<?php echo URL_BASE; ?>";

			//alert('tipo---'+tipo+'---');

			if (tipo == 'pdf') {
				window.open(url+"print.php?inicial="+inicial+"&final="+final);
			} else {
				window.open(url+"first.php?link=4&inicial="+inicial+"&final="+final);
			}
			//https://pt.stackoverflow.com/questions/3312/como-redirecionar-o-usu%C3%A1rio-para-outra-p%C3%A1gina-em-javascript-jquery
		}
	</script>

</div>