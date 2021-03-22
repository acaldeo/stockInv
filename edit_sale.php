<?php
  $page_title = 'Editar salida';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$sale = find_by_id('temp_sales',(int)$_GET['id']);
//$all_categories = find_all('categories');
//$all_photo = find_all('media');
if(!$sale){
  $session->msg("d","Producto id no encontrado.");
  redirect('add_sale.php');
}
?>
<?php
 if(isset($_POST['sale'])){
    $req_fields = array('product-qty' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['product-nombre']));
       $p_qty   = $_POST['product-qty'];
       $query   = "UPDATE temp_sales SET";
       $query  .=" qty ='{$p_qty}'";
       $query  .=" WHERE id ='{$sale['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('add_sale.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_sale.php?id='.$sale['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_sale.php?id='.$sale['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar salida</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-6">
           <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id'] ?>">
              <div class="form-group">
                <label for="qty">Producto</label>
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" disabled="disabled" class="form-control" name="product-nombre" value="<?php echo remove_junk($sale['product']);?>">
               </div>
              </div>
              <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="qty">Cantidad</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="product-qty" value="<?php echo remove_junk($sale['qty']);?>">
                   </div>
                  </div>
                 </div>
                
               </div>
              </div>
              <button type="submit" name="sale" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
