<?php
/*************************/
//Mostrar errores php
///*************************/
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
///*************************/
  $page_title = 'Agregar Remito';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $c_remitos  = count_by_id('remitos') ;
  //$all_remitos = find_all('remitos');
  //$all_photo = find_all('media');
  $all_productos= find_all('products');
  $sales = find_all_sale_temp();
  $remitos = intval($c_remitos['total']) + 1 ;
?>
<?php
 if(isset($_POST['add_sale'])){
   $req_fields = array('product-name','product-quantity');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-name']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     /*if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }*/
     $date    = make_date();
     $query  = "INSERT INTO temp_sales(";
     $query .=" id_remito,product,qty,fecha";
     $query .=") VALUES (";
     $query .=" '{$remitos}','{$p_name}','{$p_qty}','{$date}'";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('add_sale.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('sales.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_sale.php',false);
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
         <div class="pull-right">
          <form method="post" action="copia_tabla.php" class="clearfix">
                <button type="submit" name="cerrar_sale" class="btn btn-danger">Cerrar Remito</button>
          </form>
        </div>
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Remito</span>
         </strong>
        </div>
       
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_sale.php" class="clearfix">
              <div class="form-group">
                <!--<div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Descripción">
               </div>-->
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-name">
                      <option value="">Selecciona una Producto</option>
                    <?php  foreach ($all_productos as $produ): ?>
                      <option value="<?php echo $produ['name'] ?>">
                        <?php echo $produ['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="product-quantity" placeholder="Cantidad">
                  </div>
                  </div>
                </div>
              </div>
              <button type="submit" name="add_sale" class="btn btn-danger">Agregar Producto</button>
          </form>
          
         </div>
        </div>
      </div>
    </div>
  </div>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <!--<div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Todas la ventas</span>
          </strong>
          <div class="pull-right">
            <a href="add_sale.php" class="btn btn-primary">Agregar venta</a>
          </div>
        </div>-->

        <div class="panel-body">
          
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 15%;"> Remito</th>
                <th> Nombre del producto </th>
                <th class="text-center" style="width: 15%;"> Cantidad</th>
                <th class="text-center" style="width: 15%;"> Fecha </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['id_remito']); ?></td>
               <td><?php echo remove_junk($sale['product']); ?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center"><?php echo $sale['fecha']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
