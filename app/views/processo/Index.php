<?php
	if(!isset($_SESSION)){
	session_start();
        $_SESSION['objeto'] = "processo/index";
	}
?>

<div class="base-home">
	<h1 class="titulo-pagina">Lista de Processos

</h1>
</div> <!-- fim da class="base-home" -->

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
				<input class="btn btn-secondary" type="submit" value="pesquisar">
</div> <!--  fim da div class filho 1 -->

 	<div class="filho2">
		 <?php
			if(isset($processo)){		
			foreach($processo as $pd){
			}
				echo "<br><h3>Qtde de processo: ".count($processo)."</h3>";   
		?>
	</div> <!-- fim da div class filho 2 -->
</form>
</div><!--  fim da div class pai -->

    <div class="tableResponsividade">
		<table>
			<thead>
				<tr>
					<th align="center" width="5%">Id Processo</th>
					<th align="center" width="5%">Id denuncia</th>
					<th align="center" width="10%">Doc denuncia</th>
					<th align="center" width="10%"> 
						<?php 
							if(isset($processo)){		
							foreach($processo as $pd){
							}
								echo "<br><h4>Qtde de processo: ".count($processo)."</h4>";   
							}
						?>
					</th>

					<th align="center" width="7%">Número do Processo</td>
					<th align="center" width="7%">Data de Instauração </th>
<!--					<th align="center" width="5%">Data do Encerramento </th>  -->
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
					<td align="center"> <?php $data = new DateTime($pd->data_instauracao); 
						if($data == "0000-00-00"){
							echo "00/00/0000";
						}else{
							echo $data->format('d/m/Y');
						}
			?>
			</td>

					<td>
						<?php echo $pd->observacao  ?> 
					</td>

					<td>
						<?php 
						    if($pd->id_fase < 3){?>
    						    <div> 
							    	<a class="btn btn-info" href="<?php echo URL_BASE ."Fase/Tramitar/".$pd->id_processo ?>">Fase</a>
						<?php 
						    }else{
    						    echo '<div class="btn-desabilitado">'; 
							    echo '<a href="#" class="btn btn-light">Fase</a>';
						    }
						 ?>
						</div> 
					</td>

					<td>
						<a class="btn btn-info" href="<?php echo URL_BASE ."Portaria/Vincular/".$pd->id_processo ?>" >Portaria</a>
					</td>
	
					<td>
						<a class="btn btn-info" href="<?php echo URL_BASE ."Upload/AnexarProc/".$pd->id_processo."/".$pd->id_fase; ?>" >Anexar</a>
					</td>

					<td>
						<a class="btn btn-info" href="<?php echo URL_BASE ."Processo/Edit/".$pd->id_processo ?>" >Editar</a>
					</td>

				 	<td> 
				        <a class="btn btn-dark" href="<?php echo URL_BASE."Ocorrencia/IncluirOcorrenciaVincProc/".$pd->id_processo ?>">Ocorrencia</a> 
					</td>  <!-- fim da div acima -->
							
					<td> 
						<a class="btn btn-danger" href="<?php echo URL_BASE ."Processo/Excluir/".$pd->id_processo ?>" >Excluir</a>
					</td>

					<td> 
						<a class="btn btn-dark" href="<?php echo URL_BASE . "Finalizados/Novo/".$pd->id_processo."/".$pd->numero_processo ?>" >Finalizar</a>
					</td>
				</tr> 

                <?php 
        			} // chave de fim do foreach da tabela processo  	
        		?>

				<?php
					if(isset($processado)){		
			    ?>
    			<tr>
					<th align="center">Id servidor</th>
					<th align="center">CPF</th>
					<th align="center"colspan="2">Nome</th>
					<th align="center" colspan="2">Data Encerramento</th>
				</tr>
				<?php
					    foreach($processado as $serv){
				?>

				<tr>
					<td align="center"><?php echo $serv->id_servidor ?></td>
					<td align="center"><?php echo $serv->cpf ?></td>
					<td align="center"colspan="2"><?php echo $serv->nome_servidor ?> </td>

					<td colspan="2" align="right"> <?php 
					    if($serv->data_fechamento > 0){
					        $data = new DateTime($serv->data_fechamento);
					        echo $data->format('d/m/Y');
					    }else{
					        echo "00/00/0000";
					    }
			?>
                    </td>
				</tr>
    		<?php
				} // chave de fim do foreach da tabela servidor
			        echo "<tr><td>&nbsp;</td></td> </tr>";
    	} // chave de fim do if do processo para servidor 
	}
}
?>
				</div>  <!-- fim da div class="tabela-processo" -->

			</table>

<!--		</div>   -->   			
		
		<?php
			if(isset($totalPaginas)){
				$totalPaginas = $_SESSION['totalPaginas'];

					for($q=1; $q<=$totalPaginas; $q++){  
						echo "<a href=".URL_BASE.'pesquisa/porParametroLink/?p='.($q); ?>  
						<?php echo "[".($q)."]" ?> </a> 
	    <?php
                }
            }
		?>
</div>
