import React from 'react';

function Footer({ setLikes, updateTextStyle }) {
  const handleLike = () => {
    setLikes((prevLikes) => prevLikes + 1);
  };

  const handleSetTextStyle = () => {
    updateTextStyle(30, null);
  };

  return (
    <footer className="footer">
      <p>
        Stopka <button onClick={handleSetTextStyle}>Ustaw parametry tekstu na 30px, a kolor pozostaw bez zmian.</button>
      </p>
      <p>
        <button onClick={handleLike}>Polub tę stronę!</button>
      </p>
    </footer>
  );
}

export default Footer;
