<?php
  $page_title = 'Editar proveedor';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$proveedor = find_by_id('proveedores',(int)$_GET['id']);
//$all_categories = find_all('categories');
//$all_photo = find_all('media');
if(!$proveedor){
  $session->msg("d","Missing proveedor id.");
  redirect('proveedor.php');
}
?>
<?php
 if(isset($_POST['proveedor'])){
    $req_fields = array('proveedor-nombre','proveedor-telefono','proveedor-direccion' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['proveedor-nombre']));
       $p_tel   = (int)$_POST['proveedor-telefono'];
       $p_dir   = remove_junk($db->escape($_POST['proveedor-direccion']));
       $query   = "UPDATE proveedores SET";
       $query  .=" nombre ='{$p_name}', telefono ='{$p_tel}',";
       $query  .=" direccion ='{$p_dir}'";
       $query  .=" WHERE id ='{$proveedor['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Proveedor ha sido actualizado. ");
                 redirect('proveedor.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_proveedor.php?id='.$proveedor['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_proveedor.php?id='.$proveedor['id'], false);
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
            <span>Editar proveedor</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_proveedor.php?id=<?php echo (int)$proveedor['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="proveedor-nombre" value="<?php echo remove_junk($proveedor['nombre']);?>">
               </div>
              </div>
              <!--<div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="proveedor-nombre">
                    <option value="">Selecciona una categoría</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value=""> Sin imagen</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                          <?php echo $photo['file_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>-->

              <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="qty">Telefono</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="text" class="form-control" name="proveedor-telefono" value="<?php echo remove_junk($proveedor['telefono']);?>">
                   </div>
                  </div>
                 </div>
                  <div class="col-md-6">
                   <div class="form-group">
                     <label for="qty">Direccion</label>
                     <div class="input-group">
                       <span class="input-group-addon">
                         <i class="glyphicon glyphicon-usd"></i>
                       </span>
                       <input type="text" class="form-control" name="proveedor-direccion" value="<?php echo remove_junk($proveedor['direccion']);?>">
                    </div>
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="proveedor" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
