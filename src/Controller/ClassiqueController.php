<?php

namespace App\Controller;

use App\Entity\Autorise;
use App\Entity\Classique;
use App\Entity\Lire;
use App\Entity\User;
use App\Controller\AdminController;
use App\Entity\Inscrit;
use App\Form\UserType;
use App\Form\Classique1Type;
use App\Repository\CategorieRepository;
use App\Repository\InscritRepository;
use App\Repository\ClassiqueRepository;
use App\Repository\LireRepository;
use App\Repository\AutoriseRepository;
use App\Repository\PeriodiqueRepository;
use App\Repository\SousCatRepository;
use App\Repository\MofonainaRepository;
use App\Repository\UserRepository;
use Cassandra\Date;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\File;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * @Route("/classique")
 */
class ClassiqueController extends AbstractController
{
   public $a=0;
    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     * @param Request $request
     * @return JsonResponse
     * @Route("/admin/listSousCat", name="classique_list_SousCat", methods={"GET"})
     */
    public function listSousCat(Request $request)
    {
        // Get Entity manager and repository
        is_int($request->query->get("idCat"));
        $em = $this->getDoctrine()->getManager();
        $SousCatsRepository = $em->getRepository("App\Entity\SousCat");

        // Search the neighborhoods that belongs to the city with the given id as GET parameter "cityid"

        $SousCats = $SousCatsRepository->createQueryBuilder("q")
            ->where("q.idCat = :idCat")
            ->setParameter("idCat", ($request->query->get("idCat")))
            ->getQuery()
            ->getResult();


        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($SousCats as $libellesousCat){
            $responseArray[] = array(
                "id" => $libellesousCat->getId(),
                "libelleSousCat" => $libellesousCat->getLibelleSousCat()
            );
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }


    /**
     * @Route("/listLivre", name="classiquelll", methods={"GET"})
     */
    public function listLivre(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $classiqueRepository = $em->getRepository("App\Entity\Classique");
        $livres = $classiqueRepository->createQueryBuilder("q")
            ->where("q.idSousCat = :idSousCat")
            ->setParameter("idSousCat", $request->query->get("idSousCat"))
            ->getQuery()
            ->getResult();

        //var_dump($libelleSousCas[0]);
        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($livres as $livre){
            $responseArray[]= array(
                "idLiv"=>$livre->getId(),
                "cheminLiv" => $livre->getCheminLiv(),
                "titreLiv"=> $livre->getTitreLiv()
            );
             // dump('$libelleSousCat->getLibelleSousCat()');
            //echo $libelleSousCat->getLibelleSousCat();
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);
    }
    /**
     * @Route("/chercheLiv", name="chercheLiv", methods={"GET"})
     */
    public function chercheLiv(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $classiqueRepository = $em->getRepository("App\Entity\Classique");
        if($request->query->get("par")==1){
            $livres = $classiqueRepository->findByTitre($request->query->get("search"));
        }
        else{
            $livres = $classiqueRepository->findByWord($request->query->get("search"));
        }
         //var_dump($libelleSousCas[0]);
        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($livres as $livre){
            $responseArray[]= array(
                "idLiv"=>$livre->getId(),
                "cheminCouv"=>$livre->getCheminCouv(),
                "cheminLiv" => $livre->getCheminLiv(),
                "titreLiv"=> $livre->getTitreLiv(),
                "auteurLiv"=>$livre->getAuteurLiv()
            );
            // dump('$libelleSousCat->getLibelleSousCat()');
            //echo $libelleSousCat->getLibelleSousCat();
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);
    }
    public function chercheAut(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $us=$this->getUser()->getId();
        }
        else{
            $us=$this->getUser()->getId();
        }
        $em = $this->getDoctrine()->getManager();
        $autoriseRepository = $em->getRepository("App\Entity\Autorise");

            $autos = $autoriseRepository->findAuto($us,$request->query->get("cheminLiv"));

        //var_dump($libelleSousCas[0]);
        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        if (!$autos){
            $file=$request->query->get("cheminLiv");
            $titre=$request->query->get("titreLiv");

            $fil='/uploads/files/';
            $dateDemande= new \DateTime('now');
            $autorise= new Autorise();
            $autorise->setTitreLivre($titre)
                ->setCheminLivre($file)
                ->setDateDemande($dateDemande)
                ->setIdUser($us)
                ->setAutorisation(0);
            $Manager= $this->getDoctrine()->getManager();
            $Manager->persist($autorise);
            $Manager->flush();
            $responseArray[]= array(
                "autorise"=> false
            );
        }
        else{
            foreach($autos as $livre){
                $responseArray[]= array(
                    "chemin"=> $livre->getCheminLivre(),
                    "titre"=> $livre->getTitreLivre(),
                    "autorise"=> $livre->getAutorisation()
                );
                // dump('$libelleSousCat->getLibelleSousCat()');
                //echo $libelleSousCat->getLibelleSousCat();
            }

        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);
    }

    /**
     * @Route("/new", name="classique_form", methods={"GET"})
     */
    public function indexNew()
    {
        $form=$this->createForm(Classique1Type::class,new Classique);
        $var['form']=$form->createView();
        return $this->render('classique/new.html.twig',$var);
    }
    /**
     * @Route("/admin/listCat", name="classique_cat", methods={"GET"})
     */
    public function listCat()
    {
        $em = $this->getDoctrine()->getManager();
        $CatRepository=$em->getRepository("App\Entity\Categorie");
        $Cats=$CatRepository->findAll();
        $responseArray = array();
        foreach($Cats as $cat){
            $responseArray[]= array(
                "idCat"=> $cat->getId(),
                "libelleCat" => $cat->getLibelleCat()
            );
            // dump('$libelleSousCat->getLibelleSousCat()');
            //echo $libelleSousCat->getLibelleSousCat();
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);
    }
    /**
     * @Route("/admin/listNumIvent", name="classique_numIvent", methods={"GET"})
     */
    public function listNumIvent(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $classiqueRepository=$em->getRepository("App\Entity\Classique");
        $numIvents = $classiqueRepository->createQueryBuilder("q")
            ->where("q.numIvent = :numIvent")
            ->setParameter("numIvent", $request->query->get("numIvent"))
            ->getQuery()
            ->getResult();
        $responseArray = 0;

            if($numIvents!=null)
            { $responseArray=1; }
        else{$responseArray=0;}   // dump('$libelleSousCat->getLibelleSousCat()');
            //echo $libelleSousCat->getLibelleSousCat();


        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);
    }
    /**
     * @Route("/aaa", name="classique_index", methods={"GET"})
     */
    public function index(ClassiqueRepository $classiqueRepository,CategorieRepository $categorieRepository): Response
    {

        return $this->render('classique/index.html.twig', [
            'classiques' => $classiqueRepository->findAll(),'categories'=>$categorieRepository->findAll()
        ]);
    }
    /**
     * @Route("/per", name="classique_index", methods={"GET"})
     */
    public function per(ClassiqueRepository $classiqueRepository): Response
    {

        return $this->render('perikopa.html.twig');
    }
    /**
     * @Route("/inscrit", name="inscrit", methods={"POST"})
     */
    public function inscrit(ClassiqueRepository $classiqueRepository,InscritRepository $inscritRepository,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $sinoda=$_POST['sinoda'];
        $nom=$_POST['nom'];
        $fonction=$_POST['fonction'];
        $email=$_POST['email'];
        $mdp=$_POST['password'];
        $inscrit= new Inscrit();
        $user= new User();
        $password = $passwordEncoder->encodePassword($user, $mdp);
        $inscrit->setEmail($email)
            ->setSinoda($sinoda)
            ->setNom($nom)
            ->setFonction($fonction)
            ->setPassword($password);
        $Manager= $this->getDoctrine()->getManager();
        $Manager->persist($inscrit);
        $Manager->flush();
        return $this->render('loginContact.html.twig');
    }
    /**
     * @Route("/inscrit_add", name="inscrit_add", methods={"POST"})
     */
    public function inscritAdd(InscritRepository $inscritRepository,UserRepository $userRepository,\Swift_Mailer $mailer): Response
    {
        $us=$this->getUser();
        $id=$_POST['id'];
        $sinoda=$_POST['sinoda'];
        $email=$_POST['email'];
        $nom=$_POST['nom'];
        $fonction=$_POST['fonction'];
        $sinoda=$_POST['sinoda'];
        $mdp=$_POST['password'];
         $user= new User();
         $user->setEmail($email)
            ->setFonction($fonction)
            ->setSinoda($sinoda)
            ->setPassword($mdp)
            ->setRoles(["ROLE_USER"])
            ->setUsername($nom);
        $Manager= $this->getDoctrine()->getManager();
        $Manager->persist($user);
        $Manager->flush();
        $inscri=$inscritRepository->findOneBySomeField($id);
        $message = (new \Swift_Message('Inscrit mail'))
            // On attribue l'expéditeur
            ->setFrom('faraniainadanie@gmail.com')
            // On attribue le destinataire
            ->setTo($email)
            // On crée le texte avec la vue
            ->setBody(
                $this->renderView(
                    'inscrit/inscrit.html.twig',[
                        'inscrit' => $inscri,
                    ]
                ),
                'text/html'
            )
        ;
        $mailer->send($message);

        $this->addFlash('message', 'votre demande est valider,vous pouvez vous connecter en biblotheque KTI avec votre email et votre password'); // Permet un message flash de renvoi

        $Manager->remove($inscri);
        $Manager->flush();
        return $this->render('admin.html.twig');
    }
    /**
     * @Route("/mofo", name="mofo", methods={"GET"})
     */
    public function mofo(ClassiqueRepository $classiqueRepository,MofonainaRepository $mofonainaRepository): Response
    {
        $us=$this->getUser();
        $date=$_GET['date'];
        $mofos=$mofonainaRepository->findAll();
        $responseArray= array();
        foreach($mofos as $mofo){
            $responseArray[]= array(
                "datee"=> $mofo->getDate(),
                "text"=> $mofo->getText()
            );}
        $dernier=count($mofos);
        return $this->render('mofonaina.html.twig', [ 'date'=>$date,'user'=>$us,
            'mofo' => $mofos,'dernier'=>$dernier]);
    }
    /**
     * @Route("/ooo", name="safidy")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function showUserAction(ClassiqueRepository $classiqueRepository,PeriodiqueRepository $periodiqueRepository,CategorieRepository $categorieRepository,LireRepository $lireRepository,SousCatRepository $sousCatRepository)
    {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return $this->render('admin.html.twig'); }
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $us=$this->getUser();
            $usId=$us->getId();
            $lires=$classiqueRepository->findAll();
            $dikas=$periodiqueRepository->findAll();
            foreach ($dikas as $dika){
                $valiny[]=array("id"=>$dika->getId(),);
            }
            $isadika=count($valiny);
            $dateDemande= new \DateTime('now');
            foreach($lires as $lire){
                $responseArray[]= array(
                    "id"=> $lire->getId(),
                );}
            $isa=count($responseArray);
            return $this->render('homepage.html.twig',['isa'=>$isa,'valiny'=>$isadika,'user'=>$us,'date'=>$dateDemande
            ]);
        }

    }
    /**
     * @Route("/listLiv", name="classique_list")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function listLiv(CategorieRepository $categorieRepository,SousCatRepository $sousCatRepository,ClassiqueRepository $classiqueRepository,LireRepository $lireRepository)
    {

        $us=$this->getUser();
        $usId=$us->getId();
        $LIRE=$lireRepository->findHistorique($usId);
        $aut=$classiqueRepository->findAllAut();
        return $this->render('listeLivre.html.twig',[
        'categories' => $categorieRepository->findAll(),'sousCats'=> $sousCatRepository->findAll(),'classiques'=>$classiqueRepository->findAll(),'lires'=>$LIRE,'user'=>$us,'auts'=>$aut
        ]);
    }
    /**
     * @Route("/home", name="classique_home")
     */
    public function home(CategorieRepository $categorieRepository,PeriodiqueRepository $periodiqueRepository,ClassiqueRepository $classiqueRepository)
    {
        $us=$this->getUser();
        $usId=$us->getId();
       $lires=$classiqueRepository->findAll();
$dikas=$periodiqueRepository->findAll();
foreach ($dikas as $dika){
    $valiny[]=array("id"=>$dika->getId(),);
}
$isadika=count($valiny);
        $dateDemande= new \DateTime('now');

        foreach($lires as $lire){
            $responseArray[]= array(
                "id"=> $lire->getId(),
                 );}
        $isa=count($responseArray);
        return $this->render('homepage.html.twig',['isa'=>$isa,'valiny'=>$isadika,'user'=>$us,'date'=>$dateDemande
        ]);
    }

    /**
     * @Route("/biblio", name="biblio")
     */
    public function biblio(CategorieRepository $categorieRepository,SousCatRepository $sousCatRepository,ClassiqueRepository $classiqueRepository)
    {$us=$this->getUser();
        $usId=$us->getId();
        return $this->render('contact.html.twig',['user'=>$us]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(CategorieRepository $categorieRepository,SousCatRepository $sousCatRepository,ClassiqueRepository $classiqueRepository)
    {

        return $this->render('loginContact.html.twig');
    }
    /**
     * @Route("/guide", name="guide")
     */
    public function guide(CategorieRepository $categorieRepository,SousCatRepository $sousCatRepository,ClassiqueRepository $classiqueRepository)
    {$us=$this->getUser();
        $usId=$us->getId();
        return $this->render('guide.html.twig',['user'=>$us]);
    }
    /**
     * @Route("/kti", name="kti")
     */
    public function kti(CategorieRepository $categorieRepository,SousCatRepository $sousCatRepository,ClassiqueRepository $classiqueRepository)
    {$us=$this->getUser();
        $usId=$us->getId();
        return $this->render('kti.html.twig',['user'=>$us]);
    }
    /**
     * @Route("/info", name="info",methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function info(CategorieRepository $categorieRepository,SousCatRepository $sousCatRepository,ClassiqueRepository $classiqueRepository)
    {
        $us=$this->getUser();
        $usId=$us->getId();
        $file=$_GET['file'];
        return $this->render('infoLiv.html.twig',['user'=>$us,'categories' => $categorieRepository->findAll(),'sousCats'=> $sousCatRepository->findAll(),'classique'=>$classiqueRepository->findOneBySomeField($file)]);
    }

    /**
     * @Route("/web", name="classique_pdf",methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
   // public function index(CategorieRepository $categorieRepository): Response
   /// {
     //   return $this->render('categorie/index.html.twig', [
     //       'categories' => $categorieRepository->findAll(),
     //   ]);
    //}
    public function telechargerPdf(ClassiqueRepository $classiqueRepository,AutoriseRepository $autoriseRepository): Response
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $us=$this->getUser()->getId();
        }
        else{
            $us=$this->getUser()->getId();
        }
        $file=$_GET['file'];
        $titre=$_GET['titreLivre'];

        $fil='/uploads/files/';
        $dateDemande= new \DateTime('now');
        $autorise= new Autorise();
        $autorise->setTitreLivre($titre)
            ->setCheminLivre($file)
        ->setDateDemande($dateDemande)
        ->setIdUser($us)
        ->setAutorisation(0);
  $Manager= $this->getDoctrine()->getManager();
  $Manager->persist($autorise);
  $Manager->flush();
        return $this->render('viewer.html',['file'=>'/uploads/files/'.$file]/*'classique'=> $classiqueRepository->findOneBySomeField($pdf)]*/);
    }
    public function showPdf(ClassiqueRepository $classiqueRepository,LireRepository $lireRepository): Response
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $us=$this->getUser()->getId();
        }
        else{
            $us=$this->getUser()->getId();
        }
        $file=$_GET['file'];
        $titre=$_GET['titreLivre'];

        $fil='/uploads/files/';
        $dateLire= new \DateTime('now');
        $lire= new Lire();
        $lire->setTitreLivre($titre)
            ->setCheminLivre($file)
            ->setDateLire($dateLire)
            ->setIdUser($us);
        $Manager= $this->getDoctrine()->getManager();
        $Manager->persist($lire);
        $Manager->flush();
        return $this->render('viewer.html',['file'=>'/uploads/files/'.$file]/*'classique'=> $classiqueRepository->findOneBySomeField($pdf)]*/);
    }
    public function affiche(ClassiqueRepository $classiqueRepository,LireRepository $lireRepository): Response
    {

        $file=$_GET['file'];

        $fil='/uploads/files/';
        return $this->render('viewer.html',['file'=>'/uploads/files/'.$file]/*'classique'=> $classiqueRepository->findOneBySomeField($pdf)]*/);
    }
    /**
     * @Route("/{id}", name="classique_show", methods={"GET"})
     */
    public function show(Classique $classique): Response
    {
        return $this->render('classique/show.html.twig', [
            'classique' => $classique,
        ]);
    }

}
