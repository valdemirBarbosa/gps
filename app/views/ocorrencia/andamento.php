<div class="base-home">
	<h1 class="titulo-pagina">Dados do Processo</h1>

<div class="frmConsulta">  
	<form method="POST" action="<?php echo URL_BASE . 'Andamento/ConsultaPorNumeroProcesso' ?>" >
		<label>Pesquisa por número do processo</label>
		<input type="number" autofocus name="pesquisaPorNumeroProcesso">
		<input type="submit" value="pesquisar">
	</form>
</div>
</div>

<form action="<?php echo URL_BASE ."Processo/Salvar" ?>" method="POST">
		<?php foreach($processo as $pd){ ?>
		<fieldset>
			<legend><h4>Códigos</h4></legend>	
				<label>Id do Processo</label>
						<input id="txt_id" readonly name="txt_id_processo" enable="false" value="<?php echo $pd->id_processo ?>" >

				<label>Id da denuncia</label>
				<input readonly name="txt_id_denuncia" enable="false" value="<?php echo $pd->id_denuncia ?>" >

				<label>fase</label>
				<select name="txt_id_fase">
					<option value="<?php echo $pd->id_fase ?>"><?php echo $pd->fase ?></option>

					<?php foreach($fase as $f){ ?>
						<option value="<?php echo $f->id_fase ?>"><?php echo $f->fase ?> </option>
					<?PHP } ?>
				</select>
		</fieldset>		

		<fieldset>
			<legend>informações do processo</legend>
				<label>Número do Processo</label>
					<input class="txt_numero_processo" name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $pd->numero_processo ?>">
				
				<label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" value="<?php echo $pd->data_instauracao ?>">

				<div class="obs">
					<label id="obs">observação</label> 
				</div>
				<textarea rows="4" cols="100" name="txt_observacao"> 
					<?php echo $pd->observacao ?> 
				</textarea>	
				
				<label>Data de Encerramento</label>
					<input name="txt_data_encerramento" type="date" value="<?php echo $pd->data_encerramento ?>">
		</fieldset>
		
		<?php } ?>

	<fieldset>
		<div >	
		<table class="tabela_ocorrencia" width="98%" border="1" cellspacing="1" cellpadding="0">
		  <thead>
			<tr>
				<th align="center" width="5%">Id</th>
				<th align="center" width="5%">Id.proc..</th>
				<th align="center" width="10%">Número do Processo</th>
				<th align="center" width="10%">Data da ocorrência </th>
				<th align="center" width="60%">ocorrência </th>
				<th width="5%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
	<?php 
	  foreach($ocorrencia as $oco){
	?>
			<tr>
				<td align="center"><?php echo $oco->id_ocorrencia ?> </td>
				<td align="center"><?php echo $oco->id_processo ?> </td>
				<td align="center"><?php echo $oco->numero_processo ?> </td>
				<td><?php echo date('d/m/Y', strtotime($oco->data_ocorrencia)) ?> </td> 
				<td><?php echo $oco->ocorrencia ?> </td>
				<td align="center"><?php echo $oco->anexo ?> </td>
			
				<td>
					<div class="btn-editar"> 
						<a href="<?php echo URL_BASE ."Ocorrencia/Edit/".$oco->id_ocorrencia ?>">Editar</a>
	  				</div>
				</td>
				<td>
					<div class="btn-excluir"> 
						<a href="<?php echo URL_BASE ."Ocorrencia/Excluir/".$oco->id_ocorrencia ?>" >Excluir</a>
					  </div>
				</td>
			</tr> 
	<?php } ?>
	  </div>
	  </div>
		</table>
	  </fieldset>
		<p>...</P>
					
</body>
</html>