<div class="mask">Loading...</div>
<div class="easyui-panel" fit="true" title="Rekening" border="true" collapsible="true">
    <table id="dg-rekening" class="easyui-datagrid" data-options="iconCls:'icon-reload',fit:true,toolbar: '#tb-rekening',border:false"></table>
</div>
<div id="tb-rekening">
    <table width="100%" border="0" padding="0">
        <tr>
            <td>
                <a id="addRekening" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-add'">Add Rekening</a> |
            	<a id="editRekening" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-edit'">Edit Rekening</a> |
            	<a id="delRekening" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-remove'">Hapus Rekening</a> |
                <a id="printRekening" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-print'">Cetak</a> |
                <a id="filterRekening" class="easyui-splitbutton" data-options="menu:'#pilihanFilterRekening',iconCls:'icon-filter'">Filter</a>
            </td>
            <td style="text-align: right;">
                <input class="easyui-searchbox" data-options="prompt:'Cari',searcher:cariRekening"></input>  
            </td>
        </tr>
    </table>            	
</div>
<div id="pilihanFilterRekening" style="width:150px;">
	<div id="clearFilterRekening" data-options="iconCls:'icon-filter-delete'">Clear Filter</div>
</div>
<div id="formRekening" class="easyui-dialog" data-options="modal:true,closed:true,closable:false" buttons="#tombolRekening" style="width:500px;height:270px;padding:10px">
	<div class="ftitle">Rekening</div>
	<form id="frmRekening" method="post" novalidate>
        <input id="typeRekening" name="type" type="hidden" value="" />
        <input id="oldValueRekening" name="old_value" type="hidden" value="" />
        <table style="width: 100%; border=1">
            <tr>
                <td style="width: 20%;">Kode rekening</td>
                <td style="width: 80%;"><input id="kodeRekening" name="kode" style="width: 70px;" class="easyui-validatebox" required="true" maxlength="7"></td>
            </tr>
            <tr>
                <td>Nama rekening</td>
                <td><input name="nama" style="width: 100%;" class="easyui-validatebox" required="true"></td>
            </tr>
            <tr>
                <td>Tipe rekening</td>
                <td><select id="tipeRekening" name="tipe" style="width:100%" class="easyui-combobox" panelHeight="50" editable="false">
						<option value="H">Header</option>  
						<option value="S">Sub Header</option>
					</select>
                </td>
            </tr>
            <tr>
                <td>Header</td>
                <td><select id="headerRekening" name="header" class="easyui-combobox"style="width: 350px;"></td>
            </tr>
        </table>
	</form>
</div>
<div id="tombolRekening" style="text-align: center;">
	<a id="tombolSaveRekening" class="easyui-linkbutton" iconCls="icon-save" data-options="plain:true">Simpan</a>
	<a class="easyui-linkbutton" iconCls="icon-cancel" data-options="plain:true" onclick="javascript:$('#formRekening').dialog('close')">Cancel</a>
</div> 
<div id="windowPrintRekening" class="easyui-dialog" title="&nbsp;Cetak Rekening" style="width:1000px;height:700px;padding:10px;" data-options="toolbar: '#tb-windowPrintRekening',iconCls:'icon-print-preview',collapsible:false,minimizable:false,maximizable:true,closed:true,modal:true"></div>
<div id="tb-windowPrintRekening">
	<a id="pdfSaveRekening" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-pdf'">Save to PDF</a> |
    <a id="excelSaveRekening" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-excel'">Save to Excel</a>
</div>
<script type="text/javascript" src="<?=$js;?>jquery.easyui.min.js"></script>  
<script type="text/javascript" src="<?=site_url('home/js_rekening')?>"></script>