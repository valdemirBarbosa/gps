<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Processo</h1>
</div>

<form action="<?php echo URL_BASE ."Pad/Salvar" ?>" method="POST">
	<fieldset>
	<legend><h4>id - identificadores </h4></legend>
		<label>Id da denuncia</label>
		<select autofocus name="id_denuncia">
			<?php foreach($denunciaId as $den){?>
			<option value="<?php echo $den->id_denuncia?>">
				<?php echo $den->id_denuncia." / ".$den->denuncia_fato; }?>
			</option>
		</select>
	
		<label class="faseLbl">Fase</label>
		<select class="faselst" name="fase" class="fase">
			<option>FASE DO PROCESSO
				<?php foreach($fase as $f){?>
					<option value="<?php $f->id_fase ?>"> <?php echo $f->fase ?>
			</option>
		<?php } ?>
		</select>

	<div class="num_processo">
		<label>Número do Processo</label>
		<input name="txt_numero_processo" type="number" placeholder="Insira o número do processo">
	
		<label>Data de Instauração</label>
		<input name="txt_data_instauracao" type="date" >
	</div>		


	<div class="obs">
	<label id="obs">observação</label> 
	</div>
	
	<textarea rows="4" cols="95" name="txt_observacao" class="txtArea"> 
	</textarea>		

	<label class="lblAnexo">Anexo</label>
	<input class="btnAnexo" name="txt_anexo" type="file" >

		<input type="submit" value="Cadastrar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn_limpar">
</form>
</fieldset>