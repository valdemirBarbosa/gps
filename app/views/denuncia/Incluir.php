<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>nova denúncia</h1>
</div>

<form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">
<fieldset>
	<label>id_denuncia</label>
	<input id="txt_id" name="txt_id" class="txt-id" type="number" value="">

	<label for="txt_denuncia">naração dos fatos da denúncia</label>
	<textarea autofocus="true" id="txt_denuncia" name="txt_denuncia" class="denuncia" rows="3" cols="70">
	</textarea>
</fieldset>

<fieldset>
<table class="denuncianteTab">
	<tr>
	<td>
		<label for="denuncianteLst" class="denunciante">Denunciante</label>
			<select name="lst_id_denunciante" id="denuncianteLst" class="denuncianteLst">
				<option>Selecione o denunciante</option>
					<?php foreach($denunciante as $d){?>
				
				<option value="<?php echo $d->id_denunciante  ?>" >
					<?php echo $d->nome_denunciante   ?> 
				</option>
				<?php }  ?>	
			</select>
	</td>
	<td>	
		<label class="tipo_document">tipo de documento</label>
			<select name="lst_tipo_documento" class="tipo_documento">
				<option>Selecione o tipo de documento</option>
					<?php foreach($documento as $doc){?>
					<option value="<?php echo $doc->id_tipo_documento   ?>">
						<?php echo $doc->tipo_de_documento   ?> </option>
				<?php }  ?>	
			</select>
	</td>

	<tr>
		<td>
			<label>número do documento</label>
			<input name="txt_numero_documento" type="number" placeholder="número do documento">
		</td>
		<td>

			<label>data de entrada</label>
			<input name="txt_data_entrada" type="date" placeholder="00/00/0000">
		</td>

	</tr>
</table>		
</fieldset>

	<fieldset>
		<label>observação</label>
		<textarea rows="3" cols="108" class="" name="txt_observacao">
		</textarea>
	</fieldset>

	<fieldset>				
			<input type="hidden" name="acao" value="Editar">
				<input type="submit" value="Incluir" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn">
				<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">
			</fieldset>
	</form>
	<div class="fim">
	</div>
