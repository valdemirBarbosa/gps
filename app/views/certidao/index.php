<div class="base-home">
	<h1 class="titulo-pagina">Certidão</h1>

</div>
<div class="certidao">
<img width="60%" height="10%" src="<?php echo URL_BASE ."assets\img\logoMaio2021.JPG" ?>" width="400" height="200">	

<div class="pai">  
	<div class="filho1">  
		<form method="GET" action="<?php echo URL_BASE . 'CertidaoNew/cnp'; ?>" >
				<label>Pesquisa</label>
					<label>CPF</label>
						<input autofocus type="number" name="cpf">
						<input type="submit" value="Gerar Atestado">

		</form>

<!--	****************** HTML ************************   // -->
<?php

		$html1 = "<div class='margemCertidao'> 
				<div class='cabecahoCertidao'>";
		$logo = "<img width='792' height='90' src ='". URL_BASE . "assets/img/logoMaio2021.jpg'>";

		$html2 = "<br><br><h3>Secretaria de Administração
				<br><p>Comissão Permanente de Sindicância e Processos Administrativo Discliplinares
				</p></h3>
								
				<br><br><br><br><h2>Atestado</h2>
				</div> <!-- Fim da div cabecalho da certidao -->";

				if(isset($dadosCertidao)){
					foreach ($dadosCertidao as $c){
	/* 					print_r($dadosCertidao);
	//					exit;
	*/
						$html3 = "<br>
								<div class='corpoTextoCertidao'>
								Atestamos para os devidos fins que o(a) servidor(a) "; 
										
						$html4 =  $dadosCertidao[0] . " CPF: " .$dadosCertidao[1] . $dadosCertidao[2];  
								"</div> <!-- Fim da div corpo do texto certidao -->
								</div>"; 
								}
						$html = $logo . $html1  . $html2 . $html3 . $html4;
					}
	 ?>

	<form method="GET" action="<?php echo URL_BASE . 'Certidao/imprimir' ?>" >
			<input type="submit" value="Imprimir">
			<input type="hidden" name="html" value="<?php 
														if(isset($html)){
															echo $html;
														}else{
															exit;
														}
														 ?>" > 
	</form>
	