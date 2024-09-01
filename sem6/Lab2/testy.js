console.log("Zadanie1")

function wyswietlLiczby(...argumenty){
    console.log(argumenty)
   }
   wyswietlLiczby(4,6,7,9,0,2)

function sumator(...argumenty) {
    const suma = argumenty.reduce((acc, val) => acc + val, 0);
    const tekst = `Suma liczb: ${argumenty.join(', ')} wynosi ${suma}.`;
    return tekst;
}
console.log(sumator(1, 2, 3));

console.log("\nZadanie2")
const { listaZadan, poniedzialek, wtorek } = require('./dane');

const tekstyZadan = listaZadan.map(zadanie => zadanie.tekst);
console.log("Właściwości tekst z obiektów:");
tekstyZadan.forEach(tekst => console.log(tekst));

const tekstyZadanNowaTablica = listaZadan.map(zadanie => zadanie.tekst);
console.log("Teksty zadań:");
console.log(tekstyZadanNowaTablica);

const tekstyZrealizowanychZadan = listaZadan.filter(zadanie => zadanie.zrealizowano).map(zadanie => zadanie.tekst);
console.log("Teksty zrealizowanych zadań:");
console.log(tekstyZrealizowanychZadan);

console.log("\nZadanie3")
const stawkaGodzinowa = 35;

const wynik = poniedzialek.concat(wtorek)
    .map(zadanie => zadanie.czas / 60)
    .filter(czas => czas > 2)
    .map(czas => czas * stawkaGodzinowa)
    .reduce((acc, curr) => acc + curr)
    .toFixed(2)
    .concat(' PLN');

console.log("Final: " + wynik);