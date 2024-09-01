import React, { useState } from 'react';

function Sidebar({ updateTextStyle }) {
  const [fontSize, setFontSize] = useState('');
  const [fontColor, setFontColor] = useState('');

  const handleApplyStyles = () => {
    updateTextStyle(parseInt(fontSize) || 20, fontColor || 'pink');
  };

  return (
    <div className="sidebar">
      <input
        type="text"
        placeholder="Rozmiar czcionki"
        value={fontSize}
        onChange={(e) => setFontSize(e.target.value)}
      />
      <input
        type="text"
        placeholder="Kolor czcionki"
        value={fontColor}
        onChange={(e) => setFontColor(e.target.value)}
      />
      <button onClick={handleApplyStyles}>
        Ustaw parametry tekstu
      </button>
    </div>
  );
}

export default Sidebar;
