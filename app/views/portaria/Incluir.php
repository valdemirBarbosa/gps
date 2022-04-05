<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>nova Portaria</h1>
</div>
<form action="<?php echo URL_BASE ."portaria/Salvar" ?>" method="POST">
		<fieldset>
			<legend><h4>Códigos</h4></legend>	
			<?php foreach($vincProcess as $vp){ }?>

				<label>Id do Processo</label>
				<input id="txt_id_processo" type="number"  name="txt_id_processo" value="<?php  echo $vp->id_processo; ?>">

				<label>Número do Processo</label>
				<input value="<?php echo $vp->numero_processo; ?>"  id="txt_numero_processo" type="number"  name="txt_numero_processo">
			</fieldset>		

		<fieldset>
			<legend>Informações da Portaria</legend>
				<label>Tipo</label>
					<input name="txt_tipo" type="text" placeholder="tipo da portaria" required autofocus>

				<label>Número da Portaria</label>
					<input name="txt_numero" type="number" placeholder="Insira o  Número da Portaria" required>
				
				<label>Data de elaboracao</label>
					<input name="txt_data_elaboracao" type="date" required>
				<br/>
				<label>Data de publicação</label>
					<input name="txt_data_publicacao" type="date" required>

				<label>Veículo</label>
					<input name="txt_veículo" type="text" placeholder="veículo da publicação" required>
									
				<label>Prazo</label>
					<input name="txt_prazo" min="1" type="number" placeholder="Prazo para cumprimento em dias" required>

					<br/>
	
				<label>Conteúdo</label>
					<textarea name="txt_conteudo" rows="3" cols="140" placeholder="redação da portaria">
				</textarea> 
	
				<label>observação</label>
		    		<input name="txt_observacao" type="text" size="120" cols="40" rows="2">
	    </fieldset>

		<fieldset>				
					<input type="hidden" name="acao" value="Editar">
					<input type="submit" value="Incluir" class="btn">
					<input type="reset" name="Reset" id="button" value="Limpar" class="btn">
					<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">
		</fieldset>
    <div class="fim">
	</div>
</form>

