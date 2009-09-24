<?php


//paginacion de los datos
//Limito la busqueda
$TAMANO_PAGINA = 20;


//examino la p�gina a mostrar y el inicio del registro a mostrar
$pagina = $_GET["pagina"];
if (!$pagina) {
    $inicio = 0;
    $pagina=1;
}
else {
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
} 


require("../conectar.php");

//$informe=$_POST["informe"];
//$ssql4 = "select * from caja_chica where fecha between '$ano-$mesa-01' and '$ano-$mesa-30'";

//miro a ver el n�mero total de campos que hay en la tabla con esa b�squeda
$ssql =  "select * from pago where date_part('month',fecha) = $mes_sel and date_part('Year',fecha)=$ano";
//echo"consulta:".$ssql;
$sstat2 = pg_exec($dbh,$ssql);
$num_total_registros = pg_numrows($sstat2);
//calculo el total de p�ginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

$i=0;

$sql3 = "select sum(total) as total  from pago where date_part('month',fecha) = $mes_sel and date_part('Year',fecha)=$ano";
//echo"consulta:".$sql3;
$ssql3 = pg_exec($dbh,$sql3);
$aux2 = pg_fetch_assoc($ssql3);
//saldo actual
$saldoact=$aux2[total];

?>

        <table width="687" border="0" cellspacing="0" cellpadding="0">
          <form  id="aif" name="aif" action="ing_egre.php?op=ef" method="post">
          </form>
          <tr>
            <td width="14" height="19">&nbsp;</td>
            
            <td width="48" class="textoform">&nbsp;</td>
            <td width="6" class="textoform">&nbsp;</td>
            <td width="326" class="textoform"><?php echo " ".$mes_actual." de ".$ano;?></td>
            <td width="91" class="textoform"><strong>Total de mes </strong></td>
            <td width="7" class="textoform"><strong>:</strong></td>
            <td width="179" class="textoform"><strong>$</strong><?php echo " ".$saldoact; ?></td>
            <td width="16">&nbsp;</td>
          </tr>
          
          <tr>
            <td height="30">&nbsp;</td>
            <td colspan="6" class="textoform">
            
            
           <div id="tabla">
            <table width="657" border="0" cellspacing="0" cellpadding="0" id="tablasort" class="to">
              <thead class="to">
              <tr>
                <th width="103">Fecha</th>
				<th width="159">Proveedor</th>
                <th width="159">Tipo de servicio </th>
                <th width="238">Observaci&oacute;n</th>               
                <th width="157">Saldo</th>
              </tr>
              </thead>
              <tbody class="to"> 
              <?php
			 
			  
			  while($aux = pg_fetch_assoc($sstat2))
			  {
			  
			  $fecha=$aux[fecha];
			  $proveedor=$aux[proveedor];
			  $tipo_s=$aux[tipo_s];
			  $observacion=$aux[observaciones];
			  $saldo=$aux[total];
			  $cod=$aux[id_pago];
			  
		  
			 if ($i%2==0)
			  	{ 
	            echo "<tr>";
				}
			  else
			  	{
				echo "<tr class='odd'>";
				}
				
               echo "<td><a href='#=".$cod."' >".$fecha."</a></td>";
               echo "<td><a href='#=".$cod."' >".$proveedor."</a></td>";
               echo "<td><a href='#=".$cod."' >".$tipo_s."</a></td>";
			   echo "<td><a href='#=".$cod."' >".$observacion."</a></td>";
               echo "<td><a href='#=".$cod."' >".$saldo."</a></td>";
			  
               
               
				echo "<td>&nbsp;</td>";
			   echo "</tr>";
			   $i=$i+1;
			
			   }
			  
			  
			/*  if(($mesal==date("m")))
				{
				$sql = "UPDATE saldocc  SET saldo=$saldo, fecha='".date("j-n-Y")."' WHERE fecha=$;";
				}
				else
				$sql = "INSERT INTO saldocc(saldo, fecha) VALUES ($saldo, '".date("j-n-Y")."');";
			  
		      $stat = pg_exec($dbh,$sql);*/
			  
			  
			  ?>
              </tbody>
            </table>
            <?php
	
    //muestro los distintos �ndices de las p�ginas, si es que hay varias p�ginas
if ($total_paginas > 1){

	if($pagina==1)
		$prev=1;
	else
		$prev=$pagina-1;
		
	if($pagina==$total_paginas)
		$next=$total_paginas;
	else
		$next=$pagina+1;

?>
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><a href="ing_egre.php?op=ef&pagina=1"><img src="../tablesorter/icons/first.png" width="16" height="16"></a></td>
                <td><a href="ing_egre.php?op=ef&pagina=<?php echo $prev; ?>"><img src="../tablesorter/icons/prev.png" width="16" height="16"></a></td>
                <td align="center" valign="middle">&nbsp;<?php echo $pagina; ?>&nbsp;</td>
                <td><a href="ing_egre.php?op=ef&pagina=<?php echo $next; ?>"><img src="../tablesorter/icons/next.png" width="16" height="16"></a></td>
                <td><a href="ing_egre.php?op=ef&pagina=<?php echo $total_paginas; ?>"><img src="../tablesorter/icons/last.png" width="16" height="16"></a></td>
              </tr>
            </table>
<?php
} 
?>
		</div>            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
        
       
        
