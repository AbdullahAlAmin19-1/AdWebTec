import React from 'react'

import { Link } from 'react-router-dom';

const Footer = () => {
    return (
        <>
            <div className="container-fluid py-4 bg-dark">
                <div className="row">
                    <div className="col-4">
                        <h1 className="text-white">Grocery OS</h1>
                        <p className="text-white small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                        <p className="text-white mb-0">&copy; Copyrights. All rights reserved.
                            <Link className="text-primary" style={{textDecoration: 'none'}} to="/"> Grocery OS</Link>
                        </p>
                    </div>
                    <div className="col-2">
                        <h5 className="text-white mb-3">Quick links</h5>
                        <ul className="list-unstyled text-muted">
                            <li><Link className="text-primary" style={{textDecoration: 'none'}} to="/">Home</Link></li>
                            <li><Link className="text-primary" style={{textDecoration: 'none'}} to="#">About Us</Link></li>
                            <li><Link className="text-primary" style={{textDecoration: 'none'}} to="#">Contact Us</Link></li>
                            <li><Link className="text-primary" style={{textDecoration: 'none'}} to="#">FAQ</Link></li>
                        </ul>
                    </div>

                    <div className="col-2">
                        <h5 className="text-white mb-3">Social links</h5>
                        <ul className="list-unstyled text-muted">
                            <li><Link className="text-primary" style={{textDecoration: 'none'}} to="#">Facebook</Link></li>
                            <li><Link className="text-primary" style={{textDecoration: 'none'}} to="#">Instagram</Link></li>
                            <li><Link className="text-primary" style={{textDecoration: 'none'}} to="#">Youtube</Link></li>
                            <li><Link className="text-primary" style={{textDecoration: 'none'}} to="#">Linkedin</Link></li>
                        </ul>
                    </div>

                    <div className="col-4">
                        <h5 className="text-white mb-3">Newsletter</h5>
                        <p className="small text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                        <form action="#">
                            <div className="input-group mb-3">
                                <input className="form-control" type="text" placeholder="Recipient's email" aria-label="Recipient's email" aria-describedby="button-addon2" />
                                <button className="btn btn-primary" id="button-addon2" type="button"><i className="fas fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </>
    )
}

export default Footer