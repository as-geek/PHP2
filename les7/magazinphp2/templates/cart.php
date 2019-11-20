<h2>Корзина</h2><hr>
<? foreach ($products as $item): ?>
<div id="<?= $item['id_cart'] ?>">
    <h2><?=$item['name']?></h2>
    <img width="150px" src="/img/<?=$item['link']?>">
    <p>Цена:<?=$item['price']?></p>

    <button data-id="<?= $item['id_cart']?>" class="delete">Удалить</button>
    <hr>
</div>
<? endforeach; ?>

<script>
    let buttons = document.querySelectorAll('.delete');

    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            console.log(id);
            (
                async () => {
                    const response = await fetch('/cart/delete/', {
                        method: 'POST',
                        headers: new Headers({
                            'Content-Type': 'application/json'
                        }),
                        body: JSON.stringify({
                            id: id,
                        })
                    });

                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                    document.getElementById(id).remove();
                    console.log(answer.id);
                }
            )();
        })
    });

</script>