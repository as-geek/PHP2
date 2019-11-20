<?php

/** @var \app\models\ProductRepository $product */

?>

<h2><?=$product->name?></h2>
<img width="300px" src="/img/<?=$product->link?>">
<p><?=$product->price?></p>
