<?php

function filterOddNumbers($numbers){
    return array_filter($numbers, function ($num){
        return $num % 2 == 1;
    });
}

function printOddNumbers($numbers){
    foreach (filterOddNumbers($numbers) as $num){
        echo $num.'<br>';
    }
}

function printUntilVowelChar($words){
    global $vowels;
    foreach ($words as $word){
        $firstChar = mb_substr($word, 0, 1);
        if(!in_array($firstChar, $vowels)){
            echo $word.'<br>';
        }else{
            break;
        }
    }
}