<div class="base-home">
	<h1 class="titulo-pagina">Lista de denúncias</h1>
</div>
<?php //paramentros para pesquisa dos formulários de denuncia e processo
 		$tabela = 'denuncia';
 		$view = 'denuncia/Index';
		$retorno = 'denunciaRet';
?>

<div class="containerPesqusa">
<div class="frmConsulta">  
	<form method="GET" action="<?php echo URL_BASE . 'Pesquisa/Consulta'; ?>" >
		<table>
			<tr>
				<td>
					<label>Pesquisa</label>
						<select name="pesquisa" class="select">
								<option value="1">Número do documento</option>
								<option value="2">Número do Processo</option>
								<option value="3">Nome</option>
								<option value="4">CPF</option>
						</select>
				</td>
				<td>
						<input type="text" autofocus name="valorPreenchidoUsuario">
						<input type="hidden" name="view" value="<?php echo $view ?>">
						<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
						<input type="hidden" name="tabela" value='<?php echo $tabela ?>'>
						<input type="submit" value="pesquisar">
				</td>
			</tr>
			</table>

			</form>
		</div>
	</div>
		
	
<div class="base-lista">
	<span class="qtde">Há <b><?php echo  count($denunciaRet) ?></b> denuncia(s) cadastrada(s)</span>
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
				<th width="20%">denunciados</th>
				<th width="10%" align="center" colspan="2">Ação</th>
			</tr>
	<?php 
	  foreach($denunciaRet as $den){
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
		   <td><?php echo $den->denunciados ?> </td>
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