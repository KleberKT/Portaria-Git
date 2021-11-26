<?php
   $file = "rel" . date('Y-m-d H:i:s').".csv";

   ob_clean();
   ob_start();
   header('Content-Type: application/csv');
   //header('Content-Disposition: attachment; filename="$datlstExc.csv"');
   header('Content-Disposition: attachment; filename="'.$file.'"');

   $inicial = $_GET['inicial']." 00:00:00";
   $final = $_GET['final']." 23:29:59";

   $fp = fopen('php://output', 'w+');

   $sql = "SELECT id,nome,docto,lancado,porte_peq,data_che,data_ent,data_sai,
           CONCAT(TIMESTAMPDIFF(HOUR,data_che + INTERVAL TIMESTAMPDIFF(DAY,data_che,data_ent) DAY, data_ent),':',
           CAST(TIMESTAMPDIFF(MINUTE,data_che + INTERVAL TIMESTAMPDIFF(HOUR,data_che,data_ent) HOUR, data_ent)AS CHAR)) AS data1,
           CONCAT(TIMESTAMPDIFF(HOUR,data_ent + INTERVAL TIMESTAMPDIFF(DAY,data_ent,data_sai) DAY, data_sai),':',
           CAST(TIMESTAMPDIFF(MINUTE,data_ent + INTERVAL TIMESTAMPDIFF(HOUR,data_ent,data_sai) HOUR, data_sai)AS CHAR)) AS data2,
           CONCAT(TIMESTAMPDIFF(HOUR,data_che + INTERVAL TIMESTAMPDIFF(DAY,data_che,data_sai) DAY, data_sai),':',
           CAST(TIMESTAMPDIFF(MINUTE,data_che + INTERVAL TIMESTAMPDIFF(HOUR,data_che,data_sai) HOUR, data_sai)AS CHAR)) AS data3,
           motorista,rg,cpf,placa,obs 
           FROM portaria 
           WHERE data_che >= ('$inicial') 
           AND data_che <= ('$final') 
           ORDER BY data_che DESC";

   $results = selectsql($sql);

   fputs($fp,"ID;NOME;DOCTO;PRE NOTA;PORTE PEQ;DT CHEGADA;DATA ENTRADA;DATA SAIDA;MOTORISTA;RG;CPF;PLACA;OBS"."\r\n");

   foreach ( $results as $result ) 
   {
      fputcsv( $fp, $result, ";" );
   }

   fclose($fp);
   die();

?>
