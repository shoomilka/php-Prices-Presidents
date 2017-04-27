<?php
/*
По адресу http://2eu.kiev.ua/get_ads.php можно получить список объявлений в JSON формате. Каждое объявление содержит следующую информацию:

image = ссылка на изображение
weight = условный критерий важности объявления
price = цена объявления

— помощью PHP необходимо написать скрипт, который получит список объявлений по указанному выше адресу (например, через cURL),
отсортирует их по параметру price (чем выше price, тем выше объявление в списке, если у объявлений одинаковое значение параметра price,
выше будет то объявление, у которого больше параметр weight), после чего сгенерирует HTML код блока, в который вставит изображения
из трех объявлений оказавшихся сверху после сортировки, и отправит его на вывод.

Пример кода HTML, в который необходимо вставить ссылки из отсортированного списка объявлений:

<ul>
	<li><img src="#1" alt="" /></li>
	<li><img src="#2" alt="" /></li>
	<li><img src="#3" alt="" /></li>
</ul>
*/

$url = 'http://2eu.kiev.ua/get_ads.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);

$a = curl_exec($ch);

curl_close($ch);

//$a = '[{"image":"http:\/\/2eu.kiev.ua\/assets\/templates\/images\/benefits\/new-advantages-slide-1.jpg","weight":4,"price":1},{"image":"http:\/\/2eu.kiev.ua\/assets\/templates\/images\/benefits\/new-advantages-slide-2.jpg","weight":3,"price":2},{"image":"http:\/\/2eu.kiev.ua\/assets\/templates\/images\/benefits\/new-advantages-slide-3.jpg","weight":2,"price":1},{"image":"http:\/\/2eu.kiev.ua\/assets\/templates\/images\/benefits\/new-advantages-slide-4.jpg","weight":1,"price":4},{"image":"http:\/\/2eu.kiev.ua\/assets\/templates\/images\/benefits\/new-advantages-slide-5.jpg","weight":5,"price":4},{"image":"http:\/\/2eu.kiev.ua\/assets\/templates\/images\/home\/docs\/doc-1.png","weight":2,"price":3}]';

$a = json_decode($a, true);

/*
echo '<pre>';
var_dump($a);
echo '</pre>';
*/

function sort_function($a, $b){
    if($a['price'] != $b['price'])
        return $a['price'] < $b['price'];
    else return $a['weight'] < $b['weight'];
}
usort($a, 'sort_function');

echo '<ul>';
for($i = 0; $i < 3; $i++)
	echo '<li><img src="'.$a[$i]['image'].'" alt="" /></li>';
echo '</ul>';

/*
echo '<pre>';
var_dump($a);
echo '</pre>';
*/