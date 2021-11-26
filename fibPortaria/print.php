<?php
	require_once("fPDF/fpdf.php");
	require_once("include/config.php");
	require_once("include/crud.php");

	$inicial = $_GET['inicial']." 00:00:00";
	$final = $_GET['final']." 23:29:59";

	class relatorio extends FPDF{

		function Header(){

			$data_impressao = 'DATA DE IMPRESSÃO: ';
			$data_impressao .= date('d/m/Y');

			$this->Cell(560,75,'',1,0,"L");
			$this->Ln(2);
			$this->Image('logo_syspot3.jpg',425,30);
			$this->SetFont('Arial','B',11);

			$this->Cell(0,20,"SYSPOT",0,0,'L');
			$this->Ln(13);
			$this->SetFont('Arial','',10);
			$this->Cell(0,20,"RELATÓRIO GERAL",0,0,'L');
			$this->Ln(13);
			$this->Cell(0,20,"ENTRADA E SAÍDA DE MOTORISTAS",0,0,'L');
			$this->Ln(13);
			$this->Cell(0,20,$data_impressao,0,0,'L');
			$this->Ln(13);
			$this->Cell(0,20,"2021",0,0,'L');
			$this->Ln(40);			
		}
	}

	$pdf=new relatorio("P","pt","A4");
	$pdf->AddPage();

	$sql = "SELECT * 
			FROM portaria 
			WHERE data_che >= ('$inicial') 
			AND data_che <= ('$final') 
			ORDER BY data_che DESC";
				
	$portarias = selectsql($sql);

	//echo $sql;exit();

	if($portarias) {
		foreach ($portarias as $linha) {
			$pdf->Cell(50,20,"Chegada",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$pdf->Cell(00,20,date("d-m-Y   H:i:s",strtotime($linha["data_che"])),0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"Entrada",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$pdf->Cell(0,20,date("d-m-Y   H:i:s",strtotime($linha["data_ent"])),0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"Saída",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$pdf->Cell(00,20,date("d-m-Y   H:i:s",strtotime($linha["data_sai"])),0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"Nota",0,0,'L');
			$pdf->Cell(10,20,": ",0,0,'L');
			$pdf->Cell(00,20,$linha["docto"],0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"Empresa",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$pdf->Cell(00,20,$linha["nome"],0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"Motorista",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$pdf->Cell(00,20,$linha["motorista"],0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"CNH",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$pdf->Cell(00,20,$linha["rg"],0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"CPF",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$pdf->Cell(00,20,$linha["cpf"],0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"Placa",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$pdf->Cell(00,20,$linha["placa"],0,0,'L');
			$pdf->Ln(11);
			$pdf->Cell(50,20,"Obs:",0,0,'L');
			$pdf->Cell(10,20,":",0,0,'L');
			$obs = explode("\n", $linha["obs"]);
			$pdf->Cell(00,20,$obs[0],0,0,'L');

			$pdf->Ln(30);
		}
	} else {

	}

 	ob_clean(); 
	$pdf->Output();

   

?>