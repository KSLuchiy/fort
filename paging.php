<?php
echo "<ul class=\"pagination\">";
  
// кнопка на первую страницу
if($page>1){
    echo "<li><a href='{$page_url}' title='Перейти на первую страницу.'>";
        echo "Первая страница";
    echo "</a></li>";
}
  
// подсчет всех записей для формирования количества страниц
$total_pages = ceil($total_rows / $records_per_page);
  
// показ ссылок по умолчанию
$range = 2;
  
// отображение нумерации ссылок
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;
  
for ($x=$initial_num; $x<$condition_limit_num; $x++) {
  
    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {
  
        // текущая страница
        if ($x == $page) {
            echo "<li class='active'><a href=\"#\">$x <span class=\"sr-only\">(current)</span></a></li>";
        }
  
        // не текущая страница
        else {
            echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
        }
    }
}
  
// кнопка на последнюю страницу
if($page<$total_pages){
    echo "<li><a href='" .$page_url . "page={$total_pages}' title='Последняя страница {$total_pages}.'>";
        echo "Последняя страница";
    echo "</a></li>";
}
  
echo "</ul>";
?>