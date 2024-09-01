import { useState, useEffect } from 'react';
import "./App.css";

function App() {
  const [temperature, setTemperature] = useState(0);
  const [stateMatter, setStateMatter] = useState("");

  const handleChange = (event) => {
    setTemperature(event.target.value);
  };

  useEffect(() => {
    if (temperature <= 0) {
      setStateMatter("stały");
    } else if (temperature >= 100) {
      setStateMatter("gazowy");
    } else {
      setStateMatter("ciekły");
    }
  }, [temperature]);

  return (
    <div className="temperature">
      <label>Temperatura:&nbsp;
        <input
          type="text"
          onChange={handleChange}
          value={temperature}
          placeholder="Wprowadź temperaturę wody"
        />&nbsp;°C
      </label>
      <div className={stateMatter}>
        <p className={stateMatter}>
          W temperaturze {temperature} °C woda jest w stanie
          <span> {stateMatter}m.</span>
        </p>
      </div>
    </div>
  );
}

export default App;
