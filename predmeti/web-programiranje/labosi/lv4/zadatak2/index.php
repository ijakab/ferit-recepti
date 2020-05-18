<?php

echo "Zadatak 2" . "<br /><br />\n";

function is_anagram($word1, $word2)
{
    return count_chars($word1, 1) == count_chars($word2, 1);
}

/**
 * Definirajte dva proizvoljna argumenta unutar funkcije
 */
echo is_anagram("example 1", "example 2") ? "Predani parametri su anagrami" : "Predani parametri nisu anagrami";
echo is_anagram("blaȭtra", "traablȭ") ? "Predani parametri su anagrami" : "Predani parametri nisu anagrami";
echo is_anagram("hey", "heyȭ") ? "Predani parametri su anagrami" : "Predani parametri nisu anagrami";

?>
