$(document).ready(function() {
    
    $('#dg-program').datagrid({  
        url:'<?=site_url('ajax/ajaxGetProgram')?>',
		title:'Program',
        fitColumns: true,
        striped: true,
        rownumbers: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        columns:[[  
            {field:'kode',title:'Kode',width:70,sortable:true},  
            {field:'nama',title:'Nama',width:500,sortable:true},  
            {field:'nama_urusan',title:'Nama Urusan',width:300,sortable:true},  
            {field:'nama_jenis',title:'Jenis Program',width:200,sortable:true}
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
		},
        onDblClickRow: function(index,data){
             $('#editProgram').click();
        }
    });
    
    function createColumnMenuProgram(){
		var tmenu = $('<div id="tmenuProgram" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-program').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenuProgram);
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
    
    $('#skpdProgram2').combobox({
		panelWidth:350,
		panelHeight:300,
		editable: false,
        valueField:'kode',
		textField:'nama',
        url:'<?=site_url('ajax/ajaxGetSkpdList')?>',
	});
       
    $('#skpdProgram').combogrid({
		panelWidth:350,
		panelHeight:300,
		idField:'kode',
		textField:'nama',
		url:'<?=site_url('ajax/ajaxGetSkpd')?>',
        fitColumns: true,
        multiple: false,
        editable: false,
        singleSelect: true,
        pagination: true,
        pageSize: 10,
        striped: true,
        columns:[[
			{field:'kode',title:'Kode',width:80},
			{field:'nama',title:'Nama',width:500}
		]]
	});
       
    $('#urusanProgram').combogrid({
		panelWidth:350,
		panelHeight:300,
		idField:'kode',
		textField:'nama',
		url:'<?=site_url('ajax/ajaxGetUrusan')?>',
        queryParams: {tipe:'S'},
		fitColumns: true,
        multiple: false,
        editable: false,
        singleSelect: false,
        pagination: true,
        pageSize: 30,
        striped: true,
        columns:[[
			{field:'kode',title:'Kode',width:60},
			{field:'nama',title:'Nama',width:500}
		]]
	});
       
    $('#addProgram').bind('click',function(){
        $('#formProgram').dialog('open').dialog('setTitle','Tambah Program');
        $('#formProgram').form('clear');
        $('#typeProgram').val('add');
        $('#oldValueProgram').val('');
        $('#tipeProgram').combobox('setValue','1');
        $('#urusanProgram').combogrid('clear'); 
    });
    
    $('#editProgram').bind('click',function(){
        var row = $('#dg-program').datagrid('getSelected');
        if (row){
            $('#formProgram').dialog('open').dialog('setTitle','Edit Program');
			$('#formProgram').form('load',row);
            $('#typeProgram').val('edit');
            $('#oldValueProgram').val(row.kode);
		} else {
            $.messager.alert('Informasi','Silahkan pilih data program yang akan di edit !','info');
		}        
    });
    
    $('#delProgram').bind('click',function(){
        var row = $('#dg-program').datagrid('getSelected');
		if (row){
            $.messager.confirm('Konfirmasi', 'Anda yakin ingin menghapus data program '+row.kode+' ?', function(r){
            	if (r){
                    $.post('<?=site_url('ajax/ajaxSetProgram')?>',{type:'delete',kode:row.kode},
                        function(result){
                            var result = eval('('+result+')');
                            if (result.success){
                                $('#dg-program').datagrid('reload');
                                $.messager.show({
                                	title:'Berhasil',
                                	msg:result.msg,
                                	timeout:3000,
                                	showType:'slide'
                                });
                                $('#headerProgram').combobox('reload');
                            } else {
                                $.messager.alert('Informasi',result.msg,'info');
                                if (result.msg=='Session Expired'){
                                    $.messager.alert('Informasi','Sesi anda telah berakhir !','info');
                                    window.location.href = "<?=base_url()?>";
                                }
                            }
					});
				}
            });
		} else { 
            $.messager.alert('Informasi','Silahkan pilih data yang akan di Remove !','info');
		}
    });
    
    $('#tombolSaveProgram').bind('click',function(){
        $('#frmProgram').form('submit',{
			url: '<?=site_url('ajax/ajaxSetProgram')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
                console.log(result);
                var result = eval('('+result+')');
                if (result.success){
                    $('#formProgram').dialog('close');
                    $('#dg-program').datagrid('reload');	
                    $.messager.show({
                    	title:'Berhasil',
                    	msg:result.msg,
                    	timeout:3000,
                    	showType:'slide'
                    });
                    $('#headerProgram').combobox('reload');
				} else {
				    $.messager.alert('Informasi',result.msg,'info');
                    $('#kodeProgram').focus();
                    if (result.msg=='Session Expired'){
                        $.messager.alert('Informasi','Sesi anda telah berakhir !','info');
                        window.location.href = "<?=base_url()?>";
                    }
				}
			}
		});
    });
    
    $('#printProgram').bind('click',function(){
        $('#windowPrintProgram').dialog('open').dialog('refresh', 'ajax/ajaxGetProgram/print'); ;
        //$('#windowPrintProgram').window('open');
        //$('#windowPrintProgram').window('refresh','<?=site_url('ajax/ajaxGetProgram/print')?>');
    });
    
    $('#pdfSaveProgram').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetProgram/print/pdf/d')?>";
    });
    
    $('#excelSaveProgram').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetProgram/print/excel')?>";
    });
                
});

function cariProgram(value){
    $('#dg-program').datagrid('reload',{search: value});
}