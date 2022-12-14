<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Denunciante</h1>
</div>

			<!--Botões !-->

<form action="<?php echo URL_BASE ."denunciante/Salvar" ?>" method="POST">
	<fieldset>
		<label>Nome/Descrição do denunciante</label>
		<input autofocus name="txt_nome" type="text" size="87" placeholder="Insira o nome/descrição do denunciante" required>

		<div>	
			<label>observação</label>
			<textarea  name="txt_observacao" rows="5" cols="100" ></textarea>
		</div>

			<input type="hidden" name="acao" value="Cadastrar">
			<input type="hidden" name="id" value="NULL">
			<input type="submit" value="Cadastrar" class="btn">
			<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn limpar"/>
		
	</fieldset>
</form>
