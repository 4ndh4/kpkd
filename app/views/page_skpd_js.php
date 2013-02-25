$(document).ready(function() {
    
    $('#dg-skpd').datagrid({  
        url:'<?=site_url('ajax/ajaxGetSkpd')?>',
		fitColumns: true,
        striped: true,
        rownumbers: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        columns:[[  
            {field:'kode',title:'Kode',width:100,sortable:true},  
            {field:'nama',title:'Nama',width:500,sortable:true},  
            {field:'nama_pa',title:'Nama PA',width:200,sortable:true},  
            {field:'alamat',title:'Alamat',width:300,sortable:true}
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenuSkpd').length){
				createColumnMenuSkpd();
			}
			$('#tmenuSkpd').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		},
        onDblClickRow: function(index,data){
             $('#editSkpd').click();
        }
    });
    
    function createColumnMenuSkpd(){
		var tmenu = $('<div id="tmenuSkpd" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-skpd').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenuSkpd);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-skpd').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-skpd').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
    
    $('#addSkpd').bind('click',function(){
        $('#formSkpd').dialog('open').dialog('setTitle','Tambah Skpd');
        $('#formSkpd').form('clear');
        $('#typeSkpd').val('add');
        $('#oldValueSkpd').val('');
        $('#tab-skpd').tabs('select',0);
        $('#urusanSKPD').combogrid('clear'); 
        $('#urusan_skpd').val('');       
    });
    
    $('#editSkpd').bind('click',function(){
        var row = $('#dg-skpd').datagrid('getSelected');
        if (row){
            $('#formSkpd').dialog('open').dialog('setTitle','Edit Skpd');
			$('#formSkpd').form('load',row);
            $('#typeSkpd').val('edit');
            $('#oldValueSkpd').val(row.kode);
            $('#tab-skpd').tabs('select',0);
            $.post('<?=site_url('ajax/ajaxGetUrusanSkpd')?>',{skpd:row.kode},
                function(result){
                    var result = eval('('+result+')');
                    if (result.success)
                        $('#urusanSKPD').combogrid('setValues',result.data); 
                    else {
                        $('#urusanSKPD').combogrid('clear');
                    } 
			});
		} else {
            $.messager.alert('Informasi','Silahkan pilih data skpd yang akan di edit !','info');
		}        
    });
    
    $('#delSkpd').bind('click',function(){
        var row = $('#dg-skpd').datagrid('getSelected');
		if (row){
            $.messager.confirm('Konfirmasi', 'Anda yakin ingin menghapus data skpd '+row.kode+' ?', function(r){
            	if (r){
                    $.post('<?=site_url('ajax/ajaxSetSkpd')?>',{type:'delete',kode:row.kode},
                        function(result){
                            var result = eval('('+result+')');
                            if (result.success){
                                $('#dg-skpd').datagrid('reload');
                                $.messager.show({
                                	title:'Berhasil',
                                	msg:result.msg,
                                	timeout:3000,
                                	showType:'slide'
                                });
                                $('#headerSkpd').combobox('reload');
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
    
    $('#tombolSaveSkpd').bind('click',function(){
        var urusan = $('#urusanSKPD').combogrid('getValues');
        $('#urusan_skpd').val(urusan);
        $('#frmSkpd').form('submit',{
			url: '<?=site_url('ajax/ajaxSetSkpd')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
                console.log(result);
                var result = eval('('+result+')');
                if (result.success){
                    $('#formSkpd').dialog('close');
                    $('#dg-skpd').datagrid('reload');	
                    $.messager.show({
                    	title:'Berhasil',
                    	msg:result.msg,
                    	timeout:3000,
                    	showType:'slide'
                    });
                    $('#headerSkpd').combobox('reload');
				} else {
				    $.messager.alert('Informasi',result.msg,'info');
                    $('#kodeSkpd').focus();
                    if (result.msg=='Session Expired'){
                        $.messager.alert('Informasi','Sesi anda telah berakhir !','info');
                        window.location.href = "<?=base_url()?>";
                    }
				}
			}
		});
    });
    
    $('#printSkpd').bind('click',function(){
        $('#windowPrintSkpd').dialog('open').dialog('refresh', 'ajax/ajaxGetSkpd/print'); ;
        //$('#windowPrintSkpd').window('open');
        //$('#windowPrintSkpd').window('refresh','<?=site_url('ajax/ajaxGetSkpd/print')?>');
    });
    
    $('#pdfSaveSkpd').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetSkpd/print/pdf/d')?>";
    });
    
    $('#excelSaveSkpd').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetSkpd/print/excel')?>";
    });
    
    $('#dg-urusan-skpd').datagrid({  
        url:'',
		fitColumns: true,
        striped: true,
        rownumbers: true,
        singleSelect: true,
        pageSize: 20,
        columns:[[  
            {field:'kode',title:'Kode',width:40,sortable:true},  
            {field:'nama',title:'Nama',width:500,sortable:true}
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenuUrusanSkpd').length){
				createColumnMenuUrusanSkpd();
			}
			$('#tmenuUrusanSkpd').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		}
    });
    
    function createColumnMenuUrusanSkpd(){
		var tmenu = $('<div id="tmenuUrusanSkpd" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-urusan-skpd').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenuUrusanSkpd);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-urusan-skpd').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-urusan-skpd').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
    
    $('#urusanSKPD').combogrid({
		panelWidth:550,
		panelHeight:300,
		idField:'kode',
		textField:'nama',
		url:'<?=site_url('ajax/ajaxGetUrusan')?>',
        queryParams: {tipe:'S'},
		fitColumns: true,
        multiple: true,
        editable: false,
        singleSelect: false,
        pagination: true,
        pageSize: 30,
        striped: true,
        columns:[[
			{field:'kode',title:'Kode',width:40},
			{field:'nama',title:'Nama',width:500}
		]]
	});
                   
});

function cariSkpd(value){
    $('#dg-skpd').datagrid('reload',{search: value});
}