<?php
function get_url_string($name)
{
    $value = filter_input(INPUT_GET, $name, FILTER_SANITIZE_URL);
    if ($value) {
        return $value;
    } else {
        return null;
    }
}

/*
//nginx setting
server {
    listen       80;
    server_name mvc.myf.cn;
    root /Users/minyifei/myf/mvc;
    index index.php index.html index.htm;

    #to handle false stastic URL request
    location / {
        if (!-e $request_filename) {
            rewrite  ^(.*)$  /index.php?_urlinfo=$1  last;
            break;
        }
    }
    location ~ \.php$ {
        include /usr/local/etc/nginx/fastcgi.conf;
        fastcgi_intercept_errors on;
        fastcgi_pass   127.0.0.1:9000;
    }

}
*/


function get_mvc_route(){
    //get controller
    $ctrl = get_url_string("ctrl");
    //get action method
    $act = getUrlString("act");
    //if nginx has rewrite the URL
    $urlinfo = getUrlString("_urlinfo");
    if(!empty($urlinfo)){
        $s = trim(str_replace("/", " ", $urlinfo));
        $urls = explode(" ", $urlinfo);
        if (isset($urls[0])) {
            $ctrl = $urls[0];
        }
        if (isset($urls[1])) {
            $act = $urls[1];
        }
    }
    //default action :index
    if(empty($act)){
        $act = "index";
    }
    //default controller index
    if(empty($ctrl)){
        $ctrl = "index";
    }
    //get params
    $route = array(
        "_a"=>$act,
        "_c"=>$ctrl,
    );
    //transform _c = 'ab_cd' to _c='AbCd'
    $name_arr = explode("_",$ctrl);
    for ($index = 0; $index < count($name_arr); $index++) {
        $name_arr[$index] = ucfirst($name_arr[$index]);
    }
    $ctrl_full_str = implode("",$name_arr);
    $route["act"]=$act;
    $route["ctrl"]=$ctrl;
    return $route;
}
