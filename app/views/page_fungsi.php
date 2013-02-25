<script type="text/javascript" src="<?=site_url('home/js_fungsi')?>"></script>
<div class="mask">Loading...</div>
<table id="dg-fungsi" class="easyui-datagrid" data-options="iconCls:'icon-reload',fit:true,toolbar: '#tb-fungsi',border:false"></table>  
<div id="tb-fungsi">
	<table width="100%" border="0" padding="0">
        <tr>
            <td>
                <a id="addFungsi" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-add'">Add Fungsi</a> |
            	<a id="editFungsi" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-edit'">Edit Fungsi</a> |
            	<a id="delFungsi" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-remove'">Hapus Fungsi</a> |
                <a id="printFungsi" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-print'">Cetak</a> |
                <a id="filterFungsi" class="easyui-splitbutton" data-options="menu:'#pilihanFilterFungsi',iconCls:'icon-filter'">Filter</a>
            </td>
            <td style="text-align: right;">
                <input class="easyui-searchbox" data-options="prompt:'Cari',searcher:cariFungsi"></input>  
            </td>
        </tr>
    </table>
</div>
<div id="pilihanFilterFungsi" style="width:150px;">
	<div id="clearFilterFungsi" data-options="iconCls:'icon-filter-delete'">Clear Filter</div>
</div>
<div id="formFungsi" class="easyui-dialog" data-options="modal:true,closed:true,closable:false" buttons="#tombolFungsi" style="width:500px;height:200px;padding:10px">
	<div class="ftitle">Fungsi</div>
	<form id="frmFungsi" method="post" novalidate>
        <input id="typeFungsi" name="type" type="hidden" value="" />
        <input id="oldValueFungsi" name="old_value" type="hidden" value="" />
        <table style="width: 100%; border=1">
            <tr>
                <td style="width: 20%;">Kode Fungsi</td>
                <td style="width: 80%;"><input id="kodeFungsi" name="kode" style="width: 20px;" class="easyui-validatebox" required="true" maxlength="2"></td>
            </tr>
            <tr>
                <td>Nama Fungsi</td>
                <td><input name="nama" style="width: 100%;" class="easyui-validatebox" required="true"></td>
            </tr>
        </table>
	</form>
</div>
<div id="tombolFungsi" style="text-align: center;">
	<a id="tombolSaveFungsi" class="easyui-linkbutton" iconCls="icon-save" data-options="plain:true">Simpan</a>
	<a class="easyui-linkbutton" iconCls="icon-cancel" data-options="plain:true" onclick="javascript:$('#formFungsi').dialog('close')">Cancel</a>
</div>  
<div id="windowPrintFungsi" class="easyui-dialog" title="&nbsp;Cetak Fungsi" style="width:600px;height:400px;padding:10px;" data-options="toolbar: '#tb-windowPrintFungsi',iconCls:'icon-print-preview',collapsible:false,minimizable:false,maximizable:true,closed:true,modal:true"></div>
<div id="tb-windowPrintFungsi">
	<a id="pdfSaveFungsi" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-pdf'">Save to PDF</a> |
    <a id="excelSaveFungsi" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-excel'">Save to Excel</a>
</div>