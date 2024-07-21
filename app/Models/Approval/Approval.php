<?php

namespace App\Models\Approval;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Approval\Approval;

class Approval extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    
    /**
     * The table associated with the model.
     * * 해당 모델의 테이블명
     *
     * @var string
     */
    protected $table = 'approval_doc';

    /**
     * The primary key associated with the table.
     * * 기본키
     *
     * @var string
     */
    protected $primaryKey = 'doc_idx';

    /**
     * Indicates if the model's ID is auto-incrementing.
     * * 기본키가 증가하는 점수 사용여부
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     * *모델의 기본키가 정수가 아닌 경우 모델에 보호된 $keyType 속성을 정의해야 합니다. 이 속성은 string 값을 가져야 합니다.
     *
     * @var string
     */
    // protected $keyType = 'string';
    
    /**
     * Indicates if the model should be timestamped.
     * * 기본 타임스탬프 관리 여부
     *
     * @var bool
     */
    public $timestamps = true;
    
    /**
     * The storage format of the model's date columns.
     * 타임 스탬프의 형식 변경에 사용
     *
     * @var string
     */
    // protected $dateFormat = 'U';

    /**
     * 타임스탬프 사용되는 컬럼명
     */
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'updated_date';

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

    protected $listModeArray = [
        'myRequest'		=> '결재요청',
        'myFinish'		=> '결재완료',
        'temp'			=> '임시문서함',
        'withdraw'		=> '기안회수',
        'myReject'		=> '기안반려',
        
        'stand'			=> '결재대기',
        'hold'			=> '결재보류',
        'ing'			=> '결재진행',
        'reject'		=> '결재반려',
        'finish'		=> '결재완료',
        'receive'		=> '수신함',
        'reference'		=> '참조참',
        'reads'			=> '열람함',
            
        'departBox_D'	=> '부서문서함',
        'departBox_W'	=> '주간업무보고',
        'departBox_M'	=> '월말업무보고'
    ];

    public function getCcontTitles(){

        return $this->contTitleArray;
    }
}
