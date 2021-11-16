<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados da ocorrência</h1>
</div>

<form action="<?php echo URL_BASE ."Ocorrencia/Salvar" ?>" method="POST">
<fieldset>
<legend><h4>id - identificadores </h4></legend>
	<?php foreach($ocorrencia as $ocor){ ?>
		<label>Id da ocorrência</label>
			<input id="txt_id" name="txt_id_ocorrencia" value="<?php echo $ocor->id_ocorrencia ?>" >

			<label>Id do processo</label>
			<input id="txt_id" name="txt_id_pprocesso" value="<?php echo $ocor->id_processo ?>" >

			<label>Número do processo</label>
			<input name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $ocor->numero_processo ?>">
</fieldset>

	<fieldset>
		<legend>Ocorrências</legend>
			<label>Data da ocorrencia</label>
			<input autofocus name="txt_data_ocorrencia" type="date" value="<?php echo $ocor->data_ocorrencia ?>">

			<div class="ocorrencia">		
				<label>Ocorrência</label>
				<input type="text" size="110" name="txt_ocorrencia" value="<?php echo $ocor->ocorrencia ?>"> 
			</div>

			<br/>
				<label id="obs">observação</label> 
				<input type="text" size="110" name="txt_observacao" value="<?php echo $ocor->observacao ?>"> 
			<br/>
	</fieldset>
	
		<?php } ?>
				
		<input type="hidden" name="id_ocorrencia" value="<?php echo $ocor->id_ocorrencia ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
		<br/>
		<br/>
		<br/>
		
		</form>
