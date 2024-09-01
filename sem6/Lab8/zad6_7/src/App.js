import './App.css';
import React, { useState } from 'react';
import Header from './components/Header';
import Sidebar from './components/Sidebar';
import MainArea from './components/MainArea';
import Footer from './components/Footer';

function App() {
  const [fontSize, setFontSize] = useState(18);
  const [fontColor, setFontColor] = useState('green');
  const [likes, setLikes] = useState(0);

  const updateTextStyle = (size, color) => {
    setFontSize(size);
    if (color !== null) {
      setFontColor(color);
    }
  };

  return (
    <div className="grid-parent">
      <Header fontSize={fontSize} fontColor={fontColor} likes={likes} />
      <Sidebar updateTextStyle={updateTextStyle} />
      <MainArea fontSize={fontSize} fontColor={fontColor} />
      <Footer setLikes={setLikes} updateTextStyle={updateTextStyle} />
    </div>
  );
}

export default App;
