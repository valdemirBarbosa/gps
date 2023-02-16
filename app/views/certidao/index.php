<div class="base-home">
	<h1 class="titulo-pagina">Certidão</h1>

</div>
<div class="certidao">

<div class="paiCertidao">  
<img width="60%" height="10%" src="<?php echo URL_BASE ."assets\img\logoMaio2021.JPG" ?>" width="400" height="200">	

	<div class="filho1">  
		<form method="GET" action="<?php echo URL_BASE . 'CertidaoNew/cnp'; ?>" >
				<label>Informe o CPF</label><br/>
						<input required autofocus type="number" name="cpf">
						<input type="submit" value="Gerar Atestado">
						<input class="sucess" form="imprimir" type="submit" value="Imprimir">

		</form>
		</div> <!-- fim da div filho1 certidao -->

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
						$html3 = "<br>
								<div class='corpoTextoCertidao'>
								ATESTAMOS PARA OS DEVIDOS FINS QUE O(A) SERVIDOR(A) ";
										
						$html4 =  $dadosCertidao;  
								"</div> <!-- Fim da div corpo do texto certidao -->
								</div> <!-- Fim da div margem certidao -->"; 

						$html = $logo . $html1  . $html2 . $html3 . $html4;
					}
                    
                    if(isset($html4)){				
        			    echo "<hr/>";
    					    echo "<div class='resultadoCertidao'>".$html4."</div>";
    				    echo "<hr/>";
                    }
    
	 ?>
<div class="paiCertidao">  
	<form name="imprimir" id="imprimir" method="POST" action="<?php echo URL_BASE . 'Certidao/imprimir' ?>" >
			<input type="hidden" name="html" value="<?php echo $html ?>" > 
	</form>
</div> <!-- Fim da div paiCertidao 2 -->

	</div> <!-- Fim da div paiCertidao-->
	</div> <!-- Fim da div certidao -->