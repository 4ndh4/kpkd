$(document).ready(function() {
    
    $('#dg-urusan').datagrid({  
        url:'<?=site_url('ajax/ajaxGetUrusan')?>',
		fitColumns: true,
        striped: true,
        rownumbers: true,
        singleSelect: true,
        pagination: true,
        pageSize: 30,
        columns:[[  
            {field:'kode',title:'Kode',width:50,sortable:true},  
            {field:'nama',title:'Nama',width:500,sortable:true},  
            {field:'nama_tipe',title:'Tipe',width:100,sortable:true},  
            {field:'nama_header',title:'Header',width:200,sortable:true},  
            {field:'nama_fungsi',title:'Fungsi',width:200,sortable:true}
        ]],
		onHeaderContextMenu: function(e, field){
			e.preventDefault();
			if (!$('#tmenuUrusan').length){
				createColumnMenuUrusan();
			}
			$('#tmenuUrusan').menu('show', {
				left:e.pageX,
				top:e.pageY
			});
		},
        onDblClickRow: function(index,data){
             $('#editUrusan').click();
        }
    });
    
    function createColumnMenuUrusan(){
		var tmenu = $('<div id="tmenuUrusan" style="width:100px;"></div>').appendTo('body');
		var fields = $('#dg-urusan').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			$('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenuUrusan);
		}
		tmenu.menu({
			onClick: function(item){
				if (item.iconCls=='icon-ok'){
					$('#dg-urusan').datagrid('hideColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg-urusan').datagrid('showColumn', item.text);
					tmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
    }
    
    $('#headerUrusan').combobox({
		url:'<?=site_url('ajax/ajaxGetUrusanHeader')?>',
        panelHeight: 50,
		editable:false,
		valueField:'kode',
		textField:'nama'
	});
    
    $('#fungsiUrusan').combobox({
		url:'<?=site_url('ajax/ajaxGetFungsiList')?>',
        editable:false,
		valueField:'kode',
		textField:'nama'
	});
    
    $('#addUrusan').bind('click',function(){
        $('#formUrusan').dialog('open').dialog('setTitle','Tambah Urusan');
        $('#formUrusan').form('clear');
        $('#typeUrusan').val('add');
        $('#oldValueUrusan').val('');
        $('#tipeUrusan').combobox('setValue','S');
    });
    
    $('#editUrusan').bind('click',function(){
        var row = $('#dg-urusan').datagrid('getSelected');
        if (row){
            $('#formUrusan').dialog('open').dialog('setTitle','Edit Urusan');
			$('#formUrusan').form('load',row);
            $('#typeUrusan').val('edit');
            $('#oldValueUrusan').val(row.kode);
		} else {
            $.messager.alert('Informasi','Silahkan pilih data urusan yang akan di edit !','info');
		}        
    });
    
    $('#delUrusan').bind('click',function(){
        var row = $('#dg-urusan').datagrid('getSelected');
		if (row){
            $.messager.confirm('Konfirmasi', 'Anda yakin ingin menghapus data urusan '+row.kode+' ?', function(r){
            	if (r){
                    $.post('<?=site_url('ajax/ajaxSetUrusan')?>',{type:'delete',kode:row.kode},
                        function(result){
                            var result = eval('('+result+')');
                            if (result.success){
                                $('#dg-urusan').datagrid('reload');
                                $.messager.show({
                                	title:'Berhasil',
                                	msg:result.msg,
                                	timeout:3000,
                                	showType:'slide'
                                });
                                $('#headerUrusan').combobox('reload');
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
    
    $('#tombolSaveUrusan').bind('click',function(){
        $('#frmUrusan').form('submit',{
			url: '<?=site_url('ajax/ajaxSetUrusan')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
                console.log(result);
                var result = eval('('+result+')');
                if (result.success){
                    $('#formUrusan').dialog('close');
                    $('#dg-urusan').datagrid('reload');	
                    $.messager.show({
                    	title:'Berhasil',
                    	msg:result.msg,
                    	timeout:3000,
                    	showType:'slide'
                    });
                    $('#headerUrusan').combobox('reload');
				} else {
				    $.messager.alert('Informasi',result.msg,'info');
                    $('#kodeUrusan').focus();
                    if (result.msg=='Session Expired'){
                        $.messager.alert('Informasi','Sesi anda telah berakhir !','info');
                        window.location.href = "<?=base_url()?>";
                    }
				}
			}
		});
    });
    
    $('#printUrusan').bind('click',function(){
        $('#windowPrintUrusan').dialog('open').dialog('refresh', 'ajax/ajaxGetUrusan/print'); ;
        //$('#windowPrintUrusan').window('open');
        //$('#windowPrintUrusan').window('refresh','<?=site_url('ajax/ajaxGetUrusan/print')?>');
    });
    
    $('#pdfSaveUrusan').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetUrusan/print/pdf/d')?>";
    });
    
    $('#excelSaveUrusan').bind('click',function(){
        window.location.href = "<?=site_url('ajax/ajaxGetUrusan/print/excel')?>";
    });
                
});

function cariUrusan(value){
    $('#dg-urusan').datagrid('reload',{search: value});
}