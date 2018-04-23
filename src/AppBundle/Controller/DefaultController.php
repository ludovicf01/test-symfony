<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Patient;
use AppBundle\Entity\medecin;

class DefaultController extends Controller
{
    
    public function indexAction()
    {
        
        // replace this example code with whatever you need
        $content = $this
            ->get('templating')
            ->render('AppBundle:Default:index.html.twig');

        return new Response($content);
    }
    
    public function loadFilesAction()
    {
        //scan du répertoire ../web/files
        $dir = '..' .DIRECTORY_SEPARATOR. 'web' .DIRECTORY_SEPARATOR. 'files';
        $files = scandir($dir);
        for($i = 0;$i < count($files); ++$i){
            $path = $dir .DIRECTORY_SEPARATOR. $files[$i];
            $txt_file    = file_get_contents($path);
            //parsing d'un fichier
            $rows        = explode("\n", $txt_file);
            
            foreach($rows as $row => $data)
            {
                $patient = new Patient();
                $medecin = new medecin;
                $em = $this->getDoctrine()->getManager();
                $row_data = explode('|', $data);
                //gére l'insertion des patient
                if($row_data[0] == "PID"){
                    $pid5 = explode('^', $row_data[5]);
                    $patient->setNom($pid5[0]);
                    $patient->setPrenom($pid5[1]);
                    $pid7 = explode('^', $row_data[7]);
                    $patient->setDateNaissance($pid7[0]);   
                    $pid8 = explode('^', $row_data[8]);
                    $patient->setGenre($pid8[0]);
                    $pid11 = explode('^', $row_data[11]);
                    $patient->setRue($pid11[0]);
                    $patient->setCodepostal($pid11[4]);
                    $patient->setVille($pid11[2]);
                    $em->persist($patient);
                }elseif ($row_data[0] == "ROL") {
                    $rol4 = explode('^', $row_data[4]);
                    $medecin->setNom($rol4[1]);
                    $medecin->setPrenom($rol4[2]);
                    if($rol4[12] == "RPPS")
                        $medecin->setRpps ($rol4[0]);
                    $em->persist($medecin);
                }
                $em->flush();
            }
        }

        $content = $this
            ->get('templating')
            ->render('AppBundle:Default:result.html.twig');

        return new Response($content);
    }
}