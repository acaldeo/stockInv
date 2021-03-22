<?php
/*************************/
//Mostrar errores php
///*************************/
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
///*************************/

require_once('includes/load.php');
page_require_level(2);
$c_remitos  = count_by_id('remitos') ;
$remitos = intval($c_remitos['total']) + 1 ;	
$sales = find_all_sale_temp();

   if(isset($_POST['cerrar_sale'])){
   	if (empty($sales)) {
   		$session->msg('s',"La lista esta vacia. ");
	    redirect('add_sale.php', false);
   	}else{
     $date    = make_date();
     $query  = "INSERT INTO remitos(";
     $query .=" id,fecha";
     $query .=") VALUES (";
     $query .=" '{$remitos}','{$date}'";
     $query .=")";
     if($db->query($query)){
         $update_tablas=update_tablas(); 
	       $copia_tablas = copia_tablas('sales','temp_sales');
	       $truncate_table = truncate_table('temp_sales');	
	       $session->msg('s',"Remito guardado exitosamente. ");
	       redirect('add_sale.php', false);
	     } else {
	       $session->msg('d',' Lo siento, registro falló.');
	       redirect('sales.php', false);
	     }
	 }

 	}
 ?>