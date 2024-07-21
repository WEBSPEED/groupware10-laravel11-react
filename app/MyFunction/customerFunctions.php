<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


if (! function_exists('strEnCode')) {
    function strEnCode( $str ) {
        return Crypt::encryptString($str);
    }
}
if (! function_exists('strDeCode')) {
    function strDeCode( $str ) {
        try {
            $deStr = Crypt::decryptString($str);
        } catch (DecryptException $e) {
            $deStr = $str;
        }
        return $deStr;
    }
}




if (! function_exists('getAesKey')) {
    function getAesKey(){
        $_outStr = array();
        parse_str(base64_decode( config('cug.cug_key') ), $tmpCode);
        foreach( (array) $tmpCode as $_key=>$_val){
            $_outStr[] = chr( (int)$_key - (int)$_val );
        }
        $outStr = '-';
        if( is_array($_outStr) ){
            $outStr = implode('',$_outStr);
        }
        return $outStr;
    }
}

if (! function_exists('absint')) {
    function absint( $maybeint ) {
        return abs( intval( $maybeint ) );
    }
}

if (! function_exists('number_format_i18n')) {
    function number_format_i18n( $number, $decimals = 0, $decimal_point='.', $thousands_sep=',' ) {
        $formatted = number_format( $number, absint( $decimals ), $decimal_point, $thousands_sep );
        return $formatted;
    }
}

/**
 * 사용자별 사이트 상단 메뉴 리스트
 * id: 사용자 id
 */
if (! function_exists('getSiteMenus')) {
    function getSiteMenus($id) {
        return cache('siteMenus_'.$id);
    }
}

/**
 * 해당 회원의 소속 업체리스트
 * id: 사용자 id
 */
if (! function_exists('getCugCompanys')) {
    function getCugCompanys($id) {
        return cache('cugCompanys_'.$id);
    }
}

/**
 * Cache 데이타 값 불러오기
 */
if (! function_exists('getCacheValue')) {
    function getCacheValue($key, $skey='', $default='') {
        if( Cache::has($key) ){
            if( !empty($skey)){
                $value =  cache($key)[$skey];
            }else{
                $value =  cache($key);
            }
            if( empty($value)){
                $value = $default;
            }
        }else{
            $value = '';
        }
        return $value;
    }
}


/**
 * 첨부파일이 이미지인지 여부 체크하기
 * filetype
 */
if (! function_exists('isImage')) {
    function isImage( $filetype ) {
        if( is_array($filetype) ){
            return isImage2($filetype);
        }else{
            return preg_match('/(image)/i', $filetype);
        }
    }
}
if (! function_exists('isImage2')) {
    function isImage2( $file ) {
        if( Storage::exists($file->filepath) ){
            $imgType = getimagesize(storage_path('app').DIRECTORY_SEPARATOR.$file->filepath);
            // return Arr::has(config('cug.imgArray'), $imgType[2]);
            return @in_array($imgType[2], config('cug.imgArray'));
        }else{
            return null;
        }
    }
}


/**
 * 파일이 미리보기 가능 문서인지 여부 체크
 */
if (! function_exists('isFileViewDoc')) {
    function isFileViewDoc( $fileExt ) {
        // return Arr::has(config('cug.fileDocs'), $fileExt);
        return @in_array($fileExt, config('cug.fileDocs'));
    }
}

/**
 * 첨부파일의 용량을 Format 한다
 */
if (! function_exists('sizeFormat')) {
    function sizeFormat( $bytes, $decimals = 0 ) {
        $quant = array(
            'TB' => config('cug.TB_IN_BYTES'),
            'GB' => config('cug.GB_IN_BYTES'),
            'MB' => config('cug.MB_IN_BYTES'),
            'KB' => config('cug.KB_IN_BYTES'),
            'B'  => 1,
        );
        if ( 0 === $bytes ) {
            return number_format_i18n( 0, $decimals ) . 'B';
        }
        foreach ( $quant as $unit => $mag ) {
            if ( doubleval( $bytes ) >= $mag ) {
                return number_format_i18n( $bytes / $mag, $decimals ) . $unit;
            }
        }
        return false;
    }
}


if (! function_exists('customerDateFormat')) {
    function getContentTypeHeader($path){
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $contentType = config("mime.{$extension}") ?: 'application/octet-stream';
        return ['Content-Type' => $contentType];
    }
}

/**
 * 날짜 형식 지정
 */
if (! function_exists('customerDateFormat')) {
    function customerDateFormat($date, $dateFormat='Y.m.d') {
        return date($dateFormat, strtotime($date));
    }
}
/**
 * 날짜 형식 지정
 */
if (! function_exists('dispTimeStr')) {
    function dispTimeStr($date, $dateFormat='Y.m.d') {
        return date($dateFormat, strtotime($date));
    }
}



/**
 * 임의의 파일키을 생성한다.
 */
if (! function_exists('setFileKey')) {
    function setFileKey($file_name){
        return md5($file_name);//.'.'.getFileExt($file_name);
    }
}

/**
 * 임의의 파일명을 생성한다.
 */
if (! function_exists('setFileName')) {
    function setFileName($file_name){
        return md5(uniqid($file_name)).'.'.getFileExt($file_name);
    }
}

/**
 * 파일의 확장자 추출
 */
if (! function_exists('getFileExt')) {
    function getFileExt($filepath){
        return pathinfo($filepath, PATHINFO_EXTENSION);
    }
}

if (! function_exists('customerTest')) {
    function customerTest( ) {
        print time();
        exit;
    }
}

/**
 * 전화번호 규격화
 */
if (! function_exists('PhoneStr')) {
    function PhoneStr($Phonenumber,$gubun=false){
        $orgPhoneNumber	= trim($Phonenumber);
        if( !empty($orgPhoneNumber) ){
            $Phonenumber = str_replace( '-', '', $orgPhoneNumber );
            $Phonenumber = str_replace( ' ', '', $Phonenumber );
            $Phonenumber = str_replace( '.', '', $Phonenumber );
            switch(strlen($Phonenumber)){
                case 8:
                    $phone[0] = substr( $Phonenumber, 0, 4 );
                    $phone[1] = substr( $Phonenumber, 4, 4 );
                    break;
                case 9:
                    $phone[0] = substr( $Phonenumber, 0, 2 );
                    $phone[1] = substr( $Phonenumber, 2, 3 );
                    $phone[2] = substr( $Phonenumber, 5, 4 );
                    break;
                case 10:
                    if( substr( $Phonenumber, 0, 2 )=='02' ){
                        $phone[0] = substr( $Phonenumber, 0, 2 );
                        $phone[1] = substr( $Phonenumber, 2, 4 );
                        $phone[2] = substr( $Phonenumber, 6, 4 );
                    }else{
                        $phone[0] = substr( $Phonenumber, 0, 3 );
                        $phone[1] = substr( $Phonenumber, 3, 3 );
                        $phone[2] = substr( $Phonenumber, 6, 4 );
                    }
                    break;
                case 11:
                    $phone[0] = substr( $Phonenumber, 0, 3 );
                    $phone[1] = substr( $Phonenumber, 3, 4 );
                    $phone[2] = substr( $Phonenumber, 7, 4 );
                    break;
                default:
                    $phone[0] = $orgPhoneNumber;
            }
            if($gubun){
                return @implode('-',$phone);
            }else{
                return $phone;
            }
        }else{
            return '';
        }
    }
}


if (! function_exists('getUniqueCode')) {
    function getUniqueCode( $len=20, $cut=4, $hipen='-' ) {
		//지정된 자릿수의 랜덤한 숫자를 반환합니다. 최대 10까지 가능합니다. 4 이면 1000 에서 9999 사이의 랜덤 숫자
		function get_rand_number($len=4) {
			$len = absint( $len );
			if ($len < 1) $len = 1;
			else if ($len > 10) $len = 10;
			return rand( pow(10, $len - 1), (pow(10, $len) - 1) );
		}

		//넘어온 세자리수를 36진수로 변환해서 반환합니다. preg_match_callback 을 통해서만 사용됩니다.
		function get_simple_36($m){
			$str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			// $div = floor( $m[0] / 36 );
            // $rest = $m[0] % 36;
			// return $str[$div] . $str[$rest];
            $rest = round($m[0]);
			return str_pad($rest, 2, '0', STR_PAD_LEFT);
		}

		//지정된 자리수에 존재하는 소수 전체를 배열로 반환합니다. max len = 5
		function get_simple_prime_number($len=5){
			$len = absint( $len );
			if ($len < 1) $len = 1;
			else if ($len > 5) $len = 5;

			$prime_1 = Array(1, 2, 3, 5, 7);

			if ($len === 1) return $prime_1;

			$start = pow(10, ($len - 1)) + 1;//101
			$end = pow(10, $len) - 1;//999
			$prime = $prime_1;

			unset($prime[0]);//1제거
			unset($prime[1]);//2제거
			$array = Array();
			for($i = 11; $i <= $end; $i+=2){//10보다 큰 소수에는 짝수가 없다.
				$max = floor(sqrt($i));
				foreach($prime as $j) {
					if ($j > $max) break;
					if ($i % $j == 0) continue 2;
				}
				$prime[] = $i;
				if ($i >= $start) $array[] = $i;
			}
			return $array;
		}

		//지정된 자릿수의 숫자로된 시리얼을 반환합니다. - 를 포함하고 싶지 않을때는 $cut 이 $len 보다 크거나 같으면 됩니다. max len = 36
		function get_serial($len=16, $cut=4, $hipen='-'){

			$len = absint( $len );
			if ($len < 1) $len = 16;
			else if ($len > 36) $len = 36;

			$cut = absint( $cut );
			if ($cut < 1) $cut = 4;
			else if ($cut > $len) $cut = $len;

			list($usec, $sec) = explode(' ', microtime());
			$base_number = (string)$sec . str_replace('0.', '', (string)$usec);
			$base_number .= (string)get_rand_number(10) . (string)get_rand_number(8);//36자리 유니크한 숫자 문자열

			$prime = get_simple_prime_number(5);//5자리 소수 배열
			shuffle($prime);
			$prime = $prime[0];//랜덤한 5자리 소수

		//    $serial = bcmul(substr($base_number, 0, $len), $prime);
			$serial	 = substr($base_number, 0, $len) * $prime;
			$serial_length = strlen($serial);
			$sub = $len - $serial_length;

			if ($sub > 0) $serial .= (string)get_rand_number($sub);
			else if ($sub < 0) $serial = substr($serial, 0, $len);

			return preg_replace("`(.{" . $cut . "})`", "$1" . $hipen, $serial, floor(($len-1) / $cut));
		}

		$len = absint( $len );
		if ($len < 1) $len = 16;
		else if ($len > 24) $len = 24;

		$cut = absint( $cut );
		if ($cut < 1) $cut = 4;
		else if ($cut > $len) $cut = $len;

		$len2 = (int)($len * 3 / 2);
		if ($len2 % 2 == 1) $len2 += 1;

		$serial = get_serial($len2, $len2, $hipen);

		$serial = substr(preg_replace_callback("`.{3}`", "get_simple_36", $serial), 0, $len);

		return preg_replace("`(.{" . $cut . "})`", "$1" . $hipen, $serial, floor(($len-1) / $cut));


    }
}
