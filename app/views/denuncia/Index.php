<?php
	if(!isset($_SESSION)){
	session_start();
	}
?>

<div class="base-home">
	<h1 class="titulo-pagina">Lista de denúncias</h1>
</div>
<?php //paramentros para pesquisa dos formulários de denuncia e processo
 		$tabela = 'denuncia';
 		$view = 'denuncia/Index';
		$retorno = 'denunciaRet';
?>
<div class="frmconsulta">
	<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/porParametro'; ?>" >
					<label>Pesquisa</label> 
					<select name="pesquisa" class="select">
						<option value="1">Número do documento</option>
						<option value="2">Número do Processo</option>
						<option value="3">Nome</option>
						<option value="4">CPF</option>
					</select>
						<input class="pesquisa" type="text" autofocus name="valorPreenchidoUsuario">
						<input type="hidden" name="view" value="<?php echo $view ?>">
						<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
						<input type="hidden" name="tabela" value='<?php echo $tabela ?>'>
						<input type="submit" value="pesquisar">
	</form>
</div>

<div class="base-lista">
		<table border="1" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
				<th width="5%" align="center"> id</th>
				<th width="30%">Narração da denúncia</th>
				<th width="10%">tipo documento</th>
				<th width="1%">número</th>
				<th width="7%">data de entrada</th>
				<th width="20%">denunciados</th>
				<th width="30%">documentos anexados</th>
				<th width="10%" align="center" colspan="2">Ação</th>
			</tr>
	<?php
	if(isset($dados)){ 
	foreach($dados as $den){
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
		
			 <td><?php echo $den->documentos_anexados ?> </td>
	
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
	<?php }
	} ?>
	</div>

	<!--Botões !-->
	<div class="btn-inc">
		<script> //Link para voltar à página anterior
  			document.write('<a href="' + document.referrer + '">Voltar</a>');
 		</script>
	</div>			
	
	<div class="btn-inc">
		<a href="<?php echo URL_BASE . "denuncia/Novo" ?>" >INCLUIR </a>
	</div>

</table>
<?php
				$totalPaginas = $_SESSION['totalPaginas'];


				for($q=1; $q<=$totalPaginas; $q++):  
					echo "<a href=".URL_BASE.'pesquisa/porParametroLink/?p='.($q); ?> > <?php echo "[".($q)."]" ?> </a> 
<?php
			   endfor;
		     ?>

</body>
</html>