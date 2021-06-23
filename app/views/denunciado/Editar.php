<div class="base-home">
	<h1 class="titulo-pagina">Alterar cadastro do denunciado</h1>
</div>

<form action="<?php echo URL_BASE ."denunciado/Salvar" ?>" method="POST">
	<fieldset>
	 	<legend><h4>Identificação do denunciado</h4></legend>
	      <label>código</label>

		<input id="txt_id" name="txt_id" value="<?php echo $denunciado->id_servidor ?>" readonly>
		<label>nome</label>
		
		<input name="txt_nome" value="<?php echo $denunciado->nome_servidor ?>" type="text" autofocus>
		
		<label>cpf</label>
		<input id="cpf" name="txt_cpf" value="<?php echo $denunciado->cpf ?>" type="text"> 
		</fieldset>
		
	<fieldset>
         <legend><h4>Dados Funcionais</h4></legend>
		<label>matricula</label>
		<input id="matricula" name="txt_matricula" value="<?php echo $denunciado->matricula ?>" type="number">

		<label>vinculo</label>
		<input id="vinculo" name="txt_vinculo" value="<?php echo $denunciado->vinculo ?>" type="text" >

		<label>secretaria</label>
		<input id="secretaria" name="txt_secretaria" value="<?php echo $denunciado->secretaria ?>" type="text" >

		<div class="unidade">
			<label>unidade</label>
			<input id="unidade" name="txt_unidade" value="<?php echo $denunciado->unidade ?>" type="text" >
		</div>

		<div class="obs">
			<label id="obs">observação</label> 
		</div>
		<textarea rows="4" cols="100" name="txt_observacao" value="<?php echo 				$denunciado->observacao ?>" type="txt_observacao" >
		</textarea>
	</fieldset>
	
	<div  class="">
		<input type="hidden" name="acao" value="Editar">
		<input type="hidden" name="id_denunciado" value="<?php echo $denunciado->id_denunciado ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</div>
</form>
	