// dane.js

const listaZadan = [
    {
    id: 1,
    tekst: "Zrobienie zakupów",
    zrealizowano: true
    },
    {
    id: 2,
    tekst: "Przegląd techniczny samochodu",
    zrealizowano: false
    },
    {
    id: 3,
    tekst: "Wizyta u dentysty",
    zrealizowano: false
    }
   ];
   
   const poniedzialek = [
    {
    'nazwa': 'Przygotowania do zajęć z AI',
    'czas': 180
    },
    {
    'nazwa': 'Realizacja projektu z AI',
    'czas': 120
    }
   ]
   
   const wtorek = [
    {
    'nazwa': 'Rozbudowa swojego bloga',
    'czas': 240
    },
    {
    'nazwa': 'Administrowanie serwisem szkoly',
    'czas': 180
    },
    {
    'nazwa': 'Sluchanie koncertu online',
    'czas': 240
    }
   ]
   
   module.exports = {
       listaZadan,
       poniedzialek,
       wtorek
   };
   