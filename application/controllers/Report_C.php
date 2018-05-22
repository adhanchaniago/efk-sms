<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
defined('BASEPATH') OR exit('No direct script access allowed');

Class Report_C extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('Excel');
                
    }

     function cellColor($cells,$color){
          

            $this->excel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                     'rgb' => $color
                )
            ));
        }

    public function Excel(){
        $objReader = PHPExcel_IOFactory::createReader("Excel2007");
        $objPHPExcel = $objReader->load("ref.xlsx");
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->setTitle("List Report BRANCH");
$objPHPExcel->setActiveSheetIndex(0);
     $Border = array(
          'borders' => array(
            'allborders' => array('style' => PHPExcel_Style_Border:: BORDER_THIN)

          )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B2:AB2'.$maxrow)->applyFromArray($Border);
//========================================================================================================================


//====================================== NAMA COLUMN RANGE ===============================================================
        $objPHPExcel->getActiveSheet()->setCellValue('B2','Title');

        $objPHPExcel->getActiveSheet()->setCellValue('C2','PR_DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('D2','PR_APPROVED_DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('E2','PO_DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('F2','ER_DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('G2','VALIDATOR1');
        $objPHPExcel->getActiveSheet()->setCellValue('H2','CHECKER');
        $objPHPExcel->getActiveSheet()->setCellValue('I2','CABANG');
        $objPHPExcel->getActiveSheet()->setCellValue('J2','BRANCH_NAME');
        $objPHPExcel->getActiveSheet()->setCellValue('K2','SLA_PR');
        $objPHPExcel->getActiveSheet()->setCellValue('L2','SLA_PO');

        $objPHPExcel->getActiveSheet()->setCellValue('M2','SLA_ER_DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('N2','SLA_KIRIM');
        $objPHPExcel->getActiveSheet()->setCellValue('O2','SLA_CABANG');
        $objPHPExcel->getActiveSheet()->setCellValue('P2','SLA_FIN');
        $objPHPExcel->getActiveSheet()->setCellValue('Q2','SLA_HQ');
       

//========================================================================================================================

//=================================================== ALIGMENT CELL  //===================================================
        $objPHPExcel->getActiveSheet()->getStyle('B2:B2'.$maxrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle('C2:C2'.$maxrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D2:D2'.$maxrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E2:E2'.$maxrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle('M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        

//========================================================================================================================

//==================================================== LEBAR CELL  //=====================================================

            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);


//========================================================================================================================
//=============================================== TAMPIL DATA KE EXCEL ===================================================
        $i = 3; // >>>>>> LETAK DATA AWAL DI CELL KE-3
        $a = 1; // >>>>>> NO URUT DATA

                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$a);

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('J'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('K'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('L'.$i,'2');
               
                $objPHPExcel->getActiveSheet()->setCellValue('M'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('N'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('O'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('P'.$i,'2');
                $objPHPExcel->getActiveSheet()->setCellValue('Q'.$i,'2');
                
               

                
                $i++;
                $a++;
           
//========================================================================================================================

//================================================= OUTPUT FILENAME EXCEL ================================================
            $date_now = date("d-m-Y");
            $objPHPExcel->setActiveSheetIndex(0);
            ob_end_clean();

            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            if($_POST['cek'] == 'Cabang'){
            header('Content-Disposition: attachment;filename="REPORT_BRANCH_'.$date_now.'.xlsx"'); // Nama File Keluar (Simpan) 
            } else {
                 header('Content-Disposition: attachment;filename="REPORT_HEADQUARTER_'.$date_now.'.xlsx"'); // Nama File Keluar (Simpan) 
            }
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            ob_end_clean();

            $objWriter->save('php://output');
            exit;

            $excel->disconnectWorksheets();
            unset($excel);


    }

    

}