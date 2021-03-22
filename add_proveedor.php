<?php
  $page_title = 'Agregar proveedor';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  //$all_categories = find_all('categories');
  //$all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_proveedor'])){
   $req_fields = array('proveedor-nombre','proveedor-telefono','proveedor-direccion' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['proveedor-nombre']));
     $p_tel   = remove_junk($db->escape($_POST['proveedor-telefono']));
     $p_dir   = remove_junk($db->escape($_POST['proveedor-direccion']));
     /*if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }*/
     $date    = make_date();
     $query  = "INSERT INTO proveedores (";
     $query .=" nombre,telefono,direccion";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_tel}', '{$p_dir}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE nombre='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('add_proveedor.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('proveedor.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_proveedor.php',false);
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
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar proveedor</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_proveedor.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="proveedor-nombre" placeholder="nombre">
               </div>
              </div>
              <!--<div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value="">Selecciona una imagen</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>-->

              <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="text" class="form-control" name="proveedor-telefono" placeholder="Telefono">
                  </div>
                 </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="text" class="form-control" name="proveedor-direccion" placeholder="direccion">
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="add_proveedor" class="btn btn-danger">Agregar producto</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
