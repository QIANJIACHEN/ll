<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/ll/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/ll/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/ll/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/ll/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
		.input-search{width: 100px;margin-left: 10px;margin-right: 20px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/ll/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/ll/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/ll/public/js/jquery.js"></script>
    <script src="/ll/public/js/wind.js"></script>
    <script src="/ll/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script src="/ll/public/js/DatePicker1/WdatePicker.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
		.center-table th,.center-table td{
			text-align: center;
		}
	</style><?php endif; ?>
</head>
<link rel="stylesheet" type="text/css" href="/ll/public/css/addcourse.css" />
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li ><a href="<?php echo U('order/orderlist');?>"><?php echo L('ADMIN_ENRO_INDEX');?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" >
			<input type="hidden" name="editid" value="<?php echo ($list["id"]); ?>"/>
			<fieldset>
				<div class="control-group">
					<label class="control-label"><?php echo L('ORDER_SN');?></label>
					<div class="controls">
						<input type="text" readonly value="<?php echo ($list["order_id"]); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('COURSE');?></label>
					<div class="controls">
						<input type="text" readonly value="<?php echo ($list["coursename"]); ?>">
						<!--<button type="button" data-toggle="modal" data-target="#detail" class="btn btn btn-link" >查看课程详情</button>-->
						<a  href="<?php echo U('Testbase/Course/editcourse?editid='); echo ($list["cid"]); ?>">查看课程详情</a>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('CHILD');?></label>
					<div class="controls">
						<input type="text" readonly value="<?php if(!empty($list[childname])): echo ($list["childname"]); else: ?>未选择学生<?php endif; ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('PAYWAY');?></label>
					<div class="controls">
						<input type="text" readonly <?php if($list[state] == 0): ?>value="未支付"<?php elseif($list[state] == 1): ?>value="已支付待确认"<?php elseif($list[state] == 3): ?>value="已完成"<?php elseif($list[state] == 4): ?>value="已取消"<?php endif; ?> >
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('CAOZUO');?></label>
					<div class="controls">
						<input type="text" readonly value="<?php echo ($list["username"]); ?>">
					</div>
				</div>
				<?php if($list[cancel_state] == 1 || $list[cancel_state] == 2): ?><div class="control-group">
						<label class="control-label"><?php echo L('CANCELSTATE');?></label>
						<div class="controls">
							<?php if($list[cancel_state] == 1): ?>订单取消申请中<?php elseif($list[cancel_state] == 2 && $list[state] != 4): ?>订单取消被拒绝<?php endif; ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><?php echo L('CANCELREASON');?></label>
						<div class="controls">
							<textarea name="desc"style="width:300px;height:100px;" disabled><?php echo ($list["note"]); ?></textarea>
						</div>
					</div><?php endif; ?>
			</fieldset>
			<div class="form-actions">
				<a class="btn" href="<?php echo U('order/orderlist');?>"><?php echo L('BACK');?></a>
			</div>
		</form>
		<div class="modal fade" id="detail" style="top:300px;display: none;">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">课程详细</h4>
            </div>
            <div class="modal-body">
       			<form  class="form-horizontal js-ajax-form" >
			<fieldset>
				<div class="control-group">
					<label class="control-label">课程标题</label>
					<div class="controls">
						<input type="text" name="title" value="<?php echo ($course[title]); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">图片</label>
					<div class="controls">
						<img src="/ll/data/upload/avatar/<?php echo ($course[picture]); ?>">
					</div>
				</div>
				
				
				<div class="control-group">
					<label class="control-label">教师名字</label>
					<div class="controls">
						<input type="text" value="<?php echo ($teacher[name]); ?>">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">开课时间</label>
					<div class="controls">
						<input type="text" value="<?php echo ($course['start_time']); ?>">
					</div>
				</div>
			</fieldset>
			
		</form>	
       			
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	</div>
	<script src="/ll/public/js/common.js"></script>
</body>
<script type="text/javascript">
</script>
</html>