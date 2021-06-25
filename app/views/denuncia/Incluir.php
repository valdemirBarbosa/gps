<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>nova denúncia</h1>
</div>

<form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">
<fieldset>
	<label>id_denuncia</label>
	<input id="txt_id" name="txt_id" class="txt-id" type="number" value="">

	<label for="txt_denuncia">naração dos fatos da denúncia</label>
	<textarea id="txt_denuncia" name="txt_denuncia" class="denuncia" rows="3" cols="30">
	</textarea>
	
	<label>Denunciante</label>
		<select>
			<?php foreach($denunciante as $d){?>
				<option value="<?php echo $d->id_denunciante   ?>">
					 <?php echo $d->nome_denunciante   ?> </option>
			<?php }  ?>	
		</select>
	
	<label>tipo de documento</label>
	<input name="txt_tipo_documento" value="" type="text" placeholder="Insira o tipo de documento anexado">
				
	<label>número do documento</label>
	<input name="txt_numero_documento" value="" type="number" placeholder="número do documento">

	<label>data de entrada</label>
	<input name="txt_data_entrada" value="" type="date" placeholder="00/00/0000">

	<label>observação</label>
	<textarea rows="3" cols="85" class="denuncia" name="txt_observacao">
	</textarea>
</fieldset>	

<fieldset>				
	<input type="hidden" name="acao" value="Cadastrar">
	<input type="hidden" name="id" value="">
	<input type="submit" value="Cadastrar" class="btn">
	<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
</fieldset>
	</form>
</div>	
</div>	
	