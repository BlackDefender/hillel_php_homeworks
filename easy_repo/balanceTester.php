<?php
$startTime = time();
for($i=0; $i<30; ++$i){
    file_get_contents('http://localhost:8000/api/v1/storage?apiKey=8f1b2da19f18d875d172d6a4855ff335&key=test&requestIndex='.$i);
}

echo '30 requests take '.(time() - $startTime).' seconds';