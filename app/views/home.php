<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$title;?></title>
	<link rel="stylesheet" type="text/css" href="<?=$themes_default_url?>easyui.css" />
	<link rel="stylesheet" type="text/css" href="<?=$themes_url?>icon.css" />
	<link rel="stylesheet" type="text/css" href="<?=$css?>style.css" />
	<!--<link rel="icon" href="<?=$images;?>logo.png">-->
    <script type="text/javascript" src="<?=$js;?>jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?=$js;?>jquery.easyui.min.js"></script>  
	<script type="text/javascript" src="<?=$js;?>src/jquery.parser.js"></script>
    <script type="text/javascript" src="<?=site_url('home/js')?>"></script>            
</head>
<body class="easyui-layout">
    
    <!-- Header -->
    <div data-options="region:'north',border:false" style="height:100px;">
        <div class="easyui-panel header" fit="true" title="<center><?=$title;?></center>" collapsible="false" border="false" style="padding:5px">
            
        </div>
    </div>
    
    <!-- Main -->
    <div data-options="region:'center',title:'Welcome <?=$user;?>'" style="overflow:hidden;">
        <div class="easyui-panel" border="false" fit="true" collapsible="true">
            <div class="easyui-layout" fit="true">
                
                <!-- Menu & User -->
          		<div region="west" split="true" border="false" title="Info User" style="width:300px">
                    <div class="easyui-panel" border="false" fit="true">
                        <div class="easyui-layout" fit="true">
                            <!-- User -->
                            <div data-options="region:'north',border:false" split="true" style="height:76px;">
                                <div class="easyui-panel" fit="true" collapsible="true" border="false" style="padding:2px">
                                    <div class="easyui-panel" fit="true" style="padding:4px;">
                                        <table>
                                            <tr>
                                                <td>User Name</td>
                                                <td>:</td>
                                                <td>Nama User</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Login</td>
                                                <td>:</td>
                                                <td>Tanggal</td>
                                            </tr>
                                            <tr>
                                                <td>Autorisasi</td>
                                                <td>:</td>
                                                <td>Administrator</td>
                                            </tr>
                                        </table>
                            		</div>                                	 
                                </div>
                            </div>
                            <!-- Menu -->
                            <div data-options="region:'center',border:false">
                                <div class="easyui-panel" fit="true" collapsible="false" border="false" title="Menu Navigation">
                                    <div id="menuAccordion" class="easyui-accordion" fit="true" border="false">
                                		<div title="&nbsp;Master Tabel" data-options="iconCls:'icon-list'">
                                			<table id="tg-master"></table>
                                		</div>
                                		<div title="&nbsp;Anggaran" data-options="iconCls:'icon-program'">
                                			Anggaran
                                		</div>
                                		<div title="&nbsp;Penatausahaan" data-options="iconCls:'icon-money'" style="padding:10px;">
                                			Penatausahaan
                                		</div>
                                		<div title="&nbsp;Akuntansi dan Pelaporan" data-options="iconCls:'icon-report'" style="padding:10px;">
                                			Akuntansi dan Pelaporan
                                		</div>
                                		<div title="&nbsp;Pengaturan" data-options="iconCls:'icon-config'" style="padding:10px;">
                                			Pengaturan
                                		</div>
                                	</div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                
                <!-- Main Content Tab -->
          		<div region="center" split="true" border="false">
                
                    <!-- Main Content Tab -->                                
                    <div id="tab-content" class="easyui-tabs" fit="true" border="false" tools="#tab-tools">
                    
                        <!-- Tab Home -->
        				<div title="Welcome" style="padding:1px;overflow:hidden;">
                            <div class="easyui-panel" border="true" fit="true" collapsible="true" title="Home Simakda">
                                dd
                            </div>
                        </div>
                        
        			</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div data-options="region:'south',border:false" style="height:26px;">
        <div class="easyui-panel" fit="true" title="<center>&copy; <?=date('Y');?> AndhA Inc.</center>" collapsible="false" border="false" style="text-align: center;"></div>
    </div>
    
    <!-- Toolbar Tabs Main Content -->
    <div id="tab-tools">
	    <select id="themes" style="width:100%" class="easyui-combobox" panelHeight="150" editable="false">
			<option value="default">default</option>  
			<option value="cupertino">cupertino</option>
            <option value="dark-hive">dark-hive</option> 
			<option value="gray">gray</option>   
			<option value="pepper-grinder">pepper-grinder</option>  
			<option value="metro">metro</option>  
			<option value="sunny">sunny</option> 
		</select>
        <a id="logout" class="easyui-linkbutton" title="Logout" data-options="plain:true,iconCls:'icon-logout'"></a>
	</div>
    
</body>
</html>