import React, { useState } from 'react';
import { NavLink, useNavigate } from 'react-router-dom'


export default function HeaderLayout(props)
{
    const [showingNavigationDropdown,setShowingNavigationDropdown] = useState(false);

    const navigate = useNavigate();

    const handleLogout = () => {
    
        Swal.fire({
            title: '로그아웃 하시겠습니까?',
            text: '',
            icon: 'question',
            iconColor: '#d33',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '확인',
            cancelButtonText: '취소'
        }).then((result) => {
            if( result.isConfirmed){                    
                axios.delete('/auth/logout')
                    .then((response) => {
                        localStorage.removeItem('status')
                        navigate('/auth')
                        toast.fire({ icon:"success", title:"로그아웃!!" })
                    });
            }
        });
    }

    return (    
        <header className="navbar navbar-expand fixed header-navbar">
            <NavLink to="/" className="navbar-brand text-white">이맥스ICT</NavLink>
            <div className="navbar-nav-scroll">
                <ul className="navbar-nav bd-navbar-nav flex-row header-menu">
                    <li className="nav-item">
                        <NavLink to="/about" className="nav-link">전자결재</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/auth" className="nav-link">Login</NavLink>
                    </li>
                    <li className="nav-item">
                        <a role="button" className="nav-link" onClick={handleLogout}>Logout</a>
                    </li>
                </ul>
            </div>
            <nav className="navbar-nav flex-row ml-md-auto d-block d-lg-flex header-my">
                <div className="navbar-collapse collapse">
                    <ul className="navbar-nav ml-auto">
                        <li className={`nav-item dropdown ${showingNavigationDropdown ? ' show':''}`} id="userDropdownWrap" >
                            <button type="button" className={`nav-link dropdown-toggle ${showingNavigationDropdown ? ' open':''}`} onClick={e=>setShowingNavigationDropdown(!showingNavigationDropdown)} >
                                <span className="header-nav-user" id="user-info" data-toggle="tooltip" >
                                    <img src="../../images/6aecda497cc09b8b3d1ee2b173ca1d57.jpg" className="avatar img-fluid rounded-circle mb-avatar-img" />
                                    <span className="text-white nav-user-name">시스템관리자 팀장</span>
                                </span>
                            </button>
                            <div className={`dropdown-menu tooltip_profile ${showingNavigationDropdown ? ' show':''}`} >
                                <div className="head_profile">
                                    <img src="../../images/6aecda497cc09b8b3d1ee2b173ca1d57.jpg" onerror="this.src='../../images/6aecda497cc09b8b3d1ee2b173ca1d57.jpg'" className="ico_comm ico_profile" alt="" />
                                    <div className="etc_thumb"><span className="badge badge-primary font-weight-normal">겸임</span></div>
                                    <div className="cont_thumb">
                                        <strong className="tit_thumb">시스템관리자 팀장</strong>
                                        <div className="desc_thumb">(주)이맥스ICT / 시스템개발팀</div>
                                    </div>
                                </div>
                                <div className="box_mode">
                                    <NavLink to="/about" className="link_txt site-menu-link">개인정보</NavLink>
                                    <button type="button" className="link_txt btn-site-logout" title="로그아웃" onClick={handleLogout}><span className="text-danger"><i className="fas fa-sign-out fa-flip-horizontal mr-1"></i>로그아웃</span></button>
                                </div>
                                <div className="box_mode mt-2">
                                    <NavLink to="/about" className="link_txt site-menu-link">시스템 관리</NavLink>
                                    <NavLink to="/about" className="link_txt site-menu-link">환경설정</NavLink>
                                </div>
                                <div className="box_instead d-none">
                                    <NavLink to="/about" className="link_txt site-menu-link">로그인 기록</NavLink>
                                </div>
                                <div className="box_instead">
                                    <NavLink to="/about" className="link_txt site-menu-link">
                                        <em className="txt_set">근태관리</em>
                                        <span className="ico_comm ico_arr_l type_reverse"></span>
                                    </NavLink>
                                </div>
                                <div className="info_desc">							
                                    <strong className="tit_txt">설정</strong>
                                    <ul className="list_desc approval_header_config">
                                        <li>
                                            <NavLink to="/about" className="_stopDefault link_txt" title="결재선 관리"><em className="tit_desc">결재선 관리</em><span className="ico_comm ico_arr_l type_reverse"></span></NavLink>
                                        </li>
                                        <li id="approval-pin">
                                            <em className="tit_desc">결재암호</em> 
                                            <div className="customer-form-switch customer-form-switch-sm customer-form-switch-inline">
                                                <input type="checkbox" id="switchApprPassword" className="customer-form-switch-input" value="1" />
                                                <div className="customer-form-switch-box">
                                                    <div className="customer-form-switch-circle"></div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div className="info_instead">
                                        <button type="button" className="_stopDefault link_txt" title="대리결재자 설정"><em className="txt_set">대리결재자 설정</em><span className="ico_comm ico_arr_l type_reverse"></span></button>
                                    </div>							
                                </div>
                                <div className="info_desc login_time">
                                    마지막 로그인<br />2024.7.17 (수) 10:31                                
                                    <NavLink to="/about" className="link_txt site-menu-link" >로그인 기록<span className="ico_comm ico_arr_l type_reverse"></span></NavLink>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    )
}
