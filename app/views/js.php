$(document).ready(function() {
    
    // TreeGrid Master Tabel
    $('#tg-master').treegrid({
		fit: true,
		url:'<?=site_url('ajax/ajaxGetMenu/01')?>',
		border: false,
        fitColumns: true,
        idField:'kode',
		treeField:'nama',
		columns:[[
			{field:'kode',title:'kode',hidden:true},
			{field:'nama',title:'Menu',width:500}
		]],
        onClickRow: function(row){
            if ($('#tab-content').tabs('exists',row.nama)){
				$('#tab-content').tabs('select',row.nama);
			} else {
				$('#tab-content').tabs('add',{
					title:row.nama,
                    border: true,
					href:'<?=site_url('home')?>'+'/page_'+row.page,
					closable:true
				});
			}
        }
	});
    
    $('#tab-content').tabs({
        onLoad: function(panel){
            $('.mask').hide();
        },
        onBeforeClose: function(title,index){
            var target = this;
            $.messager.confirm('Confirm','Are you sure you want to close tab '+title,function(r){
            	if (r){
            		var opts = $(target).tabs('options');
            		var bc = opts.onBeforeClose;
            		opts.onBeforeClose = function(){};  
                		$(target).tabs('close',index);
                		opts.onBeforeClose = bc;
            	}
            });
            return false;
        }
    });
    
    // Themes
    $('#themes').combobox({
		onSelect: function(){ 
            var theme = $(this).combobox('getValues');
		    var url = '<?=$themes_url?>'+'/'+theme+'/easyui.css';  
            var link = $('head').find('link:first');
            link.attr('href', url);
        }  
	});
            
});