<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <title>@yield('title')</title>
    @yield('css')
</head>
<body>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl">
            <a class="logo navbar-logo f-l mr-10 hidden-xs" href="{{route('admin_index')}}">在线直播</a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs">后台</span>

            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->role->role_name}}</li>
                    <li class="dropDown dropDown_hover">
                        <a href="#" class="dropDown_A">
                            {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->username}}
                            <i class="Hui-iconfont">&#xe6d5;</i>
                        </a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:void(0);" onClick="myselfinfo()">个人信息</a></li>
                            <li><a href="#">切换账户</a></li>
                            <li><a href="{{route('admin_logout')}}">退出</a></li>
                        </ul>
                    </li>
                    <!-- 邮件 -->
                    <li id="Hui-msg">
                        <a href="#" title="消息">
                            <span class="badge badge-danger">1</span>
                            <i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i>
                        </a>
                    </li>

                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:void(0);" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:void(0);" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:void(0);" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:void(0);" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:void(0);" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:void(0);" data-val="orange" title="橙色">橙色</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- 右侧的导航栏 -->
<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">
        <!-- 专业管理 -->
        <dl id="menu-article">
            <dt>
                <i class="Hui-iconfont">&#xe616;</i>
                专业管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd id="project">
                <ul>
                    <li id="project_category"><a href="{{route('protype_list')}}" title="专业分类">专业分类</a></li>
                    <li id="profession_list"><a href="{{route('profession_list')}}" title="专业列表">专业列表</a></li>
                </ul>
            </dd>
        </dl>
        <!-- 课程管理 -->
        <dl id="menu-picture">
            <dt>
                <i class="Hui-iconfont">&#xe626;</i>
                课程管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd id="course">
                <ul>
                    <li id="course_list"><a href="{{route('course_list')}}" title="课程列表">课程列表</a></li>
                    <li id="course_play"><a href="{{route('lesson_list')}}" title="点播列表">点播列表</a></li>
                </ul>
            </dd>
        </dl>
        <!-- 试卷管理 -->
        <dl id="menu-product">
            <dt>
                <i class="Hui-iconfont">&#xe72d;</i>
                试卷试题管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd id="paper">
                <ul>
                    <li id="paper_list"><a href="{{route('paper_list')}}" title="试卷管理">试卷管理</a></li>
                    <li id="question_list"><a href="{{route('question_list')}}" title="试题管理">试题管理</a></li>
                </ul>
            </dd>
        </dl>
        <!-- 直播管理 -->
        <dl id="menu-comments">
            <dt>
                <i class="Hui-iconfont">&#xe66f;</i>
                直播管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd id="live">
                <ul>
                    <li id="stream_list"><a href="{{route('stream_list')}}" title="直播流列表">直播流列表</a></li>
                    <li id="live_list"><a href="{{route('live_list')}}" title="直播课程">直播课程</a></li>
                </ul>
            </dd>
        </dl>
        <!-- 会员管理 -->
        <dl id="menu-member">
            <dt>
                <i class="Hui-iconfont">&#xe60d;</i> 会员管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd id="member">
                <ul>
                    <li id="member_list">
                        <a href="{{route('member_list')}}" title="会员列表">会员列表</a>
                    </li>
                </ul>
            </dd>
        </dl>
        <!-- 管理员管理 -->
        <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd id="manager">
                <ul>
                    <li id="role_manager">
                        <a href="{{route('role_index')}}" title="角色管理">角色管理</a>
                    </li>
                    <li id="auth_manager">
                        <a href="{{route('auth_index')}}" title="权限管理">权限管理</a>
                    </li>
                    <li id="admin_list">
                        <a href="{{route('manager_index')}}" title="管理员列表">管理员列表</a>
                    </li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<!-- 收起展开按钮 -->
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>


<section class="Hui-article-box">
    <!-- 面包屑 -->
    @yield('breadcrumb')
    <!-- 内容部分 -->
    <div class="Hui-article">
        <article class="cl pd-20">
            <!-- 内容 -->
            @yield('content')
        </article>

        <footer class="footer">
            <p></p>
        </footer>
    </div>
</section>

<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script>
@yield('js')
</body>
</html>
