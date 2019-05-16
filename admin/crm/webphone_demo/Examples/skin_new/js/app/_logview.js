define(["jquery","common","stringres","global"],function(f,i,a,b){function e(n){try{i.PutToDebugLog(4,"_logview: onCreate");f(window).resize(function(){if(f.mobile.activePage.attr("id")==="page_logview"){c()}});f("#logview_menu_ul").on("click","li",function(o){g(f(this).attr("id"))});f("#btn_logview_menu").on("click",function(){l("#logview_menu_ul")});f("#btn_logview_menu").attr("title",a.get("hint_menu"));f("#support_selectall").on("click",function(){f("#log_text").select()});f("#btn_loghelp").on("click",function(){i.AlertDialog(a.get("help"),a.get("logview_help")+" "+a.get("support_email"))})}catch(m){i.PutToDebugLogException(2,"_logview: onCreate",m)}}function k(p){try{i.PutToDebugLog(4,"_logview: onStart");b.isLogviewStarted=true;if(!i.isNull(document.getElementById("logview_title"))){document.getElementById("logview_title").innerHTML=a.get("logview_title")}if(!i.isNull(document.getElementById("logview_btnback"))){document.getElementById("logview_btnback").innerHTML="<span>&LT;</span>&nbsp;"+a.get("go_back_btn_txt")}f(".separator_line_thick").css("background-color",i.HoverCalc(i.getBgColor("#logview_header"),-30));c();var n=a.get("support_email");if(!i.isNull(n)&&n.length>2){if(!i.isNull(document.getElementById("sendtosupport"))){document.getElementById("sendtosupport").innerHTML=a.get("sendtosupport")}if(!i.isNull(document.getElementById("support_selectall"))){document.getElementById("support_selectall").innerHTML=a.get("support_selectall")}var m="mailto:"+i.Trim(n)+"?subject="+encodeURIComponent("JSPhone Log")+"&body="+a.get("support_email_body");f("#sendtosupport").attr("href",m)}else{f("#sendtosupport_container").hide()}f("#log_text").html(b.logs)}catch(o){i.PutToDebugLogException(2,"_logview: onStart",o)}}function c(){try{f("#page_logview_content").height(i.GetDeviceHeight()-f("#logview_header").height()-2);f("#log_text").height(i.GetDeviceHeight()-f("#logview_header").height()-f("#sendtosupport_container").height()-5);f("#log_text").width(i.GetDeviceWidth())}catch(m){i.PutToDebugLogException(2,"_logview: MeasureLogview",m)}}var d="#menuitem_logview_close";function l(n){try{if(i.GetParameter("devicetype")===i.DEVICE_WIN_SOFTPHONE()){f("#btn_logview_menu").removeAttr("data-transition")}if(i.isNull(n)||n.lenght<1){i.PutToDebugLog(2,"ERROR, _logview: CreateOptionsMenu menuid null");return}if(f(n).length<=0){i.PutToDebugLog(2,"ERROR, _logview: CreateOptionsMenu can't get reference to Menu");return}if(n.charAt(0)!=="#"){n="#"+n}f(n).html("");f(n).append('<li id="'+d+'"><a data-rel="back">'+a.get("menu_close")+"</a></li>").listview("refresh");return true}catch(m){i.PutToDebugLogException(2,"_logview: CreateOptionsMenu",m)}return false}function g(n){try{if(i.isNull(n)||n.length<1){return}f("#logview_menu").on("popupafterclose",function(o){f("#logview_menu").off("popupafterclose");switch(n){case d:f.mobile.back();break}})}catch(m){i.PutToDebugLogException(2,"_logview: MenuItemSelected",m)}}function h(n){try{i.PutToDebugLog(4,"_logview: onStop");b.isLogviewStarted=false;f("#log_text").html("")}catch(m){i.PutToDebugLogException(2,"_logview: onStop",m)}}function j(n){try{i.PutToDebugLog(4,"_logview: onDestroy");b.isLogviewStarted=false}catch(m){i.PutToDebugLogException(2,"_logview: onDestroy",m)}}return{onCreate:e,onStart:k,onStop:h,onDestroy:j}});