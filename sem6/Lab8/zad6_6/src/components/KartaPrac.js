import './KartaPrac.css';

function KartaPrac({ dziennik }) {
  return (
    <table className="table table-sm">
      <thead>
        <tr className="row">
          <th className="col-sm-2" scope="col">Nazwa</th>
          <th className="col-sm-4" scope="col">Opis zadania</th>
          <th className="col-sm-2" scope="col">Data</th>
          <th className="col-sm-2" scope="col">Priorytet</th>
        </tr>
      </thead>
      <tbody>
        {dziennik.map((zadanie, index) => (
          <tr className="row" key={index}>
            <td className="col-sm-2">{zadanie.nazwa}</td>
            <td className="col-sm-4">{zadanie.opis}</td>
            <td className="col-sm-2">{zadanie.data}</td>
            <td className="col-sm-2">{zadanie.priorytet ? 'Tak' : 'Nie'}</td>
          </tr>
        ))}
      </tbody>
    </table>
  );
}

export default KartaPrac;
