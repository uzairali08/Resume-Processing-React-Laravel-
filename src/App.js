  import React, { useState, useEffect } from "react";
  import "./App.css";
  
  function App() {
    const [file, setFile] = useState("");
    const [message, setMessage] = useState("");
  
    async function fileUpload(event) {
      event.preventDefault();
  
      // console.warn(file);
  
      const formData = new FormData();
      formData.append('file', file);
      let response = await fetch("http://localhost:8000/api/uploadFile", {
        method: "POST",
        body: formData
      });
  
      let result = await response.json();
      // setMessage(result.message);
      alert(result.message)
    }
  
    return (
      <div className="App">
        <form className="form" onSubmit={fileUpload}>
          <span className="form-title">Steps for Uploading CV</span>
          <ol className="form-ol">
            <li>Save your CV in a digital format</li>
            <li>Drag & Drop your CV or Click on 'Choose file'</li>
            <li>Select your CV</li>
            <li>Save and Upload your CV</li>
          </ol>
          <label htmlFor="file-input" className="drop-container">
            <span className="drop-title">Drop your CV here</span>
            or
            <input type="file" required="" id="file-input" onChange={(e) => setFile(e.target.files[0])} />
          </label>
          <button className="uploadBtn" type="submit">Save & Upload</button>
        </form>
        {/* {message && <div className="message">{message}</div>} */}
      </div>
    );
  }
  
  export default App;
  