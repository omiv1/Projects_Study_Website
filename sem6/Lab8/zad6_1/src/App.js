import './Card.css';

function App() {
  return (
    <div>
      <h1>Słynni informatycy</h1>
      <div className="Card">
        <h2>Alan Turing</h2>
        <img src="https://mdz.cs.pollub.pl/ai/alan_turing.jpg" alt="Alan Turing" />
        <p>1912 - 1954</p>
        <p>Matematyk</p>
        <p>Anglia</p>
      </div>
      <div className="Card">
        <h2>Niklaus Wirth</h2>
        <img src="https://mdz.cs.pollub.pl/ai/nicolas_wirth.jpg" alt="Niklaus Wirth" />
        <p>1934 - ?</p>
        <p>Elektronik i informatyk</p>
        <p>Szwajcaria</p>
      </div>
      <div className="Card">
        <h2>Dennis Ritchie</h2>
        <img src="https://mdz.cs.pollub.pl/ai/dennis_ritchie.jpg" alt="Dennis Ritchie" />
        <p>1941 - 2011</p>
        <p>Matematyk, fizyk, informatyk</p>
        <p>USA</p>
      </div>
      <div className="Card">
        <h2>Bjarne Stroustrup</h2>
        <img src="https://mdz.cs.pollub.pl/ai/bjarne_stroustrup.jpg" alt="Bjarne Stroustrup" />
        <p>1950 - ?</p>
        <p>Informatyk</p>
        <p>Dania</p>
      </div>
    </div>
  );
}

export default App;
