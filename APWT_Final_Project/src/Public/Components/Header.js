import { useState } from 'react';
import { Link } from 'react-router-dom';
import LogedHeader from '../../Vendor/Components/LogedHeader';
import AdHeader from '../../Admin/Components/AdHeader';
import CusHeader from '../../Customer/Components/CusHeader';
const Header = () => {
    const [keyword, setKeyword] = useState("");

    document.title='Grocery OS - Home';

    const handleForm = (event) => {
        event.preventDefault();
        if (keyword) {
            window.location.href = `/searchproduct/${keyword}`;
        }
    }

    return (
        <>
            {
                localStorage.getItem('user_type') == "Admin" ?
                    <AdHeader />
                    :
                    ''
            }

            {
                localStorage.getItem('user_type') == "Vendor" ?
                    <LogedHeader />
                    :
                    ''
            }

            {
                localStorage.getItem('user_type') == "Customer" ?
                    <CusHeader />
                    :
                    ''
            }

            {
                localStorage.getItem('user_type') ?
                    ""
                    :
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
            }

        </>
    )
}

export default Header