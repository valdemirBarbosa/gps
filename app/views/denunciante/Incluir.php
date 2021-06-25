<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Ocorrencias/Denunciante</h1>
</div>

<form action="<?php echo URL_BASE ."denunciante/Salvar" ?>" method="POST">
	<fieldset>
		<label>Nome/Descrição do denunciante</label>
		<input name="txt_nome" required autofocus  type="text" placeholder="Insira o nome/descrição do denunciante">


		<div class="obs">	
			<label>observação</label>
			<textarea  name="txt_observacao" rows="5" cols="100">
			</textarea>
		</div>
			<input type="hidden" name="acao" value="Cadastrar">
			<input type="hidden" name="id" value="">
			<input type="submit" value="Cadastrar" class="btn">
			<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
		</div>
			</form>
		</div>	
</div>	
	