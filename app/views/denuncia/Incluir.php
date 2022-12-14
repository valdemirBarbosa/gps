
<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>nova denúncia</h1>
</div>

<form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">

<fieldset>
		<label>Naração dos fatos da denúncia</label>
 		<textarea rows="1" cols="112" class=""  autofocus name="txt_denuncia">
		</textarea>
 	</fieldset>

	<fieldset>
<table class="denuncianteTab">
	<tr>
	<td>
		<label for="denuncianteLst" class="denunciante">Denunciante</label>
			<select autocomplete name="lst_id_denunciante" id="denuncianteLst" class="denuncianteLst">
				<option>Selecione o denunciante</option>

				<?php foreach($denunciante as $d){
				 ?>
				 
				<option value="<?php echo $d->id_denunciante ?>" >
					<?php echo $d->nome_denunciante  ?> 
					
				</option>
					

				<?php }
				
				?>	
			</select>
	</td>
	<td>	
		<label class="tipo_document">tipo de documento</label>
			<select name="id_tipo_doc" class="tipo_documento">
				<option>Selecione o tipo de documento</option>
					<?php foreach($documento as $doc){?>
					<option value="<?php echo $doc->id_tipo_documento  ?>">
						<?php echo $doc->tipo_de_documento  ?> </option>
				<?php } ?>	
			</select>
	</td>

	<tr>
		<td>
			<label>número do documento</label>
			<input name="txt_numero_documento" type="text" placeholder="número do documento">
		</td>
		<td>

			<label>data de entrada</label>
			<input name="txt_data_entrada" type="date" placeholder="00/00/0000">
		</td>

	</tr>
</table>		
</fieldset>

<!--
	<fieldset>
		<label>denunciados</label>
 		<textarea rows="2" cols="130" class="" name="txt_denunciados" dirname="explanation.dir">
		</textarea>
 	</fieldset>
-->

	<fieldset>
		<label>documentos anexados ao processo</label>
 		<textarea rows="1" cols="110" class="" name="txt_documentos_anexados">
		</textarea>
 	</fieldset>

	<fieldset>
		<label>observação</label>
 		<textarea rows="2" cols="130" class="" name="txt_observacao">
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
