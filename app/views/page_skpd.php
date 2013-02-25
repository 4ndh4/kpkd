<script type="text/javascript" src="<?=site_url('home/js_skpd')?>"></script>
<div class="mask">Loading...</div>
<table id="dg-skpd" class="easyui-datagrid" data-options="iconCls:'icon-reload',fit:true,toolbar: '#tb-skpd',border:false"></table>  
<div id="tb-skpd">
    <table width="100%" border="0" padding="0">
        <tr>
            <td>
                <a id="addSkpd" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-add'">Add Skpd</a> |
            	<a id="editSkpd" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-edit'">Edit Skpd</a> |
            	<a id="delSkpd" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-remove'">Hapus Skpd</a> |
                <a id="printSkpd" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-print'">Cetak</a> |
                <a id="filterSkpd" class="easyui-splitbutton" data-options="menu:'#pilihanFilterSkpd',iconCls:'icon-filter'">Filter</a>
            </td>
            <td style="text-align: right;">
                <input class="easyui-searchbox" data-options="prompt:'Cari',searcher:cariSkpd"></input>  
            </td>
        </tr>
    </table>            	
</div>
<div id="pilihanFilterSkpd" style="width:150px;">
	<div id="clearFilterSkpd" data-options="iconCls:'icon-filter-delete'">Clear Filter</div>
</div>
<div id="formSkpd" class="easyui-dialog" data-options="modal:true,closed:true,closable:false" buttons="#tombolSkpd" style="width:710px;height:500px;padding:10px">
	<div class="ftitle">Skpd</div>
	<form id="frmSkpd" method="post" novalidate>
        <input id="typeSkpd" name="type" type="hidden" value="" />
        <input id="oldValueSkpd" name="old_value" type="hidden" value="" />
        <input id="urusan_skpd" name="urusan_skpd" type="hidden" value="" />
        <table style="width: 100%; border=1">
            <tr>
                <td style="width: 15%;">Kode skpd</td>
                <td style="width: 85%;"><input id="kodeSkpd" name="kode" style="width: 70px;" class="easyui-validatebox" required="true" maxlength="7"></td>
            </tr>
            <tr>
                <td>Nama Skpd</td>
                <td><input name="nama" style="width: 100%;" class="easyui-validatebox" required="true"></td>
            </tr>   
            <tr>
                <td>Urusan Skpd</td>
                <td><select id="urusanSKPD" class="easyui-combogrid" name="urusan" style="width:550px;"></select></td>
            </tr> 
            <tr style="vertical-align: top;">
                <td>Alamat Skpd</td>
                <td><textarea name="alamat" cols="20" rows="3" style="width: 100%;"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="easyui-panel" collapsible="false" style="padding:0px;width:670px" border="false">
                        <div id="tab-skpd" class="easyui-tabs">
                            <div title="Pengguna Anggaran" style="padding:15px;overflow:hidden;"> 
                                <table style="width: 100%; border=1">
                                    <tr>
                                        <td style="width: 15%;">Nama</td>
                                        <td style="width: 85%;"><input name="nama_pa" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td><input name="jabatan_pa" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Pangkat</td>
                                        <td><input name="pangkat_pa" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Nip</td>
                                        <td><input name="nip_pa" style="width: 200px;" class="easyui-validatebox" maxlength="21"></td>
                                    </tr>
                                </table>
                            </div>
                            <div title="PPK" style="padding:15px;overflow:hidden;"> 
                                <table style="width: 100%; border=1">
                                    <tr>
                                        <td style="width: 15%;">Nama</td>
                                        <td style="width: 85%;"><input name="nama_ppk" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td><input name="jabatan_ppk" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Pangkat</td>
                                        <td><input name="pangkat_ppk" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Nip</td>
                                        <td><input name="nip_ppk" style="width: 200px;" class="easyui-validatebox" maxlength="21"></td>
                                    </tr>
                                </table>
                            </div>
                            <div title="Bendahara Pengeluaran" style="padding:15px;overflow:hidden;"> 
                                <table style="width: 100%; border=1">
                                    <tr>
                                        <td style="width: 15%;">Nama</td>
                                        <td style="width: 85%;"><input name="nama_bendout" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td><input name="jabatan_bendout" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Pangkat</td>
                                        <td><input name="pangkat_bendout" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Nip</td>
                                        <td><input name="nip_bendout" style="width: 200px;" class="easyui-validatebox" maxlength="21"></td>
                                    </tr>
                                </table>
                            </div>
                            <div title="Bendahara Penerimaan" style="padding:15px;overflow:hidden;"> 
                                <table style="width: 100%; border=1">
                                    <tr>
                                        <td style="width: 15%;">Nama</td>
                                        <td style="width: 85%;"><input name="nama_bendin" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td><input name="jabatan_bendin" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Pangkat</td>
                                        <td><input name="pangkat_bendin" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Nip</td>
                                        <td><input name="nip_bendin" style="width: 200px;" class="easyui-validatebox" maxlength="21"></td>
                                    </tr>
                                </table>
                            </div>
                            <div title="Bank, Rekening, Npwp" style="padding:15px;overflow:hidden;"> 
                                <table style="width: 100%; border=1">
                                    <tr>
                                        <td style="width: 15%;">Bank Skpd</td>
                                        <td style="width: 85%;"><input name="bank" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Rekening Skpd</td>
                                        <td><input name="rekening" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>NPWP skpd</td>
                                        <td><input name="npwp" style="width: 100%;" class="easyui-validatebox"></td>
                                    </tr>
                                    <tr>
                                        <td>Singkatan</td>
                                        <td><input name="singkatan" style="width: 50px;" class="easyui-validatebox" maxlength="4"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>  
        </table>
	</form>
</div>
<div id="tombolSkpd" style="text-align: center;">
	<a id="tombolSaveSkpd" class="easyui-linkbutton" iconCls="icon-save" data-options="plain:true">Simpan</a>
	<a class="easyui-linkbutton" iconCls="icon-cancel" data-options="plain:true" onclick="javascript:$('#formSkpd').dialog('close')">Cancel</a>
</div> 
<div id="windowPrintSkpd" class="easyui-dialog" title="&nbsp;Cetak Skpd" style="width:1000px;height:700px;padding:10px;" data-options="toolbar: '#tb-windowPrintSkpd',iconCls:'icon-print-preview',collapsible:false,minimizable:false,maximizable:true,closed:true,modal:true"></div>
<div id="tb-windowPrintSkpd">
	<a id="pdfSaveSkpd" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-pdf'">Save to PDF</a> |
    <a id="excelSaveSkpd" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-excel'">Save to Excel</a>
</div>