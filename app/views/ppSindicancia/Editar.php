<div class="base-home">
		<h1 class="titulo-pagina">Alterar dados do processo</h1>
	</div>

	  <form action="<?php echo URL_BASE ."PpSindicancia/Salvar" ?>" method="POST">
		<fieldset>
			<legend><h4>códigos</h4></legend>

		<?php foreach($pp as $ps){ ?>
				<label>id</label>
					<input id="txt_id" name="txt_id" readonly="true" value="<?php echo $ps->id ?>" >

				<label>Id da Denuncia</label>
					<input id="txt_id" name="txt_id_denuncia" readonly="true"  type="number" value="<?php echo $ps->id_denuncia ?>" >

				<label for="fase">FASE</label>
					<select name="txt_fase" id="txt_fase">
						<option value=""><?php echo $ps->fase ?></option>
						<option value="1">Procedimento Preliminar</option>
						<option value="2">SINDICÂNCIA</option>
					</select>
		</fieldset> 
		<fieldset> 

				<label>Número do Processo</label>
					<input name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $ps->numero_processo ?>">
				
				<label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" value="<?php echo $ps->data_instauracao ?>">

				<div class="txt-obs">
					<label>Observação</label>
						<textarea name="txt_observacao" rows="4" cols="100">
							<?php echo $ps->observacao ?>
					</textarea>
				</div>
		<?php } ?>

				<input type="submit" value="Salvar" class="btn">
				<input type="reset" name="Reset" id="button" value="Voltar" class="btn limpar">
			</form>
		</div>	
</div>	
	