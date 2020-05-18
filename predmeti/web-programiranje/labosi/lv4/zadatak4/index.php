<?php

echo "Zadatak 4" . "<br /><br />\n";

function zeroSorter($array)
{
   $iterationNum = count($array);
   $newArray = [];
   for($iteration = 0; $iteration < $iterationNum; $iteration++) {
        $item = $array[$iteration];
        if(is_null($item) || is_bool($item)) {
            return false;
        }

   }

   for($iteration = 0; $iteration < $iterationNum; $iteration++) {
       $item = $array[$iteration];
       if($item != 0 || $item != '0') {
          array_push($newArray, $item);
       }
   }

   for($iteration = 0; $iteration < $iterationNum; $iteration++) {
       $item = $array[$iteration];
       if($item == 0 || $item == '0') {
          array_push($newArray, $item);
       }
  }
   return $newArray;
}

// Test 1
var_dump(zeroSorter([5, 0, 6, 1, 0, 8]) == [5, 6, 1, 8, 0, 0]);
// Test 2 - potrebno je paziti na raspored pojavljivanja 0 - u nizu prva '0' nalazi se ispred numeričke 0 i tako je potrebno rasporediti niz
var_dump(zeroSorter([5, 6, '0', 1, 0, '0', 8, '0']) == [5, 6, 1, 8, '0', 0, '0', '0']);
// Test 3 - funkcija ne smije obuhvatiti i sortirati null, false ili true, potrebno je smjesta vratiti false
var_dump(zeroSorter([5, null, '0', 1, 0, '0', false, 9, '0']) == [5, null, 1, false, 9, '0', 0, '0', '0']);

/**
 * Test 4 - Definirajte i prikažite jedan primjer
 */
var_dump(zeroSorter([5, null, '0']) == [5, null, '0']);
