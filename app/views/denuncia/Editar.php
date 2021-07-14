<div class="base-home">
		<h1 class="titulo-pagina">Alterar denúncia</h1>
	</div>

	  <form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">
		<fieldset>
		<legend><h4>denúncia</h4></legend>
			<label>id denuncia</label>
				<input id="txt_id" name="txt_id" value="<?php echo $denuncia->id_denuncia ?>" >

			<label>Naração dos fatos da denúncia</label>
		      	<textarea rows="3" cols="85" class="denuncia" name="txt_denuncia"> <?php echo $denuncia->denuncia_fato ?>
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
					<select nome="lst_tipo_documento" class="tipo_documento">
						<option>Selecione o tipo de documento</option>
							<?php foreach($documento as $doc){?>
							<option value="<?php $doc->id_tipo_documento   ?>">
								<?php echo $doc->tipo_de_documento   ?> </option>
						<?php }  ?>	
					</select>
			</td>
			</table>
		</fieldset>

		<fieldset>
		<table border="1">
		  <tr>
			<td width="45%">
				<label>numero do documento</label>
					<input name="txt_numero_documento" type="number" value="<?php echo $denuncia->numero_documento ?>"  >
			</td>	
			<td width="55%">
				<div>
				<label for="dataMask">data de entrada</label>
					<input id="dataMask" name="txt_data_entrada" value="<?php echo $denuncia->data_entrada?>" type="date" required>
				</div> 
			</td>
			<td></td>
			</tr>
			</table> 
				<div class="observacao">
					<label>Observação</label>
				</div>
	
				<textarea rows="3" cols="85" class="denuncia" name="txt_observacao">
						<?php echo $denuncia->observacao ?> 
				</textarea> 
			</fieldset>
		
		<input type="hidden" name="id_denuncia" value="<?php echo $denuncia->id_denuncia ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</form>
</div>	
</div>	
	