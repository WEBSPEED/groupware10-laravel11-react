<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Approval\Approval;

use App\Http\Controllers\Approval\ApprovalWhereController;


class ApprovalController extends Controller
{
    protected $contTitleArray = [
        'myRequest'		=> '결재요청함',
        'temp'			=> '임시문서함',
        'withdraw'		=> '회수문서함',
        'myReject'		=> '반려문서함',
        'myFinish'		=> '완료문서함',
        'stand'			=> '결재대기함',
        'hold'			=> '결재보류함',
        'ing'			=> '결재진행함',
        'reject'		=> '반려문서함',
        'finish'		=> '완료문서함',
        'reference'		=> '참조문서함',
        'reads'			=> '열람문서함',
        'receive'		=> '수신문서함',
        'departBox'		=> '부서문서함',
        'departBox_D'	=> '부서문서함',
        'departBox_W'	=> '주간업무보고',
        'departBox_M'	=> '월말업무보고',
        'docBox'		=> '문서대장'
    ];

    protected $dashboarTypes = [
        'myRequest'		=> '결재요청함',
        'temp'			=> '임시문서함',
        'myReject'		=> '반려문서함',
        'myFinish'		=> '완료문서함',

        'stand'			=> '결재대기함',
        'hold'			=> '결재보류함',
        'ing'			=> '결재진행함',

        'reject'		=> '반려문서함',
        'finish'		=> '완료문서함',

        'receive'		=> '수신문서함',
        'reference'		=> '참조문서함',
        'reads'			=> '열람문서함'
    ];
    
	protected $docStateArray= [
        '0'	=> array('txt'=>'임시저장','icon'=>'','color'=>'secondary'),
        '1'	=> array('txt'=>'진행','icon'=>'','color'=>'info'),
        '2'	=> array('txt'=>'완료','icon'=>'','color'=>'primary'),
        '3'	=> array('txt'=>'반려','icon'=>'','color'=>'danger'),
        '4'	=> array('txt'=>'보류','icon'=>'','color'=>'warning'),
        '9'	=> array('txt'=>'회수','icon'=>'','color'=>'warning')
    ];

    //
    public function dashboard(): Response
    {
        $news = array();
        $docCnts = array();
        foreach( (array) $this->dashboarTypes as $_key => $_val ){
            $docCnt = Approval::query();            
            $docCnt = $this->getApprovalWhere( $docCnt, $_key );
            $docCnt = $docCnt->count();

            $news[$_key] = ( $docCnt >= 20 ) ? true : false;
            $docCnts[$_key] = $docCnt;
        }
        return response([
            'news' => $news,
            'count' => $docCnts
        ]);
    }

    public function getDocLists(Request $request): Response
    {
        $pageSize = isset($request->pageSize) && (int)$request->pageSize > 0 ? $request->pageSize : 5;

        $docs = Approval::query();
        // if( $request->searchQuery != '' ){
        //     $docs = Product::where('name', 'like', '%' . $request->searchQuery . '%');
        // }
        $docs = $this->getApprovalWhere( $docs, $request->type);
        
        if( !empty($request->search_keyfield) && !empty($request->search_keyword) ){
            $docs->where(str_replace('search_', '', $request->search_keyfield), 'like', '%' . $request->search_keyword . '%');
        }
        

        //$products = $products->latest()->get();
        $docs = $docs->latest()->paginate($pageSize);   // 1페이지당 2개씩

        return response([
            'pageTitle' => $this->contTitleArray[$request->type],
            // 'docStatus' => $this->docStateArray,
            'docs' => $docs
        ]);
        return response($docs);
    }
    
    public function getApprovalWhere(Builder $docs, $listMode, $docIdx=0, $docKey='', $readCheck=false, $isAdmin=false): Builder
    {
		// 결재 기안함 및 결재함 조건 검색용
		$myUserMode		= array('myRequest','myFinish','temp','myReject','withdraw');
		$reqUserMode	= array('stand','hold','ing','finish','reject');

        // 기안함
        if( in_array($listMode, $myUserMode) ){			
			// 결재 요청함
			if( $listMode === 'myRequest' ){
				$docs->whereIn('doc_status', [1,2,3,4]);
			}

			// 결재완료함
			if( $listMode === 'myFinish' ){
				$docs->where([
                    ['doc_status', 2],
                    ['doc_finish_flag', 1]
                ]);
			// 	$_where[] = 'D.doc_status=2';
			// 	$_where[] = 'P.process_type in (0,1,4)';
			// 	$_where[] = 'D.doc_finish_flag=1';								// 결재완료
			}

			// 임시문서함
			if( $listMode === 'temp' ){
                $docs-> where('doc_status', 0);
			}
			
			// //반려문서함
			if( $listMode === 'myReject' ){
				$docs->where([
                    ['doc_status', 3],
                    ['doc_re_submit_flag', 1]
                ]);
			// 	$_where[] = 'D.doc_status=3';
			// 	$_where[] = 'P.process_type in (0,1,4)';
			// 	$_where[] = 'P.process_status!=0';
			// 	$_where[] = 'D.doc_re_submit_flag=1';
			}
			
			//회수문서함
			if( $listMode === 'withdraw' ){
                $docs-> where('doc_status', 9);
			}
			
			// // 기안함 공용
			// $_where[] = 'D.doc_reg_mb_code=\''.$this->parent->mcode.'\'';
			// $_where[] = 'D.doc_reg_mb_code=P.process_reg_mb_code';
			// $_where[] = 'P.process_reg_user=1';	//2022-11-08	
        }

        // 결재함        
		if( in_array($listMode, $reqUserMode) ){
			// 결재대기함 (보류함)
			if( $listMode === 'stand' || $listMode === 'hold' ){
                $docs-> where('doc_status', 1);
                if( $listMode === 'stand' ){
                    $docs-> where('doc_hold', 0);
                }else{
                    $docs-> where('doc_hold', 1);
                }
				// $_where[] = 'P.process_status=1';
				// $_where[] = 'D.doc_process_idx = P.process_idx';
			}

			// 결재진행함
			if( $listMode === 'ing' ){
                $docs-> where('doc_status', 1);
				// $_where[] = 'P.process_status in (2,4)';
			}

			// 결재완료함
			if( $listMode === 'finish' ){
				$docs->where([
                    ['doc_status', 2],
                    ['doc_finish_flag', 1]
                ]);
				// $_where[] = 'D.doc_status=2';
				// $_where[] = 'P.process_status=2';
				// $_where[] = 'D.doc_finish_flag=1';
			}

			// 반려문서함
			if( $listMode === 'reject' ){
                $docs-> where('doc_status', 3);
				// $_where[] = 'D.doc_status=3';		// 반려
				// $_where[] = 'P.process_status in(2,3,4)';
			}
			
			// // 결제함 공용
			// $_where[] = 'P.process_type in (0,1,4)';
			// $_where[] = 'P.process_reg_user=0';	//2022-11-08	
			// if( $isAdmin === false ){
			// 	if( $listMode === 'stand' ){
			// 		// 결재 배정자 및 대리 결재자
			// 		$_where[] = '\''.$this->parent->mcode.'\' in (P.process_mb_code, P.process_entrust_mb_code)';
			// 	}else{
			// 		// 결재 배정자 및 대리 결재자 및 실제 결재자
			// 		$_where[] = '\''.$this->parent->mcode.'\' in (P.process_mb_code, P.process_status_mb_code, P.process_entrust_mb_code)';
			// 	}
			// }
        }
        
		// 수신함 (결재가 완료되었을 경우만 확인 가능)
		if( $listMode === 'receive' ){
            $docs-> where('doc_status', 2);
			// $_where[] = 'D.doc_status=2';	// 결재 완료
			// $_where[] = 'R2.mb_code=\''.$this->parent->mcode.'\'';
			// if( $readCheck === true ){
			// 	$_where[] = 'R2.view_date is null';
			// }
		}

		// 참조함 (참조는 결재가 시작되면 바로 확인이 가능)
		if( $listMode === 'reference' ){
            $docs->whereIn('doc_status', [1,2,3,4]);
			// $_where[] = 'D.doc_status in (1,2,3,4)';
			// $_where[] = 'R1.reference_type=1';
			// $_where[] = 'R1.mb_code=\''.$this->parent->mcode.'\'';
			// if( $readCheck === true ){
			// 	$_where[] = 'R1.view_date is null';
			// }
		}

		// 열람함 (결재가 완료되었을 경우만 확인 가능)
		if( $listMode === 'reads' ){
            $docs-> where('doc_status', 2);
			// $_where[] = 'D.doc_status=2';		// 결재 완료
			// $_where[] = 'R1.reference_type=2';
			// $_where[] = 'R1.mb_code=\''.$this->parent->mcode.'\'';
			// if( $readCheck === true ){
			// 	$_where[] = 'R2.view_date is null';
			// }
		}


        
		// 문서대장
		if( $listMode === 'docBox' ){
            $docs-> where('doc_status', 2);
			// $_where[] = 'D.doc_status=2';	// 결재 완료
			// $_where_or_d = array();
			// $_where_or_d[] = '(D.doc_open_type=\'O\')';
			// $_where_or_d[] = '(D.doc_open_type in (\'D\',\'N\') and D.doc_reg_mb_depart_code in ('.implode(',', $GLOBALS['_WCUG']['company']->getTeamCodeList( $this->parent->MEMBER )).'))';
			// $_where[]	= '('.implode(' or ', $_where_or_d).')';
		}


        return $docs;
    }

}
