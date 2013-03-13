<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
    <meta http-quiv="Content-Type" charset=utf-8 />
    <title>在这里，约见你</title>
    <link rel="stylesheet" type="text/css" href="__CSS__/base.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/datepicker.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery.Jcrop.min.css" media="screen"/>
    <link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon" />
    <!--<link rel="stylesheet" type="text/css" href="../styles/hua.css" media="screen"/>-->
    <script src="__JS__/lib/modernizr-transitions.js"></script>
    <script type="text/javascript" src="__JS__/lib/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="__JS__/lib/autoresize.jquery.js"></script>
    <script type="text/javascript" src="__JS__/lib/datepicker.js" charset="utf-8"></script>
    <script src="__JS__/lib/jquery.masonry.min.js"></script>
    <script src="__JS__/function/base.js" type="text/javascript"></script>
    <script type="text/javascript" src="__JS__/lib/ajaxfileupload.js"></script>
    <script type="text/javascript" src="__JS__/lib/jquery.Jcrop.min.js"></script>

  </head>
    <body>
    <script type="text/javascript">
    var user,group;
    user = "<?php echo ($uid); ?>";
    group = "<?php echo ($group); ?>";
    if(group == ''){
        $('#footer,#messagebar').remove();
    }else{
        var ii = parseInt(group);
        switch(ii){
            case 0:
                $('#footer,#messagebar').remove();
                break;
            case 1: //管理员登陆
                yj_base.uid = user;
                yj_base.group = 'admin';
                break;
            case 2: //买家登陆
                yj_base.uid = user;
                yj_base.group = 'guest';
                // yj_sidebar.init(user);
                $('#footer').remove();
                break;
            case 3: //卖家登陆
                yj_base.uid = user;
                yj_base.group = 'seller';
                // yj_sidebar.init(user);
                break;
            default:
                $('#footer,#messagebar').remove();
                break;
        }
    }
</script>
<script src="__JS__/function/log_reg.js" type="text/javascript"></script>
<script src="__JS__/function/req_log_reg.js" type="text/javascript"></script>
<div id="headlogo">
    <div id="logotop"><div class="logoright"></div></div>
    <div id="loginbar">
<!--        <div class="searchbar">
            <input type="text" id="searchbar_ipt" value="请输入您感兴趣的关键字"/>
        </div>-->
    
    <div class="form-search" style="float: left;">
    <div class="input-append" >
        <input type="text" id="searchbar_ipt" class="span2 search-query" value="请输入您感兴趣的关键字">
        <button type="button" class="btn"><i class="icon-search"></i></button>
    </div>
    </div>
        <div class="login_register">
        	<ul><?php echo ($navdiv); ?></ul>
        </div>
        <div class="typebar goindex" style="margin-left: 10px;">
            <a href="index.php">
                <span style="background-position: -191px -102px;"></span>
                首页
            </a>
        </div>
        <div class="typebar fir_typ" style="background:#F5F6F4;">
    		<a href="javascript:void(0);">
            	<span style="background-position: -192px -27px;"></span>
                分类
            </a>
    		</div>
        <div class="typebar sec_typ">
            <a href="javascript:void(0);">
                <span></span>扩展
            </a>
        </div>
        
        <div id="sec_typ_cont">
            <div class="red leftpane">{
            </div>
            <div class="minpane">
                <ul>
                    <li><a href="index.php?m=Index&a=extpage&type=1">邮件</a>
                    </li>
                    <li><a href="index.php?m=Index&a=extpage&type=2">设置</a>
                    </li>
                    <li><a href="index.php?m=Index&a=extpage&type=3">关于约见</a>
                    </li>
                </ul>
            </div>  
            <div class="red rightpane">
            }
            </div>
        </div>
    </div>
</div>
<div id="navbar">
    <ul>
    <li><a href="index.php?type=3385FF"><div class="nav_nav" style="background:#3385FF;"><span>科技</span><div class="nav_img" style="background-position:-23px -489px;"></div></div></a></li>
    <li><a href="index.php?type=00B3FF"><div class="nav_nav" style="background:#00B3FF;"><span>金融</span><div class="nav_img" style="background-position:-75px -489px;"></div></div></a></li>
    <li><a href="index.php?type=FF38A8"><div class="nav_nav" style="background:#FF38A8;"><span>美女</span><div class="nav_img" style="background-position:-124px -489px;"></div></div></a></li>
    <li><a href="index.php?type=E3007F"><div class="nav_nav" style="background:#E3007F;"><span>艺术</span><div class="nav_img" style="background-position:-177px -489px;"></div></div></a></li>
    <li><a href="index.php?type=A2E024"><div class="nav_nav" style="background:#A2E024;"><span>教育</span><div class="nav_img" style="background-position:-227px -489px;"></div></div></a></li>
    <li><a href="index.php?type=FF8E24"><div class="nav_nav" style="background:#FF8E24;"><span>娱乐</span><div class="nav_img" style="background-position:-279px -489px;"></div></div></a></li>
    <li><a href="index.php?type=A736FF"><div class="nav_nav" style="background:#A736FF;"><span>体育</span><div class="nav_img" style="background-position:-328px -489px;"></div></div></a></li>
    <li><a href="index.php?type=B6C70A"><div class="nav_nav" style="background:#B6C70A;"><span>传媒</span><div class="nav_img" style="background-position:-380px -489px;"></div></div></a></li>
    </ul>
    <div id="navfont"></div>
</div>
<div id="minnavbar">
    <ul>
        <li><a href="index.php?type=3385FF"><div style="background:#3385FF;">科技</div></a></li>
        <li><a href="index.php?type=00B3FF"><div style="background:#00B3FF;">金融</div></a></li>
        <li><a href="index.php?type=A2E024"><div style="background:#A2E024;">教育</div></a></li>
        <li><a href="index.php?type=B6C70A"><div style="background:#B6C70A;">传媒</div></a></li>
        <li><a href="index.php?type=FF8E24"><div style="background:#FF8E24;">娱乐</div></a></li>
        <li><a href="index.php?type=FF38A8"><div style="background:#FF38A8;">美女</div></a></li>
        <li><a href="index.php?type=E3007F"><div style="background:#E3007F;">艺术</div></a></li>
        <li><a href="index.php?type=A736FF"><div style="background:#A736FF;">体育</div></a></li>
    </ul>
</div>

        <!-- <div id="messagebar">
            <div class="bardiv" id="dialog"><a href=#></a><div class="bartit_grn"><span>99</span></div></div>
            <div class="bardiv" id="message"><a href=#></a><div class="bartit_grn"><span>1</span></div></div>
        </div> -->
        <div id="include">       
            <div id="ext_contant">  
                <div class="ext_left">
                    <ul>
                        <li><div class="extitem ext_a_cur"><a href="javascript:tabchange('ext_mail');"><span>邮件</span></a></div></li>
                        <li><div class="extitem"><a href="javascript:tabchange('ext_options');"><span>账号设置</span></a></div></li>
                        <li><div class="extitem"><a href="javascript:tabchange('ext_password');"><span>密码修改</span></a></div></li>
                        <li><div class="extitem"><a href="javascript:tabchange('ext_meeted');"><span>见过的人</span></a></div></li>
                        <li><div class="extitem"><a href="javascript:tabchange('ext_about');"><span>关于约见</span></a></div></li>
                    </ul>
                </div>
                <div class="ext_right">
                    <div class="ext_cont ext_mail ext_div_cur">
                        <div style="height:27px;border-bottom: 1px #998989 solid;width:100%;">
                            <ul class="ext_cont_mu">
                            <li><a href="javascript:m_tabchange('ext_mail_site');"><div class="ext_mail_cur">站内通知</div></a></li>
                            <li><a href="javascript:m_tabchange('ext_mail_meet');"><div>约见通知</div></a></li>
                            <li><a href="javascript:m_tabchange('ext_mail_comment');"><div>约见评价</div></a></li>
<!--                             <li><a href="javascript:m_tabchange('ext_mail_wait2');"><div>待定</div></a></li>
                            <li><a href="javascript:m_tabchange('ext_mail_wait3');"><div>待定</div></a></li> -->
                        </ul>
                        </div>
                        <div class="ext_mail_div ext_mail_site ext_mail_div_cur">
                            <ul>
                                <li style="margin-bottom:20px;margin-top:0px;"><a class="checkbox  main_check" href="javascript:;"></a>&nbsp;全选&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="yj_ext.deleteNoticeList();">删除</a></li>
                                <!-- <li class="viewedmail" mailid=''><a class="checkbox act" href="javascript:;"></a>&nbsp;&nbsp;<a class="main_name" href="detail.php?&uid=''">去问去问</a>&nbsp;&nbsp;&nbsp;你妹你妹&nbsp;&nbsp;2012年12月11日&nbsp;&nbsp;&nbsp;&nbsp;【<a href="javascript:;" onclick="yj_ext.detailSiteNotice();">查看</a>】</li> -->

                            </ul>
                            <div class="ext_mail_foot">
                                <a class="checkbox  main_check" href="javascript:;"></a>&nbsp;全选&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="yj_ext.deleteNoticeList();">删除</a>
                                <div style="border-bottom: 1px #998989 solid;width:100%;height:1px;"></div>
                                <div class="pagecontrol">
                                    <ul>
                                        <li><a href="javascript:;" onclick="yj_ext.listSiteNotice('pre')">上一页</a></li>
                                        <li>|</li>
                                        <li><a href="javascript:;" onclick="yj_ext.listSiteNotice('next')">下一页</a></li>
                                    </ul>
                                </div>
                                <div class="yuejian_page" style="margin-top:10px;">1/1</div>
                            </div>
                        </div>
                        <div class="ext_mail_div ext_mail_site2 ">
                            <div class="site2_title">
                                <ul>
                                    <li><a href="javascript:;" id="mail_list">返回</a></li>
                                    <li>|</li>
                                    <li><a href="javascript:;" id="mail_del" onclick="yj_ext.deleteSiteNotice(this);">删除</a></li>
                                </ul>
                            </div>
                            <div class="site2_content">
                                <p>来自：<span></span></p>
                                <p>时间：<span></span></p>
                                <br />
                                <p>主题：<span></span></p> 
                                <p>----------------------------------------------------</p>
                                <div class="site2_content_cont"></div>
                            </div>
                            <div class="ext_mail_foot">
                                <div style="border-bottom: 1px #998989 solid;width:100%;height:1px;"></div>
                                <div class="pagecontrol">
                                </div>
                            </div>
                        </div>
                        <div class="ext_mail_div ext_mail_meet">
                            <div class="ext_mail_meet_alert red" style="display:none;">暂无约见评价通知</div>
                            <div class="ext_mail_meet_in">
                                <br />
                                <p>尊敬的&nbsp;<span class="red"></span>&nbsp;先生:</p><br />
                                <p>您所发布的&nbsp;<span class="red"></span>&nbsp;约见需求结果，已从&nbsp;<span class="red"></span>&nbsp;名竞拍者中产生！</p>
                                <div class="ext_mail_meet_cont">
                                    <div class="left_meet_cont"></div>
                                    <div class="mid_meet_cont">
                                        <div class="mid_meet_cont_left">
                                            <img src="__IMG__/leijunlit.png" />
                                            <div class="meet_name meet_name_man">
                                                <span></span>
                                            </div>
                                        </div>

                                        <div class="mid_meet_cont_right">
                                            <div class="meet_shad"></div>
                                            <p>尊敬的<span></span>先生:</p>
                                            <div style="border-bottom: 1px #998989 solid;width:166px;height:1px;margin:8px 0 0 10px;"></div>
                                            <div class="meet_word">
                                                <p></p>
                                            </div>
                                            <div class="meet_price"><span>出价：￥</span><span></span></div>
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
                                            <li><a href="javascript:;" onclick="yj_ext.queryYuejian('pre');">上一页</a></li>
                                            <li>|</li>
                                            <li><a href="javascript:;" onclick="yj_ext.queryYuejian('next');">下一页</a></li>
                                        </ul>
                                    </div>
                                    <div class="yuejian_page">1/1</div>
                                </div>
                            </div>
                        </div>
                        <div class="ext_mail_div ext_mail_comment">
                            <div class="ext_mail_comment_alert red" style="display:none;">暂无约见评价通知</div>
                            <div class="ext_mail_comment_in">
                                <div class="comment_cont">
                                    <p>尊敬的<span>雷军</span>：</p>
                                    <p>您与<span class="red">李开复</span>定于2012年9月5日的约见已完成</p>
                                    <br />
                                    <p>请进行评价</p>
                                    <a href="javascript:;"><div class="select_div" style="margin-top: 0px;">
                                        <div class="select_div_sel select_div_sel_cur" select="0"></div>
                                        <div class="select_div_cont">这次约见改变了我的人生！</div>
                                    </div></a>
                                    <a href="javascript:;"><div class="select_div" select="1">
                                        <div class="select_div_sel"></div>
                                        <div class="select_div_cont">今生难忘的见面，我受益匪浅。</div>
                                    </div></a>
                                    <a href="javascript:;"><div class="select_div" select="2">
                                        <div class="select_div_sel"></div>
                                        <div class="select_div_cont">不算失望，但也没什么惊喜。</div>
                                    </div></a>
                                    <a href="javascript:;"><div class="select_div" select="3">
                                        <div class="select_div_sel"></div>
                                        <div class="select_div_cont">和描述不符，我挺失望的。</div>
                                    </div></a>
                                </div>
                                <a href="javascript:;" class="nounder_a"><div class="ext_comment_btn" onclick="yj_ext.submitYJComment();">提交评价</div></a>
                                <div class="red" style="width:340px;margin-top:20px;font-size:1em;line-height:1.4em;">注意：您如果在1个工作日内未作出评价，我们将默认为最佳评价，感谢您参与评价！</div>
                                <div class="ext_mail_foot" style="margin-top:20px;">
                                    <div style="border-bottom: 1px #998989 solid;width:100%;height:1px;"></div>
                                    <div class="pagecontrol" style="margin-top:10px;">
                                        <ul>
                                            <li><a href="javascript:;">上一页</a></li>
                                            <li>|</li>
                                            <li><a href="javascript:;">下一页</a></li>
                                        </ul>
                                    </div>
                                    <div class="yuejian_page">1/1</div>
                                </div>
                            </div>

                        </div>
<!--                         <div class="ext_mail_div ext_mail_wait2">4</div>
                        <div class="ext_mail_div ext_mail_wait3">5</div> -->
                    </div>
                    <div class="ext_cont ext_meeted">
                        <div class="carelist">
                            <div class="tit_hed"></div>
                            <span class="contanttitle" style="margin-left:5px;">我见过的人......<a href="javascript:;" style="color:#494848;font-size:1em;" onclick="yj_ext.queryCareUser(0);">查看全部</a></span>
                            <div class="carelistin" style="width:630px;">
                                <ul>
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
                    <div class="ext_cont ext_options ext-modify">
                        <!-- <a href="javascript:;"><div class="modify" id="infomodify"></div></a> -->
                        <ul>
                            <li>姓名</li>
                            <li><div><input type="text" id="username"/></div></li>
                            <li></li>
                        </ul>
                        <ul style="height:110px;">
                            <li>头像</li>
                            <li><a href="javascript:;"><img class="modifyhead" src="__IMG__/yuesmall.png"></a>
                                <div style="display:inline-block;background:none;margin-left:20px;">
                                    点击左侧区域
                                    <br />
                                    上传或修改自己的真实照片
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>手机号码</li>
                            <li><div><input type="text" id="phone"/></div></li>
                            <li>（目前仅支持中国大陆移动、联通、电信运营手机号码）</li>
                        </ul>
                        <ul>
                            <li>银行卡号</li>
                            <li><div style="background-position:0px -258px;width:280px;"><input type="text" id="bankid"style="width:253px;"/></div></li>
                            <li>（请仔细核对您的银行卡）</li>
                        </ul>
                        <ul>
                            <li>开户行</li>
                            <li><div style="background-position:0px -258px;width:280px;"><input type="text" id="bankname"style="width:253px;"/></div></li>
                            <li>（请仔细填写开户行全称）</li>
                        </ul>
                        <ul>
                            <li>开户人</li>
                            <li><div><input type="text" id="bankuser"/></div></li>
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
                        <div class="mod_alert" style="margin:20px auto;"></div>
                        <div class="savefoot">
                            <div style="border-bottom: 1px #998989 solid;width:90%;height:1px;"></div>
                            <div class="options_save_btn"><a href="javascript:;"><div onclick="yj_ext.submitBaseInfo();"></div></a></div>
                        </div>
                    </div> 
                    <div class="ext_cont ext_password ext-modify">
                        <ul>
                            <li>当前密码</li>
                            <li><div><input type="password" id="oldpassword" /></div></li>
                            <li>（请输入当前 约见.me 的登录密码）</li>
                        </ul>
                        <ul>
                            <li>新密码</li>
                            <li><div><input type="password" id="newpassword" /></div></li>
                            <li>（密码为6-32位 英文字母开头 数字、英文字母<br />或下划线组合 密码区分大小写）</li>
                        </ul>
                        <ul>
                            <li>确认密码</li>
                            <li><div><input type="password" id="senewpassword" /></div></li>
                            <li>（请再次输入新密码）</li>
                        </ul>
                        <div class="mod_alert"></div>
                        <div class="savefoot">
                            <div style="border-bottom: 1px #998989 solid;width:90%;height:1px;"></div>
                            <div class="options_save_btn"><a href="javascript:;"><div onclick="yj_ext.submitModifyPass();"></div></a></div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
<div id="flog" class="log"></div>
<div id="headimgmodify" class="log_rest_div" style="height:400px;width: 550px;">
    <div class="lgtit">修改头像</div>
    <div class="close"><a href="javascript:void(0)"><div id="closemodifyhead"></div></a></div>
    <div class="headimg_left" style="width:240px;">
        <div class="tit_hed"></div>
        <div class="headimg_left_tit">当前头像</div>
        <div class="headimg_big"><img id="cropbox" src="__IMG__/head.png"></div>
    </div>    
    <div class="headimg_right">
        <div class="tit_hed"></div>
        <div class="headimg_left_tit">设置新头像</div>
        <div class="headimg_intro">请使用JPG、GIF、BMP或PNG文件<br />最大4M。</div>    
        <div class="uploadbtn"><a href="javascript:;"><div></div></a><img id="loading" src="__IMG__/loading.gif" style="margin-top: -30px;margin-left: 110px;display:none;"></div>
        <form name="form" action="" method="POST" enctype="multipart/form-data">
        <input type="file" id="fileToUpload" name="fileToUpload" onchange="yj_ext.uploadImg(this);" style="display:none;"/>
        </form>
        <div class="del_linediv xline" style="width:200px;margin:20px 0 20px 30px;"></div>
        <div class="tit_hed"></div>
        <div class="headimg_left_tit">小头像</div>
        <div class="headimg_intro" style="margin-top: 50px;">拖动左侧选框以调整小头像位置</div>  
        <div class="headimg_small"><img src="__IMG__/yuesmall.png" /></div>
        <a href="javascript:;"><div class="headimgsavebtn" onclick="yj_ext.resizeImg();"></div></a>
    </div>
</div>
<div id="logindiv" class="modal hide fade yjlog_rest_div" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<!--<div class="lgtit">登陆约见</div>-->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><div class="yjclose2"></div></button>
<h3>登陆约见</h3>
</div>
    <div class="quicklogin">
    	<span>使用合作账号登陆</span>
        <ul>
            <li><a href="javascript:void(0)"><div class="weibo"></div></a><p>微博</p></li>
            <li><a href="javascript:void(0)"><div class="renren"></div></a><p>人人</p></li>
            <li><a href="javascript:void(0)"><div class="tencent"></div></a><p>QQ</p></li>
        </ul>
    </div>
    <div id="login" class="log_res_right">
    	<ul style="margin-top:42px;">
            <li>用户名</li>
            <li><div class="login_ipt"><input id="username" type="text" /></div></li>
        </ul>
        <br />
		<ul id="log_password">
            <li>密&nbsp;&nbsp;&nbsp;&nbsp;码</li>
            <li><div class="login_ipt"><input id="password" type="password" /></div></li>
        </ul>
        <br />
        <div class="forgetpass"><a href="javascript:void(0)"/>忘记密码？</a></div>
        <br />
        <a href="javascript:;"><div class="sbmtlogin"></div></a>
        <p class="log_reg_alert" style="margin-left:50px;margin-top:-21px;">用户名或密码输入有误</p>  
    </div>
<!--    <div class="close"><a href="javascript:void(0)"><div id="closelogin"></div></a></div>-->
</div>
<script>
$('#username,#password').focus(function(){
    $('.log_reg_alert').hide();
});
$('.forgetpass').click(function(){
    $('.log_reg_alert').hide();
});
</script><div id="registerdiv" class="modal hide fade yjlog_rest_div" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<!--	<div class="lgtit">注册约见</div>-->
        <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><div class="yjclose2"></div></button>
<h3>注册约见</h3>
</div>
    <div class="quicklogin quickregister">
    	<span>使用合作账号登陆</span>
        <ul>
        	<li><a href="<?php echo ($weiboLoginUrl); ?>"><div class="weibo" ></div></a><p>微博</p></li>
                <li><a href="javascript:void(0)"><div class="renren"></div></a><p>人人</p></li>
            <li><a href="javascript:void(0)"><div class="tencent"></div></a><p>QQ</p></li>
        </ul>
    </div>
    <div id="register" class="log_res_right">
    	<ul style="margin-top:42px;">
            <li>用户名</li>
            <li><input id="reg_username" placeholder="邮箱或手机号" type="text" /></li>
        </ul><br />
        <ul>
            <li>密&nbsp;&nbsp;&nbsp;&nbsp;码</li>
            <li><input id="reg_password" type="password" /></li>
        </ul><br />
        <ul>
            <li>确认密码</li>
            <li><input id="reg_sepassword" type="password" /></li>
        </ul><br />
        <ul>
            <li>兴&nbsp;&nbsp;&nbsp;&nbsp;趣</li>
            <li  style="margin-left:0px;">
                <div class="registertype">
                    <ul>
                        <li style="background:#3385FF" name="3385FF"><a href="javascript:void(0)">科技</a></li>
                        <li style="background:#00B3FF" name="00B3FF"><a href="javascript:void(0)">金融</a></li>
                        <li style="background:#A2E024" name="A2E024"><a href="javascript:void(0)">教育</a></li>
                        <li style="background:#B6C70A" name="B6C70A"><a href="javascript:void(0)">传媒</a></li>
                        <li style="background:#FF8E24" name="FF8E24"><a href="javascript:void(0)">娱乐</a></li>
                        <li style="background:#A736FF" name="A736FF"><a href="javascript:void(0)">体育</a></li>
                        <li style="background:#E3007F" name="E3007F"><a href="javascript:void(0)">艺术</a></li>
                    </ul>
                </div>
            </li>
        </ul><br />
        <div class="agreeto">
            <a class="agree_btn" href="javascript:void(0)"><div></div></a>
            <div><span style="line-height: 26px;">我已同意约见的</span><a href="javascript:void(0)">用户注册声明</a>
            </div>
        </div>
        <a href="javascript:void(0)"><div class="sbmtrigster" onclick="yj_register.registerNew();"></div></a>
        <p class="log_reg_alert" style="margin-top:-5px;margin-left:5px;"></p>  
    </div>
<!--    <div class="close"><a href="javascript:void(0)"><div id="closeregister"></div></a></div>-->
</div>
<script>
$('#reg_username,#reg_password,#reg_sepassword').focus(function(){
    $('.log_reg_alert').hide();
});
$('#reg_username').blur(function(){
    yj_register.queryName();
});
</script>

<script type="text/javascript" src="__JS__/pagejs/extpage.js"></script>
<script type="text/javascript" src="__JS__/pagejs/head.js"></script>
<script type="text/javascript" src="__JS__/pagejs/log_reg.js"></script>
<script type="text/javascript" src="__JS__/function/req_extpage.js"></script>
<script type="text/javascript" src="__JS__/function/ext.js"></script>
    <script type="text/javascript">
        datepicker.init();
    </script>
    <script>
        var type = '<?php echo ($type); ?>';
        if(type=='1'){
            tabchange(null,'ext_mail');
            $('.extitem').each(function(){$(this).removeClass('ext_a_cur')});
            $('.extitem:eq(0)').addClass('ext_a_cur');
        }else if(type=='2'){
            tabchange(null,'ext_options');
            $('.extitem').each(function(){$(this).removeClass('ext_a_cur')});
            $('.extitem:eq(1)').addClass('ext_a_cur');
        }else if(type=='3'){
            tabchange(null,'ext_about');
            $('.extitem').each(function(){$(this).removeClass('ext_a_cur')});
            $('.extitem:eq(4)').addClass('ext_a_cur');
        }
   </script>

</body>

</html>