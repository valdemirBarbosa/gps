<?php
	if(!isset($_SESSION)){
	session_start();
        $_SESSION['objeto'] = "processo/index";
	}
?>

<div class="base-home">
	<h1 class="titulo-pagina">Lista de Processos

</h1>
</div>

<?php //paramentros para pesquisa dos formulários de denuncia e processo
		$tabela = 'processo';
		$tabela1 = 'fase';
 		$view = 'processo/Index';
		$retorno = 'processo';
?>

<div class="pai"> 
	<div class="filho1"> 

		<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/processo'; ?>" >
		<?php
include "app/views/radio.php";
?>
	
		<label>Pesquisa</label>

			<select name="pesquisa" classe="select">
						<option value="1">Número documento da denúncia</option>
						<option value="2" selected="selected">Número do Processo</option>
						<option value="3">Nome</option>
						<option value="4">CPF</option>
						<option value="7">Id do Processo</option>
				</select>
	
				<input type="text" required autofocus name="valorPreenchidoUsuario">
				<input type="hidden" name="view" value="<?php echo $view ?>">
				<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
<!-- 				<input type="hidden" name="tabela" value='<?php echo $tabela ?>'>
 -->				<input type="hidden" name="tabela1" value='<?php echo $tabela1 ?>'>
				<input type="submit" value="pesquisar">
</div>

 	<div class="filho2">
		 <?php
			if(isset($processo)){		
			foreach($processo as $pd){
			}
				echo "<br><h3>Qtde de processo: ".count($processo)."</h3>";   
			}
		?>
	</div>
</form>

</div>

<div class="tabela-processo">
		<table border="1" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th align="center" width="5%">Id Processo</th>
					<th align="center" width="5%">Id denuncia</th>
					<th align="center" width="5%">Doc denuncia</th>
					<th align="center" width="5%"> 
						<?php
							if(isset($processo)){		
							foreach($processo as $pd){
							}
								echo "<br><h4>Qtde de processo: ".count($processo)."</h4>";   
							}
						?>
					</th>
					<th align="center" width="5%">Número do Processo</td>
					<th align="center" width="5%">Id do Processado</td>
					<th width="20%">Nome do servidor</td>
					<th align="center" width="5%">Data de Instauração </th>
					<th width="5%">Data de encerramento</th>
					<th width="20%">Observação</th>
					<th align="center" colspan="7">Ação</th>
				</tr>

			</thead>
		<?php 
			if(isset($processo)){		
			foreach($processo as $pd){
		?>
				<tr>
					<td align="center"><?php echo $pd->id_processo; ?></td>
					<?php  $_SESSION['id'] = $pd->id_processo; ?>
					<td align="center"><?php echo $pd->id_denuncia ?> </td>
					<td align="center"><?php echo $pd->numero_documento ?> </td>
					<td hidden><?php echo $_SESSION['id_fase'] = $pd->id_fase ?> </td>
					<td align="center"><?php echo $pd->fase;
					  ?> </td>
  					<?php  $_SESSION['id_fase'] = $pd->id_fase; ?>

					<td align="center"><?php echo $pd->numero_processo ?> </td>
					<td align="center"><?php echo $pd->id_processado ?> </td>
					<td><?php echo $pd->nome_servidor ?> </td>
					<td align="center"> <?php $data = new DateTime($pd->data_instauracao);
						if($data == "0000-00-00"){
							echo "00/00/0000";
						}else{
							echo $data->format('d-m-Y');
						}
		?>
					</td> 

					<td align="center">
				    	<?php 
		    	            $data = strtotime($pd->data_encerramento); 
		    	            if($data > 0){
		    	                echo date("d/m/Y", $data);
		    	            }else{
		    	                echo "00/00/0000";
		    	            }
				    	    ?>
					</td> 

					<td>
						<?php echo $pd->observacao  ?> 
					</td>

					<td>
						<div class="btn-portaria"> 
							<a href="<?php echo URL_BASE ."Fase/Tramitar/".$pd->id_processo ?>" >Fase</a>
						</div>
					</td>

					<td>
						<div class="btn-portaria"> 
							<a href="<?php echo URL_BASE ."Portaria/Vincular/".$pd->id_processo ?>" >Portaria</a>
						</div>				
					</td>
	
<!--  					<td>
					<div class="btn-ocorrencia"> 
						<a href="<?php //echo URL_BASE ."Vincular/Ocorrencia/".$pd->id_processo ?>" >Ocorrência</a>
					</div>
					</td>
 -->					
					<td>
					<div class="btn-editar"> 
							<a href="<?php echo URL_BASE ."Upload/AnexarProc/".$pd->id_processo."/".$pd->id_fase ?>" >Anexar</a>
					</div>	
					</td>

					<td>
					<div class="btn-editar">
						<a href="<?php echo URL_BASE ."Processo/Edit/".$pd->id_processo ?>" >Editar</a>
						</div>
					</td>

				 	<td> 
					   <div class="btn-ocorrencia">
					      <a href="<?php echo URL_BASE."Ocorrencia/IncluirOcorrenciaVincProc/".$pd->id_processo ?>">Ocorrencia</a> 
						</div>
					</td>
							
<!-- Resolvendo este caso de inclusão na tabela de processados em - fase -
     mudar de fase, porque o servidor já está na tabela de processados.?
     Incluir um novo registro com novo número em uma nova fase e fechar a fase anterior? 
    <td> 
	      <div class="btn-ocorrencia">
		  <a href="<?php echo URL_BASE ."Processo/Processar/".$pd->id_processo ?>" >Processar</a>
	</td>
-->					
					<td> 
					<div class="btn-excluir">
						<a href="<?php echo URL_BASE ."Processo/Excluir/".$pd->id_processo ?>" >Excluir</a>
					</div>
					</td>

					<td> 
					<div class="btn-excluir">
						<a href="<?php echo URL_BASE . "Finalizados/Novo/".$pd->id_processo."/".$pd->numero_processo ?>" >Finalizar</a>
					</div>
					</td>
				</tr> 


				<!-- inserir duas linhas em branco
				TABELA PARA DADOS DO SERVIDOR PROCESSADO - IMPLEMENTAR COM UM ARRAY DE UMA CONSULTA ESPECÍFICA. 14/10/2022
				
  				<tr> <td colspan="13"></td> </tr>
 				<tr> <td colspan="13"></td> </tr> -->

<!-- 				<tr>
					<th align="center" colspan="2"></th>
					<th align="center">Id servidor</th>
					<th align="center" colspan="2">CPF</th>
					<th align="center"colspan="3">Nome</th>
				</tr>
				<?php/*
					if(isset($processo)){		
					foreach($processo as $serv){
				*/?>

				<tr>
					<td align="center" colspan="2"></td>
					<td align="center"><?php/* echo $serv->id_servidor */?></td>
					<td align="center" colspan="2"><?php/* echo $serv->cpf */?></td>
					<td align="center"colspan="3"><?php/* echo $serv->nome_servidor */?> </td>
				</tr>
				-->
				<?php
			//	} // chave de fim do foreach da tabela servidor  	
			//	}
 
 
		}
	} // chave de fim do foreach da tabela ?>
			
				</div>
			</table>
		</div>			
		
		<?php
//					if(isset($totalPaginas)){
//						$totalPaginas = $_SESSION['totalPaginas'];

//					for($q=1; $q<=$totalPaginas; $q++):  
//						echo "<a href=".URL_BASE.'pesquisa/porParametroLink/?p='.($q); ?>  <?php //echo "[".($q)."]" ?> </a> 
	<?php
//				endfor;
//				}
				?>


			<p>...</P>
	</div>
