<?php
use App\Settings;
use App\User;
use App\Pages;
use App\PostViewsDownload;
use App\Favourite;
use App\Analytics;
use App\PostRatings;
use App\PaymentGateway;
use App\AppliedUsers;
use App\SubscriptionPlan;
use App\Jobs;

if (! function_exists('check_company_jobs')) {
    function check_company_jobs($user_id)
    { 
        $total_jobs = Jobs::where('user_id',$user_id)->count();

        return $total_jobs;
    }
}

if (! function_exists('user_plan_limit_check')) {
    function user_plan_limit_check($user_id)
    { 
        $user_info = User::where('id',$user_id)->first();
        $user_type=$user_info->usertype;
        $user_plan_id=$user_info->plan_id;
        $user_plan_exp_date=$user_info->exp_date;

        if($user_plan_id==NULL)
        {
            $msg= 'You have no active subscription, please purchase the plan!';

                return $msg;
        }
        else
        {

            $plan_info = SubscriptionPlan::findOrFail($user_plan_id);
            $plan_job_limit=$plan_info->plan_job_limit;
            $current_plan=$plan_info->plan_name;
    
            if(strtotime(date('m/d/Y'))>=$user_plan_exp_date)
            {         
                $expired_on=date('d, M Y',$user_plan_exp_date);

                $msg= 'Your current plan is '.$current_plan.' which  expired on '.$expired_on.' so now Renew subscription.';

                return $msg;
            }
            
            if($user_type=="User")
            {
                $total_jobs_applied = AppliedUsers::where('user_id',$user_id)->count();

                if($total_jobs_applied >= $plan_job_limit)
                { 
                    $msg= 'Your current plan is '.$current_plan.' which have '.$plan_job_limit.' job applied limit and you already reached this limit so now Upgrade subscription';

                    return $msg;
                }
            } 
            else
            {
                $total_jobs = Jobs::where('user_id',$user_id)->count();

                if($total_jobs >= $plan_job_limit)
                { 
                    $msg= 'Your current plan is '.$current_plan.' which have '.$plan_job_limit.' job applied limit and you already reached this limit so now Upgrade subscription';

                    return $msg;
                }
            }
        }
        return "true";        
    }
}

if (! function_exists('total_applied_jobs')) {
    function total_applied_jobs($user_id)
    { 
        $applied_total = AppliedUsers::where('user_id',$user_id)->count();

        return $applied_total;
    }
}

if (! function_exists('total_saved_jobs')) {
    function total_saved_jobs($user_id)
    { 
        $saved_total = Favourite::where('user_id',$user_id)->count();

        return $saved_total;
    }
}

if (! function_exists('getPaymentGatewayInfo')) {
function getPaymentGatewayInfo($id,$field_name=null)
{ 
 
    $gateway_obj= PaymentGateway::find($id); 

    if(isset($field_name))
    {
        $gateway_info=json_decode($gateway_obj->gateway_info);

        //echo $gateway_info->status;
        //exit;

        return $gateway_info->$field_name;
    }
    else
    { 
        return $gateway_obj;
    }
     
}
}

if (!function_exists('post_total_reviews_count')) {
    function post_total_reviews_count($post_id,$post_type)
    {
            $view_count = PostRatings::where('post_id', '=', $post_id)->where('post_type', '=', $post_type)->count();

            return $view_count;
    }
}
 
if (!function_exists('check_user_rating')) {
    function check_user_rating($post_type,$post_id,$user_id=null)
    {       
        if($user_id)
        {
             $rate_obj = PostRatings::where('post_type', '=', $post_type)->where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();

             if($rate_obj)
             {
                return true;
             }
             else
             {
                return false;
             }
        }
        else
        {
            return false;
        }
          
    }
}

if (!function_exists('check_favourite')) {
    function check_favourite($post_type,$post_id,$user_id=null)
    {       
        if($user_id)
        {
             $fav_obj = Favourite::where('post_type', '=', $post_type)->where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();

             if($fav_obj)
             {
                return true;
             }
             else
             {
                return false;
             }
        }
        else
        {
            return false;
        }
          
    }
}

if (!function_exists('post_views_count')) {
    function post_views_count($post_id,$post_type)
    {
            $view_count = PostViewsDownload::where('post_id', '=', $post_id)->where('post_type', '=', $post_type)->sum('post_views');

            return $view_count;
    }
}

if (!function_exists('post_views_save')) {
    function post_views_save($post_id,$post_type,$user_id=null)
    {       

           $today_date=  strtotime(date('m/d/Y'));

        $view_info = PostViewsDownload::where('post_id', '=', $post_id)->where('post_type', '=', $post_type)->where('date', '=', $today_date)->first();   


        if($view_info)
        { 
            $view_obj = PostViewsDownload::findOrFail($view_info->id);        
            $view_obj->increment('post_views');     
            $view_obj->save();
             
        }
        else
        {
            $view_obj = new PostViewsDownload;

            $view_obj->post_id = $post_id;
            $view_obj->post_type = $post_type;
            $view_obj->post_views = 1;
            $view_obj->date = $today_date;
            $view_obj->save();
        }
 
    }
}

if (!function_exists('post_download_count')) {
    function post_download_count($post_id,$post_type)
    {
            $view_count = PostViewsDownload::where('post_id', '=', $post_id)->where('post_type', '=', $post_type)->sum('post_download');

            return $view_count;
    }
}

if (!function_exists('post_download_save')) {
    function post_download_save($post_id,$post_type,$user_id=null)
    {       

           $today_date=  strtotime(date('m/d/Y'));

        $view_info = PostViewsDownload::where('post_id', '=', $post_id)->where('post_type', '=', $post_type)->where('date', '=', $today_date)->first();   


        if($view_info)
        { 
            $view_obj = PostViewsDownload::findOrFail($view_info->id);        
            $view_obj->increment('post_download');     
            $view_obj->save();
             
        }
        else
        {
            $view_obj = new PostViewsDownload;

            $view_obj->post_id = $post_id;
            $view_obj->post_type = $post_type;
            $view_obj->post_download = 1;
            $view_obj->date = $today_date;
            $view_obj->save();
        }
 
    }
}


if (! function_exists('number_format_short')) {
function number_format_short( $n, $precision = 1 ) {
    if ($n < 900) {
        // 0 - 900
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        // 0.9k-850k
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        // 0.9m-850m
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'M';
    } else if ($n < 900000000000) {
        // 0.9b-850b
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = 'B';
    } else {
        // 0.9t+
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
    }

  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ( $precision > 0 ) {
        $dotzero = '.' . str_repeat( '0', $precision );
        $n_format = str_replace( $dotzero, '', $n_format );
    }

    return $n_format . $suffix;
}
}



if (! function_exists('putPermanentEnv')) {

 function putPermanentEnv($key, $value)
{
    $path = app()->environmentFilePath();

    $escaped = preg_quote('='.env($key), '/');

    file_put_contents($path, preg_replace(
        "/^{$key}{$escaped}/m",
        "{$key}={$value}",
        file_get_contents($path)
    ));
}

}

if (! function_exists('getcong')) {

    function getcong($key)
    {  
       if(file_exists(base_path('/public/.lic')))
       { 
            $settings = Settings::findOrFail('1'); 

            return $settings->$key;
       }
    }
}

if (!function_exists('alreadyInstalled')) {
    function alreadyInstalled()
    {
            return file_exists(base_path('/public/.lic'));

     }
}

 
//Site

if (!function_exists('classActivePathSite')) {
    function classActivePathSite($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
} 

//Admin
if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

if (!function_exists('classActivePathSub')) {
    function classActivePathSub($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' subdrop';
    }
}

if (!function_exists('classActivePathSub_Style')) {
    function classActivePathSub_Style($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return 'display: block;';
    }
}

if (!function_exists('classActivePathSite')) {
    function classActivePathSite($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return 'active';
    }
}

if (!function_exists('generate_timezone_list')) {
function generate_timezone_list()
{
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );

    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    ksort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC{$offset_prefix}{$offset_formatted}";

        $timezone_list[$timezone] = "({$pretty_offset}) $timezone";
    }

    return $timezone_list;
}

} 



if (! function_exists('verify_envato_purchase_code')) {
function verify_envato_purchase_code($product_code)
    { 
      
        $url = "https://api.envato.com/v3/market/author/sale?code=".$product_code;
        $curl = curl_init($url);


        $personal_token = "M8tF6z8lzZBBkmZt4xm3dU4lw7Rlbrwp";
        $header = array();
        $header[] = 'Authorization: Bearer '.$personal_token;
        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
        $header[] = 'timeout: 20';
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);

        $envatoRes = curl_exec($curl);
        curl_close($curl);
        $envatoRes = json_decode($envatoRes);
         

         return $envatoRes;
      
    }
} 

if (! function_exists('grab_image')) {
function grab_image($file_url,$save_to){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 140);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        $output = curl_exec($ch);
        $file = fopen($save_to, "w+");
        fputs($file, $output);
        fclose($file);
    }
}

if (! function_exists('checkSignSalt')) {
function checkSignSalt($data_info){

        $key="viaviweb";

        $data_json = $data_info;

        $data_arr = json_decode(urldecode(base64_decode($data_json)),true);

        //echo $data_arr['salt'];
        //exit;

        if((!isset($data_arr['sign']) && !isset($data_arr['salt'])) OR ($data_arr['sign'] == '' && $data_arr['salt'] == '')){
            //$data['data'] = array("status" => -1, "message" => "Invalid sign salt.");
             
            $response = array("success" => -1, "message" => "Invalid sign salt.","status_code" => 200);
            $set['EBOOK_APP'] = $response;
 
            header( 'Content-Type: application/json; charset=utf-8' );
            echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            exit();

             
            exit();


        }else{
            
            $data_arr['salt'];    
            
            $md5_salt=md5($key.$data_arr['salt']);

            if($data_arr['sign']!=$md5_salt){

                $response = array("success" => -1, "message" => "Invalid sign salt.","status_code" => 200);
                $set['EBOOK_APP'] = $response;

                header( 'Content-Type: application/json; charset=utf-8' );
                echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                exit();
            }
        }
        
        return $data_arr;
        
    }
}

if (! function_exists('countryNameToISO3166')) {
function countryNameToISO3166($country_name, $language) {
    if (strlen($language) != 2) {
        //Language must be on 2 caracters
        return NULL;
    }

    //Set uppercase if never
    $language = strtoupper($language);

    $countrycode_list = array('AF', 'AX', 'AL', 'DZ', 'AS', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BY', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BO', 'BQ', 'BA', 'BW', 'BV', 'BR', 'IO', 'BN', 'BG', 'BF', 'BI', 'KH', 'CM', 'CA', 'CV', 'KY', 'CF', 'TD', 'CL', 'CN', 'CX', 'CC', 'CO', 'KM', 'CG', 'CD', 'CK', 'CR', 'CI', 'HR', 'CU', 'CW', 'CY', 'CZ', 'DK', 'DJ', 'DM', 'DO', 'EC', 'EG', 'SV', 'GQ', 'ER', 'EE', 'ET', 'FK', 'FO', 'FJ', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GM', 'GE', 'DE', 'GH', 'GI', 'GR', 'GL', 'GD', 'GP', 'GU', 'GT', 'GG', 'GN', 'GW', 'GY', 'HT', 'HM', 'VA', 'HN', 'HK', 'HU', 'IS', 'IN', 'ID', 'IR', 'IQ', 'IE', 'IM', 'IL', 'IT', 'JM', 'JP', 'JE', 'JO', 'KZ', 'KE', 'KI', 'KP', 'KR', 'KW', 'KG', 'LA', 'LV', 'LB', 'LS', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MK', 'MG', 'MW', 'MY', 'MV', 'ML', 'MT', 'MH', 'MQ', 'MR', 'MU', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'ME', 'MS', 'MA', 'MZ', 'MM', 'NA', 'NR', 'NP', 'NL', 'NC', 'NZ', 'NI', 'NE', 'NG', 'NU', 'NF', 'MP', 'NO', 'OM', 'PK', 'PW', 'PS', 'PA', 'PG', 'PY', 'PE', 'PH', 'PN', 'PL', 'PT', 'PR', 'QA', 'RE', 'RO', 'RU', 'RW', 'BL', 'SH', 'KN', 'LC', 'MF', 'PM', 'VC', 'WS', 'SM', 'ST', 'SA', 'SN', 'RS', 'SC', 'SL', 'SG', 'SX', 'SK', 'SI', 'SB', 'SO', 'ZA', 'GS', 'SS', 'ES', 'LK', 'SD', 'SR', 'SJ', 'SZ', 'SE', 'CH', 'SY', 'TW', 'TJ', 'TZ', 'TH', 'TL', 'TG', 'TK', 'TO', 'TT', 'TN', 'TR', 'TM', 'TC', 'TV', 'UG', 'UA', 'AE', 'GB', 'US', 'UM', 'UY', 'UZ', 'VU', 'VE', 'VN', 'VG', 'VI', 'WF', 'EH', 'YE', 'ZM', 'ZW');
    $ISO3166 = NULL;
    //Loop all country codes
    foreach ($countrycode_list as $countrycode) {
        $locale_cc = Locale::getDisplayRegion('-' . $countrycode, $language);
        //Case insensitive
        if (strcasecmp($country_name, $locale_cc) == 0) {
            $ISO3166 = $countrycode;
            break;
        }
    }
    //return NULL if not found or country code
    return $ISO3166;
}

}

if (! function_exists('getRandomColorCode')) {
function getRandomColorCode()
{   
    $code=array('#ff8acc', '#5b69bc','#35b8e0', '#71b6f9', '#ff8acc');

    $rand_keys = array_rand($code,2);
    //$v = $array[$k];

    //return $code[$rand_keys[0]];

    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

}

if (! function_exists('getRandomProgressColor')) {
function getRandomProgressColor()
{   
    $code=array('primary', 'pink','info', 'warning', 'danger', 'success', 'dark', 'purple');

    $rand_keys = array_rand($code,2);
     

    return $code[$rand_keys[0]];
}

}

if (! function_exists('get_ip_location')) {

   function get_ip_location($ip)
    {
            $url = "http://ip-api.com/json/".$ip;
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
             
            // Retrieve IP data from API response 
            $ipData = json_decode($response, true); 
             
            // Return geolocation data 
            return !empty($ipData)?$ipData:false; 
    } 
}

if (! function_exists('save_visitor_analytics_info')) {
function save_visitor_analytics_info($user_ip,$os_name,$browser_name) {
     
 
    $get_ip_info=get_ip_location($user_ip);

     
    if($get_ip_info['status']=="success")
    {
         $user_country_code=$get_ip_info['countryCode'];
         $user_country=$get_ip_info['country'];
    }
    else
    {
        $user_country_code='';
         $user_country='';
    }
   
    $date=strtotime(date('m/d/Y'));

    //Check duplicate
    $analytics_info = Analytics::where('user_ip',$user_ip)->where('date',$date)->first();

    if($analytics_info=="")
    {
        $analytics_obj = new Analytics;
 
        $analytics_obj->user_ip = $user_ip;
        $analytics_obj->country_code = $user_country_code;
        $analytics_obj->country = $user_country;
        $analytics_obj->operating_system = $os_name;
        $analytics_obj->browser = $browser_name;
        $analytics_obj->date = $date;
         
        $analytics_obj->save();
    }

    return true;

 }
}    
 

if (! function_exists('getCurrencySymbols')) {
    function getCurrencySymbols($code)
    { 
        $currency_symbols = array(
                            'AED' => '&#1583;.&#1573;', // ?
                            'AFN' => '&#65;&#102;',
                            'ALL' => '&#76;&#101;&#107;',
                            'AMD' => '',
                            'ANG' => '&#402;',
                            'AOA' => '&#75;&#122;', // ?
                            'ARS' => '&#36;',
                            'AUD' => '&#36;',
                            'AWG' => '&#402;',
                            'AZN' => '&#1084;&#1072;&#1085;',
                            'BAM' => '&#75;&#77;',
                            'BBD' => '&#36;',
                            'BDT' => '&#2547;', // ?
                            'BGN' => '&#1083;&#1074;',
                            'BHD' => '.&#1583;.&#1576;', // ?
                            'BIF' => '&#70;&#66;&#117;', // ?
                            'BMD' => '&#36;',
                            'BND' => '&#36;',
                            'BOB' => '&#36;&#98;',
                            'BRL' => '&#82;&#36;',
                            'BSD' => '&#36;',
                            'BTN' => '&#78;&#117;&#46;', // ?
                            'BWP' => '&#80;',
                            'BYR' => '&#112;&#46;',
                            'BZD' => '&#66;&#90;&#36;',
                            'CAD' => '&#36;',
                            'CDF' => '&#70;&#67;',
                            'CHF' => '&#67;&#72;&#70;',
                            'CLF' => '', // ?
                            'CLP' => '&#36;',
                            'CNY' => '&#165;',
                            'COP' => '&#36;',
                            'CRC' => '&#8353;',
                            'CUP' => '&#8396;',
                            'CVE' => '&#36;', // ?
                            'CZK' => '&#75;&#269;',
                            'DJF' => '&#70;&#100;&#106;', // ?
                            'DKK' => '&#107;&#114;',
                            'DOP' => '&#82;&#68;&#36;',
                            'DZD' => '&#1583;&#1580;', // ?
                            'EGP' => '&#163;',
                            'ETB' => '&#66;&#114;',
                            'EUR' => '&#8364;',
                            'FJD' => '&#36;',
                            'FKP' => '&#163;',
                            'GBP' => '&#163;',
                            'GEL' => '&#4314;', // ?
                            'GHS' => '&#162;',
                            'GIP' => '&#163;',
                            'GMD' => '&#68;', // ?
                            'GNF' => '&#70;&#71;', // ?
                            'GTQ' => '&#81;',
                            'GYD' => '&#36;',
                            'HKD' => '&#36;',
                            'HNL' => '&#76;',
                            'HRK' => '&#107;&#110;',
                            'HTG' => '&#71;', // ?
                            'HUF' => '&#70;&#116;',
                            'IDR' => '&#82;&#112;',
                            'ILS' => '&#8362;',
                            'INR' => '&#8377;',
                            'IQD' => '&#1593;.&#1583;', // ?
                            'IRR' => '&#65020;',
                            'ISK' => '&#107;&#114;',
                            'JEP' => '&#163;',
                            'JMD' => '&#74;&#36;',
                            'JOD' => '&#74;&#68;', // ?
                            'JPY' => '&#165;',
                            'KES' => '&#75;&#83;&#104;', // ?
                            'KGS' => '&#1083;&#1074;',
                            'KHR' => '&#6107;',
                            'KMF' => '&#67;&#70;', // ?
                            'KPW' => '&#8361;',
                            'KRW' => '&#8361;',
                            'KWD' => '&#1583;.&#1603;', // ?
                            'KYD' => '&#36;',
                            'KZT' => '&#1083;&#1074;',
                            'LAK' => '&#8365;',
                            'LBP' => '&#163;',
                            'LKR' => '&#8360;',
                            'LRD' => '&#36;',
                            'LSL' => '&#76;', // ?
                            'LTL' => '&#76;&#116;',
                            'LVL' => '&#76;&#115;',
                            'LYD' => '&#1604;.&#1583;', // ?
                            'MAD' => '&#1583;.&#1605;.', //?
                            'MDL' => '&#76;',
                            'MGA' => '&#65;&#114;', // ?
                            'MKD' => '&#1076;&#1077;&#1085;',
                            'MMK' => '&#75;',
                            'MNT' => '&#8366;',
                            'MOP' => '&#77;&#79;&#80;&#36;', // ?
                            'MRO' => '&#85;&#77;', // ?
                            'MUR' => '&#8360;', // ?
                            'MVR' => '.&#1923;', // ?
                            'MWK' => '&#77;&#75;',
                            'MXN' => '&#36;',
                            'MYR' => '&#82;&#77;',
                            'MZN' => '&#77;&#84;',
                            'NAD' => '&#36;',
                            'NGN' => '&#8358;',
                            'NIO' => '&#67;&#36;',
                            'NOK' => '&#107;&#114;',
                            'NPR' => '&#8360;',
                            'NZD' => '&#36;',
                            'OMR' => '&#65020;',
                            'PAB' => '&#66;&#47;&#46;',
                            'PEN' => '&#83;&#47;&#46;',
                            'PGK' => '&#75;', // ?
                            'PHP' => '&#8369;',
                            'PKR' => '&#8360;',
                            'PLN' => '&#122;&#322;',
                            'PYG' => '&#71;&#115;',
                            'QAR' => '&#65020;',
                            'RON' => '&#108;&#101;&#105;',
                            'RSD' => '&#1044;&#1080;&#1085;&#46;',
                            'RUB' => '&#1088;&#1091;&#1073;',
                            'RWF' => '&#1585;.&#1587;',
                            'SAR' => '&#65020;',
                            'SBD' => '&#36;',
                            'SCR' => '&#8360;',
                            'SDG' => '&#163;', // ?
                            'SEK' => '&#107;&#114;',
                            'SGD' => '&#36;',
                            'SHP' => '&#163;',
                            'SLL' => '&#76;&#101;', // ?
                            'SOS' => '&#83;',
                            'SRD' => '&#36;',
                            'STD' => '&#68;&#98;', // ?
                            'SVC' => '&#36;',
                            'SYP' => '&#163;',
                            'SZL' => '&#76;', // ?
                            'THB' => '&#3647;',
                            'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
                            'TMT' => '&#109;',
                            'TND' => '&#1583;.&#1578;',
                            'TOP' => '&#84;&#36;',
                            'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
                            'TTD' => '&#36;',
                            'TWD' => '&#78;&#84;&#36;',
                            'TZS' => '',
                            'UAH' => '&#8372;',
                            'UGX' => '&#85;&#83;&#104;',
                            'USD' => '&#36;',
                            'UYU' => '&#36;&#85;',
                            'UZS' => '&#1083;&#1074;',
                            'VEF' => '&#66;&#115;',
                            'VND' => '&#8363;',
                            'VUV' => '&#86;&#84;',
                            'WST' => '&#87;&#83;&#36;',
                            'XAF' => '&#70;&#67;&#70;&#65;',
                            'XCD' => '&#36;',
                            'XDR' => '',
                            'XOF' => '',
                            'XPF' => '&#70;',
                            'YER' => '&#65020;',
                            'ZAR' => '&#82;',
                            'ZMK' => '&#90;&#75;', // ?
                            'ZWL' => '&#90;&#36;',
                        );
            
            $currency_html_code=$currency_symbols[$code];

            return $currency_html_code;
    }

}

if (! function_exists('getCurrencyList')) {
    function getCurrencyList()
    {                   
            // count 164
            $currency_list = array(
                "AFA" => "Afghan Afghani",
                "ALL" => "Albanian Lek",
                "DZD" => "Algerian Dinar",
                "AOA" => "Angolan Kwanza",
                "ARS" => "Argentine Peso",
                "AMD" => "Armenian Dram",
                "AWG" => "Aruban Florin",
                "AUD" => "Australian Dollar",
                "AZN" => "Azerbaijani Manat",
                "BSD" => "Bahamian Dollar",
                "BHD" => "Bahraini Dinar",
                "BDT" => "Bangladeshi Taka",
                "BBD" => "Barbadian Dollar",
                "BYR" => "Belarusian Ruble",
                "BEF" => "Belgian Franc",
                "BZD" => "Belize Dollar",
                "BMD" => "Bermudan Dollar",
                "BTN" => "Bhutanese Ngultrum",
                "BTC" => "Bitcoin",
                "BOB" => "Bolivian Boliviano",
                "BAM" => "Bosnia",
                "BWP" => "Botswanan Pula",
                "BRL" => "Brazilian Real",
                "GBP" => "British Pound Sterling",
                "BND" => "Brunei Dollar",
                "BGN" => "Bulgarian Lev",
                "BIF" => "Burundian Franc",
                "KHR" => "Cambodian Riel",
                "CAD" => "Canadian Dollar",
                "CVE" => "Cape Verdean Escudo",
                "KYD" => "Cayman Islands Dollar",
                "XOF" => "CFA Franc BCEAO",
                "XAF" => "CFA Franc BEAC",
                "XPF" => "CFP Franc",
                "CLP" => "Chilean Peso",
                "CNY" => "Chinese Yuan",
                "COP" => "Colombian Peso",
                "KMF" => "Comorian Franc",
                "CDF" => "Congolese Franc",
                "CRC" => "Costa Rican ColÃ³n",
                "HRK" => "Croatian Kuna",
                "CUC" => "Cuban Convertible Peso",
                "CZK" => "Czech Republic Koruna",
                "DKK" => "Danish Krone",
                "DJF" => "Djiboutian Franc",
                "DOP" => "Dominican Peso",
                "XCD" => "East Caribbean Dollar",
                "EGP" => "Egyptian Pound",
                "ERN" => "Eritrean Nakfa",
                "EEK" => "Estonian Kroon",
                "ETB" => "Ethiopian Birr",
                "EUR" => "Euro",
                "FKP" => "Falkland Islands Pound",
                "FJD" => "Fijian Dollar",
                "GMD" => "Gambian Dalasi",
                "GEL" => "Georgian Lari",
                "DEM" => "German Mark",
                "GHS" => "Ghanaian Cedi",
                "GIP" => "Gibraltar Pound",
                "GRD" => "Greek Drachma",
                "GTQ" => "Guatemalan Quetzal",
                "GNF" => "Guinean Franc",
                "GYD" => "Guyanaese Dollar",
                "HTG" => "Haitian Gourde",
                "HNL" => "Honduran Lempira",
                "HKD" => "Hong Kong Dollar",
                "HUF" => "Hungarian Forint",
                "ISK" => "Icelandic KrÃ³na",
                "INR" => "Indian Rupee",
                "IDR" => "Indonesian Rupiah",
                "IRR" => "Iranian Rial",
                "IQD" => "Iraqi Dinar",
                "ILS" => "Israeli New Sheqel",
                "ITL" => "Italian Lira",
                "JMD" => "Jamaican Dollar",
                "JPY" => "Japanese Yen",
                "JOD" => "Jordanian Dinar",
                "KZT" => "Kazakhstani Tenge",
                "KES" => "Kenyan Shilling",
                "KWD" => "Kuwaiti Dinar",
                "KGS" => "Kyrgystani Som",
                "LAK" => "Laotian Kip",
                "LVL" => "Latvian Lats",
                "LBP" => "Lebanese Pound",
                "LSL" => "Lesotho Loti",
                "LRD" => "Liberian Dollar",
                "LYD" => "Libyan Dinar",
                "LTL" => "Lithuanian Litas",
                "MOP" => "Macanese Pataca",
                "MKD" => "Macedonian Denar",
                "MGA" => "Malagasy Ariary",
                "MWK" => "Malawian Kwacha",
                "MYR" => "Malaysian Ringgit",
                "MVR" => "Maldivian Rufiyaa",
                "MRO" => "Mauritanian Ouguiya",
                "MUR" => "Mauritian Rupee",
                "MXN" => "Mexican Peso",
                "MDL" => "Moldovan Leu",
                "MNT" => "Mongolian Tugrik",
                "MAD" => "Moroccan Dirham",
                "MZM" => "Mozambican Metical",
                "MMK" => "Myanmar Kyat",
                "NAD" => "Namibian Dollar",
                "NPR" => "Nepalese Rupee",
                "ANG" => "Netherlands Antillean Guilder",
                "TWD" => "New Taiwan Dollar",
                "NZD" => "New Zealand Dollar",
                "NIO" => "Nicaraguan CÃ³rdoba",
                "NGN" => "Nigerian Naira",
                "KPW" => "North Korean Won",
                "NOK" => "Norwegian Krone",
                "OMR" => "Omani Rial",
                "PKR" => "Pakistani Rupee",
                "PAB" => "Panamanian Balboa",
                "PGK" => "Papua New Guinean Kina",
                "PYG" => "Paraguayan Guarani",
                "PEN" => "Peruvian Nuevo Sol",
                "PHP" => "Philippine Peso",
                "PLN" => "Polish Zloty",
                "QAR" => "Qatari Rial",
                "RON" => "Romanian Leu",
                "RUB" => "Russian Ruble",
                "RWF" => "Rwandan Franc",
                "SVC" => "Salvadoran ColÃ³n",
                "WST" => "Samoan Tala",
                "SAR" => "Saudi Riyal",
                "RSD" => "Serbian Dinar",
                "SCR" => "Seychellois Rupee",
                "SLL" => "Sierra Leonean Leone",
                "SGD" => "Singapore Dollar",
                "SKK" => "Slovak Koruna",
                "SBD" => "Solomon Islands Dollar",
                "SOS" => "Somali Shilling",
                "ZAR" => "South African Rand",
                "KRW" => "South Korean Won",
                "XDR" => "Special Drawing Rights",
                "LKR" => "Sri Lankan Rupee",
                "SHP" => "St. Helena Pound",
                "SDG" => "Sudanese Pound",
                "SRD" => "Surinamese Dollar",
                "SZL" => "Swazi Lilangeni",
                "SEK" => "Swedish Krona",
                "CHF" => "Swiss Franc",
                "SYP" => "Syrian Pound",
                "STD" => "São Tomé and Príncipe Dobra",
                "TJS" => "Tajikistani Somoni",
                "TZS" => "Tanzanian Shilling",
                "THB" => "Thai Baht",
                "TOP" => "Tongan pa'anga",
                "TTD" => "Trinidad & Tobago Dollar",
                "TND" => "Tunisian Dinar",
                "TRY" => "Turkish Lira",
                "TMT" => "Turkmenistani Manat",
                "UGX" => "Ugandan Shilling",
                "UAH" => "Ukrainian Hryvnia",
                "AED" => "United Arab Emirates Dirham",
                "UYU" => "Uruguayan Peso",
                "USD" => "US Dollar",
                "UZS" => "Uzbekistan Som",
                "VUV" => "Vanuatu Vatu",
                "VEF" => "Venezuelan BolÃvar",
                "VND" => "Vietnamese Dong",
                "YER" => "Yemeni Rial",
                "ZMK" => "Zambian Kwacha"
            );
 

            return $currency_list;
    }

}


 