<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style type="text/css" media="all">
    div#logout /* 退出包含框样式 */ {
        width:400px;
        padding: 10px;
        margin:0 auto;
        z-index: 0;
        min-height: 1px;
        min-width: 1px;
        _height: 100%;
        background: #F6F6F6;
        -moz-user-select: none;
        -webkit-user-select: none;
        -o-user-select:none;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        -o-border-radius:10px;
        -ms-border-radius:10px;
        border-radius: 10px;
        -moz-box-shadow: 0 0 8px #000;
        -webkit-box-shadow: 0 0 8px #000;
        -o-box-shadow: 0 0 8px #000;
        -ms-box-shadow: 0 0 8px #000;
        box-shadow: 0 0 8px #000;
    }
    </style>

</head>
<body>
    <div style="height:150px;"></div>
    <div id="logout">
        <div class="message">
            <table class="message" cellpadding=0 cellspacing=0>
                <tr>
                    <td height='5' class="topTd"></td>
                </tr>
                <?php if(($jumpUrl) != "showmsg"): ?><tr class="row">
                        <th class="tCenter space"><?php echo ($msgTitle); ?></th>
                    </tr><?php endif; ?>
                <?php if(isset($message)): ?><tr class="row">
                    <td style="color: blue"><?php echo ($message); ?></td>
                </tr><?php endif; ?>
                <?php if(isset($error)): ?><tr class="row">
                    <td style="color: red"><?php echo ($error); ?></td>
                </tr><?php endif; ?>
                
                <?php if(($jumpUrl) != "showmsg"): if(isset($closeWin)): ?><tr class="row">
                        <td>系统将在 <span id='num' style="color: blue; font-weight: bold"><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待,直接点击 <a href="<?php echo ($jumpUrl); ?>" class="goToNext">这里</a> 关闭
                        </td>
                    </tr><?php endif; ?>
                    <?php if(!isset($closeWin)): ?><tr class="row">
                        <td>系统将在 <span id='num' style="color: blue; font-weight: bold"><?php echo ($waitSecond); ?></span> 秒后自动跳转,如果不想等待,直接点击 <a href="<?php echo ($jumpUrl); ?>" class="goToNext">这里</a> 跳转
                        </td>
                    </tr><?php endif; endif; ?>
                <tr>
                    <td height='5' class="bottomTd"></td>
                </tr>
            </table>
        </div>

    </div>
    <!-- 为自动调整弹出框大小，和 其他页面保持一致，需要有个.cen_bot的元素作为判断弹出框应该多大的依据 -->
    <div class="cen_bot" style="height: 2px;"></div>
    
    <script type="text/javascript" src="/static/js/js/jquery-1.8.3.min.js"></script>

    <script type="text/javascript" charset="utf-8">
    var count   = 0;

    $(document).ready(function() { 
        function gotoUrl(){
             count--;  
             if(count > 0) {
                 $('#num').html(count);
                 window.setTimeout(gotoUrl, 1000);
             } else {
                if(jumpUrl.length<1){
                    history.back(-1);
                }
                
                if($(window.frameElement).hasClass(iframe_class)){
                    //当前页面在弹出框中
                    //如果操作成功，直接关闭弹出框即可，如果失败，返回原页面
                    if(error.length>0){
                        //操作失败
                        //弹出框中隐藏跳转的中文提示
                        if(jumpUrl.indexOf('history')==-1){
                            setTimeout(function(){location.href=jumpUrl;},3000); //指定3秒刷新一次
                        }
                        else{
                            setTimeout('history.back();',3000); //指定3秒刷新一次 
                        }
                    }
                    if(message.length>0){
                        
                        //调用iframe上的方法，关闭当前弹出框
                        //调整弹出框大小到合适大小
                        if(jumpUrl.length>0){
                            location.href=jumpUrl;
                        }
                    }
                }else if(($.browser.msie && self.frameElement && self.frameElement.tagName=="IFRAME") || (!$.browser.msie && top!=this)){
                    //是否在frame中，session过期，则要跳转_top
                    top.href        = jumpUrl;
                }else{
                    document.location.href      = jumpUrl; //当前窗口的最外层进行跳转
                }
             }
        }

        function jump(countS) {
            //如果count无值的话，需要有个默认值，避免循环调整
            if(isNaN(countS)){
                count   = 3;
            }else{
                count   = countS;
            }
            
            window.setTimeout(gotoUrl, 1000);
        }
        
        //如果当前页面是ymprompt弹出页面即在指定iframe中，则关闭弹出框，并刷新原列表页面，如果不是则不做处理
        var iframe_class='ympop_iframe_class';
        var jumpUrl="<?php echo ($jumpUrl); ?>";
        var error="<?php echo ($error); ?>";//错误信息
        var message="<?php echo ($message); ?>";//成功信息
        if(jumpUrl!="showmsg") jump(<?php echo ($waitSecond); ?>);
    });
    </script>
</body>
</html>