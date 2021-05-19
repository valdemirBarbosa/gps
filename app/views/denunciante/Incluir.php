<div class="base-home">
			<h1 class="titulo"><span class="cor">Novo</span> cadastro</h1>
		<div class="base-formulario">	
			<form action="<?php echo URL_BASE ."denunciante/Salvar" ?>" method="POST">
				
			<div class="col">
				
				<label>Id do denunciante</label>
					<input name="txt_id" disabled type="number">

				<label>Nome/Descrição do denunciante</label>
					<input name="txt_nome" required autofocus  type="text" placeholder="Insira o nome/descrição do denunciante">
			</div>

			<div>
				<label>Observações</label>
					<textarea name="txt_observacao" rows="3" placeholder="Insira observações" class="txt-obs">
					</textarea>
			</div>

				<div class="col">
					<input type="hidden" name="acao" value="Cadastrar">
					<input type="hidden" name="id" value="">
					<input type="submit" value="Cadastrar" class="btn">
					<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
				</div>

			</form>
		</div>	
</div>	
	