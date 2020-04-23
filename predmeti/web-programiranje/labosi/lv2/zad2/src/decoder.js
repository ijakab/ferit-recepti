import dictionary from "./dictionary.js";

class Decoder {
  checkUpperCase(str) {
    return str === str.toUpperCase();
  }

  decode(str, shift) {
    let decodeString = "";

    for (let i = 0; i < str.length; i++) {
      // provjera velikih i malih slova
      if (this.checkUpperCase(str[i])) {
        decodeString += String.fromCharCode(
          (((str.charCodeAt(i) + shift - 65) % 26) % 26) + 65
        );
      } else {
        decodeString += String.fromCharCode(
          (((str.charCodeAt(i) + shift - 97) % 26) % 26) + 97
        );
      }
    }

    return decodeString;
  }

  /**
   * Kreiraj bruteforce metodu koja će generirati polje dekodiranih riječi
   * (svaki put shift slova pomicati za jedan - proizvoljan broj) i ako rečenica sadrži riječ
   * iz riječnika metoda vraća shift ključ koji dekodira traženu riječ
   *
   * Rješenje zadatka definirajte unutar metode bruteForce
   */

  bruteForce(str, counter) {
    if(counter === 0) throw new Error('Could not find shift key')
    const decodedForCounter = this.decode(str, counter)
    if(this.hasWordFromDictionary(decodedForCounter)) return counter
    return this.bruteForce(str, counter - 1)
  }
  
  hasWordFromDictionary(str) {
    let foundWordCounter = 0
    for(const word of dictionary) {
      if(str.includes(word)) foundWordCounter ++
    }
    return foundWordCounter > 1 // potrebna provjera jer jedan prijasnji slucaj sadrzi rijec "ste", pa program misli da je to rjesenje
  }
}

export default Decoder;
