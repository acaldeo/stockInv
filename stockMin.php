<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
   $all_proveedor = find_all('proveedores');
   $stockMinimo = $_POST['stock_minimo'];
   $proveedor = $_POST['product-proveedor'];
  if (isset($_POST['buscar'])) {
       if ($stockMinimo == "" && $proveedor != "") {
        $products = join_product_proveedor_filtro($proveedor);
    }elseif ($stockMinimo != "" && $proveedor == "") {
        $products = join_product_stockMin_filtro($stockMinimo);
    }elseif ($stockMinimo == "" && $proveedor == "") {
        $products = join_product_stockMin();
    }
   } else{
     $products = join_product_stockMin();  
   }
  
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <div class="pull-left">
              <form method="post">
                <div class="container">
                    <div class="row">
                      <div class="col-md-3">  
                           <input type="number" placeholder="Stock Mimino" name="stock_minimo">
                      </div>
                      <div class="col-md-3">
                         <select class="form-control" name="product-proveedor">
                              <option value="">Selecciona Proveedor</option>
                              <?php  foreach ($all_proveedor as $prov): ?>
                                  <option value="<?php echo (int)$prov['id'] ?>">
                                   <?php echo $prov['nombre'] ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                     <button name="buscar" type="submit">Buscar</button>
                 </div>
               </div>
              </form>
              
          </div>
          <div class="pull-right">
             <a target="_blank" href="reportes/reporte_stock.php?id=<?php echo $proveedor;?>id2=<?php echo $stockMinimo;?>" class="btn btn-primary">Imprimir Listado</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Imagen</th>
                <th> Descripción </th>
                <th class="text-center" style="width: 10%;"> Categoría </th>
                <th class="text-center" style="width: 10%;"> Stock </th>
                <th class="text-center" style="width: 10%;"> Stock Minimo</th>
                <th class="text-center" style="width: 10%;"> Proveedor</th>
                <!--<th class="text-center" style="width: 10%;"> Precio de compra </th>
                <th class="text-center" style="width: 10%;"> Precio de venta </th>-->
                <th class="text-center" style="width: 10%;"> Agregado </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['stock_min']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['proveedor']); ?></td>
                <!--<td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>-->
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
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
