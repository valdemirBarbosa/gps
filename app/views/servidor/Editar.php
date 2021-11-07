<div class="base-home">
	<h1 class="titulo-pagina">Alterar cadastro do servidor</h1>
</div>

  <form action="<?php echo URL_BASE ."servidor/Salvar" ?>" method="POST">
	<fieldset>
	   	<legend><h4>Identificação do servidor</h4></legend>
		   <label>código</label>
			<input name="txt_id" id="txt_id"value="<?php echo $servidor->id_servidor ?>" readonly>

			<label>nome</label>
			<input name="txt_nome" size="70" value="<?php echo $servidor->nome_servidor ?>" type="text" autofocus>

			<label>cpf</label>
			<input id="cpf" name="txt_cpf" value="<?php echo $servidor->cpf ?>" type="text">
		</fieldset>

		<fieldset>
             <legend><h4>Dados Funcionais</h4></legend>
			<label>matricula</label>
			<input name="txt_matricula" value="<?php echo $servidor->matricula ?>" type="number">

			<label>vinculo</label>
			<input name="txt_vinculo" value="<?php echo $servidor->vinculo ?>">

			<label>Secretaria</label>
			<input type="text" size="50" name="txt_secretaria" value="<?php echo $servidor->secretaria ?>">
			
			<div class="unidade">
				<label>unidade</label>
				<input id="unidade" name="txt_unidade" value="<?php echo $servidor->unidade ?>" type="text" >
			</div>

			<div class="obs">
				<label id="obs">observação</label> 
				<input type="text" size="130" name="txt_observacao" value="<?php echo $servidor->observacao ?>" >		
			</div>

		<div>
			<input type="hidden" name="acao" value="Cadastrar">
			<input type="hidden" name="id" value="<?php echo $servidor->id_servidor ?>">
			<input type="submit" value="Cadastrar" class="btn">
			<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn limpar"/>
		</div>
	</fieldset>
  </form>
