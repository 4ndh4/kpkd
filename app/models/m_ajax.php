<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ajax extends CI_Model {
    
    var $expired;
    var $expited_msg;
    var $images;
    
	function __construct() {
		parent::__construct();
        $this->images = $this->config->item('img_url');
        $this->load->library('session_lib');
        if ($this->session_lib->userdata('username_umbcms')==''){
            $this->expired = true;
            $this->expired_msg = "{success:false, Msg:'Session Expired'}";
        } else {
            $this->expired = false;
        }
	}
	
	function m_getTableValue($table='',$field='',$arrWhere=array()) {
		$query = $this->db->select($field)->from($table)->where($arrWhere)->get();
        if($query->num_rows() > 0) {
        	foreach ($query->result() as $row) {
			   return $row->$field;
			}
        } else {
        	return false;
        }
	}
	
	function getMenu($header='')
    {
        //if ($this->expired) return $this->expired_msg;   
        $sql = "SELECT kode,nama,page FROM menu WHERE header='$header'";
        $query = $this->db->query($sql);
        return json_encode($query->result());
    }
    
    function getFungsi($print='')
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $count = $this->input->post('rows') != '' ? $this->input->post('rows') : 30;
		$start = $this->input->post('page') != '' ? $count*($this->input->post('page')-1) : 0;
		$sort  = $this->input->post('sort') != '' ? $this->input->post('sort') : 'kode';
		$order = $this->input->post('order') != '' ? $this->input->post('order') : 'ASC';
		$cari  = $this->input->post('search');
		
        $sql   = "SELECT * FROM ms_fungsi";
        
        if ($cari != "") $sql .= " where kode LIKE '%$cari%' OR nama LIKE '%$cari%'";
        
        if ($print=='print')
            $sql .= " order by 1";
        else
            if ($sort != "") $sql .= " order by $sort $order";
        
        $query = $this->db->query($sql);
        $total = $query->num_rows();
                        
        if ($print=='print'){
            return $query;
        } else {
            $sql  .= " limit ".$start.",".$count;
            $query = $this->db->query($sql);
            return '{"total":"'.$total.'","rows":'.json_encode($query->result()).',"post":'.json_encode($this->input->post()).'}';
        }
    }
    
    function getFungsiList()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $sql   = "SELECT kode,nama FROM ms_fungsi order by kode";
        $query = $this->db->query($sql);
        return json_encode($query->result());
    }
    
    function setFungsi()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $type = $this->input->post('type');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$oldv = $this->input->post('old_value');
		
        $data = array('kode'=>$kode,'nama'=>$nama);
        
        if ($type=='add'){
            $query = $this->db->get_where('ms_fungsi',array('kode'=>$kode));
	        if ($query->num_rows()>0) return "{success:false, msg:'Kode fungsi $kode sudah terdapat di dalam database !'}"; 
            if ($this->db->insert('ms_fungsi', $data))
				return "{success:true, msg:'Berhasil menambah data fungsi baru.'}";
			else
				return "{success:false, msg:'Gagal menambah data fungsi baru.'}";            
        } elseif ($type=='edit'){
            if ($kode!=$oldv){
                $query = $this->db->get_where('ms_fungsi',array('kode'=>$kode));
                if ($query->num_rows()>0) return "{success:false, msg:'Kode fungsi $kode sudah terdapat di dalam database !'}"; 
            }
            if($this->db->update('ms_fungsi', $data,array('kode'=>$oldv))) {
				return "{success:true, msg:'Berhasil merubah data fungsi'}";
			} else {
				return "{success:false, msg:'Gagal merubah data fungsi'}";
			}
        } elseif ($type=='delete'){       
            if($this->db->delete('ms_fungsi', array('kode' => $kode))) {
    			return "{success:true, msg:'Berhasil menghapus data fungsi $kode'}";
    		} else {
    			return "{success:false, msg:'Gagak menghapus data fungsi $kode'}";
    		}
        }
    }
    
    function getUrusan($print='')
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $count = $this->input->post('rows') != '' ? $this->input->post('rows') : 30;
		$start = $this->input->post('page') != '' ? $count*($this->input->post('page')-1) : 0;
		$sort  = $this->input->post('sort') != '' ? $this->input->post('sort') : 'kode';
		$order = $this->input->post('order') != '' ? $this->input->post('order') : 'ASC';
		$tipe = $this->input->post('tipe');
		$cari  = $this->input->post('search');
		
        $sql   = "SELECT *,(select nama from ms_urusan where kode=a.header) as nama_header,
                         IF(a.tipe='H','Header','Sub Header') AS nama_tipe,
                         (SELECT nama FROM ms_fungsi WHERE kode=a.fungsi) AS nama_fungsi
                 FROM ms_urusan a";
        
        if ($cari != "") {
            $sql2 = "SELECT * FROM (".$sql.") a 
                     where (kode LIKE '%$cari%' OR nama LIKE '%$cari%' OR header LIKE '%$cari%' OR tipe LIKE '%$cari%' OR
                           fungsi LIKE '%$cari%' OR nama_header LIKE '%$cari%' OR nama_tipe LIKE '%$cari%' OR nama_fungsi LIKE '%$cari%')
                    ";
            if ($tipe != "") $sql2 .= " and tipe='$tipe'";
            $sql = $sql2;
        } elseif ($tipe != "") $sql .= " where tipe='$tipe'";
        
        if ($print=='print')
            $sql .= " order by 1";
        else
            if ($sort != "") $sql .= " order by $sort $order";
        
        $query = $this->db->query($sql);
        $total = $query->num_rows();
                        
        if ($print=='print'){
            return $query;
        } else {
            $sql  .= " limit ".$start.",".$count;
            $query = $this->db->query($sql);
            return '{"total":"'.$total.'","rows":'.json_encode($query->result()).',"post":'.json_encode($this->input->post()).'}';
        }
        
    }
    
    function setUrusan()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $type = $this->input->post('type');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$header = $this->input->post('header');
		$tipe = $this->input->post('tipe');
		$fungsi = $this->input->post('fungsi');
		$oldv = $this->input->post('old_value');
		
        $data = array('kode'=>$kode,'nama'=>$nama,'header'=>$header,'tipe'=>$tipe,'fungsi'=>$fungsi);
        
        if ($type=='add'){
            $query = $this->db->get_where('ms_urusan',array('kode'=>$kode));
	        if ($query->num_rows()>0) return "{success:false, msg:'Kode urusan $kode sudah terdapat di dalam database !'}"; 
            if ($this->db->insert('ms_urusan', $data))
				return "{success:true, msg:'Berhasil menambah data urusan baru.'}";
			else
				return "{success:false, msg:'Gagal menambah data urusan baru.'}";            
        } elseif ($type=='edit'){
            if ($kode!=$oldv){
                $query = $this->db->get_where('ms_urusan',array('kode'=>$kode));
                if ($query->num_rows()>0) return "{success:false, msg:'Kode urusan $kode sudah terdapat di dalam database !'}"; 
            }
            if($this->db->update('ms_urusan', $data,array('kode'=>$oldv))) {
				return "{success:true, msg:'Berhasil merubah data urusan'}";
			} else {
				return "{success:false, msg:'Gagal merubah data urusan'}";
			}
        } elseif ($type=='delete'){       
            if($this->db->delete('ms_urusan', array('kode' => $kode))) {
    			return "{success:true, msg:'Berhasil menghapus data urusan $kode'}";
    		} else {
    			return "{success:false, msg:'Gagak menghapus data urusan $kode'}";
    		}
        }
    }
    
    function getUrusanHeader()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $sql   = "SELECT kode,nama FROM ms_urusan where tipe='H'";
        $query = $this->db->query($sql);
        return json_encode($query->result());
    }
    
    function getUrusanSkpd($skpd='')
    {
        //if ($this->expired) return $this->expired_msg;   
        $skpd  = $skpd == '' ? $this->input->post('skpd') : $skpd;
        $sql   = "SELECT urusan FROM ms_skpd_urusan where kode='$skpd'";
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $ret = array();
            foreach ($query->result() as $row){
                $ret[] = $row->urusan; 
            }
            return "{success:true, data:".json_encode($ret)."}";
        } else {
            return "{success:false, data:['']}";
        }
    }   
    
    function getSkpd($print='')
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $count = $this->input->post('rows') != '' ? $this->input->post('rows') : 30;
		$start = $this->input->post('page') != '' ? $count*($this->input->post('page')-1) : 0;
		$sort  = $this->input->post('sort') != '' ? $this->input->post('sort') : 'kode';
		$order = $this->input->post('order') != '' ? $this->input->post('order') : 'ASC';
		$cari  = $this->input->post('search');
		
        $sql   = "SELECT * FROM ms_skpd";
        
        if ($cari != "") $sql .= " where kode LIKE '%$cari%' OR nama LIKE '%$cari%'";
        
        if ($print=='print')
            $sql .= " order by 1";
        else
            if ($sort != "") $sql .= " order by $sort $order";
        
        $query = $this->db->query($sql);
        $total = $query->num_rows();
                        
        if ($print=='print'){
            return $query;
        } else {
            $sql  .= " limit ".$start.",".$count;
            $query = $this->db->query($sql);
            return '{"total":"'.$total.'","rows":'.json_encode($query->result()).',"post":'.json_encode($this->input->post()).'}';
        }
        
    }
    
    function getSkpdList()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $sql   = "SELECT kode,nama FROM ms_skpd order by kode";
        $query = $this->db->query($sql);
        return json_encode($query->result());
    }
    
    function setSkpd()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $type = $this->input->post('type');
		$kode = $this->input->post('kode');
		$oldv = $this->input->post('old_value');
		
        $data = array(
                    'kode'=>$kode,
                    'nama'=>$this->input->post('nama'),
                    'nama_pa'=>$this->input->post('nama_pa'),
                    'jabatan_pa'=>$this->input->post('jabatan_pa'),
                    'pangkat_pa'=>$this->input->post('pangkat_pa'),
                    'nip_pa'=>$this->input->post('nip_pa'),
                    'nama_ppk'=>$this->input->post('nama_ppk'),
                    'jabatan_ppk'=>$this->input->post('jabatan_ppk'),
                    'pangkat_ppk'=>$this->input->post('pangkat_ppk'),
                    'nip_ppk'=>$this->input->post('nip_ppk'),
                    'nama_bendout'=>$this->input->post('nama_bendout'),
                    'jabatan_bendout'=>$this->input->post('jabatan_bendout'),
                    'pangkat_bendout'=>$this->input->post('pangkat_bendout'),
                    'nip_bendout'=>$this->input->post('nip_bendout'),
                    'nama_bendin'=>$this->input->post('nama_bendin'),
                    'jabatan_bendin'=>$this->input->post('jabatan_bendin'),
                    'pangkat_bendin'=>$this->input->post('pangkat_bendin'),
                    'nip_bendin'=>$this->input->post('nip_bendin'),
                    'singkatan'=>$this->input->post('singkatan'),
                    'alamat'=>$this->input->post('alamat'),
                    'bank'=>$this->input->post('bank'),
                    'rekening'=>$this->input->post('rekening'),
                    'npwp'=>$this->input->post('npwp')
                    );
        
        if ($type=='add'){
            $query = $this->db->get_where('ms_skpd',array('kode'=>$kode));
	        if ($query->num_rows()>0) return "{success:false, msg:'Kode skpd $kode sudah terdapat di dalam database !'}"; 
            if ($this->db->insert('ms_skpd', $data)){
				$urusan = $this->input->post('urusan_skpd');
                $aurusan = explode(",",$urusan);
                for ($i=0;$i<count($aurusan);$i++){
                    $data = array('kode'=>$kode,'urusan'=>$aurusan[$i]);
                    $this->db->insert('ms_skpd_urusan', $data);
                }
                return "{success:true, msg:'Berhasil menambah data skpd baru.'}";
			} else
				return "{success:false, msg:'Gagal menambah data skpd baru.'}";            
        } elseif ($type=='edit'){
            if ($kode!=$oldv){
                $query = $this->db->get_where('ms_skpd',array('kode'=>$kode));
                if ($query->num_rows()>0) return "{success:false, msg:'Kode skpd $kode sudah terdapat di dalam database !'}"; 
            }
            if($this->db->update('ms_skpd', $data,array('kode'=>$oldv))) {
                $urusan = $this->input->post('urusan_skpd');
                $aurusan = explode(",",$urusan);
                $this->db->delete('ms_skpd_urusan',array('kode'=>$oldv));
                for ($i=0;$i<count($aurusan);$i++){
                    $data = array('kode'=>$kode,'urusan'=>$aurusan[$i]);
                    $this->db->insert('ms_skpd_urusan', $data);
                }
                return "{success:true, msg:'Berhasil merubah data skpd',Post:".json_encode($this->input->post())."}";
			} else {
				return "{success:false, msg:'Gagal merubah data skpd'}";
			}
        } elseif ($type=='delete'){       
            if($this->db->delete('ms_skpd', array('kode' => $kode))) {
    			$this->db->delete('ms_skpd_urusan',array('kode'=>$kode));
                return "{success:true, msg:'Berhasil menghapus data skpd $kode'}";
    		} else {
    			return "{success:false, msg:'Gagak menghapus data skpd $kode'}";
    		}
        }
    }
     
    function getRekening($print='')
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $count = $this->input->post('rows') != '' ? $this->input->post('rows') : 30;
		$start = $this->input->post('page') != '' ? $count*($this->input->post('page')-1) : 0;
		$sort  = $this->input->post('sort') != '' ? $this->input->post('sort') : 'kode';
		$order = $this->input->post('order') != '' ? $this->input->post('order') : 'ASC';
		$tipe = $this->input->post('tipe');
		$cari  = $this->input->post('search');
		
        $sql   = "SELECT *,(select nama from ms_rekening where kode=a.header) as nama_header,
                         IF(a.tipe='H','Header','Sub Header') AS nama_tipe
                 FROM ms_rekening a";
        
        if ($cari != "") {
            $sql2 = "SELECT * FROM (".$sql.") a 
                     where (kode LIKE '%$cari%' OR nama LIKE '%$cari%' OR header LIKE '%$cari%' OR tipe LIKE '%$cari%' OR
                           nama_header LIKE '%$cari%' OR nama_tipe LIKE '%$cari%')
                    ";
            if ($tipe != "") $sql2 .= " and tipe='$tipe'";
            $sql = $sql2;
        } elseif ($tipe != "") $sql .= " where tipe='$tipe'";
        
        if ($print=='print')
            $sql .= " order by 1";
        else
            if ($sort != "") $sql .= " order by $sort $order";
        
        $query = $this->db->query($sql);
        $total = $query->num_rows();
                        
        if ($print=='print'){
            return $query;
        } else {
            $sql  .= " limit ".$start.",".$count;
            $query = $this->db->query($sql);
            return '{"total":"'.$total.'","rows":'.json_encode($query->result()).',"post":'.json_encode($this->input->post()).'}';
        }
        
    }
    
    function setRekening()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $type = $this->input->post('type');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$header = $this->input->post('header');
		$tipe = $this->input->post('tipe');
		$oldv = $this->input->post('old_value');
		
        $data = array('kode'=>$kode,'nama'=>$nama,'header'=>$header,'tipe'=>$tipe);
        
        if ($type=='add'){
            $query = $this->db->get_where('ms_rekening',array('kode'=>$kode));
	        if ($query->num_rows()>0) return "{success:false, msg:'Kode rekening $kode sudah terdapat di dalam database !'}"; 
            if ($this->db->insert('ms_rekening', $data))
				return "{success:true, msg:'Berhasil menambah data rekening baru.'}";
			else
				return "{success:false, msg:'Gagal menambah data rekening baru.'}";            
        } elseif ($type=='edit'){
            if ($kode!=$oldv){
                $query = $this->db->get_where('ms_rekening',array('kode'=>$kode));
                if ($query->num_rows()>0) return "{success:false, msg:'Kode rekening $kode sudah terdapat di dalam database !'}"; 
            }
            if($this->db->update('ms_rekening', $data,array('kode'=>$oldv))) {
				return "{success:true, msg:'Berhasil merubah data rekening'}";
			} else {
				return "{success:false, msg:'Gagal merubah data rekening'}";
			}
        } elseif ($type=='delete'){       
            if($this->db->delete('ms_rekening', array('kode' => $kode))) {
    			return "{success:true, msg:'Berhasil menghapus data rekening $kode'}";
    		} else {
    			return "{success:false, msg:'Gagak menghapus data rekening $kode'}";
    		}
        }
    }
    
    function getRekeningHeader()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $sql   = "SELECT kode,nama FROM ms_rekening where tipe='H'";
        $query = $this->db->query($sql);
        return json_encode($query->result());
    }
    
    function getProgram($print='')
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $count = $this->input->post('rows') != '' ? $this->input->post('rows') : 30;
		$start = $this->input->post('page') != '' ? $count*($this->input->post('page')-1) : 0;
		$sort  = $this->input->post('sort') != '' ? $this->input->post('sort') : 'kode';
		$order = $this->input->post('order') != '' ? $this->input->post('order') : 'ASC';
		$skpd = $this->input->post('skpd');
		$cari  = $this->input->post('search');
		
        $sql   = "SELECT *,(select nama from ms_urusan where kode=a.urusan) as nama_urusan,
                         IF(a.jenis='1','Tidak Langsung','Langsung') AS nama_jenis
                 FROM ms_program a";
        
        if ($cari != "") {
            $sql2 = "SELECT * FROM (".$sql.") a 
                     where (kode LIKE '%$cari%' OR nama LIKE '%$cari%' OR urusan LIKE '%$cari%' OR jenis LIKE '%$cari%' OR
                           nama_urusan LIKE '%$cari%' OR nama_jenis LIKE '%$cari%')
                    ";
            if ($skpd != "") $sql2 .= " and skpd='$skpd'";
            $sql = $sql2;
        } elseif ($skpd != "") $sql .= " where skpd='$skpd'";
        
        if ($print=='print')
            $sql .= " order by 1";
        else
            if ($sort != "") $sql .= " order by $sort $order";
        
        $query = $this->db->query($sql);
        $total = $query->num_rows();
                        
        if ($print=='print'){
            return $query;
        } else {
            $sql  .= " limit ".$start.",".$count;
            $query = $this->db->query($sql);
            return '{"total":"'.$total.'","rows":'.json_encode($query->result()).',"post":'.json_encode($this->input->post()).'}';
        }
        
    }
    
    function setProgram()
    {
        //if ($this->expired) return $this->expired_msg;   
        
        $type = $this->input->post('type');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$skpd = $this->input->post('skpd');
		$urusan = $this->input->post('urusan');
		$jenis = $this->input->post('jenis');
		$oldv = $this->input->post('old_value');
		
        $data = array('kode'=>$kode,'nama'=>$nama,'skpd'=>$skpd,'urusan'=>$urusan,'jenis'=>$jenis);
        
        if ($type=='add'){
            $query = $this->db->get_where('ms_program',array('kode'=>$kode,'skpd'=>$skpd,'urusan'=>$urusan));
	        if ($query->num_rows()>0) return "{success:false, msg:'Kode program $kode sudah terdapat di dalam database !'}"; 
            if ($this->db->insert('ms_program', $data))
				return "{success:true, msg:'Berhasil menambah data program baru.'}";
			else
				return "{success:false, msg:'Gagal menambah data program baru.'}";            
        } elseif ($type=='edit'){
            if ($kode!=$oldv){
                $query = $this->db->get_where('ms_program',array('kode'=>$kode,'skpd'=>$skpd,'urusan'=>$urusan));
                if ($query->num_rows()>0) return "{success:false, msg:'Kode program $kode sudah terdapat di dalam database !'}"; 
            }
            if($this->db->update('ms_program', $data,array('kode'=>$oldv,'skpd'=>$skpd,'urusan'=>$urusan))) {
				return "{success:true, msg:'Berhasil merubah data program'}";
			} else {
				return "{success:false, msg:'Gagal merubah data program'}";
			}
        } elseif ($type=='delete'){       
            if($this->db->delete('ms_program', array('kode' => $kode,'skpd'=>$skpd,'urusan'=>$urusan))) {
    			return "{success:true, msg:'Berhasil menghapus data program $kode'}";
    		} else {
    			return "{success:false, msg:'Gagak menghapus data program $kode'}";
    		}
        }
    }
             
}