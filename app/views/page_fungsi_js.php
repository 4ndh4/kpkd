$(document).ready(function() {
    
    $('#dg-fungsi').datagrid({  
        url:'<?=site_url('ajax/ajaxGetFungsi')?>',
		fitColumns: true,
        striped: true,
        rownumbers: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        columns:[[  
            {field:'kode',title:'Kode',width:40,sortable:true},  
            {field:'nama',title:'Nama',width:500,sortable:true}
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenuFungsi').length){
				createColumnMenuFungsi();
			}
			$('#tmenuFungsi').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		},
        onDblClickRow: function(index,data){
             $('#editFungsi').click();
        }
    });
    
    function createColumnMenuFungsi(){
		var tmenu = $('<div id="tmenuFungsi" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-fungsi').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenuFungsi);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-fungsi').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-fungsi').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
    
    $('#addFungsi').bind('click',function(){
        $('#formFungsi').dialog('open').dialog('setTitle','Tambah Fungsi');
        $('#formFungsi').form('clear');
        $('#typeFungsi').val('add');
        $('#oldValueFungsi').val('');
    });
    
    $('#editFungsi').bind('click',function(){
        var row = $('#dg-fungsi').datagrid('getSelected');
        if (row){
            $('#formFungsi').dialog('open').dialog('setTitle','Edit Fungsi');
			$('#formFungsi').form('load',row);
            $('#typeFungsi').val('edit');
            $('#oldValueFungsi').val(row.kode);
		} else {
            $.messager.alert('Informasi','Silahkan pilih data fungsi yang akan di edit !','info');
		}        
    });
    
    $('#delFungsi').bind('click',function(){
        var row = $('#dg-fungsi').datagrid('getSelected');
		if (row){
            $.messager.confirm('Konfirmasi', 'Anda yakin ingin menghapus data fungsi '+row.kode+' ?', function(r){
            	if (r){
                    $.post('<?=site_url('ajax/ajaxSetFungsi')?>',{type:'delete',kode:row.kode},
                        function(result){
                            var result = eval('('+result+')');
                            if (result.success){
                                $('#dg-fungsi').datagrid('reload');
                                $.messager.show({
                                	title:'Berhasil',
                                	msg:result.msg,
                                	timeout:3000,
                                	showType:'slide'
                                });
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
    
    $('#tombolSaveFungsi').bind('click',function(){
        $('#frmFungsi').form('submit',{
			url: '<?=site_url('ajax/ajaxSetFungsi')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
                console.log(result);
                var result = eval('('+result+')');
                if (result.success){
                    $('#formFungsi').dialog('close');
                    $('#dg-fungsi').datagrid('reload');	
                    $.messager.show({
                    	title:'Berhasil',
                    	msg:result.msg,
                    	timeout:3000,
                    	showType:'slide'
                    });
				} else {
				    $.messager.alert('Informasi',result.msg,'info');
                    $('#kodeFungsi').focus();
                    if (result.msg=='Session Expired'){
                        $.messager.alert('Informasi','Sesi anda telah berakhir !','info');
                        window.location.href = "<?=base_url()?>";
                    }
				}
			}
		});
    });
    
    $('#printFungsi').bind('click',function(){
        $('#windowPrintFungsi').dialog('open').dialog('refresh', 'ajax/ajaxGetFungsi/print'); ;
        //$('#windowPrintFungsi').window('open');
        //$('#windowPrintFungsi').window('refresh','<?=site_url('ajax/ajaxGetFungsi/print')?>');
    });
    
    $('#pdfSaveFungsi').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetFungsi/print/pdf/d')?>";
    });
    
    $('#excelSaveFungsi').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetFungsi/print/excel')?>";
    });
            
});

function cariFungsi(value){
    $('#dg-fungsi').datagrid('reload',{search: value});
}