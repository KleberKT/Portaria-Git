<?php
	function mostraPaginacao($url, $ordem, $lpp, $total){
						
		$paginas = ceil($total / $lpp-1);
		$paginas_mostradas = ceil($total / $lpp); //Páginas que são mostradas realmente	
		
		
		$ordem_mostrada = $ordem + 1; //Especifica um valor para a variável ordem mostrada		
		
		if($ordem ==0){
			$mais = $ordem+1;
			$url_mais = "$url&ordem=$mais";
			$paginacao="<div><p>Página $mais de $paginas_mostradas</p><br>
			<a href=$url_mais>Próxima</a> | 
			<a href=$url&ordem=$paginas>Última</a></div>";				
		}
		if($ordem > 0){
			$mais = $ordem+1;
			$url_mais = "$url&ordem=$mais";
			$menos = $ordem - 1;
			$url_menos = "$url&ordem=$menos";
			$paginacao="<div><p>Página $mais de $paginas_mostradas</p><br>
			<a href=$url&ordem=0>Primeira</a> | 
			<a href=$url_menos>Anterior</a> | 
			<a href=$url_mais>Próximo</a> | 
			<a href=$url&ordem=$paginas>Última</a></div>";				
		}
		if($ordem ==$paginas){
			$menos = $ordem - 1;
			$url_menos = "$url&ordem=$menos";
			$paginacao="<div><p>Página $mais de $paginas_mostradas</p><br>
			<a href=$url&ordem=0>Primeira</a> |				
			<a href=$url_menos>Anterior</a>  </div>";
		}
		if($paginas <=0 ){					
			$paginacao="<div><p>Página 1 de 1 </p> </div>";
		}
		
		return $paginacao;
}

//função limata caracteres
function limita_caracteres($texto, $limite, $quebra = true){
   $tamanho = strlen($texto);
   if($tamanho <= $limite){ //Verifica se o tamanho do texto é menor ou igual ao limite
      $novo_texto = $texto;
   }else{ // Se o tamanho do texto for maior que o limite
      if($quebra == true){ // Verifica a opção de quebrar o texto
         $novo_texto = trim(substr($texto, 0, $limite))."...";
      }else{ // Se não, corta $texto na última palavra antes do limite
         $ultimo_espaco = strrpos(substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limite
         $novo_texto = trim(substr($texto, 0, $ultimo_espaco))."..."; // Corta o $texto até a posição localizada
      }
   }
   return $novo_texto; // Retorna o valor formatado
}