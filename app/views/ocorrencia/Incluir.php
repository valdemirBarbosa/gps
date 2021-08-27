<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Ocorrencias/Andamento</h1>
</div>
						
<form action="<?php echo URL_BASE ."Ocorrencia/Salvar" ?>" method="POST">
	<fieldset>
	<legend><h4>id - identificadores </h4></legend>

<?php
?>
		<label>Id Processo</label>
		<input name="txt_id_processo" type="number" value="<?php foreach($vincularProcessoOcorrencia as $vp){}
							echo $vp->id_processo; ?>">

		<label>Número do Processo</label>
		<input name="txt_numero_processo" type="number" value="<?php foreach($vincularProcessoOcorrencia as $vp){
							echo $vp->numero_processo; } ?>" >
	</legend>
	</fieldset>

	<fieldset>
		<legend>Ocorrências </legend>
		<table>
			<tr>
				<td>
					<label>Data de ocorrencia</label>
					<input autofocus name="txt_data_ocorrencia" type="date" >
				</td>
			</tr>

			<tr>
				<td>
					<label>Ocorrencia/Andamento</label>
					<input class="txt_ocorrencia" name="txt_ocorrencia" type="text" >
				</td>
			</tr>
	
			<tr>
				<td>
					<label>Observação</label>
					<input class="txt_observacao" name="txt_observacao" type="text" placeholder="observações">
				</td>
			</tr>
					</table>
					<table>
			<tr>
				<td>
					<label>Anexo</label>
				</td>
				<td>
					<input name="txt_anexo" type="file" >
				</td>
			</tr>
		</table>
			<input type="submit" value="Cadastrar" class="btn">
			<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">

	</fieldset>				
</form>
	