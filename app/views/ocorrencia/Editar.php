<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados da ocorrência</h1>
</div>

<form action="<?php echo URL_BASE ."Ocorrencia/Salvar" ?>" method="POST">
<fieldset>
<legend><h4>id - identificadores </h4></legend>
	<?php foreach($ocorrencia as $ocor){ ?>
		<label>Id da ocorrência</label>
			<input id="txt_id" name="txt_id_ocorrencia" value="<?php echo $ocor->id_ocorrencia ?>" >

			<label>Id fase</label>
			<input id="txt_id"  name="txt_id_fase"  enable="false" value="<?php echo $ocor->id_fase ?>" >

			<label>Número do processo anterior</label>
			<input name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $ocor->numero_processo ?>">
</fieldset>

	<fieldset>
		<legend>Ocorrências</legend>
			<label>Data da ocorrencia</label>
			<input name="txt_data_ocorrencia" type="date" value="<?php echo $ocor->data_ocorrencia ?>">

			<div class="ocorrencia">		
				<label>Ocorrência</label>
				<textarea rows="2" cols="55" name="txt_ocorrencia">
					<?php echo $ocor->ocorrencias ?>
				</textarea>
			</div>

			<div class="obs">
				<label id="obs">observação</label> 
			</div>
				<textarea rows="4" cols="100" name="txt_observacao">
						<?php echo $ocor->observacao ?>		
				</textarea>
	</fieldset>
	
		<?php } ?>
				
		<input type="hidden" name="id_ocorrencia" value="<?php echo $ocor->id_ocorrencia ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">

		</form>
