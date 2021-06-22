<div class="base-home">
	<h1 class="titulo-pagina">Lista de Processo Preliminar / Sindicância</h1>
</div>

<div class="base-lista">


	<span class="qtde">Há <b><?php echo count($ppSind) ?></b> processo preliminares e sindicâncias</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "PpSindicancia/Novo" ?>" >INCLUIR </a></div>
<!--
	<form class="form-pesquisa" method="post" action="<?php echo URL_BASE ."denuncia/Pesquisar/"?>">
	   <table>
		<tr>
		   <td width="10%">
			<label>Pesquisar por ID</label>
			<input name="id_denuncia" type="number">
               </td>
		 
		   <td width="20%">
			<label>Pesquisar por numero do processo</label>
			<input name="numero_processo" type="text">
               </td>

		   <td width="20%">
			<label>Pesquisar por denunciante</label>
			<input name="nome_denunciante" type="text">
               </td>
	     </tr>

		  <tr><td colspan="5"> 
		  		<input type="submit" value="Pesquisar" class="btn-dark">
			</td>
		  </tr>
        </table>
      </form>

 Incluindo um formulário de pesquisa de denuncia !-->

 <div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
				<th  width="7%">Id Sindicância</th>
				<th  width="7%">Id Denuncia</th>
				<th width="20%">Fase</th>
				<th width="15%">Numero do Processo</td>
				<th width="10%">Data Instauração </th>
				<th width="25%">Observação</th>
				<th width="25%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
		</thead>
	<?php 
	  foreach($ppSind as $ps){
	?>
			<tr>
				<td align="center" ><?php echo $ps->id ?> </td>
				<td align="center" ><?php echo $ps->id_denuncia ?> </td>
				<td align="center"><?php echo $ps->fase  ?> </td>
				<td align="center"><?php echo $ps->numero_processo ?> </td>
				<td><?php echo date('d/m/Y', strtotime($ps->data_instauracao)) ?> </td> 
				<td><?php echo $ps->observacao  ?> </td>
				<td><?php echo $ps->anexo ?> </td>
				<td>
					<div class="btn-editar">
						<a href="<?php echo URL_BASE ."PpSindicancia/Edit/".$ps->id ?>" class="btn">Editar</a>
	  				</div>			
				</td>
				<td>
					<div class="btn-excluir">	 
						<a href="<?php echo URL_BASE ."PpSindicancia/Excluir/".$ps->id ?>" class="btn">Excluir</a>
					</div>	
				</td>
			</tr> 
	<?php } ?>

			<hr/><hr/>
		</table>
	</div>				
		<p>...</P>
</div>					
</div>
</div>

</body>
</html>