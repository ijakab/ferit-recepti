#### Zadatak 4

Definirajte funkciju koja razvrstava niz pomicanjem svih nultih elemenata (0 ili '0') do kraja, također je potrebno pridržavati se  redoslijeda nula.

Primjer rješenja defniranog zadatka:

```php
var_dump(zeroSorter([5,0,6,1,0,8]) == [5,6,1,8,0,0]); // `bool(true)`
var_dump(zeroSorter([5,6,'0',1,0,'0',8,'0']) == [5,6,1,8,'0',0,'0','0']); // `bool(true)`
```