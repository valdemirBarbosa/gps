<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Processo</h1>
</div>

<form action="<?php echo URL_BASE ."Processo/Salvar" ?>" method="POST">

<fieldset>
	<legend><h4>id - identificadores </h4></legend>
	<br/>
<br/>
<br/>

	<div class="cabecalhoForm">

	<!-- início da classe css id_denuncia  -->
		<div class="id_denuncia">  		
				<?php
					if(isset($_GET['id'])){?>
 						<?php echo "Identificador da denúncia: ".$_GET['id'] ?> 
				<?php } ?> 
		</div> <!-- Fim da classe css id_denuncia  -->		

	<!-- início da classe css faseLabel  -->
<!-- 		<div class="faseLabel"> 				
 --> 					
		 <!-- Fim da classe css faseLabel  -->

	<!-- início da classe css fase  -->
		<div class="fase">
 
		</div><!-- fim da classe css fase  -->

	</div>
			<br/>
			<label for="">Incluindo no: </label>
 			<?php
			 $fase = 0;
				if(isset($_GET['f'])){ //f de fase  ?>
					<?php
						$fase = $_GET['f'];
						if($fase == 1)
							echo "PROCESSO PRELIMINAR";
							if($fase == 2)
								echo "SINDICANCIA";
								if($fase == 3)
									echo "PAD";
				} ?>
			<br/>
	<div class="num_processo">
		<label>Número do Processo</label>
		<input autofocus name="txt_numero_processo" type="number" placeholder="Insira o número do processo">
	
		<label>Data de Instauração</label>
		<input name="txt_data_instauracao" type="date" >
	</div>		


	<div class="obs">
		<label id="obs">observação</label> 
	</div>
	
	<textarea rows="3" cols="95" name="txt_observacao" class="txtArea"> 
	</textarea>		

	<br/>
	<label class="lblAnexo">Anexo</label>
	<input class="btnAnexo" name="txt_anexo" type="file" >
	
	<br/>
		<input type="submit" value="Cadastrar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn_limpar">
	</form>
</fieldset>