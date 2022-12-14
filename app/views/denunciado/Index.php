<?php
	if(!isset($_SESSION)){
	session_start();
	}

if(!isset($_SESSION['id_usuario'])){
    header("Location: ". URL_BASE . "index.php");
}else{
    
?>

        <div class="base-home">
    	<h1 class="titulo-pagina">Lista de denunciados e processados</h1>
    
        </div>
        <div class="base-lista">
        	<span class="qtde">Há <b><?php if(isset($servidor)){
        		   		echo count($servidor);
    			}else{
    				echo 0;
        		} 
    	 ?></b> servidores(as) cadastrados(as)</span>
    
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
    		$view =  'denunciado/Index';
    		$_SESSION['view'] = $view; 
    		$_SESSION['tabela'] = $tabela; 
    ?>
    <div class="pai">  
    	<div class="filho1">  
    		<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/cdp'; ?>" >
    				<label>Pesquisa</label>
    					<select name="pesquisa" class="select">
    <!--
    		Implementar primneiro pra liberar		
    		<option value="1">Número documento da denúncia</option>
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
    			 </tr>
    		<?php
    		} ?>
    		</table>
    
    	<!-- registros da tabela de denunciados -->				
    	<div class="recuoTabNivel2">	
    	<table>
    		<thead>	 
    		<tr>
    				<th colspan="7"><div class="tituloTabela">Registro de Denúncias</div></th></tr>
    				<th align="center">Nome do servidor</th>
    				<th align="center">Id da denuncia</th>
    				<th align="left">data inclusão</th>
    				<th align="left">número da documento</th>
    				<th align="left">infração</th>
    <!-- 				<th align="left">data fechamento</th>    Ocultado. Penso não ser necessário por conta da inclusão do processo já ter a data de instauração -->
    			  </tr>
    		 </thead>
    	
    		<?php if(isset($denunciados)){
    				foreach($denunciados as $den){   
    					$qtde = count($den);
    		?>
    	
    		 <tr class="cor1">
    				<td align="center"><?php echo $den[19]  ?></td>
    				<td align="center"><?php echo $den[2]  ?></td>
    				<td align="center"><?php echo $den[3]  ?></td>
    				<td align="center"><?php echo $den[10] ?></td>
    				<td><?php echo $den[8] ?></td>
    <!-- 				<td><?php //echo $den[5]  ?></td>
     -->			 </tr>
    		 <?php }
    		 } ?>
    	</table>
    </div>  <!-- fim da div recuoTabNivel2 -->
    
    	<!-- registros da tabela de processados -->				
    	<div class="recuoTabNivel3">
    	<form method="POST" action="<?php echo URL_BASE . "finalizados/Novo" ?>">
    		<table class="processados">
    		<thead>	 
    		<tr><td colspan="6"><div class="tituloTabela">Registro de Processo</div></td></tr>
    			<tr>
    					<th width="10%">Id processados</th>
    					<th width="10%">Id denuncia</th>
    					<th width="10%">Id do denunciado</th>
    					<th width="15%">numero do processo</th>
    					<th width="20%">data instauração</th>
    					<th width="10%" align="left">data encerramento</th>
    					<th width="5px">Ação</th>	
    				</tr>
    			<?php if(isset($processados)){
    				foreach($processados as $proces){   
    			?>
    					<tr class="cor1">
    
    <!-- 					<input type="hidden" name="id_processo" value="<?php //echo $proces[0] ?>">
     -->					<input type="hidden" name="numero_processo" value="<?php echo $proces[3] ?>">
    					<input type="hidden" name="id_processado" value="<?php echo $proces[0] ?>">
    
    					<td><?php echo $proces[0]  ?></td>
    					<td align="center"><?php echo $proces[1]  ?></td>
    					<td align="center"><?php echo $proces[2]  ?></td>
    					<td align="center"><?php echo $proces[3]  ?></td>
    					<td align="center"><?php echo date("d/m/Y", strtotime($proces[4]))  ?></td>
    					<td align="center">
    					    <?php 
    					        if($proces[5] == "0000-00-00 00:00:00"){
    					            echo "00-00-0000";
    					        }else{
    					            echo date("d/m/Y", strtotime($proces[5]));
    					        }
    		                ?>
    					 </td>	
    	<!--				<td align="center"><input type="submit" value="Finalizar Processo"></td>	
    	-->			</tr>
    				<?php } ?>
    
    				</tbody>
    			</table>		 
    		</form>
    
    	</div>   <!-- fim da div recuoTabNivel3 -->
    </div>					
    </div>
    </div>
    <?php } 
    	}
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