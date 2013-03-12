<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    <meta http-quiv="Content-Type" charset=utf-8 />
    <title>在这里，约见你</title>
    <link rel="stylesheet" type="text/css" href="../styles/base.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../styles/datepicker.css" media="screen"/>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
    <!--<link rel="stylesheet" type="text/css" href="../styles/hua.css" media="screen"/>-->
    <script src="../scripts/lib/modernizr-transitions.js"></script>
    <script type="text/javascript" src="../scripts/lib/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="../scripts/lib/autoresize.jquery.js"></script>
    <script type="text/javascript" src="../scripts/lib/datepicker.js" charset="utf-8"></script>
    <script src="../scripts/lib/jquery.masonry.min.js"></script>
    <script src="../scripts/function/base.js" type="text/javascript"></script>
  </head>
    <body>
        <?php include "../inc/auth.php"; ?>
        <?php include 'headlogo.php'; ?>
        <div id="messagebar">
            <div class="bardiv" id="dialog"><a href=#></a><div class="bartit_grn"><span>99</span></div></div>
            <div class="bardiv" id="message"><a href=#></a><div class="bartit_grn"><span>1</span></div></div>
        </div>
        <div id="include">       
            <div id="ext_contant">  
                <div class="ext_left">
                    <ul>
                        <li><div class="extitem ext_a_cur"><a href="javascript:tabchange('ext_mail');"><span>邮件</span></a></div></li>
                        <li><div class="extitem"><a href="javascript:tabchange('ext_meeted');"><span>见过的人</span></a></div></li>
                        <li><div class="extitem"><a href="javascript:tabchange('ext_options');"><span>账号设置</span></a></div></li>
                        <li><div class="extitem"><a href="javascript:tabchange('ext_about');"><span>关于约见</span></a></div></li>
                    </ul>
                </div>
                <div class="ext_right">
                    <div class="ext_cont ext_mail ext_div_cur">
                        
                        <div style="height:27px;border-bottom: 1px #998989 solid;width:100%;">
                            <ul class="ext_cont_mu">
                            <li><a href="javascript:m_tabchange('ext_mail_site');"><div class="ext_mail_cur">站内通知</div></a></li>
                            <li><a href="javascript:m_tabchange('ext_mail_meet');"><div>约见通知</div></a></li>
<!--                             <li><a href="javascript:m_tabchange('ext_mail_wait1');"><div>待定</div></a></li>
                            <li><a href="javascript:m_tabchange('ext_mail_wait2');"><div>待定</div></a></li>
                            <li><a href="javascript:m_tabchange('ext_mail_wait3');"><div>待定</div></a></li> -->
                        </ul>
                        </div>
                        <div class="ext_mail_div ext_mail_site ext_mail_div_cur">
                            <ul>
                                <li style="margin-bottom:20px;margin-top:0px;"><a class="checkbox  main_check act" href="javascript:;"></a>&nbsp;全选&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">删除</a></li>
                                <!-- <li>
                                    <a class="checkbox" href="javascript:;"></a>&nbsp;&nbsp;<a class="main_name" href="javascript:;">李开复</a>&nbsp;&nbsp;给您留言了&nbsp;&nbsp;2012/09/06&nbsp;&nbsp;12:30&nbsp;&nbsp;&nbsp;&nbsp;【<a href="detail.php">查看</a>】
                                </li> -->
                            </ul>
                            <div class="ext_mail_foot">
                                <a class="checkbox  main_check act" href="javascript:;"></a>&nbsp;全选&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">删除</a>
                                <div style="border-bottom: 1px #998989 solid;width:100%;height:1px;"></div>
                                <div class="pagecontrol">
                                    <ul>
                                        <li><a href="javascript:;">上一页</a></li>
                                        <li>|</li>
                                        <li><a href="javascript:;">下一页</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ext_mail_div ext_mail_meet">
                            <br />
                            <p>尊敬的&nbsp;<span class="red">雷军</span>&nbsp;先生:</p><br />
                            <p>您所发布的&nbsp;<span class="red">2012年12月20日</span>&nbsp;约见需求结果，已从&nbsp;<span class="red">123456</span>&nbsp;名竞拍者中产生！</p>
                            <div class="ext_mail_meet_cont">
                                <div class="left_meet_cont"></div>
                                <div class="mid_meet_cont">
                                    <div class="mid_meet_cont_left">
                                        <img src="../images/leijunlit.png" />
                                        <div class="meet_name meet_name_man">
                                            <span>雷小明</span>
                                        </div>
                                    </div>  
                                    <div class="mid_meet_cont_right">
                                        <div class="meet_shad"></div>
                                        <p>尊敬的雷军先生:</p>
                                        <div style="border-bottom: 1px #998989 solid;width:166px;height:1px;margin:8px 0 0 10px;"></div>
                                        <div class="meet_word">
                                            <p>我很想和您见面第一次我很想和您见面第一次我很想和您见面第一次我很想和您见面第一次</p>
                                        </div>
                                        <div class="meet_price"><span>出价：￥5000</span></div>
                                    </div>
                                </div>
                                <div class="right_meet_cont"></div>
                            </div>
                            <div class="meet_side">
                                <p>约见.me</p>
                                <p>2012/12/19</p>
                            </div>
                            <div class="ext_mail_foot" style="margin-top:20px;">
                                <div style="border-bottom: 1px #998989 solid;width:100%;height:1px;"></div>
                                <div class="pagecontrol" style="margin-top:10px;">
                                    <ul>
                                        <li><a href="javascript:;">上一页</a></li>
                                        <li>|</li>
                                        <li><a href="javascript:;">下一页</a></li>
                                    </ul>
                                </div>
                                <div id="yuejian_page">1/81</div>
                            </div>
                        </div>
                        <!--<div class="ext_mail_div ext_mail_wait1">3</div>
                        <div class="ext_mail_div ext_mail_wait2">4</div>
                        <div class="ext_mail_div ext_mail_wait3">5</div> -->
                    </div>
                    <div class="ext_cont ext_meeted">
                        <div class="carelist">
                            <div class="tit_hed"></div>
                            <span class="contanttitle" style="margin-left:5px;">我见过的人......<a href="javascript:;" style="color:#494848;font-size:1em;" onclick="yj_ext.queryCareUser('');">查看全部</a></span>
                            <div class="carelistin" style="width:630px;">
                                <ul>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        <a href="detail.php"><img src="../images/testlkf.png"></a>
                                        <br />
                                        <a href="detail.php">李开复</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> 
                    </div> 
                    <div class="ext_cont ext_about">
                        <p class="abouttitle">什么是约见</p>
                        <p>生活中，我们并不总能幸运地遇到对的人，但是我们渴望，有一个绝佳的合作伙伴，一个领进门的行业导师或是一个能帮助自己的人。</p>
                        <p>在约见，你可以找到k歌高手、篮球达人、设计大师甚至是曾经梦想见到的企业家、体育明星、歌唱家等等。</p>
                        <p>我们相信，在他们身上，必然有值得学习的地方，</p>
                        <p>我们坚信，面对面，你会得到更多。</p>
                        <p>告别虚拟的网络平台，约见吧！</p>  
                        <p class="abouttitle" style="margin-top:50px;">联系我们</p>
                        <p>电子邮箱：yuejian@sina.com</p>
                        <p>新浪微博：@约见网</p>
                        <p>官方QQ：1234567</p>
                        <p>违规信息举报QQ：1234567</p>
                        <p>联系地址：北京市海淀区西外大街168号 腾达大厦1503室 （邮编100044）</p>
                    </div> 
                    <div class="ext_cont ext_options">
                        <ul>
                            <li>用户名</li>
                            <li id="username">a@a.com</li>
                            <li></li>
                        </ul>
                        <ul style="height:78px;">
                            <li>头像</li>
                            <li id="headimg"><img src="../images/testlkf.png"></li>
                            <li><a href="javascript:;">修改</a></li>
                        </ul>
                        <ul>
                            <li>手机号码</li>
                            <li id="phone">13333333333</li>
                            <li><a href="javascript:;">修改</a></li>
                        </ul>
                        <ul>
                            <li>密码</li>
                            <li id="password"></li>
                            <li><a href="javascript:;">修改</a></li>
                        </ul>
                        <ul>
                            <li>银行卡号</li>
                            <li id="bankid">6220200222222222222</li>
                            <li><a href="javascript:;">修改</a></li>
                        </ul>
                        <!-- <div class="select_welfare"><a href="javascript:;"><div class="select_welfare_span"></div></a><a href="javascript:;" style="margin-left:0px;line-height: 22px;">约见收入始终用于公益事业</a></div>
                        <div class="select_subpro">
                            <ul>
                                <li style="width: 90px;"><a class="checkbox" href="javascript:;"></a><a href="javascript:;" onmouseover="openintro('1')" onmouseout="openintro('')">支持梦想</a></li>
                                <li><a class="checkbox" href="javascript:;"></a><a href="javascript:;" onclick="javascript:window.open('http://www.raleigh.org.cn');" onmouseover="openintro('2')" onmouseout="openintro('')">雷利基金</a></li>
                                <li><a class="checkbox" href="javascript:;"></a><a href="javascript:;" onmouseover="openintro('3')" onmouseout="openintro('')">西儿基金</a></li>
                                <li><a class="checkbox" href="javascript:;"></a><a href="javascript:;" onmouseover="openintro('4')" onmouseout="openintro('')">重病医疗</a></li>
                            </ul>
                        </div>
                        <div class="welfare_intro"></div> -->
                        <div class="savefoot">
                            <div style="border-bottom: 1px #998989 solid;width:90%;height:1px;"></div>
                            <div class="options_save_btn"><a href="javascript:;"><div></div></a></div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
<div id="flog"></div>
</body>
<script type="text/javascript" src="../scripts/pagejs/extpage.js"></script>
<script type="text/javascript" src="../scripts/pagejs/head.js"></script>
<script type="text/javascript" src="../scripts/function/ext.js"></script>
    <script type="text/javascript">
        datepicker.init();
    </script>
    <script>
        var type = <?php echo $_GET["type"]?>;
        if(type==1){
            tabchange(null,'ext_mail');
            $('.extitem').each(function(){$(this).removeClass('ext_a_cur')});
            $('.extitem:eq(0)').addClass('ext_a_cur');
        }else if(type==2){
            tabchange(null,'ext_options');
            $('.extitem').each(function(){$(this).removeClass('ext_a_cur')});
            $('.extitem:eq(2)').addClass('ext_a_cur');
        }else if(type==3){
            tabchange(null,'ext_about');
            $('.extitem').each(function(){$(this).removeClass('ext_a_cur')});
            $('.extitem:eq(3)').addClass('ext_a_cur');

        }
   </script>
</html>