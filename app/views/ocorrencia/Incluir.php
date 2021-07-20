<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Ocorrencias/Andamento</h1>
</div>

<form action="<?php echo URL_BASE ."Ocorrencia/Salvar" ?>" method="POST">
	<fieldset>
	<legend><h4>id - identificadores </h4></legend>
		<label>Id ocorrencia</label>
		<input id="txt_id" name="txt_id_ocorrencia" enable="false" readonly>

		<label>Id Processo</label>
		<input id="txt_id_processo" name="txt_id_processo" type="number" placeholder="Informe o ID do processo"value="<?php foreach($processo as $p){
										echo $p->id_processo; 
										}?>">

		<label>Número do Processo</label>
		<input name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php foreach($processo as $p){
						echo $p->numero_processo;
					} ?>" >
	</legend>
	</fieldset>

	<fieldset>
		<legend>Ocorrências </legend>
		<table>
			<th>Data de ocorrencia</th>
			<th>Ocorrencia/Andamento</th>
			<tr>
				<td><input autofocus name="txt_data_ocorrencia" type="date" ></td>
				<td><input name="txt_ocorrencia" type="text" ></td>
			</tr>
		</table>

		<label>Observação</label>
		<input name="txt_observacao" type="text" placeholder="Livre para observações"></td>

		<label>Anexo</label>
		<td><input name="txt_anexo" type="file" >
</td>


			<input type="submit" value="Cadastrar" class="btn">
			<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</form>
</div>	
</div>	
	