<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test browser detection</title>
</head>
<body>


<script src="update.js"></script>
<script src="js/zepto.min.js"></script>
<style>
    body {
        font-family: sans-serif;
        font-size: 10px;
    }
    .red {
        background-color: rgb(255,200,200);
    }
    .green {
        background-color: rgb(200,255,200);
    }    
    td {
        border-bottom: 1px solid #aaa;
        
    }
    table {
        border-collapse: collapse;
        
    }
</style>
<table>
<?php

require '../lib/init.php';

$uas=[
    ["Current Browser",false,$_SERVER['HTTP_USER_AGENT']],
    ["FF 47","Firefox 47","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0"],
    ["Android 2.2","Android Browser mobile","Mozilla/5.0 (Linux; U; Android 2.2.1; en-us; Nexus One Build/FRG83) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1"],
    ["Blackberry 6+7",false,"Mozilla/5.0 (BlackBerry; U; BlackBerry AAAA; en-US) AppleWebKit/534.11+ (KHTML, like Gecko) Version/X.X.X.X Mobile Safari/534.11+"],
    ["Kindle",false,"Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/528.5+) Version/4.0 Kindle/3.0 (screen 600×800; rotate)"],
    ["iPad",false,"Mozilla/5.0 (iPad; U; CPU OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5"],
    ["iPhone",false,"Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5"],
    ["Chrome 41","Chrome 41","Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36"],
    ["IE 10","Internet Explorer 10","Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)"], 
    ["chrome frame",false,"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; chromeframe/13.0.782.215)"],
    ["IE 8","Internet Explorer 8","Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; Zune 3.0)"],
    ["IE 7","Internet Explorer 7","Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; SLCC2; .NET CLR 2.0.50727; InfoPath.3; .NET4.0C; .NET4.0E; .NET CLR 3.5.30729; .NET CLR 3.0.30729; MS-RTC LM 8)"],
    ["Galaxy S4 Chrome","Chrome 18 mobile","Mozilla/5.0 (Linux; Android 4.2.2; nl-nl; SAMSUNG GT-I9505 Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Version/1.0 Chrome/18.0.1025.308 Mobile Safari/535.19","Android 4.2"],
    ["Chrome 52","Chrome 52","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.3"],
    ["IE 10 in IE 7 mode","Internet Explorer 10","Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0)","Windows 7"],
    ["Android 4.1","Android Browser mobile","Mozilla/5.0 (Linux; U; Android 4.1.2; nl-nl; GT-I9300 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30"],
    ["IE 11","Internet Explorer 11","Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko","Windows 10"],
    ["IE 11 Compat","Internet Explorer 11","Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 10.0; WOW64; Trident/8.0; .NET4.0C; .NET4.0E)","Windows 10"],
    ["Edge","Edge 12.1","Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.10136","Windows 10"],
    ["Vivaldi","Vivaldi 1.02","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Safari/537.36 Vivaldi/1.2.465.1"],    
    ["Opera 15","Opera 15","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.52 Safari/537.36 OPR/15.0.1147.100","Windows 7"],
    ["Opera 36","Opera 36","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36 OPR/36.0.2130.59","Windows 7"],
    ["Chrome 53","Chrome 53","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36","MacOS 10.12"],
    ["IE 7","Internet Explorer 7","Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; WOW64; SLCC2; .NET CLR 2.0.50727; InfoPath.3; .NET4.0C; .NET4.0E; .NET CLR 3.5.30729; .NET CLR 3.0.30729; MS-RTC LM 8)", "winxp"],
    ["Chrome in Webview",false,"Mozilla/5.0 (Linux; Android 5.1.1; Nexus 5 Build/LMY48B; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/43.0.2357.65 Mobile Safari/537.36","Android 5.1"],
    ["","Firefox 37","Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:37.0) Gecko/20100101 Firefox/37.0","Ubuntu"],
    ["","Samsung Browser","Mozilla/5.0 (Linux; Android 5.0; SAMSUNG-SM-N900A Build/LRX21V) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/4.0 Chrome/44.0.2403.133 Mobile Safari/537.36","Android 5.0"],
    ["FF on Android","Firefox 26 mobile","Mozilla/5.0 (Android; Mobile; rv:26.0) Gecko/26.0 Firefox/26.0","Android ?"],
    ["Googlebot","","Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)",""],
    ["","Yandex Browser 13.12","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.12785 YaBrowser/13.12.1599.12785 Safari/537.36","Windows 7"],
    ["","Yandex Browser 16.07","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 YaBrowser/16.7.0.3342 Safari/537.36","Windows 10"],
    ["","Chrome 49","Mozilla/5.0 (Windows NT 5.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.1700.41 Safari/537.36","win xp"],
    ["","Firefox 51","Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:51.0) Gecko/20100101 Firefox/51.0","MacOS 10.12"],
    ["Firefox on iOS","iOS 8.3 mobile","Mozilla/5.0 (iPad; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) FxiOS/1.0 Mobile/12F69 Safari/600.1.4","iOS"],
    ["Chrome on iOS","iOS 10.3 mobile","Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) CriOS/56.0.2924.75 Mobile/14E5239e Safari/602.1","iOS"],
    ["Mobile Safari","iOS 10.3 mobile","Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/603.1.23 (KHTML, like Gecko) Version/10.0 Mobile/14E5239e Safari/602.1","iOS"],
    ["Chrome on iOS desktop mode","iOS desktop mode","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/600.7.12 (KHTML, like Gecko) Version/8.0.7 Safari/600.7.12","iOS"],
    ["Android Webview Old","Webview","Mozilla/5.0 (Linux; U; Android 4.1.1; en-gb; Build/KLP) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30","Android 4.1"],    
    ["Android Webview >K","Webview","Mozilla/5.0 (Linux; Android 4.4; Nexus 5 Build/_BuildID_) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36","Android 4.4"],
    ["Android Webview >L","Webview","Mozilla/5.0 (Linux; Android 5.1.1; Nexus 5 Build/LMY48B; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/43.0.2357.65 Mobile Safari/537.36","Android 5.1"],
    ["","iOS 9.1 mobile","Mozilla/5.0 (iPad; CPU OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1","iOS 9"],
    ["","Vivaldi 1.09","Mozilla/5.0 (Windows NT 6.1; win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.82 Safari/537.36 vivaldi/1.9.818.44"," Windows 7"],
    ["","Chrome 58","Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36","Windows 10"],
    ["","Edge 14.1","Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36 Edge/14.14332","Windows 10"],
    ["","Vivaldi 1.10","Mozilla/5.0 (Windows NT 6.1; win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.82 Safari/537.36 vivaldi/1.10.818.44"," Windows 7"],
    ["","Vivaldi 1.06","Mozilla/5.0 (Windows NT 6.1; win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.82 Safari/537.36 vivaldi/1.6.818.44"," Windows 7"],
    ["","Yandex Browser 17.04","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 YaBrowser/17.4.0.3342 Safari/537.36","Windows 10"],    
    ["","UC Browser 11.03 mobile","Mozilla/5.0 (Linux; U; Android 7.0; zh-CN; HUAWEI NXT-DL00 Build/HUAWEINXT-DL00) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/40.0.2214.89 UCBrowser/11.3.0.907 Mobile Safari/537.36","Android 7.0"],
    ["","UC Browser 9.09 mobile","Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; iris 352E Build/JDQ39) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.9.2.467 U3/0.8.0 Mobile Safari/533.1","Android 4.2.2"],
    ["","","",""]
];

foreach ($uas as $ua) {
    $uastr=$ua[2];
    $nua=(normalize_ua($uastr));
    $bx_=get_browserx($nua);
    $browid=$bx_[0];
    $brown=$bx_[1];
    $browver=$bx_[2];

    $sysx=get_system($nua);
    $sys=$sysx[0];
    $ver=$sysx[1];
    $sysn=$sysx[2];   
    
    echo '<tr><td>'.$ua[0].'</td><td>'.$ua[1].'</td><td>'.$browid.' '.$brown.' '.$browver.'</td><td>'.(is_outdated($nua)?'':'up-to-date').'</td><td>'.$uastr.'</td></tr>';
}

?>
</table>