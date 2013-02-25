<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$title;?></title>
	<link rel="icon" href="<?=$images;?>logo.png">
    <link rel="stylesheet" type="text/css" href="<?=$themes_default_url?>easyui.css" />
	<link rel="stylesheet" type="text/css" href="<?=$themes_url?>icon.css" />
	<link rel="stylesheet" type="text/css" href="<?=$css?>style.css" />
	<script type="text/javascript" src="<?=$js;?>jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?=$js;?>jquery.easyui.min.js"></script>  
	<script type="text/javascript" src="<?=$js;?>src/jquery.parser.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            
            $('#tblLogin').bind('click',function(){
                 $('#frmLogin').form('submit',{
    				url: '<?=site_url('home/doLogin')?>',
    				onSubmit: function(){
    					return $(this).form('validate');
    				},
    				success: function(result){
    					var result = eval('('+result+')');
                        if (result.success){
                            window.location.href = "<?=base_url()?>";
    					} else {
                            console.log(result);
                            $.messager.progress('close');
    						$.messager.alert('Login Error',result.Msg,'Info');
    					}
    				},
                    onBeforeLoad: function(param){
                        console.log(param);
                        $.messager.progress(); 
                    }
    			});
            });
            
            $('#tblReset').bind('click',function(){
                $('#tblReset').form('clear');
            });
            
            $('#username,#password').bind('keypress',function(event){
                if (event.which == 13){
                    $('#tblLogin').click(); 
                } 
            });
            
            $('#username').focus();
        });
    </script>            
</head>
<body>
    <div id="formLogin" class="easyui-dialog" title="Login Form" data-options="modal:true,closable:false" buttons="#tombolLogin" style="width:400px;height:305px;padding:10px">
	<div id="logo"><img src="<?=$images;?>logo.png" /></div>
    <hr noshade size="1" color="#ECA343"/>
    <form id="frmLogin" method="post" novalidate>
        <table style="width: 100%; border=1">
            <tr>
                <td style="width: 30%;">User Name</td>
                <td style="width: 70%;"><input id="username" name="user" style="width: 100%;" class="easyui-validatebox" required="true"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input id="password" name="pass" type="password" style="width: 100%;" class="easyui-validatebox" required="true"></td>
            </tr>
        </table>
	</form>
    <hr noshade size="1" color="#ECA343"/>
    <center>
        <sup>
            Copyright &copy; PT. Antar Mitra Prakarsa (AMP) - m-STARS Mobile<br />
            Two Kemang Place, Jalan Kemang Raya Selatan No.2, Jakarta
        </sup>
    </center>
</div>
<div id="tombolLogin" style="text-align: center">
	<a id="tblLogin" class="easyui-linkbutton" iconCls="icon-ok" data-options="plain:true">Login</a> 
	<a id="tblReset" class="easyui-linkbutton" iconCls="icon-cancel" data-options="plain:true">Reset</a>
</div>     

</body>
</html>