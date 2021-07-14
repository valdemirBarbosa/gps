<div class="base-home">
	<h1 class="titulo-pagina">Lista de denúncias</h1>
</div>
	
<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($denuncia) ?></b> denuncia(s) cadastrada(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denuncia/Novo" ?>" >INCLUIR </a></div>

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
				<th width="10%" align="center"> id</th>
				<th width="30%">Narração da denúncia</th>
				<th width="10%">tipo documento</th>
				<th width="10%">número</td>
				<th width="10%">data de entrada</th>
				<th width="20%">observação</th>
				<th width="10%" align="center" colspan="2">Ação</th>
			</tr>
	<?php 
	  foreach($denuncia as $den){
	?>
		<tr>
		   <td align="center"><?php echo $den->id_denuncia  ?> </td>
		   <td><?php echo $den->denuncia_fato  ?> </td>
		   <td align="center"><?php echo $den->tipo_de_documento ?> </td>
		   <td align="center"><?php echo $den->numero_documento  ?></td>
		   <?php $dt_entrada = explode("-",$den->data_entrada);
		   $dia = $dt_entrada[2];
		   $mes = $dt_entrada[1];
		   $ano = $dt_entrada[0];
	?>
	         <td align="center"><?php echo $dia."/".$mes."/".$ano  ?> </td> 
		   <td><?php echo $den->observacao ?> </td>
		   <td>
			<div class="btn-editar"> 
				<a href="<?php echo URL_BASE ."denuncia/Edit/".$den->id_denuncia ?>" >Editar</a>
	  	      </div>	
               </td>
		   <td>
			<div class="btn-excluir"> 
				<a href="<?php echo URL_BASE ."denuncia/Excluir/".$den->id_denuncia ?>" >Excluir</a>
				</div>
			</td>
		   </tr> 
	<?php } ?>

			<hr/><hr/>
		</table>
</div>		
</body>
</html>