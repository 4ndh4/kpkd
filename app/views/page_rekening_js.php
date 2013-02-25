$(document).ready(function() {
    
    $('#dg-rekening').datagrid({  
        url:'<?=site_url('ajax/ajaxGetRekening')?>',
        fit: true,
		fitColumns: true,
        striped: true,
        rownumbers: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        columns:[[  
            {field:'kode',title:'Kode',width:70,sortable:true},  
            {field:'nama',title:'Nama',width:500,sortable:true},  
            {field:'nama_tipe',title:'Tipe',width:100,sortable:true},  
            {field:'header',title:'Header',width:70,sortable:true},  
            {field:'nama_header',title:'Nama Header',width:400,sortable:true}
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenuRekening').length){
				createColumnMenuRekening();
			}
			$('#tmenuRekening').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		},
        onDblClickRow: function(index,data){
             $('#editRekening').click();
        }
    });
    
    function createColumnMenuRekening(){
		var tmenu = $('<div id="tmenuRekening" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-rekening').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenuRekening);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-rekening').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-rekening').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
    
    $('#headerRekening').combobox({
		url:'<?=site_url('ajax/ajaxGetRekeningHeader')?>',
        panelHeight: 150,
		editable:false,
		valueField:'kode',
		textField:'nama'
	});
    
    $('#fungsiRekening').combobox({
		url:'<?=site_url('ajax/ajaxGetFungsiList')?>',
        editable:false,
		valueField:'kode',
		textField:'nama'
	});
    
    $('#addRekening').bind('click',function(){
        $('#formRekening').dialog('open').dialog('setTitle','Tambah Rekening');
        $('#formRekening').form('clear');
        $('#typeRekening').val('add');
        $('#oldValueRekening').val('');
        $('#tipeRekening').combobox('setValue','S');
    });
    
    $('#editRekening').bind('click',function(){
        var row = $('#dg-rekening').datagrid('getSelected');
        if (row){
            $('#formRekening').dialog('open').dialog('setTitle','Edit Rekening');
			$('#formRekening').form('load',row);
            $('#typeRekening').val('edit');
            $('#oldValueRekening').val(row.kode);
		} else {
            $.messager.alert('Informasi','Silahkan pilih data rekening yang akan di edit !','info');
		}        
    });
    
    $('#delRekening').bind('click',function(){
        var row = $('#dg-rekening').datagrid('getSelected');
		if (row){
            $.messager.confirm('Konfirmasi', 'Anda yakin ingin menghapus data rekening '+row.kode+' ?', function(r){
            	if (r){
                    $.post('<?=site_url('ajax/ajaxSetRekening')?>',{type:'delete',kode:row.kode},
                        function(result){
                            var result = eval('('+result+')');
                            if (result.success){
                                $('#dg-rekening').datagrid('reload');
                                $.messager.show({
                                	title:'Berhasil',
                                	msg:result.msg,
                                	timeout:3000,
                                	showType:'slide'
                                });
                                $('#headerRekening').combobox('reload');
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
    
    $('#tombolSaveRekening').bind('click',function(){
        $('#frmRekening').form('submit',{
			url: '<?=site_url('ajax/ajaxSetRekening')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
                console.log(result);
                var result = eval('('+result+')');
                if (result.success){
                    $('#formRekening').dialog('close');
                    $('#dg-rekening').datagrid('reload');	
                    $.messager.show({
                    	title:'Berhasil',
                    	msg:result.msg,
                    	timeout:3000,
                    	showType:'slide'
                    });
                    $('#headerRekening').combobox('reload');
				} else {
				    $.messager.alert('Informasi',result.msg,'info');
                    $('#kodeRekening').focus();
                    if (result.msg=='Session Expired'){
                        $.messager.alert('Informasi','Sesi anda telah berakhir !','info');
                        window.location.href = "<?=base_url()?>";
                    }
				}
			}
		});
    });
    
    $('#printRekening').bind('click',function(){
        $('#windowPrintRekening').dialog('open').dialog('refresh', 'ajax/ajaxGetRekening/print'); ;
        //$('#windowPrintRekening').window('open');
        //$('#windowPrintRekening').window('refresh','<?=site_url('ajax/ajaxGetRekening/print')?>');
    });
    
    $('#pdfSaveRekening').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetRekening/print/pdf/d')?>";
    });
    
    $('#excelSaveRekening').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetRekening/print/excel')?>";
    });
                
});

function cariRekening(value){
    $('#dg-rekening').datagrid('reload',{search: value});
}