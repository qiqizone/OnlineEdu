@extends('admin.index.base')

@section('title')
    试题列表
@endsection

@section('breadcrumb')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 试卷试题管理
        <span class="c-gray en">&gt;</span> 试题管理
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
@endsection

@section('content')
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:void(0);" onclick="datadel()" class="btn btn-danger radius">
                    <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                </a>
                <a href="javascript:void(0);" onclick="member_add('添加用户','{{route("member_add")}}','','510')"
                   class="btn btn-primary radius">
                    <i class="Hui-iconfont">&#xe600;</i> 添加用户
                </a>
                <a href="javascript:void(0);" onclick="location.href = '{{route("question_export")}}';"
                   class="btn btn-success radius">
                    <i class="Hui-iconfont">&#xe644;</i> 导出
                </a>
                <a href="javascript:void(0);" onclick="import_func('导入','{{route("question_import")}}','500','260')"
                   class="btn btn-warning radius">
                    <i class="Hui-iconfont">&#xe645;</i> 导入
                </a>
            </span>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="15"><input type="checkbox" name="" value=""></th>
                    <th width="30">ID</th>
                    <th width="100">题干</th>
                    <th width="40">所属试卷</th>
                    <th width="40">分值</th>
                    <th width="90">选项</th>
                    <th width="150">答案</th>
                    <th width="130">创建时间</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                    <tr class="text-c">
                        <td><input type="checkbox" value="{{$value->id}}" name=""></td>
                        <td>{{$value->id}}</td>
                        <td>{{$value->question}}</td>
                        <td>{{$value->paper->paper_name}}</td>
                        <td>{{$value->score}}</td>
                        <td>
                            <a href="javascript:void(0);" onclick="show_option('{{$value->options}}');">查看选项</a>
                        </td>
                        <td>{{$value->answer}}</td>
                        <td>{{$value->created_at}}</td>
                        <td class="td-manage">
                            <a style="text-decoration:none" onClick="member_stop(this,'10001')"
                               href="javascript:void(0);" title="停用">
                                <i class="Hui-iconfont">&#xe631;</i>
                            </a>
                            <a title="编辑" href="javascript:void(0);"
                               onclick="member_edit('编辑','member-add.html','4','','510')"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            <a style="text-decoration:none" class="ml-5"
                               onClick="change_password('修改密码','change-password.html','10001','600','270')"
                               href="javascript:void(0);" title="修改密码">
                                <i class="Hui-iconfont">&#xe63f;</i>
                            </a>
                            <a title="删除" href="javascript:void(0);" onclick="member_del(this,'1')"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#question_list").addClass('current');
            $("#paper").css('display', 'block');

            $('.table-sort').dataTable({
                "aaSorting": [[1, "desc"]],//默认第几个排序
                "bStateSave": true,//状态保存
                "aoColumnDefs": [
                    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                    {"orderable": false, "aTargets": [0, 8]}// 制定列不参与排序
                ]
            });

        });

        /*用户-添加*/
        function member_add(title, url, w, h) {
            layer_show(title, url, w, h);
        }

        /*用户-查看*/
        function member_show(title, url, id, w, h) {
            layer_show(title, url, w, h);
        }

        /*用户-停用*/
        function member_stop(obj, id) {
            layer.confirm('确认要停用吗？', function (index) {
                $.ajax({
                    type: 'POST',
                    url: '',
                    dataType: 'json',
                    success: function (data) {
                        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                        $(obj).remove();
                        layer.msg('已停用!', {icon: 5, time: 1000});
                    },
                    error: function (data) {
                        console.log(data.msg);
                    },
                });
            });
        }

        /*用户-启用*/
        function member_start(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                $.ajax({
                    type: 'POST',
                    url: '',
                    dataType: 'json',
                    success: function (data) {
                        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                        $(obj).remove();
                        layer.msg('已启用!', {icon: 6, time: 1000});
                    },
                    error: function (data) {
                        console.log(data.msg);
                    },
                });
            });
        }

        /*用户-编辑*/
        function member_edit(title, url, id, w, h) {
            layer_show(title, url, w, h);
        }

        /*密码-修改*/
        function change_password(title, url, id, w, h) {
            layer_show(title, url, w, h);
        }

        /*用户-删除*/
        function member_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                $.ajax({
                    type: 'POST',
                    url: '',
                    dataType: 'json',
                    success: function (data) {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!', {icon: 1, time: 1000});
                    },
                    error: function (data) {
                        console.log(data.msg);
                    },
                });
            });
        }

        /* 试题-选项查看 */
        function show_option(optionsStr) {
            let optionArr = optionsStr.split("~");
            let resultStr = '';
            optionArr.forEach((item) => {
                resultStr += `<div>
                    <i class="Hui-iconfont" style="color: #f90;">&#xe601;</i>
                    ${item}
                </div>`;
            });
            layer.alert(resultStr, {
                title: "查看选项",
            });
        }

        /*用户-添加*/
        function import_func(title, url, w, h) {
            layer_show(title, url, w, h);
        }
    </script>
@endsection


