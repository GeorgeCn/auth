<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 角色列表</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- 公共的 -->
    <link rel="shortcut icon" href="favicon.ico"> <link href="/Github/GEauth/Public/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/Github/GEauth/Public/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/Github/GEauth/Public/admin/css/animate.css" rel="stylesheet">
    <link href="/Github/GEauth/Public/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <!-- table_bootstrap_list.html  需要 -->
    <link href="/Github/GEauth/Public/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <style type="text/css">
        .orderno{
            height:30px;
            line-height: 30px;
            text-align: center;
            width: 100%;
            font-weight: bold;
            padding-top: 5px;
            font-size: 18px;}
        .new_addorder{
            display: inline-block;
            padding:0 20px;
            font-size: 18px;
            color: #23B7E5;
            position: relative;
        }
        .icon_new{
            position: absolute;
            left:79%;
            top:-10px;
            padding:1px 3px;
            font-size:14px;
            background: #FF7272;
            color: #fff;
            text-align: center;
            font-style: normal;
            border-radius: 2px;
        }
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row wrapper border-bottom white-bg page-heading">
        <!---------为页面定时刷新提供数据START------------>
        <input type="hidden" name="ordernum" id="ordernum" value=""/>
        <!---------为页面定时刷新提供数据END------------>
        <div class="col-lg-10">
            <h2>角色管理 <span style="display:none;" id="span_alert" class="new_addorder">角色管理 <i class="icon_new" id="alertnum"></i></span></h2>
        </div>

            <div class="ibox-content">
                <form role="form" class="form-inline" name="frm" method="post" action="/Github/GEauth/admin.php/Home/index/pExcel">
                    <div class="form-group"><span style="font-size:1.25em;">订单筛选导出:</span></div>
                    <div class="form-group">
                        <input type="text" placeholder="请输入起始时间" name="start" id="start" class="laydate-icon form-control" style="height:32px;">-
                    </div>
                    <div class="form-group">
                        -<input type="text" placeholder="请输入结束时间" name="end" id="end" class="laydate-icon form-control" style="height:32px;">
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="form-group">
                        <select class="form-control" style="height:32px;" name="shopid">
                            <option value="0">请选择</option>
                            <?php if(is_array($shops)): foreach($shops as $k=>$vo): ?><option value="<?php echo ($k); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-info" type="submit">查找并导出</button>
                </form>
            </div>

    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-sm-12">
            <div class="tabs-container">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <!-- 全部 选项下的内容-->

                            <div class="col-sm-12">
                                <div class="example-wrap">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="这里可以添加新的管理员哟!" onclick="useradd();">新增管理员</button>
                                    <div class="example">
                                        <table id="exampleTablePagination" ></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="/Github/GEauth/Public/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/Github/GEauth/Public/admin/js/bootstrap.min.js?v=3.4.6"></script>

<!-- 自定义js -->
<!-- Bootstrap table -->
<script src="/Github/GEauth/Public/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/Github/GEauth/Public/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
<script src="/Github/GEauth/Public/admin/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>

<script type="text/javascript">
    $('#exampleTablePagination').bootstrapTable({
        method: 'get',
        contentType: "application/x-www-form-urlencoded",//必须要有！！！！
        url: "/Github/GEauth/admin.php/Home/User/getAdminUsers",//要请求数据的文件路径
        //height:700,//高度调整
        //toolbar: '#toolbar',//指定工具栏
        striped: true, //是否显示行间隔色
        dataField: "res",//bootstrap table 可以前端分页也可以后端分页，这里
        //我们使用的是后端分页，后端分页时需返回含有total：总记录数,这个键值好像是固定的
        //rows： 记录集合 键值可以修改  dataField 自己定义成自己想要的就好
        pageNumber: 1, //初始化加载第一页，默认第一页
        pagination:true,//是否分页
        //queryParamsType:'limit',//查询参数组织方式
        queryParams:queryParams,//请求服务器时所传的参数
        sidePagination:'server',//指定服务器端分页
        pageSize:10,//单页记录数
        pageList:[10,25,50],//分页步进值
        showRefresh:true,//刷新按钮
        showColumns:true,
        clickToSelect: true,//是否启用点击选中行
        toolbarAlign:'right',//工具栏对齐方式
        buttonsAlign:'right',//按钮对齐方式
        toolbar:'.toolbar',//指定工作栏
        search:true,
        showHeader:true,
        //showFooter:true,
        showColumns:true,
        showToggle:true,
        showPaginationSwitch:true,
        columns:[
            {
                title:'ID',
                field:'id'
            },
            {
                title:'昵称',
                field:'loginname'
            },
            {
                title:'头像',
                field:'avatar',
                formatter:function(value,row,index){
                    if(value == ''){
                        return '<img id="" src="/Github/GEauth/Public/Uploads/avatars/avatar_default.png" style="width:50px;"/>';
                    }else{
                        return '<img id="" src="/Github/GEauth/'+value+' " style="width:50px;height:50px;border-radius:50%;"/>';
                    }
                }
            },
            {
                title:'手机',
                field:'mobile'
            },
            {
                title:'邮箱',
                field:'email'
            },
            {
                title:'状态',
                field:'states',
                formatter:function(value,row,index){
                    if(value == 1){
                        return '<span>正常</span>';
                    }else{
                        return '<span>禁用</span>';
                    }
                }
            },
            {
                title:'最近登录时间',
                field:'last_login_time'
            },
            {
                title:'最近登录IP',
                field:'last_login_ip'
            },
            {
                title:'操作',
                field:'',
                align:'center',
                formatter: function(value,row,index){
                    if(row.id == 1){
                        //管理员
                        return '<button type="button" disabled class="btn btn-outline btn-default">禁用</button>&nbsp;&nbsp;' +
                                '<button type="button" disabled class="btn btn-outline btn-default">编辑</button>&nbsp;&nbsp;' +
                                '<button type="button" disabled class="btn btn-outline btn-default">删除</button>';
                    }else{
                        if(row.states == 1){
                            //管理员状态正常
                            return '<button type="button" class="btn btn-outline btn-primary" onclick="forbin('+row.id+')">禁用</button>&nbsp;&nbsp;' +
                                    '<button type="button" class="btn btn-outline btn-info" onclick="edit('+row.id+')">编辑</button>&nbsp;&nbsp;' +
                                    '<button type="button" class="btn btn-outline btn-warning" onclick="del('+row.id+')">删除</button>';
                        }else{
                            //已禁用的管理员
                            return '<button type="button" class="btn btn-outline btn-success" onclick="qy('+row.id+')">启用</button>&nbsp;&nbsp;' +
                                    '<button type="button" class="btn btn-outline btn-info" onclick="edit('+row.id+')">编辑</button>&nbsp;&nbsp;' +
                                    '<button type="button" class="btn btn-outline btn-warning" onclick="del('+row.id+')">删除</button>';
                        }

                    }
                }

            }

        ],
        locale:'zh-CN'//中文支持
    });
    //请求服务数据时所传参数
    function queryParams(params){
        return{
            //每页多少条数据
            pageSize: params.limit,
            //请求第几页
            pageIndex:(params.offset / params.limit) + 1,
        }
    }
</script>
</body>
</html>
<!--新增/编辑 管理员-->
<script type="text/javascript">
    function useradd(){
        window.location.href="/Github/GEauth/admin.php/Home/User/user_add";
    }

    function edit(id){
        window.location.href="/Github/GEauth/admin.php/Home/User/user_edit/id/"+id;
    }

</script>
<!--删除管理员-->
<script src="/Github/GEauth/Public/admin/js/plugins/layer/layer.js"></script>
<script>
    function del(id){
        layer.msg('您确定要删除吗?',{
            btn:['删除','取消'],
            time:0,
            yes:function(index){
                layer.close(index);
                $.ajax({
                    type:'post',
                    url:"/Github/GEauth/admin.php/Home/User/user_del",
                    data:{
                        id:id
                    },
                    dateType:'json',
                    success:function(msg){
                        if(msg == 1){
                            layer.msg("删除成功");
                            window.location.reload();
                        }
                    }
                })
            }
        })
    }
</script>
<!--禁用管理员-->
<script>
    function forbin(id){
        layer.msg('您确定禁用管理员吗?',{
            btn:['确定','取消'],
            time:0,
            yes:function(index){
                layer.close(index);
                $.ajax({
                    type:'post',
                    url:"/Github/GEauth/admin.php/Home/User/user_forbin",
                    data:{
                        id:id
                    },
                    dateType:'json',
                    success:function(msg){
                        if(msg == 1){
                            layer.msg("操作成功");
                            window.location.reload();
                        }
                    }
                })
            }
        })
    }
</script>
<!--启用管理员-->
<script>
    function qy(id){
        layer.msg('您确定启用管理员吗?',{
            btn:['确定','取消'],
            time:0,
            yes:function(index){
                layer.close(index);
                $.ajax({
                    type:'post',
                    url:"/Github/GEauth/admin.php/Home/User/user_forbin",
                    data:{
                        id:id,
                        type:1
                    },
                    dateType:'json',
                    success:function(msg){
                        if(msg == 1){
                            layer.msg("操作成功");
                            window.location.reload();
                        }
                    }
                })
            }
        })
    }
</script>