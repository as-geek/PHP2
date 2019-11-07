<h2>
    Каталог
</h2>
<?
foreach ($catalog as $value) {
    $items .= <<<php
<h2><a href="/product/item/{$value['id']}">{$value['name']}</a></h2>
<img width="300px" src="/img/{$value['link']}">
<p>{$value['price']}</p>

php;
}
echo $items;
?>