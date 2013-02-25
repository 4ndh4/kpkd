<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
    
	function __construct(){
		parent::__construct();
		$this->load->model('m_ajax');
	}
	
    function ajaxGetMenu($header=''){
        echo $this->m_ajax->getMenu($header);
    }
    
    function ajaxGetFungsi($print='',$to='',$d=''){
        if ($print=='print'){
            $query = $this->m_ajax->getFungsi($print);
            $judul = "LAPORAN DAFTAR FUNGSI";
            
            $cRet = "<table style=\"border-left-style: none; border-bottom-style: none; border-right-style: none; border-top-style: none;border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\">
                        <thead>
                            <tr>
                                <td colspan=\"2\" style=\"text-align:center;border-top: none;border-left: none;border-right: none;\">&nbsp;<br>$judul<br>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"10%\"><b>KODE</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"90%\"><b>NAMA</b></td>
                            </tr>
                        </thead>";
                                
            foreach ($query->result() as $row)
            {
               $cRet .= "<tr>
                            <td style=\"vertical-align:top;\" align=\"center\">".$row->kode."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama."</td>
                         </tr>";
            }                      
            $cRet .= "</table>";
            
            if ($to=='pdf')
                $this->_mpdf('Lap_Fungsi.pdf','',$cRet,10,10,10,'P',$d);
            elseif ($to=='excel'){
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Lap_Fungsi.xls");
                echo $cRet;
            } else
                echo $cRet;

        } else {
            echo $this->m_ajax->getFungsi();
        }
    }
    
    function ajaxGetFungsiList(){
        echo $this->m_ajax->getFungsiList();
    }
    
    function ajaxSetFungsi(){
        echo $this->m_ajax->setFungsi();
    }
     
    function ajaxGetUrusanSkpd($skpd=''){
        echo $this->m_ajax->getUrusanSkpd($skpd);
    }
    
    function ajaxGetUrusan($print='',$to='',$d=''){
        if ($print=='print'){
            $query = $this->m_ajax->getUrusan($print);
            $judul = "LAPORAN DAFTAR URUSAN";
            
            $cRet = "<table style=\"border-left-style: none; border-bottom-style: none; border-right-style: none; border-top-style: none;border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\">
                        <thead>
                            <tr>
                                <td colspan=\"5\" style=\"text-align:center;border-top: none;border-left: none;border-right: none;\">&nbsp;<br>$judul<br>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"10%\"><b>KODE</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"30%\"><b>NAMA</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"10%\"><b>TIPE</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"25%\"><b>HEADER</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"25%\"><b>FUNGSI</b></td>
                            </tr>
                        </thead>";
                                
            foreach ($query->result() as $row)
            {
               $cRet .= "<tr>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->kode."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama_tipe."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama_header."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama_fungsi."</td>
                         </tr>";
            }                      
            $cRet .= "</table>";
            
            if ($to=='pdf')
                $this->_mpdf('Lap_Urusan.pdf','',$cRet,10,10,10,'L',$d);
            elseif ($to=='excel'){
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Lap_Urusan.xls");
                echo $cRet;
            } else
                echo $cRet;

        } else {
            echo $this->m_ajax->getUrusan();
        }
    }
    
    function ajaxSetUrusan(){
        echo $this->m_ajax->setUrusan();
    }
    
    function ajaxGetUrusanHeader(){
        echo $this->m_ajax->getUrusanHeader();
    }
    
    function ajaxGetSkpdList(){
        echo $this->m_ajax->getSkpdList();
    }
    
    function ajaxGetSkpd($print='',$to='',$d=''){
        if ($print=='print'){
            $query = $this->m_ajax->getSkpd($print);
            $judul = "LAPORAN DAFTAR SKPD";
            
            $cRet = "<table style=\"border-left-style: none; border-bottom-style: none; border-right-style: none; border-top-style: none;border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\">
                        <thead>
                            <tr>
                                <td colspan=\"5\" style=\"text-align:center;border-top: none;border-left: none;border-right: none;\">&nbsp;<br>$judul<br>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"10%\"><b>KODE</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"25%\"><b>NAMA</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"25%\"><b>NAMA PA</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"30%\"><b>ALAMAT</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"10%\"><b>SINGKATAN</b></td>
                            </tr>
                        </thead>";
                                
            foreach ($query->result() as $row)
            {
               $cRet .= "<tr>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->kode."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama_pa."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->alamat."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->singkatan."</td>
                         </tr>";
            }                      
            $cRet .= "</table>";
            
            if ($to=='pdf')
                $this->_mpdf('Lap_Skpd.pdf','',$cRet,10,10,10,'L',$d);
            elseif ($to=='excel'){
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Lap_Skpd.xls");
                echo $cRet;
            } else
                echo $cRet;

        } else {
            echo $this->m_ajax->getSkpd();
        }
    }
    
    function ajaxSetSkpd(){
        echo $this->m_ajax->setSkpd();
    }
    
    function _mpdf($name='',$judul='',$isi='',$lMargin=10,$rMargin=10,$font=12,$orientasi='',$dest='') {
        $this->load->library('mpdf');
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1; 
        
        //$this->mpdf->SetHeader('KPKD||');
        $this->mpdf->SetFooter('Printed on @ {DATE j-m-Y}|KPKD| Page {PAGENO} of {nb}');
        
        $this->mpdf->AddPage($orientasi);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);
        
        if (!empty($dest))
            $this->mpdf->Output($name,$dest);
        else
            $this->mpdf->Output();
    }
    
    function ajaxGetRekening($print='',$to='',$d=''){
        if ($print=='print'){
            $query = $this->m_ajax->getRekening($print);
            $judul = "LAPORAN DAFTAR REKENING";
            
            $cRet = "<table style=\"border-left-style: none; border-bottom-style: none; border-right-style: none; border-top-style: none;border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\">
                        <thead>
                            <tr>
                                <td colspan=\"5\" style=\"text-align:center;border-top: none;border-left: none;border-right: none;\">&nbsp;<br>$judul<br>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"10%\"><b>KODE</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"40%\"><b>NAMA</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"10%\"><b>TIPE</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"40%\"><b>HEADER</b></td>
                            </tr>
                        </thead>";
                                
            foreach ($query->result() as $row)
            {
               $cRet .= "<tr>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->kode."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama_tipe."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".(!empty($row->header)?$row->header." - ":"").$row->nama_header."</td>
                         </tr>";
            }                      
            $cRet .= "</table>";
            
            if ($to=='pdf')
                $this->_mpdf('Lap_Rekening.pdf','',$cRet,10,10,10,'P',$d);
            elseif ($to=='excel'){
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Lap_Rekening.xls");
                echo $cRet;
            } else
                echo $cRet;

        } else {
            echo $this->m_ajax->getRekening();
        }
    }
    
    function ajaxSetRekening(){
        echo $this->m_ajax->setRekening();
    }
    
    function ajaxGetRekeningHeader(){
        echo $this->m_ajax->getRekeningHeader();
    }
    
    function ajaxGetProgram($print='',$to='',$d=''){
        if ($print=='print'){
            $query = $this->m_ajax->getProgram($print);
            $judul = "LAPORAN DAFTAR PROGRAM";
            
            $cRet = "<table style=\"border-left-style: none; border-bottom-style: none; border-right-style: none; border-top-style: none;border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\">
                        <thead>
                            <tr>
                                <td colspan=\"5\" style=\"text-align:center;border-top: none;border-left: none;border-right: none;\">&nbsp;<br>$judul<br>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"10%\"><b>KODE</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"40%\"><b>NAMA</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"30%\"><b>URUSAN</b></td>
                                <td style=\"border-top-style:1px;border-bottom-style:1px;border-left-style:1px;border-right-style:1px;text-align: center;\" bgcolor=\"#CCCCCC\" width=\"20%\"><b>JENIS</b></td>
                            </tr>
                        </thead>";
                                
            foreach ($query->result() as $row)
            {
               $cRet .= "<tr>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->kode."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->urusan." - ".$row->nama_urusan."</td>
                            <td style=\"vertical-align:top;\" align=\"left\">".$row->nama_jenis."</td>
                         </tr>";
            }                      
            $cRet .= "</table>";
            
            if ($to=='pdf')
                $this->_mpdf('Lap_Program.pdf','',$cRet,10,10,10,'P',$d);
            elseif ($to=='excel'){
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Lap_Program.xls");
                echo $cRet;
            } else
                echo $cRet;

        } else {
            echo $this->m_ajax->getProgram();
        }
    }
    
    function ajaxSetProgram(){
        echo $this->m_ajax->setProgram();
    }
    
}