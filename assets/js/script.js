$(document).ready(function() {
   
   // Grid Home
   $('#dg-home').datagrid({  
        url:'<?=site_url('ajax/getuserlog')?>',  
        toolbar: "#tb-home",
        title:"Auto Refresh Monitoring (every 10 seconds)",
        fitColumns: true,
        striped: true,
        rownumbers: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        columns:[[  
            {field:'ul_msisdn',title:'MSISDN',width:100,sortable:true},  
            {field:'p_name',title:'Program',width:100,sortable:true},  
            {field:'con_text_mon',title:'Content',width:100,sortable:true},  
            {field:'ul_service_code',title:'Service Code',width:100,sortable:true},  
            {field:'ul_sys_created_date',title:'Date/Time',width:70,align:'center',sortable:true},  
            {field:'ul_user_agent',title:'User Agent',width:300,align:'left',sortable:true},  
            {field:'ul_ipaddress',title:'Ip',width:50,align:'center',sortable:true} 
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenu').length){
				createColumnMenu();
			}
			$('#tmenu').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		}
    });
    
    function createColumnMenu(){
		var tmenu = $('<div id="tmenu" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-home').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenu);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-home').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-home').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
                
    // Grid Program
    $('#dg-program').datagrid({  
        url:'<?=site_url('ajax/getProgram')?>',  
        toolbar: "#tb-program",
        title:"Program",
        fitColumns: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        striped: true,
        columns:[[  
            {field:'p_id',title:'Program ID',width:100,sortable:true},  
            {field:'p_name',title:'Program Name',width:300,sortable:true},  
            {field:'p_desc',title:'Program Description',width:300,sortable:true},  
            {field:'p_sys_created_by',title:'Created By',width:100,sortable:true},  
            {field:'p_sys_created_date',title:'Created Date',width:120,align:'center',sortable:true},  
            {field:'p_sys_modified_by',title:'Modified By',width:300,sortable:true},  
            {field:'p_sys_modified_date',title:'Modified Date',width:120,align:'center',sortable:true},  
            {field:'action',title:'Action',width:70,align:'center',sortable:true,
                    formatter: function(value,row,index){
        				if (row.editing){ 
            				var s = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-save'"+'" onclick="saverow(this)">Save</a> ';
            				var c = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-cancel'"+'" onclick="cancelrow(this)">Cancel</a>';
            				return s+c;
            			} else {
            				var e = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-edit'"+'" onclick="editrow(this)">Edit</a> ';
            				var d = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-cut'"+'" onclick="deleterow(this)">Delete</a>';
            				return e+d;
            			}
			         }}
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenuProgram').length){
				createColumnMenuProgram();
			}
			$('#tmenuProgram').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		}
    });
    
    function createColumnMenuProgram(){
		var tmenu = $('<div id="tmenuProgram" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-program').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenu);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-program').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-program').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
    
    //---
    
    // Grid White List
    $('#dg-wl').datagrid({  
        url:'<?=site_url('ajax/getWhiteList')?>',  
        toolbar: "#tb-wl",
        title:"White List",
        fitColumns: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        striped: true,
        columns:[[  
            {field:'w_msisdn',title:'MSISDN',width:100,sortable:true},  
            {field:'w_service_code',title:'Service Code',width:300,sortable:true},  
            {field:'w_is_active',title:'Is Active',width:300,sortable:true},  
            {field:'w_is_url',title:'Is URL',width:100,sortable:true},  
            {field:'p_name',title:'(source) Program',width:120,align:'center',sortable:true},  
            {field:'con_text',title:'(source) Content',width:300,sortable:true},  
            {field:'p_name_dest',title:'(destination) Program',width:120,align:'center',sortable:true},  
            {field:'con_text_dest',title:'(destination) Content',width:120,align:'center',sortable:true},  
            {field:'w_url',title:'URL',width:120,align:'center',sortable:true},  
            {field:'action',title:'Action',width:70,align:'center',sortable:true,
                    formatter: function(value,row,index){
        				if (row.editing){ 
            				var s = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-save'"+'" onclick="saverow(this)">Save</a> ';
            				var c = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-cancel'"+'" onclick="cancelrow(this)">Cancel</a>';
            				return s+c;
            			} else {
            				var e = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-edit'"+'" onclick="editrow(this)">Edit</a> ';
            				var d = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-cut'"+'" onclick="deleterow(this)">Delete</a>';
            				return e+d;
            			}
			         }}
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenuWl').length){
				createColumnMenuWl();
			}
			$('#tmenuWl').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		}
    });
    
    function createColumnMenuWl(){
		var tmenu = $('<div id="tmenuWl" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-wl').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenu);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-wl').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-wl').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
    
    //---
    
    // Grid Uer
    $('#dg-user').datagrid({  
        url:'<?=site_url('ajax/getUser')?>',  
        toolbar: "#tb-user",
        title:"User",
        fitColumns: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        striped: true,
        columns:[[  
            {field:'u_username',title:'User Name',width:100,sortable:true},  
            {field:'u_is_admin',title:'Is Admin',width:300,sortable:true},  
            {field:'u_first_name',title:'First Name',width:300,sortable:true},  
            {field:'u_middle_name',title:'Middle Name',width:100,sortable:true},  
            {field:'u_last_name',title:'Last Name',width:120,align:'center',sortable:true},  
            {field:'u_sys_created_by',title:'Created By',width:300,sortable:true},  
            {field:'u_sys_created_date',title:'Created Date',width:120,align:'center',sortable:true},  
            {field:'u_sys_lastlogin_date',title:'Last Login',width:120,align:'center',sortable:true},  
            {field:'u_sys_modified_by',title:'Modified By',width:300,sortable:true},  
            {field:'u_sys_modified_date',title:'Modified Date',width:120,align:'center',sortable:true},  
            {field:'action',title:'Action',width:70,align:'center',sortable:true,
                    formatter: function(value,row,index){
        				if (row.editing){ 
            				var s = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-save'"+'" onclick="saverow(this)">Save</a> ';
            				var c = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-cancel'"+'" onclick="cancelrow(this)">Cancel</a>';
            				return s+c;
            			} else {
            				var e = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-edit'"+'" onclick="editrow(this)">Edit</a> ';
            				var d = '<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'+"'icon-cut'"+'" onclick="deleterow(this)">Delete</a>';
            				return e+d;
            			}
			         }}
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenuUser').length){
				createColumnMenuUser();
			}
			$('#tmenUser').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		}
    });
    
    function createColumnMenuUser(){
		var tmenu = $('<div id="tmenuUser" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-user').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenu);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-user').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-user').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
    
    //---
    
    // Auto Refresh 10 seconds
    var interval;
    function startRefresh(){
        interval = setInterval(function(){$('#dg-home').datagrid('reload');},10000);
    }
    function stopRefresh(){
        clearInterval(interval);
    }
    
    $('#tab_menu').tabs({
        onSelect:function(title,index){  
            if (index==0){
                startRefresh();
            } else {
                stopRefresh();
            }
        }  
    });  
    
    //--- 
    
    // Add Program
    $('#addProgram').bind('click',function(){
        $('#formProgram').dialog('open').dialog('setTitle','Add New Program');
    });
    
});