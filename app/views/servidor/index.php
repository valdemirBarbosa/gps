<?php
	if(!isset($_SESSION)){
	session_start();
	}
?>

<div class="base-home">
	<h1 class="titulo-pagina">Lista de servidores</h1>
</div>

<?php //paramentros para pesquisa dos formulários de denuncia e processo

		$tabela = 'servidor';
		$view =  'servidor/index';
		$retorno = 'servidorRet';
?>
<div class="frmConsulta">  
	<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/porParametro'; ?>" >
	
	<label>Pesquisa</label>
		<select name="pesquisa" class="select">
<!-- 				<option value="1">Número do documento</option>
				<option value="2">Número do Processo</option>
 -->				<option value="3">Nome</option>
				<option value="4">CPF</option>
		</select>
	
		<input class="pesquisa" type="text" autofocus name="valorPreenchidoUsuario">
		<input type="hidden" name="view" value="<?php echo $view ?>">
		<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
		<input type="hidden" name="tabela" value="<?php echo $tabela ?>">
		
		<input type="submit" value="pesquisar">
	</form>
</div>

<div class="base-lista">
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			   <tr>
				<th width="15%" align="left">Nome do servidor</th>
				<th width="5%" align="center">Cpf</th>
				<th width="5%" align="center">Matricula</th>
				<th width="7%" align="left">Vinculo</th>
				<th width="10%" align="left">Secretaria</th>
				<th width="10%" align="left">Unidade</th>
				<th width="5%" colspan="2" align="center">Ação</th>
			  </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($dados as $servidor){   ?>
				<tr class="cor1">
				<td align="center"><?php echo $servidor->nome_servidor  ?></td>
				<td align="center"><?php echo $servidor->cpf  ?></td>
				<td><?php echo $servidor->matricula  ?></td>
				<td><?php echo $servidor->vinculo  ?></td>
				<td><?php echo $servidor->secretaria  ?></td>
				<td><?php echo $servidor->unidade  ?></td>	
				<td align="center">
					<div class="btn-editar">
						<a href="<?php echo URL_BASE ."servidor/Editar/".$servidor->id_servidor ?>" >Editar</a>
					</div>
				</td>
				<td align="center">
					<div class="btn-excluir">
						<a href="<?php echo URL_BASE ."servidor/Excluir/".$servidor->id_servidor ?>" >excluir</a>
					</div>
				</td>
			 </tr>	
			 <?php } ?>									  
		  </tbody>

			<!--Botões !-->
			<div class="btn-inc">
				<script> //Link para voltar à página anterior
					document.write('<a href="' + document.referrer + '">Voltar</a>');
				</script>
			</div>			
			
			<div class="btn-inc">
				<a href="<?php echo URL_BASE . "servidor/novo" ?>" >INCLUIR </a>
			</div>

			<tr><td align="center" colspan="9">
				
			<?php
				$totalPaginas = $_SESSION['totalPaginas'];


				for($q=1; $q<=$totalPaginas; $q++):  
					echo "<a href=".URL_BASE.'pesquisa/porParametroLink/?p='.($q); ?> > <?php echo "[".($q)."]" ?> </a> 
<?php
			   endfor;
		     ?>
			</fieldset>
				</td>
	</table>
</div>
</body>
</html>