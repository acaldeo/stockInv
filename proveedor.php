<?php
  $page_title = 'Lista de proveedores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $proveedores = join_proveedor_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_proveedor.php" class="btn btn-primary">Agregar Proveedor</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 10%;"> Nombre </th>
                <th class="text-center" style="width: 10%;"> Telefono </th>
                <th class="text-center" style="width: 10%;"> Direccion</th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($proveedores as $proveedor):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td> <?php echo remove_junk($proveedor['nombre']); ?></td>
                <td class="text-center"> <?php echo remove_junk($proveedor['telefono']); ?></td>
                <td class="text-center"> <?php echo remove_junk($proveedor['direccion']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_proveedor.php?id=<?php echo (int)$proveedor['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_proveedor.php?id=<?php echo (int)$proveedor['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
