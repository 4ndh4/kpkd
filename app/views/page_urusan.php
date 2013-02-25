<script type="text/javascript" src="<?=site_url('home/js_urusan')?>"></script>
<div class="mask">Loading...</div>
<table id="dg-urusan" class="easyui-datagrid" data-options="iconCls:'icon-reload',fit:true,toolbar: '#tb-urusan',border:false"></table>  
<div id="tb-urusan">
    <table width="100%" border="0" padding="0">
        <tr>
            <td>
                <a id="addUrusan" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-add'">Add Urusan</a> |
            	<a id="editUrusan" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-edit'">Edit Urusan</a> |
            	<a id="delUrusan" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-remove'">Hapus Urusan</a> |
                <a id="printUrusan" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-print'">Cetak</a> |
                <a id="filterUrusan" class="easyui-splitbutton" data-options="menu:'#pilihanFilterUrusan',iconCls:'icon-filter'">Filter</a>
            </td>
            <td style="text-align: right;">
                <input class="easyui-searchbox" data-options="prompt:'Cari',searcher:cariUrusan"></input>  
            </td>
        </tr>
    </table>            	
</div>
<div id="pilihanFilterUrusan" style="width:150px;">
	<div id="clearFilterUrusan" data-options="iconCls:'icon-filter-delete'">Clear Filter</div>
</div>
<div id="formUrusan" class="easyui-dialog" data-options="modal:true,closed:true,closable:false" buttons="#tombolUrusan" style="width:500px;height:270px;padding:10px">
	<div class="ftitle">Urusan</div>
	<form id="frmUrusan" method="post" novalidate>
        <input id="typeUrusan" name="type" type="hidden" value="" />
        <input id="oldValueUrusan" name="old_value" type="hidden" value="" />
        <table style="width: 100%; border=1">
            <tr>
                <td style="width: 20%;">Kode urusan</td>
                <td style="width: 80%;"><input id="kodeUrusan" name="kode" style="width: 30px;" class="easyui-validatebox" required="true" maxlength="3"></td>
            </tr>
            <tr>
                <td>Nama urusan</td>
                <td><input name="nama" style="width: 100%;" class="easyui-validatebox" required="true"></td>
            </tr>
            <tr>
                <td>Tipe urusan</td>
                <td><select id="tipeUrusan" name="tipe" style="width:100%" class="easyui-combobox" panelHeight="50" editable="false">
						<option value="H">Header</option>  
						<option value="S">Sub Header</option>
					</select>
                </td>
            </tr>
            <tr>
                <td>Header</td>
                <td><select id="headerUrusan" name="header" class="easyui-combobox"style="width: 350px;"></td>
            </tr>
            <tr>
                <td>Fungsi</td>
                <td><select id="fungsiUrusan" name="fungsi" class="easyui-combobox"style="width: 350px;"></td>
            </tr>
        </table>
	</form>
</div>
<div id="tombolUrusan" style="text-align: center;">
	<a id="tombolSaveUrusan" class="easyui-linkbutton" iconCls="icon-save" data-options="plain:true">Simpan</a>
	<a class="easyui-linkbutton" iconCls="icon-cancel" data-options="plain:true" onclick="javascript:$('#formUrusan').dialog('close')">Cancel</a>
</div> 
<div id="windowPrintUrusan" class="easyui-dialog" title="&nbsp;Cetak Urusan" style="width:1000px;height:700px;padding:10px;" data-options="toolbar: '#tb-windowPrintUrusan',iconCls:'icon-print-preview',collapsible:false,minimizable:false,maximizable:true,closed:true,modal:true"></div>
<div id="tb-windowPrintUrusan">
	<a id="pdfSaveUrusan" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-pdf'">Save to PDF</a> |
    <a id="excelSaveUrusan" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-excel'">Save to Excel</a>
</div>