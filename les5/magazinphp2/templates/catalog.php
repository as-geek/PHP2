<h2>
    Каталог
</h2>

<? foreach ($catalog as $item): ?>
    <h2><a href="/product/item/<?=$item['id']?>"><?=$item['name']?></a></h2>
    <img width="300px" src="/img/<?=$item['link']?>">
    <p><?=$item['price']?></p>
<? endforeach;?>
