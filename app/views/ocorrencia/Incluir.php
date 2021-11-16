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
			<label>Data de ocorrencia</label>
			<input autofocus name="txt_data_ocorrencia" type="date" >

			<br/>
			<label>Ocorrencia/Andamento</label>
			<input class="txt_ocorrencia" size="110" name="txt_ocorrencia" type="text" >
		
			<br/>
			<label>Observação</label>
			<input class="txt_observacao" size="119" name="txt_observacao" type="text" placeholder="observações">

			<br/>
			<label>Anexo</label>
			<input name="txt_anexo" type="file" >
		</fieldset>				

	<fieldset>				
					<input type="hidden" name="acao" value="Editar">
					<input type="submit" value="Incluir" class="btn">
					<input type="reset" name="Reset" id="button" value="Limpar" class="btn">
					<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">
		</fieldset>
    <div class="fim">
	</div>
</form>

	