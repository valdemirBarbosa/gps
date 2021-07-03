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
			<legend>denunciante</legend>			
			<label>id denunciante</label>
				<input id="txt_id" name="txt_id_denunciante" value="<?php echo $denuncia->id_denunciante ?>" type="number" >
			
			<label>denunciante</label>
				<input name="txt_denunciante" type="text" value="<?php echo $denuncia->nome_denunciante ?>" >
		</fieldset>

		<fieldset>
			<label>Tipo de documento</label>
				<input name="txt_tipo_documento" value="<?php echo $denuncia->tipo_documento ?>" > 

			<label>numero do documento</label>
				<input name="txt_numero_documento" type="number" value="<?php echo $denuncia->numero_documento ?>"  >
		<table>
		  <tr>
			<td width="50px">
				<div class="data">
					<label for="dataMask">data de entrada</label>
					<input id="dataMask" name="txt_data_entrada" value="<?php echo $denuncia->data_entrada?>" type="date" required>
				</div> 
			</td>
		   </tr>
		
			<td>
				<div class="observacao">
					<label>Observação</label>
				</div>
			</td>
			</tr>

			<tr>    
		      <td>
				<textarea rows="3" cols="85" class="denuncia" name="txt_observacao">
					 <?php echo $denuncia->observacao ?> 
				</textarea> 
		      </td>
		      </tr>
		</table> 
		</fieldset>
		
		<input type="hidden" name="id_denuncia" value="<?php echo $denuncia->id_denuncia ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</form>
</div>	
</div>	
	