<?php
$usuario=$_SESSION[username];
require("../conectar.php");
$sql = "SELECT personal.nombres, personal.apellido1, personal.apellido2 FROM personal,usuario WHERE usuario.nombre_usuario = '$usuario'";
$stat = pg_exec($dbh,$sql);
$datos = pg_fetch_assoc($stat);
$rows = pg_numrows($stat);
		if ($rows==0)
		{
			
			$nombreusuario= "";
		}
		else
		{
		    $nombreusuario= "Sr(a) ".$datos[nombres]." ".$datos[apellido1]." ".$datos[apellido2];
			$_SESSION[nusuario]="".$datos[nombres]." ".$datos[apellido1];
		}
pg_close($dbh);



?>

<table width="687" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25">&nbsp;</td>
            <td width="642">&nbsp;</td>
            <td width="20">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><p>Bienvenido <?php echo $nombreusuario; ?></p>
              <p>Escoja en el menú izquierdo la tarea que desea realizar.<br />
                </p></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>