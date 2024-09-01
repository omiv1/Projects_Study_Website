function Result(props) {
    let { result } = props;
    return (
      <div className="result">
        <input type="text" value={result} readOnly />
      </div>
    );
  }
  
  export default Result;
  