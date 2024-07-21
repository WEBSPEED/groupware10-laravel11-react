import React, { useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import Checkbox from '../../Components/Checkbox';
import SwitchBox from '../../Components/SwitchBox';

import '../../../css/auth.css';

import GuestLayout from '../../Layouts/GuestLayout';

export default function LoginForm()
{
    const [email, setEmail] = useState('system@emaxict.com');
    const [password, setPassword] = useState('1234');
    const [statusLogin, setStatusLogin] = useState(true);

    const location = useLocation();
    const userInfo = { ...location.state };
    const navigate = useNavigate();

    const handleLogin = async () => {
        await axios.post('/auth/login', {email:email,password:password,statusLogin:statusLogin})
        .then((response) => {
            console.log(response, 'success')
            if( response.data.success === true ){
                localStorage.setItem('status', [{
                    uid: response.data.data.tokey,
                    token: response.data.data.tokey
                }])
                navigate('/')
            }else{
                error.value = response.data.message
            }
        })
        .catch((error) => {
            console.log( error, 'error' )
            // if(error.response.status === 422){
            //     error.value = error.response.data.message
            // }
        })
    }
    return(
        <GuestLayout>			
            <header id="auth-header" className="auth-header"></header>
            <div className="auth-box">
                <form className="auth-form layer-loading layer-loading-after" method="post" >
                    <input type="hidden"/>
                    <div className="grid-row">
                        <div className="result-graphic grid-unit d-none">
                            <div className="loadDot"></div>
                            <div className="loadDot"></div>
                            <div className="loadDot"></div>
                            <div className="loadDot"></div>
                            <div className="loadDot"></div>
                        </div>
                    </div>
                    <h2 className="auth-title">LOGIN</h2>
                    <div className="form-group input-group input-group-merge mb-3">
                        <div className="form-input-placeholder in" >
                            <div className="form-input-placeholder-label" title="Login ID"><i className="bi bi-person-fill-lock m-auto"></i></div>
                            <input type="text" onChange={e=>setEmail(e.currentTarget.value)} value={email} className="form-control form-control-lg imeEng" required="required" />
                            <div className="form-input-placeholder-text form-input-placeholder-snByac" aria-hidden="true">Please enter your ID.</div>
                        </div>
                    </div>
                    <div className="form-group input-group input-group-merge mb-3">
                        <div className="form-input-placeholder in">
                            <div className="form-input-placeholder-label" title="Login Password"><i className="bi bi-key-fill m-auto"></i></div>
                            <input type="password" className="form-control form-control-lg" onChange={e=>setPassword(e.target.value)} value={password} required="required" />
                            <div className="form-input-placeholder-text form-input-placeholder-snByac" aria-hidden="true">Please enter a password.</div>
                            <div className="btn-passwd-view-wrap">
                                <button type="button" className="btn-passwd-view" ><i className="bi bi-eye-fill"></i></button>	
                            </div>
                        </div>
                    </div>
                    <div className="d-flex justify-content-between align-items-center">
                        <div className="d-flex">
                            <Checkbox title="Stay signed in" name="statusLogin" value="1" checked={statusLogin} onChange={e=>setStatusLogin(e.target.checked)} />
                        </div>					
                        <div className="text-right" id="ipSecurityWrap">
                            <SwitchBox title="IP Security" name="ip_security" value="1" />
                        </div>
                    </div>
                    <div className="form-group auth-btn">
                        <button type="button" onClick={handleLogin} className="btn btn-lg btn-primary btn-block" data-toggle="tooltip" title="LOGIN" ><i className="bi bi-box-arrow-in-right"></i> LOGIN</button>
                        <div className="auth-btn-sub qrlogin">
                            <button type="button" className="btn btn-link" id="QRLogin" title="QR code login">QR code login<div className="underline"></div></button>
                            <button type="button" id="findMemberInfo" className="btn btn-link" title="Find ID / Password">Find ID / Password<div className="underline"></div></button>
                        </div>
                    </div>
                    <div className="login-frm-msg">
                        <div className="loading_msg">
                            <span className="ps_msg ps_ok">
                                <em className="ps_ico"></em>
                                <span className="ps_txt">error</span>
                            </span>
                        </div>
                    </div>
                    <div className="gallery-layer-loading">
                        <div className="gallery-layer-loader">
                            <div className="gallery-layer-loader-outer"></div>
                            <div className="gallery-layer-loader-middle"></div>
                            <div className="gallery-layer-loader-inner"></div>
                        </div>
                    </div>
                </form>
                <footer className="auth-footer footer-text text-center">gw_corp_mng_copyright</footer>
            </div>
        </GuestLayout>
    )
}