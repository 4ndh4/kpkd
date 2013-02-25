<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tabel extends CI_Model{
	
    var $expired;
    var $expited_msg;
    var $prefix_table;
    
    function __construct(){
		parent::__construct();
        
        $this->prefix_table = '';//$this->config->item('prefix_table');
        
        $this->load->library('session_lib');
        if ($this->session_lib->userdata('username_umbcms')==''){
            $this->expired = true;
            $this->expired_msg = "{success:false, Msg:'Session Expired'}";
        } else {
            $this->expired = false;
        }
        
        $this->load->dbutil();
        $this->load->dbforge();
        $this->_cek_tabel();
          
	}
    
    function _tabel(){
        $ATabel = array("user","user_login","otorisasi","menu","menu_otorisasi",
                        "ms_fungsi","ms_urusan","ms_skpd","ms_skpd_urusan",
                        "ms_program","ms_kegiatan","ms_rekening",
                        "config");
        return $ATabel;
    }
    
    function _cek_tabel() {
        $ATabel = $this->_tabel();
        for ($i=0;$i<count($ATabel);$i++) 
        {
            if (!$this->db->table_exists($this->prefix_table.$ATabel[$i]))
            {
                $this->db->query($this->_buat_tabel($ATabel[$i]));
                IF ($this->_isi_tabel($ATabel[$i]) !== '')
                {
                    $this->db->query($this->_isi_tabel($ATabel[$i]));
                }
            }
        }
    }
    
    function _buat_tabel($cTabel='') {
        if (empty($cTabel)) return '';
        //-----------------
        $cSql='';
        $cTabel = strtolower($cTabel);
        switch ($cTabel) {
            case "user":
                $cSql = "create table ".$this->prefix_table."user (
                         id int(11) not NULL auto_increment,
                         username varchar(20) not NULL,
    			         password varchar(40) not NULL,
                         keterangan varchar(60) not NULL,
    			         otori varchar(40) not NULL,
                         created_by int(11) NOT NULL,
                         created_date timestamp NOT NULL default CURRENT_TIMESTAMP,
                         modified_by int(11) default NULL,
                         modified_date timestamp NULL default NULL,
                         lastlogin_date timestamp NULL default NULL,
                         PRIMARY KEY (id)
                         )";
                break;
            case "user_login":
                $cSql = "create table ".$this->prefix_table."user_login (
                         id int(11) not NULL,
                         status varchar(6) not null,
                         login_date timestamp NOT NULL default CURRENT_TIMESTAMP,
                         PRIMARY KEY (id)
                         )";
                break;
            case "otorisasi":
                $cSql = "create table ".$this->prefix_table."otorisasi (
                         id int(11) not NULL auto_increment,
                         kode varchar(40) not NULL,
    			         nama varchar(200) not NULL,
                         PRIMARY KEY (id)
                         )";
                break;
            case "menu":
                $cSql = "create table ".$this->prefix_table."menu (kode varchar(6) not NULL,
    			         nama varchar(200) not NULL,tipe varchar(1) not NULL,
                         header varchar(6) not NULL,link varchar(80) not NULL,
                         img varchar(80) not null,page varchar(80) null)";
                break;
            case "menu_otorisasi":
                $cSql = "create table ".$this->prefix_table."menu_otorisasi (kode varchar(6) not NULL,
    			         nama varchar(200) not NULL,tipe varchar(1) not NULL,
                         header varchar(6) not NULL,link varchar(80) not NULL,img varchar(80) not null,
                         page varchar(80) null,otori varchar(40) not NULL)";
                break;
            case "ms_fungsi":
                $cSql = "create table ".$this->prefix_table."ms_fungsi (kode varchar(2) NOT NULL,nama varchar(40) NOT NULL)";
                break;
            case "ms_urusan":
                $cSql = "create table ".$this->prefix_table."ms_urusan (kode varchar(3) NOT NULL,nama varchar(60) NOT NULL,header varchar(3) null,
                        tipe varchar(1) Not Null,fungsi char(2) null)";
                break;
            case "ms_skpd":
                $cSql = "create table ".$this->prefix_table."ms_skpd (kode varchar(7) NOT NULL,nama varchar(80) NOT NULL,
                        nama_pa varchar(60) not null COMMENT 'Nama Pimpinan',jabatan_pa varchar(60) not null COMMENT 'Jabatan Pimpinan',
                        pangkat_pa varchar(40) not null COMMENT 'Pangkat Pimpinan',nip_pa varchar(21) not null COMMENT 'Nip Pimpinan',
                        nama_ppk varchar(60) null COMMENT 'Nama PPK',jabatan_ppk varchar(60) null COMMENT 'Jabatan PPK',
                        pangkat_ppk varchar(40) null COMMENT 'Pangkat PPK',nip_ppk varchar(21) null COMMENT 'Nip PPK',
                        nama_bendout varchar(60) null COMMENT 'Nama Bend. Out',jabatan_bendout varchar(60) null COMMENT 'Jabatan Bend. Out',
                        pangkat_bendout varchar(40) null COMMENT 'Pangkat Bend. Out',nip_bendout varchar(21) null COMMENT 'Nip Bend. Out',
                        nama_bendin varchar(60) null COMMENT 'Nama Bend. In',jabatan_bendin varchar(60) null COMMENT 'Jabatan Bend. In',
                        pangkat_bendin varchar(40) null COMMENT 'Pangkat Bend. In',nip_bendin varchar(21) null COMMENT 'Nip Bend. In',
                        singkatan varchar(4) null,alamat varchar(200) null,
                        bank varchar(20) null,rekening varchar(20) null,npwp varchar(20) null)";
                break;
            case "ms_skpd_urusan":
                $cSql = "create table ".$this->prefix_table."ms_skpd_urusan (kode varchar(7) NOT NULL,urusan varchar(3) not null)";
                break;
            case "ms_program":
                $cSql = "create table ".$this->prefix_table."ms_program (kode varchar(2) NOT NULL,nama varchar(200) not null,
                        skpd varchar(7) not null,urusan varchar(3) not null,jenis varchar(1) not null)";
                break;
            case "ms_kegiatan":
                $cSql = "create table ".$this->prefix_table."ms_kegiatan (kode varchar(2) NOT NULL,nama varchar(200) not null,
                        skpd varchar(7) not null,urusan varchar(3) not null,program varchar(2) not null,
                        jenis varchar(1) not null)";
                break;
            case "ms_rekening":
                $cSql = "create table ".$this->prefix_table."ms_rekening (kode varchar(7) NOT NULL,nama varchar(200) not null,
                        tipe varchar(1) not null,header varchar(7) null,akun varchar(1) null,
                        kelompok varchar(8) null,lra varchar(8) null,sap varchar(8) null,neraca varchar(8) null,
                        lak varchar(8) null)";
                break;  
            case "config":
                $cSql = "create table ".$this->prefix_table."config (pemda varchar(60) not null,alamat varchar(200) not null,
    			         kota varchar(40) not null,logo varchar(100) not null)";          
                break;
        }       
        return $cSql;
    }

    function _isi_tabel($cTabel='') {
        if (empty($cTabel))
            return '';
        //-----------------
        $cSql='';
        $cTabel = strtolower($cTabel);
        switch ($cTabel) {
            case "user":
                $cpass = md5('oke');
                $cSql = "insert into ".$this->prefix_table."user 
                         (username,password,keterangan,otori,created_by) values 
                         ('andha','".$cpass."','AndhA Inc.','01','')";
                break;
            case "otorisasi":
                $cSql = "insert into ".$this->prefix_table."otorisasi (kode,nama) values ('01','administrator'),('02','operator')";
                break;
            case "menu":
                $cSql = "insert into ".$this->prefix_table."menu values 
                        ('01','Master','H','','','',''),
                        ('0101','Fungsi','S','01','master/fungsi','','Fungsi'),
                        ('0102','Urusan','S','01','master/urusan','','Urusan'),
                        ('0103','S K P D','S','01','master/skpd','','Skpd'),
                        ('0104','Program & Kegiatan','S','01','master/progkeg','','Progkeg'),
                        ('0105','Rekening','S','01','master/rekening','','Rekening'),
                        ('02','Anggaran','H','','','',''),
                        ('0201','R K A','H','02','','',''),
                        ('020101','RKA Pokok','S','0201','anggaran/rka_pokok','',''),
                        ('020102','RKA Perubahan','S','0201','anggaran/rka_ubah','',''),
                        ('0202','D P A','H','02','','',''),
                        ('020201','DPA Pokok','S','0201','anggaran/rka_pokok','',''),
                        ('020202','DPA Perubahan','S','0201','anggaran/rka_ubah','',''),
                        ('0203','A P B D','H','02','','',''),
                        ('020301','APBD Pokok','S','0201','anggaran/rka_pokok','',''),
                        ('020302','APBD Perubahan','S','0201','anggaran/rka_ubah','',''),
                        ('0204','S P D','H','02','','',''),
                        ('020401','Input SPD','S','0204','anggaran/spd','',''),
                        ('020402','Format SPD','S','0204','anggaran/spd_format','',''),
                        ('020403','Laporan SPD','S','0204','anggaran/spd_laporan','',''),
                        ('03','Penatausahaan','H','','','',''),
                        ('0301','Penerimaan','H','03','','',''),
                        ('030101','Input Proposal','S','0301','pendataan/proposal','',''),
                        ('030102','Proses Proposal','S','0301','pendataan/proses','',''),
                        ('030103','Verifikasi Proposal','S','0301','pendataan/verifikasi','',''),
                        ('030104','Registrasi Proposal','S','0301','pendataan/registrasi','',''),
                        ('030105','Format','S','0301','pendataan/format','',''),
                        ('0302','Pengeluaran','S','03','pendataan/peringatan','',''),
                        ('04','Akuntansi dan Pelaporan','H','','','',''),
                        ('0401','Pengaturan','S','04','utilitas/config','',''),
                        ('0402','User','S','04','utilitas/user','',''),
                        ('0403','Penandatangan','S','04','utilitas/ttd','',''),
                        ('05','Pengaturan dan Pelaporan','H','','','',''),
                        ('0501','Pengaturan','S','05','utilitas/config','',''),
                        ('0502','User','S','05','utilitas/user','',''),
                        ('0503','Penandatangan','S','05','utilitas/ttd','','')";
                break;
            case "menu_otorisasi":
                $cSql = "insert into ".$this->prefix_table."menu_otorisasi select *,'01' from ".$this->prefix_table."menu";                
                break;
            case "ms_fungsi":
                $cSql = "insert into ".$this->prefix_table."ms_fungsi values 
                        ('01','Pelayanan Umum'),
                        ('02','Pertahanan'),
                        ('03','Ketertiban dan ketentraman'),
                        ('04','Ekonomi'),
                        ('05','Lingkungan Hidup'),
                        ('06','Perumahan dan fasilitas umum'),
                        ('07','Kesehatan'),
                        ('08','Pariwisata dan Budaya'),
                        ('09','Agama'),
                        ('10','Pendidikan'),
                        ('11','Perlindungan sosial')";
                break;
            case "ms_urusan":
                $cSql = "insert into ".$this->prefix_table."ms_urusan values 
                        ('1','URUSAN WAJIB','','H',''),
                        ('101','Pendidikan','1','S','10'),
                        ('102','Kesehatan','1','S','07'),
                        ('103','Pekerjaan Umum','1','S','06'),
                        ('104','Perumahan','1','S','06'),
                        ('105','Penataan Ruang','1','S','05'),
                        ('106','Perencanaan Pembangunan','1','S','01'),
                        ('107','Perhubungan','1','S','04'),
                        ('108','Lingkungan Hidup','1','S','05'),
                        ('109','Pertanahan','1','S','05'),
                        ('110','Kependudukan dan Catatan Sipil','1','S','11'),
                        ('111','Pemberdayaan Perempuan dan Perlindungan Anak','1','S','11'),
                        ('112','Keluarga Berencana dan Keluarga Sejahtera','1','S','07'),
                        ('113','Sosial','1','S','11'),
                        ('114','Tenaga Kerja','1','S','04'),
                        ('115','Koperasi dan Usaha Kecil Menengah','1','S','04'),
                        ('116','Penanaman Modal','1','S','04'),
                        ('117','Kebudayaan','1','S','08'),
                        ('118','Pemuda dan Olah Raga','1','S','10'),
                        ('119','Kesatuan Bangsa dan Politik Dalam Negeri','1','S','03'),
                        ('120','Otonomi Daerah, Pemerintahan Umum, Administrasi Keuangan','1','S','01'),
                        ('121','Ketahanan Pangan','1','S','04'),
                        ('122','Pemberdayaan Masyarakat  dan Desa','1','S','04'),
                        ('123','Statistik','1','S','01'),
                        ('124','Kearsipan','1','S','01'),
                        ('125','Komunikasi dan Informatika','1','S','01'),
                        ('126','Perpustakaan','1','S','10'),
                        ('2','URUSAN PILIHAN','','H',''),
                        ('201','Pertanian','2','S','04'),
                        ('202','Kehutanan','2','S','04'),
                        ('203','Energi dan Sumberdaya Mineral','2','S','04'),
                        ('204','Pariwisata','2','S','08'),
                        ('205','Kelautan dan Perikanan','2','S','04'),
                        ('206','Perdagangan','2','S','04'),
                        ('207','Perindustrian','2','S','04'),
                        ('208','Transmigrasi','2','S','04')";
                break;
        }
        return $cSql;
    }
    
}
