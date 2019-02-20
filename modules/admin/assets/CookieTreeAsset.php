<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class CookieTreeAsset extends AssetBundle
{


    public static function register($view)
    {
        $view->registerJs('
            var cookiesCurrent = getCookie("treeCookie");
            var massCooks = checkSameCookie(cookiesCurrent);
            checkSameCookie(cookiesCurrent).filter(Boolean);
            var tmp = false;
        
            for(var i =0; i <= massCooks.length; i++){
              var currentParentLi = $(\'#treeViewId-wrapper\').find(\'[data-key="\'+parseInt(massCooks[i])+\'"]\');
              var currentSubLi = currentParentLi.find("ul");
              var toggleClick = currentParentLi.find(".kv-node-indicators");
        
                toggleClick.click(function(){
                    var parent = $(this).parent().parent();
                    var sub = parent.find("ul");
                    sub.removeClass("hiddenSub");
                    currentParentLi.removeClass("kv-collapsed");
                });
                currentParentLi.addClass("kv-collapsed");
                currentSubLi.addClass("hiddenSub");
            }
        
            $(".kv-node-indicators").click(function(){
                 var parentCategory = $(this).parent().parent();
                 var parentDataId = 0;
                 parentDataId = parentCategory.data(\'key\');
                 var subCategories = parentCategory.find("ul");
        
                 if(parentCategory.hasClass("kv-collapsed")){
                    console.log("Закритий");
                    subCategories.removeClass("visibleSub");
                    //subCategories.addClass("hiddenSub");
                    var getCooks = getCookie("treeCookie");
                      if(getCooks == ""){
                            console.log("пустое");
                            console.log(getCooks);
                            getCooks = "";
                      }else{
                        getCooks = getCooks+",";
                      }
                    setCookie("treeCookie", getCooks+parentDataId+"-hiddenSub", 30);
                    var getFirstCooks = getCookie("treeCookie");
                 }else{
                    console.log("Откритий");
                    subCategories.removeClass("hiddenSub");
                    subCategories.addClass("visibleSub");
                    var cooks = getCookie("treeCookie");
                    setCookie("treeCookie", deleteCookie(cooks,parentDataId), 30);
                 }
        
            });
        
            function deleteCookie(cooks,idDelete){
                var cookieMass = checkSameCookie(cooks);
                var result = [];
                for(var i =1; i <= cookieMass.length; i++){
                    if(parseInt(cookieMass[i]) != idDelete){
                       if (cookieMass[i]) result[i] = cookieMass[i];
                    }
                }
                result = result.filter(Boolean);
        
                return result.join(",");
            }
            function checkSameCookie(currentCookie){
        
                return unique(currentCookie.split(","));
            }
        
            function unique(A)
            {
                var n = A.length, k = 0, B = [];
                for (var i = 0; i < n; i++)
                 { var j = 0;
                   while (j < k && B[j] !== A[i]) j++;
                   if (j == k) B[k++] = A[i];
                 }
                return B;
            }
        
            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
        
            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(\';\');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == \' \') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";    
            }
    ', \yii\web\View::POS_READY);

        return parent::register($view);
    }
}