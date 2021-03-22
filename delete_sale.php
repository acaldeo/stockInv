<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $d_sale = find_by_id('temp_sales',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","ID vacío.");
    redirect('add_sale.php');
  }
?>
<?php
  $delete_id = delete_by_id('temp_sales',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","Item eliminado.");
      redirect('add_sale.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('add_sale.php');
  }
?>
