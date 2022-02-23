<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados da Portaria</h1>
</div>

<form action="<?php echo URL_BASE ."Portaria/Salvar" ?>" method="POST">
		<?php
			if(isset($portaria)){ 
				foreach($portaria as $port){ ?>
	<fieldset>
			<legend><h4>Códigos</h4></legend>	
				<label>Id Portaria</label>
					<input id="txt_id" readonly name="txt_id_portaria" enable="false" value="<?php echo $port->id_portaria ?>" >

				<label>Número do Processo</label>
					<input id="txt_numero_processo" type="number" readonly name="txt_numero_processo" value="<?php echo $port->numero_processo?>" >
		</fieldset>		
		<fieldset>
 			<legend>Informações da Portaria</legend>

<!-- 	            <label>Tipo</label> //tirado temporariamente provavelmente não será util, se for reativarei
					<input autofocus name="txt_tipo" type="text" placeholder="tipo da portaria" value="<?php echo $port->tipo ?>">
 -->
				<label>Número</label>
					<input name="txt_numero" type="number" placeholder="Insira o  Número da Portaria" value="<?php echo $port->numero ?>">
				
				<label>Data de elaboracao</label>
					<input name="txt_data_elaboracao" type="date" value="<?php echo $port->data_elaboracao ?>">

				<br/><br/>
				<label>Conteúdo</label>
					<textarea name="txt_conteudo" cols="100" rows="2"> 
						<?php echo $port->conteudo ?>
				</textarea>

				<br/><br/>
				<label>Data Publicação</label>
					<input name="txt_data_publicacao" type="date" value="<?php echo $port->data_publicacao ?>">

				<label>Veículo</label>
					<input name="txt_veículo" type="text" placeholder="veículo da publicação" value="<?php echo $port->veiculo ?>">
				
				<label>Prazo</label>
					<input name="txt_prazo" type="number" value="<?php echo $port->prazo ?>">

				<br/><br/>
				<label>Data final</label>
					<input name="txt_data_final" type="date" value="<?php echo $port->data_final ?>">

				<label>Data realizada</label>
					<input name="txt_data_realizada" type="date" value="<?php echo $port->data_realizada ?>">

				<label>Prazo atendido</label>
					<input name="txt_prazo_atendido" type="text" placeholder="Prazo para cumprimento em dias" value="<?php echo $port->prazo ?>">

					<br/><br/>
					<label id="obs">observação</label> 
					<input type="text" name="txt_observacao" size="100" value="<?php echo $port->observacao ?>" >
				<?php }} ?>
				<br/><br/><br/>
				<input type="submit" value="Salvar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
				<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">

		</fieldset>
</form>
	