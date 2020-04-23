import Decoder from "./src/decoder.js";

/**
 * Primjer: Enkriptirana rečenica je bila: Pomozi mi rjesiti ovaj zadatak
 */
let test = new Decoder();
let result = test.decode("Cbzbmv-zv-ewrfvgv-binw-mnqngnx", 13); // Primjer rješenja: Pomozi:mi:rjesiti:ovaj:zadatak
console.log(result)

/**
 * Rješenje zadatka provjerite u gornjem dijelu skripte - unutar metode decode
 * - Zaljepite enkriptirani tekst i dobiveni ključ
 */

try {
 let key = test.bruteForce("Yoxsl7mljldxl7pf7ylyfgr7abpfcofoxq7lsr7mlorhr", 100);
 console.log(key);
 console.log(test.decode('Yoxsl7mljldxl7pf7ylyfgr7abpfcofoxq7lsr7mlorhr', key))
} catch (e) {
 console.error(e)
}
