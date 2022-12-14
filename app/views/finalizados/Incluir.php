
<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Finalizar Processo</h1>
</div>

<form action="<?php echo URL_BASE ."finalizados/Salvar" ?>" method="POST">

<fieldset>

<?php
        foreach($finalizados as $f){
		$id_processo = $f->id_processo;
		$numero_processo = $f->numero_processo;
		$id_processado = $f->id_processado;
        }
?>
 		<label>id do processo</label>
 		<input type="text" name="id_processo" value="<?php echo $id_processo ?>">

		<label>numero do processo</label>
 		<input type="text" name="numero_processo" value="<?php echo $numero_processo ?>">

		 <label>id do processado</label>
 		<input type="text" name="id_processado" value="<?php echo $id_processado?>">

		<label>data finalização</label>
 		<input type="date" name="data_julgamento" autofocus value="<?php ?>">

	<fieldset>

		<label>penalidade</label>
 		<textarea rows="2" cols="130" class="" name="penalidade"></textarea>
	
		<br>
		
		<label>observacao</label>
 		<textarea rows="2" cols="130" class="" name="observacao"></textarea>
	</fieldset>


	<fieldset>				
			<input type="hidden" name="acao" value="Editar">
				<input type="submit" value="Incluir" class="btn">
				<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">
			</fieldset>
	</form>
	<div class="fim">
	</div>
