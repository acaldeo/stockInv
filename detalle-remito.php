<?php
  $page_title = 'Detalle Remito';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $remitos = find_detalle_remito('sales',(int)$_GET['id']);
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Detalle Remito</span>
         </strong>
       </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 10%;">Nro Remito</th>
                <th class="text-center" style="width: 10%;"> Producto </th>
                <th class="text-center" style="width: 10%;"> Cantidad </th>
                <th class="text-center" style="width: 10%;"> Fecha</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($remitos as $remito):?>
              <tr>
                <td class="text-center"><?php echo remove_junk($remito['id_remito']);?></td>
                <td class="text-center"> <?php echo remove_junk($remito['product']); ?></td>
                <td class="text-center"> <?php echo remove_junk($remito['qty']); ?></td>
                <td class="text-center"> <?php echo remove_junk($remito['fecha']); ?></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
