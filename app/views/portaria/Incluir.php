<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>nova Portaria</h1>
</div>
<form action="<?php echo URL_BASE ."portaria/Salvar" ?>" method="POST">
		<fieldset>
			<legend><h4>Códigos</h4></legend>	

				<label>Id do Processo</label>
				<input id="txt_id_processo" type="number"  name="txt_id_processo" value="<?php foreach($vincProcess as $vp){ echo $vp->id_processo; }?>">

				<label>Número do Processo</label>
				<input autofocus id="txt_numero_processo" type="number"  name="txt_numero_processo" >

				<label>Id fase</label>
					<input id="txt_id_fase" name="txt_id_fase">

		</fieldset>		

		<fieldset>
			<legend>Informações da Portaria</legend>
				<label>Tipo</label>
					<input name="txt_tipo" type="text" placeholder="tipo da portaria">

				<label>Número da Portaria</label>
					<input name="txt_numero" type="number" placeholder="Insira o  Número da Portaria">
				
				<label>Data de elaboracao</label>
					<input name="txt_data_elaboracao" type="date">

				<label>Conteúdo</label>
					<input name="txt_conteudo" type="text" placeholder="conteúdo da portaria">

				
				<label>Data de publicação</label>
					<input name="txt_data_publicacao" type="date">

				<label>Veículo</label>
					<input name="txt_veículo" type="text" placeholder="veículo da publicação">
				
				<label>Prazo</label>
					<input name="txt_prazo" type="number" placeholder="Prazo para cumprimento em dias">
				
				<label>Data final</label>
					<input name="txt_data_final" type="date">

				<label>Data realizada</label>
					<input NAME="txt_data_realizada" type="DATE">

				<label>Prazo atendido</label>
					<input name="txt_prazo_atendido" type="text" placeholder="Prazo para cumprimento em dias">
				
				<div class="obs">
					<label id="obs">observação</label> 
				</div>
				<textarea rows="4" cols="100" name="txt_observacao">
				</textarea>		
		</fieldset>
				<input type="submit" value="Salvar" class="btn">
				<input type="reset" name="Reset" id="button" value="Voltar" class="btn limpar">

		</form>

<!-- Formulário para anexar arquivos   		
		<form action="<?php echo URL_BASE .'Pad/Anexar' ?>" method="POST" multiple="multiple">
			<?php //$id_pad = $port->id_pad; ?>
		<table>
		  <tr>
		    <td>
		        <input type="hidden" name="id_pad" value="<?php //id_pad = $port->id_pad; ?>">
		 	  <input type="file" name="arquivo"></label>
		    <td>
		    <td>
		  	 <input type="submit" value="Anexar arquivo">
		    </td>
		  </tr>
		</table>
		</form>	!-->
		</div>	
</div>	
	