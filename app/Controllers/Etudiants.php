<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\EtudiantsFaModel;

class Etudiants extends BaseController
{
    public function __construct(){}
    public function index()
    {
        return view('etudiants_fa');
    }
    public function add()
    {
       $etudiantsFaModel =  new EtudiantsFaModel();
       $datas = [];
        if($_POST['results']){
            for ($i = 0; $i < 30; $i++) {
                $datas["etudiant_gender"] =  $_POST['results'][$i]["gender"];
                $datas["etudiant_nameFirst"] =  $_POST['results'][$i]["name"]["first"];
                $datas["etudiant_nameLast"] =  $_POST['results'][$i]["name"]["last"];
                $datas["etudiant_email"] =  $_POST['results'][$i]["email"];
                $datas["etudiant_phone"] =  $_POST['results'][$i]["phone"];
                $etudiantsFaModel->insert($datas);
            }
       }
      
    }
    public function loadatas()
    {
        $etudiantsFaModel =  new EtudiantsFaModel();
        $getDatas = $etudiantsFaModel->findAll();
        if (empty($getDatas)) {
            return 'rien';
        }else{
            $datas = json_encode($getDatas);
            return $datas;
        }
    }

    public function etudiantPdf() 
    {
       
        $etudiantsFaModel =  new EtudiantsFaModel();
        $getDatas = $etudiantsFaModel->findAll();
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pdf_view', array('datas'=> $getDatas)));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }

    public function sendEmail()
    {   
        $email = \Config\Services::email();
        if ($_POST['adressMail'] ) {
            
            if ( 0 < $_FILES['file']['error'] ) {
                return 'Error: ' . $_FILES['file']['error'] . '<br>';
            }
            else {
            $dirfile = 'uploads/' . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $dirfile);
            $email->setFrom('randripc2@gmail.com', 'dafa');
            $email->setTo($_POST['adressMail']);
            $email->attach($dirfile);
            $email->setSubject('Email Test');
            $email->setMessage('Testing the email class.');
            $email->send();
            return 'ok';
            }
         }
        
        
    }    
    
    public function delt($id = null){
        $id = 1;
		$model =  new EtudiantsFaModel();
		$model->delete();
        return true;
    }

    
   
}
