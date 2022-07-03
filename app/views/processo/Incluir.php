<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Processo</h1>
</div>

<form enctype="multipart/form-data" action="<?php echo URL_BASE ."Processo/Salvar" ?>" method="POST">

<fieldset>
	<legend><h4>id - identificadores </h4></legend>
	<br/>
<br/>
<br/>
<? 
	$view = "denuncia/index";
?>
	<div class="cabecalhoForm">

	<!-- início da classe css id_denuncia  -->
		<div class="">  		
				<?php
					if(isset($_GET['id'])){?>
 						<?php 
						 	$id = addslashes($_GET['id']);
							echo "<span class='spanTitulo'>Identificador da denúncia: $id</span>"; ?> 
						<input name="txt_id_denuncia" type="number" hidden value="<?php echo $id ?>">

					<?php } ?> 
						 <input name='view' hidden type='text' value="<?php echo $view ?>" >

		</div> <!-- Fim da classe css id_denuncia  -->		

	<!-- início da classe css fase  -->
		<div class="fase">
 
		</div><!-- fim da classe css fase  -->

	</div>
			<br/>
			<label for=""><div class="txtProcessoNovo"> INCLUÍNDO NO: </label>
 			<?php
			 $fase = 0;
				if(isset($_GET['f'])){ //f de fase  ?>
					<input hidden name="txt_id_fase" value="<?php echo $_GET['f'] ?>">
					<?php
							$fase = $_GET['f'];
							if($fase == 1)
								echo "PROCESSO PRELIMINAR";
								if($fase == 2)
									echo "SINDICANCIA";
									if($fase == 3)
										echo "PROCESSO ADMINISTRATIVO";
					}?></div>
			<br/>
	</fieldset>
		
	<fieldset>
		<div class="num_processo">
		<label>Número do Processo</label>
		<input autofocus name="txt_numero_processo" type="number" placeholder="Insira o número do processo">
	
		<label>Data de Instauração</label>
		<input required name="data_instauracao" type="date" >
	</div>		


	<div class="obs">
		<label id="obs">observação</label> 
			<textarea rows="1" cols="110" name="txt_observacao" class="txtArea"> 
	</textarea>		

	</div>

</form>
	<br/>
	<br/>
	<br/>
		<div class="centralizaBotão">
			<input type="submit" value="Cadastrar" class="btn">
		</div>

</fieldset>