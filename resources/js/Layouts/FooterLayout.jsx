import React from 'react'

const FooterLayout = () => {
  return (
    <>
        <div className="footer-actionbar">
            <div className="footer-ac-inner">
                <ul>
                    <li><button type="button"  className="btn btn-link" data-toggle="tooltip" title="" data-original-title="홈"><i className="fad fa-home-lg"></i><span className="sr-only">홈</span></button></li>
                    <li><button type="button" className="btn btn-link"  data-toggle="tooltip" title="" data-original-title="메뉴"><i className="fad fa-bars"></i><span className="sr-only">메뉴</span></button></li>
                    <li><button type="button" className="_stopDefault btn btn-link" data-toggle="tooltip" title="" data-original-title="마이페이지"><i className="fad fa-user-cog"></i><span className="sr-only">마이페이지</span></button></li>
                    <li><button type="button" className="btn btn-link" data-toggle="tooltip" title="" data-original-title="로그아웃"><i className="fad fa-sign-out-alt fa-flip-horizontal"></i><span className="sr-only">로그아웃</span></button></li>
                </ul>
            </div>
        </div>
        <footer className="footer">
            <div className="footer-cont">
                <div className="copy">Ver .9.1</div>
                <div className="footer-text">Copyright Demo EmaxICT</div>
                <div className="footer-text2">
                    <button type="button" className="btn btn-sm btn-link btn-secondary mr-2 border-0" data-toggle="tooltip" title="" data-original-title="사다리게임">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-ladder" viewBox="0 0 16 16">
                            <path d="M4.5 1a.5.5 0 0 1 .5.5V2h6v-.5a.5.5 0 0 1 1 0v14a.5.5 0 0 1-1 0V15H5v.5a.5.5 0 0 1-1 0v-14a.5.5 0 0 1 .5-.5zM5 14h6v-2H5v2zm0-3h6V9H5v2zm0-3h6V6H5v2zm0-3h6V3H5v2z"></path>
                        </svg>
                    </button>
                    <button type="button" className="btn btn-sm btn-link btn-secondary mr-2 border-0" data-toggle="tooltip" title="" data-original-title="출/퇴근 처리"><i className="far fa-business-time"></i></button>
                    <button type="button" className="btn btn-sm btn-link btn-secondary mr-2 border-0" data-toggle="tooltip" title="" data-original-title="계산기"><i className="fa fa-calculator fa-fw mr-0"></i></button>
                    <strong className="text-muted mr-1"><i className="fas fa-phone-alt text-dark mr-1"></i>고객지원</strong> : <span className="text-danger ml-1">051-553-2112</span>
                    <strong className="text-muted mr-1"><i className="fas fa-fax-alt text-dark mr-1"></i>FAX</strong> : <span className="text-danger ml-1">051-507-6811</span>
                </div>
            </div>
        </footer>
    </>
  )
}

export default FooterLayout
