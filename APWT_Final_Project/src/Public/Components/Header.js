import { useState } from 'react';
import { Link } from 'react-router-dom';

const Header = () => {
  const [keyword, setKeyword] = useState("");

  const handleForm = (event) => {
    event.preventDefault();
    if(keyword){
      window.location.href=`/searchproduct/${keyword}`;
    }
  }

  return (
    <>
      <nav className="navbar navbar-expand-sm navbar-dark bg-dark">
        <div className="container-fluid">
          <Link className="navbar-brand" to="/">Grocery OS</Link>
          <div className="collapse navbar-collapse">
            <ul className="navbar-nav me-auto">
              <li className="nav-item">
                <Link className="nav-link" to="/">Home</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/registration">Registration</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/login">Login</Link>
              </li>
            </ul>
          </div>
          <form className="d-flex" onSubmit={handleForm}>
              <input className="form-control me-2" type="text" value={keyword} placeholder="Search" onChange={(e) => { setKeyword(e.target.value) }} />
              <button className="btn btn-primary" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </>
  )
}

export default Header