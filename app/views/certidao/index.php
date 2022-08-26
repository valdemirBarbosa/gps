<div class="base-home">
	<h1 class="titulo-pagina">Certidão</h1>

</div>
<div class="certidao">
<img width="60%" height="10%" src="<?php echo URL_BASE ."assets\img\logoMaio2021.JPG" ?>" width="400" height="200">	

<div class="pai">  
	<div class="filho1">  
		<form method="POST" action="<?php echo URL_BASE . 'Certidao/cnp'; ?>" >
				<label>Pesquisa</label>
					<label>CPF</label>
						<input autofocus type="number" name="cpf" value="">
						<input type="submit" value="Gerar Atestado">
		</form>

</div>
</div>
</div>
	<?php 
		if(isset($dados)){
			foreach ($dados as $certidao){

?>
			<div class='margemCertidao'> 
				<div class="cabecahoCertidao">
					<!--<img width='600' height='50' src ='" . URL_BASE . "assets/img/logoMaio2021.jpg'>  -->
					<img width='700' height='50' src ='<?php echo  URL_BASE . "assets/img/logoMaio2021.jpg" ?>'>";

					<br><br><h3>Secretaria de Administração
					<br><p>Comissão Permanente de Sindicância e Processos Administrativo Discliplinares
					</p></h3>
					
					<br><br><br><br><h2>Atestado</h2>
		  		</div> <!-- Fim da div cabecalho da certidao -->
<?php
				foreach ($certidao as $c){?>

				<br><br><br><br>
				<div class="CorpoTextoCertida">
					Atestamos para os devidos fins que o(a) servidor(a) <?php echo $c[1] ." , CPF: ".$c[2] . $c[0]; ?> 
				</div> <!-- Fim da div corpo do texto certidao -->
<?php			} 
			}
		}
		?>

			</div> 


