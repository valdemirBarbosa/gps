<div class="base-home">
	<h1 class="titulo"><span class="cor">Alterar</span> cadastro</h1>
      <div class="base-formulario">	
	<form action="<?php echo URL_BASE ."denunciado/Salvar" ?>" method="POST">
		<label>id</label>
			<input name="txt_id" value="<?php echo $denunciado->id_servidor ?>" readonly>
		<label>nome</label>
			<input name="txt_nome" value="<?php echo $denunciado->nome_servidor ?>" type="text" autofocus>
		<label>cpf</label>
			<input name="txt_cpf" value="<?php echo $denunciado->cpf ?>" type="text"> 
		<div class="col">
			<label>matricula</label>
			<input name="txt_matricula" value="<?php echo $denunciado->matricula ?>" type="number">
	
			<label>nome provisório</label>
			<input name="txt_nome_provisorio" value="<?php echo $denunciado->nome_provisorio ?>" type="text">
		</div>	
		
		<div class="col">
			<label>vinculo</label>
			<input name="txt_vinculo" value="<?php echo $denunciado->vinculo ?>" type="text" >
		</div>
		<div class="col">
			<label>secretaria</label>
			<input name="txt_secretaria" value="<?php echo $denunciado->secretaria ?>" type="text" >
		</div>	
		
		<div class="col">
			<label>unidade</label>
			<input name="txt_unidade" value="<?php echo $denunciado->unidade ?>" type="text" >
		</div>
			<label>observacao</label>
			<input name="txt_observacao" value="<?php echo $denunciado->observacao ?>" type="txt_observacao" >
		
		<input type="hidden" name="acao" value="Editar">
		<input type="hidden" name="id_denunciado" value="<?php echo $denunciado->id_denunciado ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</form>
</div>	
</div>	
	