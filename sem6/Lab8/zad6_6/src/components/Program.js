import { useState } from 'react';
import Formularz from './Formularz';
import KartaPrac from './KartaPrac';

function Program() {
  const [dziennikZadan, ustawDziennikZadan] = useState([]);

  const dodajPrace = (zadanie) => {
    ustawDziennikZadan([...dziennikZadan, zadanie]);
  };

  return (
    <section>
      <Formularz dodajPrace={dodajPrace} />
      <KartaPrac dziennik={dziennikZadan} />
    </section>
  );
}

export default Program;
