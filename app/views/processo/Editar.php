<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados do Processo</h1>
</div>

<form action="<?php echo URL_BASE ."Processo/Salvar" ?>" method="POST">
		<?php foreach($processo as $pd){ ?>
		<fieldset>
			<legend><h4>Códigos</h4></legend>	
				<label>Id do Processo</label>
						<input id="txt_id" readonly name="txt_id_processo" enable="false" value="<?php echo $pd->id_processo ?>" >

				<label>Id da denuncia</label>
				<input readonly name="txt_id_denuncia" enable="false" value="<?php echo $pd->id_denuncia ?>" >

				<label>fase</label>
				<select name="txt_id_fase">
					<option><?php echo $pd->fase ?></option>

					<?php foreach($fase as $f){ ?>
						<option value="<?php echo $f->id_fase ?>"><?php echo $f->fase ?> </option>
					<?PHP } ?>
				</select>

		</fieldset>		
		<fieldset>
			<legend>informações do processo</legend>
				<label>Número do Processo</label>
					<input class="txt_numero_processo" name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $pd->numero_processo ?>">
				
				<label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" value="<?php echo $pd->data_instauracao ?>">

				<div class="obs">
					<label id="obs">observação</label> 
				</div>
				<textarea rows="4" cols="100" name="txt_observacao"> 
					<?php echo $pd->observacao ?> 
				</textarea>	
				
				<label>Data de Encerramento</label>
					<input name="txt_data_encerramento" type="date" value="<?php echo $pd->data_encerramento ?>">

		</fieldset>
		<?php } ?>
			<input type="hidden" name="id_processo" value="<?php echo $pd->id_processo ?>">	
			<input type="submit" value="Salvar" class="btn">
			<input type="reset" name="Reset" id="button" value="Voltar" class="btn limpar">

		</form>

<!-- Formulário para anexar arquivos   		
		<form action="<?php echo URL_BASE .'Processo/Anexar' ?>" method="POST" multiple="multiple">
			<?php //$id_processo = $pd->id_processo; ?>
		<table>
		  <tr>
		    <td>
		        <input type="hidden" name="id_processo" value="<?php //id_processo = $pd->id_processo; ?>">
		 	  <input type="file" name="arquivo"></label>
		    <td>
		    <td>
		  	 <input type="submit" value="Anexar arquivo">
		    </td>
		  </tr>
		</table>
		</form>	!-->
		</div>	
</div>	
	