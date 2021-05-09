<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ClassificationRepository;
use App\Repository\ClassiqueRepository;
use App\Repository\PeriodiqueRepository;
use App\Repository\SousCatRepository;
use App\Repository\SousClassificationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeriodiqueController extends AbstractController
{
    /**
     * @Route("/periodique", name="periodique")
     */
    public function index()
    {
        return $this->render('periodique/index.html.twig', [
            'controller_name' => 'PeriodiqueController',
        ]);
    }
    /**
     * @Route("/cherchePer", name="cherchePer", methods={"GET"})
     */
    public function cherchePer(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $periodiqueRepository = $em->getRepository("App\Entity\Classique");
        $livres = $periodiqueRepository->findByWord($request->query->get("search"));
        //var_dump($libelleSousCas[0]);
        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($livres as $livre){
            $responseArray[]= array(
                "idLiv"=>$livre->getId(),
                "cheminCouv"=>$livre->getCheminCouvPer(),
                "cheminLiv" => $livre->getCheminPer(),
                "titreLiv"=> $livre->getTitrePer(),
                "auteurLiv"=>$livre->getAuteurPer()
            );
            // dump('$libelleSousCat->getLibelleSousCat()');
            //echo $libelleSousCat->getLibelleSousCat();
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);
    }

    /**
     * @Route("/Per", name="webPer",methods={"GET"})
     *
     *
     */
    public function pdfShow(PeriodiqueRepository $periodiqueRepository): Response
    {
        $file=$_GET['file'];
        $fil='/uploads/periodique/'.$file;

        return $this->render('viewer1.html',['file'=>$fil]);
    }

    /**
     * @Route("/listPer", name="periodiqueList", methods={"GET"})
     *
     */
    public function listPer(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $periodiqueRepository = $em->getRepository("App\Entity\Periodique");
        $periodiques = $periodiqueRepository->createQueryBuilder("q")
            ->where("q.idVol = :idVol")
            ->setParameter("idVol", $request->query->get("idVol"))
            ->getQuery()
            ->getResult();

        //var_dump($libelleSousCas[0]);
        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($periodiques as $periodique){
            $responseArray[]= array(
                "idPer"=>$periodique->getId(),
                "cheminPer" => $periodique->getCheminPer(),
                "titrePer"=> $periodique->getTitrePer()
            );
            // dump('$libelleSousCat->getLibelleSousCat()');
            //echo $libelleSousCat->getLibelleSousCat();
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);
    }
    /**
     * @Route("/admin/listTheme", name="classique_cat", methods={"GET"})
     */
    public function listTheme()
    {
        $em = $this->getDoctrine()->getManager();
        $ClassRepository=$em->getRepository("App\Entity\Classification");
        $Class=$ClassRepository->findAll();
        $responseArray = array();
        foreach($Class as $Clas){
            $responseArray[]= array(
                "idTheme"=> $Clas->getId(),
                "theme" => $Clas->getTheme()
            );
            // dump('$libelleSousCat->getLibelleSousCat()');
            //echo $libelleSousCat->getLibelleSousCat();
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);
    }
    /**
     * @Route("/periodique", name="periodique")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function periodique(ClassificationRepository $classificationRepository,SousClassificationRepository $sousClassificationRepository,PeriodiqueRepository $periodiqueRepository)
    {
        $us=$this->getUser();
        $usId=$us->getId();
        return $this->render('listPer.html.twig',[
            'classifications' => $classificationRepository->findAll(),'sousClas'=> $sousClassificationRepository->findAll(),'periodiques'=>$periodiqueRepository->findAll(),'user'=>$us
        ]);
    }
    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     * @param Request $request
     * @return JsonResponse
     * @Route("/admin/listVol", name="listVol", methods={"GET"})
     */
    public function listVol(Request $request)
    {
        // Get Entity manager and repository
        is_int($request->query->get("idTheme"));
        $em = $this->getDoctrine()->getManager();
        $SousClassificationRepository = $em->getRepository("App\Entity\SousClassification");
        // Search the neighborhoods that belongs to the city with the given id as GET parameter "cityid"
        $vols = $SousClassificationRepository->createQueryBuilder("q")
            ->where("q.idTheme = :idTheme")
            ->setParameter("idTheme", ($request->query->get("idTheme")))
            ->getQuery()
            ->getResult();
        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($vols as $vol){
            $responseArray[] = array(
                "idVol" => $vol->getId(),
                "vol" => $vol->getVolume()
            );
        }
        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }

}
