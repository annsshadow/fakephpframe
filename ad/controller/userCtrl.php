<?php

/*
# support url sub-directory rewrite Nginx setting
 location /admin/ {
     if (!-e $request_filename) {
         rewrite  ^/ad/(.*)$  /ad/index.php?_urlinfo=$1  last;
         break;
     }
 }
*/

class IndexCtrl extends Controller{

    public function index(){
        echo "ad-userCtrl-index";
    }

    public function hello(){
        echo "hello world from IndexCtrl-hello";
    }
}
