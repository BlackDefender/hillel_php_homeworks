<?php
$age = intval((time()-mktime(0, 0, 0, 9, 3, 1989))/31536000, 10);
echo $age.'<br>';



?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
Меня зовут Алексей Чёрный, мне <?= $age ?> лет и я бородат.

</body>
</html>