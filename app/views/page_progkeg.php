<script type="text/javascript" src="<?=site_url('home/js_progkeg')?>"></script>
<div class="mask">Loading...</div>
<div class="easyui-layout" fit="true" border="false">
    <div region="north" split="true" border="false" style="height:350px;padding:0px;">
        <div style="padding:8px;">
            SKPD : <select id="skpdProgram" class="easyui-combogrid" style="width:350px;"></select>
        </div>     
        <table id="dg-program" class="easyui-datagrid" data-options="fit:true,toolbar: '#tb-program',border:false"></table>  
        <div id="tb-program">
            <table width="100%" border="0" padding="0">
                <tr>
                    <td>
                        <a id="addProgram" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-add'">Add Program</a> |
                    	<a id="editProgram" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-edit'">Edit Program</a> |
                    	<a id="delProgram" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-remove'">Hapus Program</a> |
                        <a id="printProgram" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-print'">Cetak</a> |
                        <a id="filterProgram" class="easyui-splitbutton" data-options="menu:'#pilihanFilterProgram',iconCls:'icon-filter'">Filter</a>
                    </td>
                    <td style="text-align: right;">
                        <input class="easyui-searchbox" data-options="prompt:'Cari',searcher:cariProgram"></input>  
                    </td>
                </tr>
            </table>            	
        </div>
        <div id="pilihanFilterProgram" style="width:150px;">
        	<div id="clearFilterProgram" data-options="iconCls:'icon-filter-delete'">Clear Filter</div>
        </div>
        <div id="formProgram" class="easyui-dialog" data-options="modal:true,closed:true,closable:false" buttons="#tombolProgram" style="width:500px;height:270px;padding:10px">
        	<div class="ftitle">Program</div>
        	<form id="frmProgram" method="post" novalidate>
                <input id="typeProgram" name="type" type="hidden" value="" />
                <input id="oldValueProgram" name="old_value" type="hidden" value="" />
                <input id="skpdProgram" name="skpd" type="hidden" value="" />
                <table style="width: 100%; border=1">
                    <tr>
                        <td style="width: 20%;">Kode program</td>
                        <td style="width: 80%;"><input id="kodeProgram" name="kode" style="width: 30px;" class="easyui-validatebox" required="true" maxlength="2"></td>
                    </tr>
                    <tr>
                        <td>Nama program</td>
                        <td><input name="nama" style="width: 100%;" class="easyui-validatebox" required="true"></td>
                    </tr>
                    <tr>
                        <td>Urusan</td>
                        <td><select id="urusanProgram" class="easyui-combogrid" name="urusan" style="width:350px;"></select></td>
                    </tr>
                    <tr>
                        <td>Jenis Program</td>
                        <td><select id="jenisProgram" name="jenis" style="width:150px" class="easyui-combobox" panelHeight="50" editable="false">
        						<option value="1">Tidak Langsung</option>  
        						<option value="2">Langsung</option>
        					</select>
                        </td>
                    </tr>
                </table>
        	</form>
        </div>
        <div id="tombolProgram" style="text-align: center;">
        	<a id="tombolSaveProgram" class="easyui-linkbutton" iconCls="icon-save" data-options="plain:true">Simpan</a>
        	<a class="easyui-linkbutton" iconCls="icon-cancel" data-options="plain:true" onclick="javascript:$('#formProgram').dialog('close')">Cancel</a>
        </div> 
        <div id="windowPrintProgram" class="easyui-dialog" title="&nbsp;Cetak Program" style="width:1000px;height:700px;padding:10px;" data-options="toolbar: '#tb-windowPrintProgram',iconCls:'icon-print-preview',collapsible:false,minimizable:false,maximizable:true,closed:true,modal:true"></div>
        <div id="tb-windowPrintProgram">
        	<a id="pdfSaveProgram" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-pdf'">Save to PDF</a> |
            <a id="excelSaveProgram" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-excel'">Save to Excel</a>
        </div>
    </div>
    <div region="center" split="true" border="false" style="padding:0px;" >
    
    </div>
</div>



    
