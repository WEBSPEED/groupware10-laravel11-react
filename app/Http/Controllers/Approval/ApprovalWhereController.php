<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Approval\Approval;

class ApprovalWhereController extends Controller
{
    //

    public function getApprovalWhere(Builder $docs, $listMode, $docIdx=0, $docKey='', $readCheck=false, $isAdmin=false): Builder
    {
		// 결재 기안함 및 결재함 조건 검색용
		$myUserMode		= array('myRequest','myFinish','temp','myReject','withdraw');
		$reqUserMode	= array('stand','hold','ing','finish','reject');

        // 기안함
        if( in_array($listMode, $myUserMode) ){		
        }

        // 결재함        
		if( in_array($listMode, $reqUserMode) ){
        }

        return $docs;
    }
}
