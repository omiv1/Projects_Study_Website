import { useState } from 'react';
import './Formularz.css';

function Formularz({ dodajPrace }) {
  const [opis, ustawOpis] = useState('');
  const [nazwa, ustawNazwe] = useState('');
  const [data, ustawDate] = useState('');
  const [priorytet, ustawPriorytet] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    dodajPrace({ opis, nazwa, data, priorytet });
    ustawOpis('');
    ustawNazwe('');
    ustawDate('');
    ustawPriorytet(false);
  };

  return (
    <form onSubmit={handleSubmit} className="col-lg-6 offset-lg-3">
      <div className="form-group mb-3">
        <label className="form-label">Nazwa</label>
        <input
          type="text"
          name="nazwa"
          className="form-control"
          value={nazwa}
          onChange={(e) => ustawNazwe(e.target.value)}
        />
      </div>
      <div className="form-group mb-3">
        <label className="form-label">Opis pracy</label>
        <input
          type="text"
          name="opis"
          className="form-control"
          value={opis}
          onChange={(e) => ustawOpis(e.target.value)}
        />
      </div>
      <div className="form-group mb-3">
        <label className="form-label">Data</label>
        <input
          type="date"
          name="data"
          className="form-control"
          value={data}
          onChange={(e) => ustawDate(e.target.value)}
        />
      </div>
      <div className="form-group mb-3">
        <label className="form-label">Priorytet</label>
        <input
          type="checkbox"
          name="priorytet"
          className="form-check-input"
          checked={priorytet}
          onChange={(e) => ustawPriorytet(e.target.checked)}
        />
      </div>
      <input type="submit" name="submit" className="btn btn-primary" value="Dodaj pracę" />
    </form>
  );
}

export default Formularz;
