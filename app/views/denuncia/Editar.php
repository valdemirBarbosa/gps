<div class="base-home">
		<h1 class="titulo-pagina">Alterar denúncia</h1>
	</div>

  <form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">
		<fieldset>
		<legend><h4>DENÚNCIA</h4></legend>
			<label>id denuncia</label>
				<input id="txt_id" name="txt_id" value="<?php echo $denuncia->id_denuncia ?>" >

			<label>Naração dos fatos da denúncia</label>
		      	<textarea rows="3" cols="80" clas="denuncia" name="txt_denuncia"> <?php echo $denuncia->denuncia_fato ?>
				</textarea>
		</fieldset>
		
		<fieldset>
		<label for="denuncianteLst" clas="denunciante">Denunciante</label>
		<select clss="denunciante" name="denunciante" clas="denunciante">
					<option><?php echo $denuncia->nome_denunciante ?>
						<?php foreach($denunciante as $den){?>
							<option value="<?php echo $den->id_denunciante ?>"> <?php echo $den->nome_denunciante ?>
					</option>
				<?php } ?>
		</select>

		<label clas="tipo_document">tipo de documento</label>
					<select nome="lst_tipo_documento" clas="tipo_documento">
						<option><?php echo $denuncia->tipo_de_documento?></option>
							<?php foreach($tipo_doc as $doc){?>
							<option value="<?php $doc->id_tipo_documento   ?>">
								<?php echo $doc->tipo_de_documento   ?> </option>
						<?php }  ?>	
					</select>
		</fieldset>

		<fieldset>
			<label>numero do documento</label>
					<input name="txt_numero_documento" type="text" value="<?php echo $denuncia->numero_documento ?>"  >

				<label for="dataMask">data de entrada</label>
					<input id="dataMask" name="txt_data_entrada" value="<?php echo $denuncia->data_entrada?>" type="date" required>

				</fieldset>					
			<fieldset>
				<label>Denunciados</label>
				<textarea rows="2" cols="110"  clas="areaDenuncia" name="txt_denunciados">
							<?php echo $denuncia->denunciados ?> 
				</textarea> 
					
					<br/>
					<label id="obs">observação</label> 
					<input type="text" size="116" name="txt_observacao" value="<?php echo $denuncia->observacao ?>"> 

			</fieldset>

			<fieldset>				
				<input type="hidden" name="acao" value="Editar">
				<input type="hidden" name="id" value="<?php echo $denuncia->id_denuncia ?>">
				<input type="submit" value="Alterar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn">
				<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">
			</fieldset>
	</form>
	<div class="fim">
	</div>
</form>
