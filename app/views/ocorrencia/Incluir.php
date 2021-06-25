<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Ocorrencias/Andamento</h1>
</div>

<form action="<?php echo URL_BASE ."Ocorrencia/Salvar" ?>" method="POST">
	<fieldset>
	<legend><h4>id - identificadores </h4></legend>
		<label>Id ocorrencia</label>
		<input id="txt_id" name="txt_id_ocorrencia" enable="false" readonly>

		<label>Id Processo</label>
		<input id="txt_id_processo" name="txt_id_processo" type="number" placeholder="Informe o número do processo">

		<label>Fase</label>
		<select name="txt_fase" id="txt_fase">
			<option value="1">PROCEDIMENTO PRELIMINAR</option>
			<option value="2">SINDICÂNCIA</option>
		</select> 
		
		<label>Número do Processo/Documento</label>
		<input autofocus name="txt_numero_processo" type="number" placeholder="Insira o número do processo">
	</legend>

		<label>Data de ocorrencia</label>
		<input name="txt_data_ocorrencia" type="date" >

		<label>Ocorrencia/Andamento</label>
		<input name="txt_ocorrencia" type="text" >

		<label>Observação</label>
		<input name="txt_observacao" type="text" placeholder="Livre para observações">

		<label>Anexo</label>
		<input name="txt_anexo" type="file" >

		<input type="submit" value="Cadastrar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</fieldset>
	</form>
</div>	
</div>	
	