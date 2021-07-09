<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>PAD</h1>
</div>

<form action="<?php echo URL_BASE ."Pad/Salvar" ?>" method="POST">
	<fieldset>
	<legend><h4>id - identificadores </h4></legend>
	<div class="id_denuncia">
		<label>Id da denuncia</label>
			<select  class="id_pp_denuncia" name="txt_id_pp_sindicancia">
				<option>Selecione o código da denúncia, confime com o número do documento</option>
				<?php foreach($denunciaId as $id){?>
					<option value="<?php $id->id_denuncia ?>"> 
				<?php echo "<td>Código: ".$id->id_denuncia."</td><td> /  Número Documento: ".$id->numero_documento."</td>
				<td> / Denúcia: ".$id->denuncia_fato."</td>";  ?> </option>
			<?php  } ?>
		</select>
	</div>		
	
	<div class="sindicancia">
		<label class="id_pp_sind">Id do Procedimento preliminar ou da sindicância</label>
		<select name="txt_id_pp_sindicancia" class="id_pp_sind_select">
			<option><span>Selecione o código da sindicância ou do processo prelimiar</span>

			</option>

			<?php foreach($sindicancia as $sind){?>
			<option value="<?php $sind->id_sindicancia ?>"> <?php echo "Código sindicância ".	$sind->id_sindicancia." / Número do processo ".$sind->numero_processo ?>
			</option>
			<?php } ?>
		</select>
	</div>

	<div class="num_processo">
		<label>Número do Processo</label>
		<input autofocus name="txt_numero_processo" type="number" placeholder="Insira o número do processo">
	
		<label>Data de Instauração</label>
		<input name="txt_data_instauracao" type="date" >
	</div>		


	<div class="obs">
	<label id="obs">observação</label> 
	</div>
	
	<textarea rows="4" cols="100" name="txt_observacao"> 
	</textarea>		

	<label>Anexo</label>
	<input name="txt_anexo" type="file" >

	<div class="btn">
		<input type="submit" value="Cadastrar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</div>			
</form>

	