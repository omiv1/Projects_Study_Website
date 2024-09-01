import React from 'react';

function MainArea({ fontSize, fontColor }) {
  const mainAreaStyle = {
    fontSize: `${fontSize}px`,
    color: fontColor,
  };

  return (
    <div className="main-area" style={mainAreaStyle}>
      <p>Szkielety programistyczne w aplikacjach internetowych: Node, MongoDB, Express, React.</p>
    </div>
  );
}

export default MainArea;
