<?php

echo "Zadatak 3" . "<br /><br />\n";

$random = rand(1, 1000);
$temp = $random;

$bin = "";
while($temp > 0) {
    if($temp % 2 == 1) {
        $bin = 1 . $bin;
    } else {
        $bin = 0 . $bin;
    }
    $temp = (int) ($temp / 2);
}

echo $random . " => Rezultat u binarnom formatu: " . $bin;
