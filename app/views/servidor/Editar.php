<div class="base-home">
	<h1 class="titulo"><span class="cor">Alterar</span> cadastro do servidor</h1>
      <div class="base-formulario">	
	<form action="<?php echo URL_BASE ."servidor/Salvar" ?>" method="POST">
		<label>id</label>
			<input name="txt_id" value="<?php echo $servidor->id_servidor ?>" readonly>
		<label>nome</label>
			<input name="txt_nome" value="<?php echo $servidor->nome_servidor ?>" type="text" autofocus>
		<label>cpf</label>
			<input name="txt_cpf" value="<?php echo $servidor->cpf ?>" type="text"> 
		<div class="col">
			<label>matricula</label>
			<input name="txt_matricula" value="<?php echo $servidor->matricula ?>" type="number">
		</div>	
		
		<div class="col">
			<label>vinculo</label>
			<input name="txt_vinculo" value="<?php echo $servidor->vinculo ?>" type="text" >
		</div>
		<div class="col">
			<label>secretaria</label>
			<input name="txt_secretaria" value="<?php echo $servidor->secretaria ?>" type="text" >
		</div>	
		
		<div class="col">
			<label>unidade</label>
			<input name="txt_unidade" value="<?php echo $servidor->unidade ?>" type="text" >
		</div>
			<label>observacao</label>
			<input name="txt_observacao" value="<?php echo $servidor->observacao ?>" type="txt_observacao" >
		
		<input type="hidden" name="acao" value="Editar">
		<input type="hidden" name="id_denunciado" value="<?php echo $servidor->id_denunciado ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</form>
</div>	
</div>	
	