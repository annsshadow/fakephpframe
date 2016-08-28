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
