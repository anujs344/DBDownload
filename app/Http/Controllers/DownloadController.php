<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mysqli;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Codedge\Fpdf\Fpdf\Fpdf;
use PhpOffice\PhpSpreadsheet\Exception;


class DownloadController extends Controller
{

    public function thirdpage(Request $req)
    {
        $conn = new mysqli($req->servername,$req->username,$req->password);
        
        if(isset($req->dbname))
        {
            
            $string = "Tables_in_".$req->dbname;
            $conn2 = new mysqli($req->servername,$req->username,$req->password,$req->dbname);
            $result = mysqli_query($conn2,"SHOW TABLES");   
            foreach($result->fetch_all() as $data)
            {
                    $group_table[] = $data[0];
            }
            
            $result1 =  $conn2->query("Show Databases");

            while ($row = $result1->fetch_object()){
            $group_arr[] = $row->Database;
            }
            $option = $req->dbname;
                    return view('third_page',compact('group_arr','group_table','option'));
        }
        
        $result =  $conn->query("Show Databases");
        while ($row = $result->fetch_object()){
            
            $group_arr[] = $row->Database;
        }
        return view('third_page',compact('group_arr'));
    }

    public function download(Request $req)
    {       


        $conn = new mysqli($req->servername, $req->username, $req->password, $req->dbname);

        if($req->type == "csv")
        {
            $sql = "SELECT * From  ".$req->tablename;
            $result = mysqli_query($conn,$sql);
            try{
                if(mysqli_fetch_assoc($result))
                {
                    while( $rows = mysqli_fetch_assoc($result) ) {
                        $developer_records[] = $rows;
                    }	
                }else{
                        $req->session()->flash('message',"Database Error");
                        return redirect()->back();
                    }
                	
                
                    $filename = "phpzag_data_export_".date('Ymd') . ".xls";			
                    header("Content-Type: application/vnd.ms-excel");
                    header("Content-Disposition: attachment; filename=\"$filename\"");	
                    $show_coloumn = false;
                    if(!empty($developer_records)) {
                    foreach($developer_records as $record) {
                        if(!$show_coloumn) {
                        echo implode("\t", array_keys($record)) . "\n";
                        $show_coloumn = true;
                        }
                        echo implode("\t", array_values($record)) . "\n";
                    }
                    }
            }catch(Exception $e){
                $req->session()->flash('message',"Database Error");
                return redirect()->back();
            }
            
                 
        }
        elseif($req->type == "pdf")
        {
            try{
                $sql = "SELECT * From  ".$req->tablename;
                $result1 = mysqli_query($conn,$sql);
                
                    if(mysqli_fetch_assoc($result1))
                    {
                        while( $rows = mysqli_fetch_assoc($result1) ) {
                            $result[] = $rows;
                        }	
                    }
                    else
                    {
                        $req->session()->flash('message',"Database Error");
                        return redirect()->back();
                    }
    
                $pdf = new Fpdf();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',16);
    
               
                foreach($result as $row) {
                    $pdf->Ln();
                    foreach($row as $column)
                        $pdf->Cell(30,12,$column,1);
                }
                $pdf->Output();
            }catch(Exception $e)
            {
                $req->session()->flash('message',"Database Error");
                return redirect()->back();
            }
            

        }
        elseif($req->type == 'txt')
        {
            try{
                $sql = "SELECT * From  ".$req->tablename;
                $result = mysqli_query($conn,$sql);
                if(mysqli_fetch_assoc($result))
                {
                    while( $rows = mysqli_fetch_assoc($result) ) {
                        $developer_records[] = $rows;
                    }	
                }else{
                        $req->session()->flash('message',"Database Error");
                        return redirect()->back();
                    }
    
              
                
                    $filename = "phpzag_data_export_".date('Ymd') . ".doc";			
                    header("Content-Type: application/vnd.ms-docs");
                    header("Content-Disposition: attachment; filename=\"$filename\"");	
                    $show_coloumn = false;
                    if(!empty($developer_records)) {
                      foreach($developer_records as $record) {
                        if(!$show_coloumn) {
                          echo implode("\t", array_keys($record)) . "\n";
                          $show_coloumn = true;
                        }
                        echo implode("\t", array_values($record)) . "\n";
                      }
                    }
                    exit;
            }catch(Exception $e)
            {
                $req->session()->flash('message',"Database Error");
                return redirect()->back();
            }
            
        }
        else
        {
            $req->session()->flash('message',"Please Select Proper Values");
            return redirect()->back();
        }
         

        
        
    }
}
