<?php
    session_start();   
	//////////////////////////////////////////////         SEGURIDAD               /////////////////////////////////////////////
	if(!array_key_exists("la_logusr",$_SESSION))
	{
		print "<script language=JavaScript>";
		print "location.href='../sigesp_inicio_sesion.php'";
		print "</script>";		
	}
	$ls_logusr=$_SESSION["la_logusr"];
	require_once("class_folder/class_funciones_nomina.php");
	$io_fun_nomina=new class_funciones_nomina();
	require_once("sigesp_sno.php");
	$io_sno=new sigesp_sno();
	$io_fun_nomina->uf_load_seguridad("SNR","sigesp_snorh_r_listadocumpleano.php",$ls_permisos,$la_seguridad,$la_permisos);
	$ls_reporte=$io_sno->uf_select_config("SNR","REPORTE","LISTADO_CUMPLEANEROS","sigesp_snorh_rpp_listadocumpleano.php","C");
	//////////////////////////////////////////////         SEGURIDAD               /////////////////////////////////////////////
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script type="text/javascript" language="JavaScript1.2" src="../shared/js/disabled_keys.js"></script>
<script language="javascript">
	if(document.all)
	{ //ie 
		document.onkeydown = function(){ 
		if(window.event && (window.event.keyCode == 122 || window.event.keyCode == 116 || window.event.ctrlKey)){
		window.event.keyCode = 505; 
		}
		if(window.event.keyCode == 505){ 
		return false; 
		} 
		} 
	}
</script>
<title >Reporte Listado de Cumplea&ntilde;eros</title>
<meta http-equiv="imagetoolbar" content="no"> 
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EFEBEF;
}

a:link {
	color: #006699;
}
a:visited {
	color: #006699;
}
a:active {
	color: #006699;
}

-->
</style>
<script type="text/javascript" language="JavaScript1.2" src="js/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="js/funcion_nomina.js"></script>
<link href="css/nomina.css" rel="stylesheet" type="text/css">
<link href="../shared/css/tablas.css" rel="stylesheet" type="text/css">
<link href="../shared/css/ventanas.css" rel="stylesheet" type="text/css">
<link href="../shared/css/cabecera.css" rel="stylesheet" type="text/css">
<link href="../shared/css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {color: #6699CC}
-->
</style>
</head>

<body>
<table width="762" border="0" align="center" cellpadding="0" cellspacing="0" class="contorno">
  <tr>
    <td width="780" height="30" colspan="11" class="cd-logo"><img src="../shared/imagebank/header.jpg" width="778" height="40"></td>
  </tr>
  <tr>
    <td width="432" height="20" colspan="11" bgcolor="#E7E7E7">
		<table width="762" border="0" align="center" cellpadding="0" cellspacing="0">
			<td width="432" height="20" bgcolor="#E7E7E7" class="descripcion_sistema Estilo1">Sistema de N�mina</td>
			<td width="346" bgcolor="#E7E7E7" class="letras-pequenas"><div align="right"><b><?php print date("j/n/Y")." - ".date("h:i a");?></b></div></td>
	  	    <tr>
	  	      <td height="20" bgcolor="#E7E7E7" class="descripcion_sistema">&nbsp;</td>
	  	      <td bgcolor="#E7E7E7" class="letras-pequenas"><div align="right"><b><?php print $_SESSION["la_nomusu"]." ".$_SESSION["la_apeusu"];?></b></div></td></tr>
        </table>
	 </td>
  </tr>
  <?php

	if (isset($_GET["valor"]))
	{ $ls_valor=$_GET["valor"];	}
	else
	{ $ls_valor="";}
	
	if ($ls_valor!='srh')
	{
	   print ('<tr>');
	   print ('<td height="20" colspan="11" bgcolor="#E7E7E7" class="cd-menu"><script type="text/javascript" language="JavaScript1.2" src="js/menu.js"></script></td>' );
	   print ('</tr>');
	}
	
	
  ?>
  <tr>
    <td width="780" height="13" colspan="11" class="toolbar"></td>
  </tr>
  <tr>
    <td height="20" width="25" class="toolbar"><div align="center"><a href="javascript:ue_print();"><img src="../shared/imagebank/tools20/imprimir.gif" title="Imprimir" alt="Imprimir" width="20" height="20" border="0"></a></div></td>
     <?php

	if (isset($_GET["valor"]))
	{ $ls_valor=$_GET["valor"];	}
	else
	{ $ls_valor="";}
	
	if ($ls_valor!='srh')
	{
	    print ('<td class="toolbar" width="25"><div align="center"><a href="javascript: ue_cerrar();"><img src="../shared/imagebank/tools20/salir.gif" title=Salir alt="Salir" width="20" height="20" border="0"></a></div></td>' );	   
	}
	else
	{
	 print ('<td class="toolbar" width="25"><div align="center"><a href="javascript: close();"><img src="../shared/imagebank/tools20/salir.gif" title=Salir alt="Salir" width="20" height="20" border="0"></a></div></td>' );	
	}
	
  ?>
    <td class="toolbar" width="25"><div align="center"><img src="../shared/imagebank/tools20/ayuda.gif" title="Ayuda" alt="Ayuda" width="20" height="20"></div></td>
    <td class="toolbar" width="25"><div align="center"></div></td>
    <td class="toolbar" width="25"><div align="center"></div></td>
    <td class="toolbar" width="25"><div align="center"></div></td>
    <td class="toolbar" width="25"><div align="center"></div></td>
    <td class="toolbar" width="25"><div align="center"></div></td>
    <td class="toolbar" width="25"><div align="center"></div></td>
    <td class="toolbar" width="25"><div align="center"></div></td>
    <td class="toolbar" width="530">&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<form name="form1" method="post" action="">
<?php
//////////////////////////////////////////////         SEGURIDAD               /////////////////////////////////////////////
	$io_fun_nomina->uf_print_permisos($ls_permisos,$la_permisos,$ls_logusr,"location.href='sigespwindow_blank.php'");
	unset($io_fun_nomina);
//////////////////////////////////////////////         SEGURIDAD               /////////////////////////////////////////////
?>		  
<table width="600" height="138" border="0" align="center" cellpadding="0" cellspacing="0" class="formato-blanco">
  <tr>
    <td height="136">
      <p>&nbsp;</p>
      <table width="550" border="0" align="center" cellpadding="1" cellspacing="0" class="formato-blanco">
        <tr class="titulo-ventana">
          <td height="20" colspan="5" class="titulo-ventana">Reporte Listado de Cumplea&ntilde;eros </td>
        </tr>
        <tr>
          <td height="20" colspan="6" class="titulo-celdanew">Intervalo de N&oacute;mina </td>
          </tr>
        <tr>
          <td width="141" height="22"><div align="right"> Desde </div></td>
          <td width="119"><div align="left">
            <input name="txtcodnomdes" type="text" id="txtcodnomdes" size="13" maxlength="10" readonly>
            <a href="javascript: ue_buscarnominadesde();"><img src="../shared/imagebank/tools20/buscar.gif" alt="Buscar" width="15" height="15" border="0"></a></div></td>
          <td width="104"><div align="right">Hasta </div></td>
          <td colspan="3"><div align="left">
            <input name="txtcodnomhas" type="text" id="txtcodnomhas" size="13" maxlength="10" readonly>
            <a href="javascript: ue_buscarnominahasta();"><img src="../shared/imagebank/tools20/buscar.gif" alt="Buscar" width="15" height="15" border="0"></a></div></td>
        </tr>
        <tr>
          <td height="20" colspan="5" class="titulo-celdanew">Intervalo de Personal </td>
          </tr>
        <tr>
          <td width="141" height="22"><div align="right"> Desde </div></td>
          <td width="119"><div align="left">
            <input name="txtcodperdes" type="text" id="txtcodperdes" size="13" maxlength="10" value="" readonly>
            <a href="javascript: ue_buscarpersonaldesde();"><img id="personal" src="../shared/imagebank/tools20/buscar.gif" alt="Buscar" width="15" height="15" border="0"></a></div></td>
          <td width="104"><div align="right">Hasta </div></td>
          <td colspan="2"><div align="left">
            <input name="txtcodperhas" type="text" id="txtcodperhas" value="" size="13" maxlength="10" readonly>
            <a href="javascript: ue_buscarpersonalhasta();"><img id="personal" src="../shared/imagebank/tools20/buscar.gif" alt="Buscar" width="15" height="15" border="0"></a></div></td>
        </tr>
        <tr class="titulo-celdanew">
          <td height="22" colspan="5">Estatus del Personal en el Sistema </td>
          </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><div align="center">Activo
            <input name="chkactivo" type="checkbox" class="sin-borde" id="chkactivo" value="1" checked>
          </div></td>
          <td><div align="center">Egresado
            <input name="chkegresado" type="checkbox" class="sin-borde" id="chkegresado" value="1">
          </div></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td height="22" colspan="5" class="titulo-celdanew">Estatus del Personal en N&oacute;mina </td>
          </tr>
        <tr>
          <td height="22"><div align="right">Activo
            <input name="chkactivono" type="checkbox" class="sin-borde" id="chkactivono" value="1" checked>
          </div></td>
          <td><div align="right">Vacaciones
            <input name="chkvacacionesno" type="checkbox" class="sin-borde" id="chkvacacionesno" value="1" checked>
          </div></td>
          <td><div align="right">Egresado
            <input name="chkegresadono" type="checkbox" class="sin-borde" id="chkegresadono" value="1" checked>
          </div></td>
          <td width="108"><div align="right">Suspendido
            <input name="chksuspendidono" type="checkbox" class="sin-borde" id="chksuspendidono" value="1" checked>
          </div></td>
          <td width="66">&nbsp;</td>
        </tr>
        <tr>
          <td height="22" colspan="5" class="titulo-celdanew">&nbsp;</td>
          </tr>
        <tr>
          <td height="22"><div align="right">Solo N&oacute;minas Normales </div></td>
          <td><label>
            <input name="chknominasnormales" type="checkbox" class="sin-borde" id="chknominasnormales" value="1" checked>
          </label></td>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="22"><div align="right">Mes </div></td>
          <td><div align="left">
            <select name="cmbmes" id="cmbmes">
              <option value="" selected>--Seleccione--</option>
              <option value="01">ENERO</option>
              <option value="02">FEBRERO</option>
              <option value="03">MARZO</option>
              <option value="04">ABRIL</option>
              <option value="05">MAYO</option>
              <option value="06">JUNIO</option>
              <option value="07">JULIO</option>
              <option value="08">AGOSTO</option>
              <option value="09">SEPTIEMBRE</option>
              <option value="10">OCTUBRE</option>
              <option value="11">NOVIEMBRE</option>
              <option value="12">DICIEMBRE</option>
            </select>
          </div></td>
          <td colspan="3">
            <div align="left"></div></td>
          </tr>
        <tr>
          <td height="20" colspan="5" class="titulo-celdanew"><div align="right" class="titulo-celdanew">Ordenado por </div></td>
          </tr>
        <tr>
          <td height="22"><div align="right">C&oacute;digo del Personal </div></td>
          <td colspan="4"><div align="left">
            <input name="rdborden" type="radio" class="sin-borde" value="1" checked>
          </div></td>
        </tr>
        <tr>
          <td height="22"><div align="right">Apellido del Personal</div></td>
          <td colspan="4"><div align="left">
            <input name="rdborden" type="radio" class="sin-borde" value="2">
          </div></td>
        </tr>
        <tr>
          <td height="22"><div align="right">Nombre del Personal</div></td>
          <td colspan="4"><div align="left">
            <input name="rdborden" type="radio" class="sin-borde" value="3">
          	<input name="reporte" type="hidden" id="reporte" value="<?php print $ls_reporte;?>">
		  </div></td>
        </tr>
       
		<tr>
          <td height="22">&nbsp;</td>
          <td colspan="4"> <div align="right"></div></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
  </tr>
</table>
</form>      
</body>
<script language="javascript">
function ue_cerrar()
{
	location.href = "sigespwindow_blank.php";
}

function ue_print()
{
	f=document.form1;
	li_imprimir=f.imprimir.value;
	ls_reporte=f.reporte.value;
	if(li_imprimir==1)
	{	
		codnomdes=f.txtcodnomdes.value;
		codnomhas=f.txtcodnomhas.value;
		if(codnomdes<=codnomhas)
		{
			codperdes=f.txtcodperdes.value;
			codperhas=f.txtcodperhas.value;
			if(codperdes<=codperhas)
			{
				mes=f.cmbmes.value;
				if(mes!="")
				{
					activo="";
					egresado="";
					activono="";
					vacacionesno="";
					egresadono="";
					suspendidono="";
					nominasnormales="";
					if(f.chkactivo.checked)
					{
						activo=1;
					}
					if(f.chkegresado.checked)
					{
						egresado=1;
					}
					if(f.chkactivono.checked)
					{
						activono=1;
					}
					if(f.chkvacacionesno.checked)
					{
						vacacionesno=1;
					}
					if(f.chkegresadono.checked)
					{
						egresadono=1;
					}
					if(f.chksuspendidono.checked)
					{
						suspendidono=1;
					}
					if(f.chknominasnormales.checked)
					{
						nominasnormales=1;
					}
					if(f.rdborden[0].checked)
					{
						orden="1";
					}
					if(f.rdborden[1].checked)
					{
						orden="2";
					}
					if(f.rdborden[2].checked)
					{
						orden="3";
					}
					pagina="reportes/"+ls_reporte+"?codnomdes="+codnomdes+"&codnomhas="+codnomhas+"&codperdes="+codperdes+"&codperhas="+codperhas;
					pagina=pagina+"&activono="+activono+"&vacacionesno="+vacacionesno+"&egresadono="+egresadono+"&suspendidono="+suspendidono;
					pagina=pagina+"&activo="+activo+"&egresado="+egresado+"&nominasnormales="+nominasnormales+"&mes="+mes+"&orden="+orden;
					window.open(pagina,"Reporte","menubar=no,toolbar=no,scrollbars=yes,width=800,height=600,left=0,top=0,location=no,resizable=yes");
				}
				else
				{
					alert("Debe seleccionar el Mes ");
				}
			}
			else
			{
				alert("El rango del personal est� erroneo");
			}
		}
		else
		{
			alert("El rango del n�mina est� erroneo");
		}
   	}
	else
   	{
 		alert("No tiene permiso para realizar esta operaci�n");
   	}		
}

function ue_buscarnominadesde()
{
	window.open("sigesp_snorh_cat_nomina.php?tipo=repliscumdes","catalogo","menubar=no,toolbar=no,scrollbars=yes,width=530,height=400,left=50,top=50,location=no,resizable=no");
}

function ue_buscarnominahasta()
{
	f=document.form1;
	if(f.txtcodnomdes.value!="")
	{
		window.open("sigesp_snorh_cat_nomina.php?tipo=repliscumhas","catalogo","menubar=no,toolbar=no,scrollbars=yes,width=530,height=400,left=50,top=50,location=no,resizable=no");
	}
	else
	{
		alert("Debe seleccionar una n�mina desde.");
	}
}

function ue_buscarpersonaldesde()
{
	window.open("sigesp_snorh_cat_personal.php?tipo=repliscumdes","catalogo","menubar=no,toolbar=no,scrollbars=yes,width=530,height=400,left=50,top=50,location=no,resizable=no");
}

function ue_buscarpersonalhasta()
{
	f=document.form1;
	if(f.txtcodperdes.value!="")
	{
		window.open("sigesp_snorh_cat_personal.php?tipo=repliscumhas","catalogo","menubar=no,toolbar=no,scrollbars=yes,width=530,height=400,left=50,top=50,location=no,resizable=no");
	}
	else
	{
		alert("Debe seleccionar un personal desde.");
	}
}
</script> 
</html>