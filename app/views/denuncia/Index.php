<?php
	if(!isset($_SESSION)){
	session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
	    header("Location: ". URL_BASE . "index");
	}else{
	    
?>
        <div class="base-home">
        	<h1 class="titulo-pagina">Lista de denúncias</h1>
        </div> <!-- FIM base-home -->
        
        
        <?php //paramentros para pesquisa dos formulários de denuncia e processo
        ?>
        
        <div class="pai">
        	<div class="filho1">
        		<form method="GET" action="<?php echo URL_BASE . 'PesquisaDenuncia/ConsultaDenuncia'; ?>" >
        
        		<label>Pesquisa</label> 
        			<select name="pesquisa">
        				<option value="1">Número do documento</option>
        				<!-- <option value="2">Número do Processo</option> !-->
        				<option value="3">Nome</option>
        				<option hidden value="4">CPF</option> <!-- Ocultado pois na tabela denuncia não há cpf -->
        				<option type="number" value="6">Id da denúncia</option>
        			</select>

        			<input type="text" autofocus name="valorPreenchidoUsuario"> 
        			<input type="submit" value="pesquisar">
            </div> <!-- fim da div class filho -->
    
        		<div class="filho2">
        			<a href="<?php echo URL_BASE . "denuncia/Novo" ?>" class="btn-inc">Incluir </a>
        		</div> <!-- fim da div class filho2 -->
        	</form>
        	</div> <!-- FIM DA DIV pai -->
        
        
        <div>
        	<table border="1" cellspacing="0" cellpadding="0">
        		<thead>
        			<tr>
        				<th align="center">id</th>
        				<th>Número documento</th>
        				<th width="10%">Tipo documento</th>
        				<th width="10%">Denunciante</th>
        				<th width="30%">Narração da denúncia</th>
        				<th width="30%">Denunciados</th>
        				<th width="7%">Data de entrada</th>
        				<th width="20%">Documentos anexados</th>
        				<th width="10%" align="center" colspan="4">Ações</th>
        			</tr>
        		</thead>
        	<?php
        	if(isset($dados)){ 
        	foreach($dados as $den){
        
        	?>
        		<tr>
        		   <td align="center"><?php echo $den->id_denuncia  ?> </td>
        		   <td align="center"><?php echo $den->numero_documento  ?></td> 
        		   <td align="center"><?php echo $den->tipo_de_documento ?> </td>
        		   <td align="center"><div class="overDenunciante"><?php echo $den->nome_denunciante ?></div> </td>
        		   <td><div class="over"><?php echo $den->denuncia_fato  ?></div> </td>
        		   <td align="center"><div class="over"><?php echo $den-> denunciados ?> </div></td>
        
        				<?php 
        					$dt_entrada = explode("-",$den->data_entrada);
        					$dia = $dt_entrada[2];
        					$mes = $dt_entrada[1];
        					$ano = $dt_entrada[0];
        				?>
                    <td align="center"><?php echo $dia."/".$mes."/".$ano  ?> </td> 
        		
        	 		<td width="30"><div class="over"><?php echo $den->documentos_anexados ?></div></td>
        
        			<td>
        			  <div class="btn-editar"> 
        					<a href="<?php echo URL_BASE ."Upload/Anexar/".$den->id_denuncia ?>">Anexar</a>
        	  	      </div>	
        			</td>
        
        			<td>
        			  <div class="btn-editar"> 
        					<a href="<?php echo URL_BASE ."denuncia/Edit/".$den->id_denuncia ?>">Editar</a>
        	  	      </div>	
        			</td>
        			
        			<td>
        				<div class="btn-excluir"> 
        					<a href="<?php echo URL_BASE ."denuncia/Excluir/".$den->id_denuncia ?>" >Excluir</a>
        				</div>
        			</td>
        
        			<td>
          				<div  class="btn-denunciar"> 
         				<a href="<?php echo URL_BASE ."denunciado/Novo/".$den->id_denuncia ?>">Ver/Incluir Denunciados</a>
        				</div>
        			</td>
        
        		</tr>
							<?php  } 
        				}?>
        				
        	</div> <!-- FIM DA DIV base-lista !-->
        	</table>
        	<div class="paginacao">
        				<?php
        					if(isset($totalPaginas)){
        
        						for($q=1; $q<=$totalPaginas; $q++):  
        							echo "<a href=".URL_BASE.'PesquisaDenuncia/ConsultaDenuncia/?p='.($q); ?> > <?php echo "[".($q)."]" ?> </a> 
        				<?php
        
        						endfor;
        					}
                    	}
        	?>
        	</div>
