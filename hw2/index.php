<?php
require 'data.php';
require 'functions.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<h2>Список друзей</h2>
<table>
    <?php
    foreach ($friendsList as $friend){
        ?>
        <tr>
            <td><?= $friend['name']; ?></td>
            <td><?= $friend['tel']; ?></td>
        </tr>
        <?php
    }
    ?>
</table>

<h2>Вывод нечетных чисел</h2>
<?php
printOddNumbers($numbers);
?>

<h2>Фильтрация нечетных чисел</h2>
<?php
var_dump(filterOddNumbers($numbers));
?>

<h2>Вывод слов пока не встретится слово с гласной буквы</h2>
<?php
printUntilVowelChar($words);
?>


</body>
</html>