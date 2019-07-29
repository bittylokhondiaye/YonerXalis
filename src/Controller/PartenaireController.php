<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Partenaire;
use App\Entity\UserPartenaire;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/api")
 */

class PartenaireController extends AbstractController
{
    /**
     * @Route("/partenaire", name="partenaire")
     */
    public function index()
    {
        return $this->render('partenaire/index.html.twig', [
            'controller_name' => 'PartenaireController',
        ]);
    }


    /**
     * @Route("/api/partenaires", name="ajouPartenaire",methods={"POST"}) 
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function ajoutPartenaire(Partenaire $partenaire,Request $request,SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $partenaire=$serializer->deserialize($request->getContent(),Partenaire::class,'json');
        $entityManager->persist($partenaire);
        $entityManager->flush();
        $data=[
            'status'=>201,
            'message'=>'partenaire ajouté'
        ];

        return new JsonResponse($data,201);
    }


    /**
     * @Route("/userPartenaires", name="addUserPartenaire", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function addUserPartenaire(Request $request, SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $userPartenaire = $serializer->deserialize($request->getContent(), UserPartenaire::class, 'json');
        $entityManager->persist($userPartenaire);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Le UserPartenaire a bien été ajouté'
        ];
        return new JsonResponse($data, 201);
    }

    /**
     * @Route("/userPartenaires/adminPartenaires", name="addAdminPartenaire", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function addAdminPartenaire(Request $request, SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $AdminPartenaire = $serializer->deserialize($request->getContent(), AdminPartenaire::class, 'json');
        $entityManager->persist($AdminPartenaire);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'L\'admin partenaire a bien été ajouté'
        ];
        return new JsonResponse($data, 201);
    }


}
