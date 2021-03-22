<?php

  $page_title = 'Home Page';
  require_once('includes/load.php');
  $products_stock_min = find_recent_product_stock_min('5');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>Bienvenido</h1>
         <h3><?php echo remove_junk(ucfirst($user['name'])); ?></h3> 
      </div>
    </div>
 </div>
 <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <a href="stockMin.php" ><span title="Ir a listado">Productos debajo del stock minimo</span></a>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
      <?php foreach ($products_stock_min as  $stock_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$stock_product['id'];?>">
                <h4 class="list-group-item-heading">
                 <?php if($stock_product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $stock_product['image'];?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($stock_product['name']));?>
                  <span class="label label-warning pull-right">
                 $<?php echo (int)$stock_product['sale_price']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($stock_product['categorie'])); ?>
              </span>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
</div>
<?php include_once('layouts/footer.php'); ?>
