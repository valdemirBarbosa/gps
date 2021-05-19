<div class="base-home">
	<h1 class="titulo"><span class="cor">Alterar</span> cadastro</h1>
      <div class="base-formulario">	
	<form action="<?php echo URL_BASE ."denunciante/Salvar" ?>" method="POST">
		<label>id</label>
			<input name="txt_id" value="<?php echo $denunciante->id_denunciante ?>" readonly>
		<label>nome</label>

			<input name="txt_nome" value="<?php echo $denunciante->nome_denunciante ?>" type="text" autofocus>
		
		<div class="col">
			<label>observação</label>
			<input name="txt_observacao" value="<?php echo $denunciante->observacao ?>" type="text" >
		</div>
		
		<input type="hidden" name="acao" value="Editar">
		<input type="hidden" name="id_denunciante" value="<?php echo $denunciante->id_denunciante ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</form>
</div>	
</div>	
	