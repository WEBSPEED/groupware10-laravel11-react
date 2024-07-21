import React from 'react';
import Checkbox from '../../Components/Checkbox';
import SwitchBox from '../../Components/SwitchBox';

import '../../../css/auth.css'

import GuestLayout from '../../Layouts/GuestLayout'

const Login = () => {
  return (
	<GuestLayout>			
		<header id="auth-header" className="auth-header"></header>
		<div className="auth-box">
			<form className="auth-form layer-loading layer-loading-after" method="post">
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
					<div className="form-input-placeholder" >
						<div className="form-input-placeholder-label" title="Login ID"><i className="bi bi-person-fill-lock m-auto"></i></div>
						<input type="text" className="form-control form-control-lg imeEng" required="required" />
						<div className="form-input-placeholder-text form-input-placeholder-snByac" aria-hidden="true">Please enter your ID.</div>
					</div>
				</div>
				<div className="form-group input-group input-group-merge mb-3">
					<div className="form-input-placeholder">
						<div className="form-input-placeholder-label" title="Login Password"><i className="bi bi-key-fill m-auto"></i></div>
						<input className="form-control form-control-lg"required="required" />
						<div className="form-input-placeholder-text form-input-placeholder-snByac" aria-hidden="true">Please enter a password.</div>
						<div className="btn-passwd-view-wrap">
							<button type="button" className="btn-passwd-view" ><i className="bi bi-eye-fill"></i></button>	
						</div>
					</div>
				</div>
				<div className="d-flex justify-content-between align-items-center">
					<div className="d-flex">
						<Checkbox title="Stay signed in" name="statusLogin" value="1" />
					</div>					
					<div className="text-right" id="ipSecurityWrap">
						<SwitchBox title="IP Security" name="ip_security" value="1" />
					</div>
				</div>
				<div className="form-group auth-btn">
					<button type="submit" className="btn btn-lg btn-primary btn-block" data-toggle="tooltip" title="LOGIN" ><i className="bi bi-box-arrow-in-right"></i> LOGIN</button>
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

export default Login
