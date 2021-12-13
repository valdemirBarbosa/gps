<div class="base-home">
	<h1 class="titulo-pagina">Alterar cadastro de denunciante</h1>
</div>
			<!--Botões !-->
			<div class="btn-inc">
				<script> //Link para voltar à página anterior
					document.write('<a href="' + document.referrer + '">Voltar</a>');
				</script>
			</div>			
			

  <form action="<?php echo URL_BASE ."denunciante/Salvar" ?>" method="POST">
<fieldset>
  <legend><h4>denunciante</h4></legend>
	<div class="centraliza">
	   <label>código</label>
		<input id="txt_id" name="txt_id" value="<?php echo $denunciante->id_denunciante ?>" readonly>

		<label>nome</label>
			<input name="txt_nome" value="<?php echo $denunciante->nome_denunciante ?>" type="text" autofocus>
			<div>
				<label>observação</label>
				<input name="txt_observacao" type="text" size="100" cols="40" rows="2" value="<?php echo $denunciante->observacaoDenunciante ?>" >
			</div>
			</div>
		</fieldset>

		<fieldset>				
			<input type="hidden" name="acao" value="Editar">
			<input type="hidden" name="id_denunciante" value="<?php echo $denunciante->id_denunciante ?>">
			<input type="submit" value="Alterar" class="btn">
			<input type="reset" name="Reset" id="button" value="Limpar" class="btn">
			<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">
			<br/><br/>

		</fieldset>
	</form>
