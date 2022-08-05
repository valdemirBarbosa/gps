<div class="base-home">
	<h1 class="titulo-pagina">Lista de denunciados - falta parametrizar no index porque no model e no controller está ok</h1>

</div>
<div class="base-lista">
	<span class="qtde">Há <b><?php if(isset($servidor)){
/* 			print_r($denunciados);
			exit;
 */		   		echo count($servidor);
			}else{
				echo 0;
    		} 
	 ?></b> denunciado(s) cadastrado(s)</span>

	<!-- INCLUÍDO EM 29/07/2022                                                                                -->
	<div class="base-home">
	<h1 class="titulo-pagina"> Consulta servidor 
		<?php  
			$qtde = 0;
			if(isset($servidor) && count($servidor) > 0){
				$qtde = count($servidor);
			}else{
				$qtde = 0; 
			}
			echo "Qtde: ".$qtde;
		?></h1>
	</div>

<?php //paramentros para pesquisa dos formulários de denuncia e processo
		$tabela = 'servidor';
		$view =  'denunciado/index';
		$_SESSION['view'] = $view; 
		$_SESSION['tabela'] = $tabela; 
?>
<div class="pai">  
	<div class="filho1">  
		<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/ConsultaDenuncia_e_Processo'; ?>" >
				<label>Pesquisa</label>
					<select name="pesquisa" class="select">
<!-- 						<option value="1">Número documento da denúncia</option>
						<option value="2">NÚMERO DO PROCESSO</option>
 -->						<option value="3">Nome</option>
						<option value="4">CPF</option>
					</select>
				
					<input class="" type="text" autofocus name="valorPreenchidoUsuario">
					<input type="hidden" name="view" value="<?php echo $view ?>">
					<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
					<input type="hidden" name="tabela" value="<?php echo $tabela ?>">
					<input type="submit" value="pesquisar">
		</form>
	</div>
</div>
<!--                                                                                                      -->

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			   <tr>
				<th align="center">Nome do servidor</th>
				<th align="left">CPF</th>
				<th align="left">Vinculo</th>
				<th align="left">Secretaria</th>
				<th align="left">Unidade</th>
			  </tr>
		  </thead>
		  <tbody>
		  	<?php 
				if(isset($servidor)){
					foreach($servidor as $serv){
			?>

				<tr class="cor1">
				<td align="center"><?php echo $serv[1]  ?></td>
				<td><?php echo $serv[2]  ?></td>
				<td><?php echo $serv[4]  ?></td>
				<td><?php echo $serv[5]  ?></td>
				<td><?php echo $serv[6]  ?></td>	
				<td align="center">
				</td>
			 </tr>
		<?php }
		} ?>
		</table>

	<!-- registros da tabela de denunciados -->				
		<table>
		<thead>	 
		<tr><td colspan="7"><div class="tituloTabela">Registro de Denúncias</div></td></tr>
				<th width="5%" align="center"></th>
				<th width="5%" align="center">Id da denuncia</th>
				<th width="5%" align="center">Id do denunciado</th>
				<th width="25%" align="left">data inclusão</th>
				<th width="10%" align="left">número da documento</th>
				<th width="15%" align="left">infração</th>
				<th width="15%" align="left">data fechamento</th>
			  </tr>
		 </thead>
	
		<?php if(isset($denunciados)){
				foreach($denunciados as $den){   
		?>
	
		 <tr class="cor1">
				<td></td>
				<td align="center"><?php echo $den[2]  ?></td>
				<td align="center"><?php echo $den[0] ?></td>
				<td><?php echo $den[3] ?></td>
				<td><?php echo $den[10]  ?></td>
				<td><?php echo $den[8]  ?></td>
				<td><?php echo $den[5]  ?></td>	
			 </tr>
		 <?php }
		 } ?>
	</table>
	
	<!-- registros da tabela de processados -->				
	<table>
	 <thead>	 
	 <tr><td colspan="7"><div class="tituloTabela">Registro de Processo</div></td></tr>
		 <tr>
				<th width="5%" align="center">Id processados</th>
				<th width="25%" align="left">numero do processo</th>
				<th width="10%" align="left">data instauração</th>
				<th width="15%" align="left">data encerramento</th>
			  </tr>
	    <?php if(isset($processados)){
			foreach($processados as $proces){   
		?>
	
				<tr class="cor1">
				<td align="center"><?php echo $proces[0]  ?></td>
				<td><?php echo $proces[3]  ?></td>
				<td><?php echo $proces[4]  ?></td>
				<td><?php echo "00/00/0000"  ?></td>	
			 </tr>
		</table>		 
	  </tbody>
</div>					
</div>
</div>
<?php } 
	}?>
<!-- 				<div class="btn-editar">
					<a href="<?php echo URL_BASE ."denunciado/Editar/".$denunciado->id_denunciado ?>" >Editar</a>
			  	</div>
				</td>
				<td align="center">
					<div class="btn-excluir">
					<a href="<?php echo URL_BASE ."denunciado/Excluir/".$denunciado->id_denunciado ?>" >excluir</a>
			  	</div>	
 -->
</body>
</html>