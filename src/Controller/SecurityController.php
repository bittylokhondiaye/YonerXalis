<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


    /**
     * @Route("/api")
     */
class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if(isset($values->email,$values->password)) {
            $user = new User();
            $user->setEmail($values->email);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setProfile($values->Profile);
            $user->setStatut("BLOQUER");
            $Profile=$values->Profile;
            $roles=[];
            if($Profile=="user" ){
                $roles=["ROLE_USER"];
            }
            else if($Profile=="admin"){
                $roles=["ROLE_ADMIN"];
            }
            else if($Profile=="superAdmin"){
                $roles=["ROLE_SUPER_ADMIN"];
            }
        
            $user->setRoles($roles);
            $user->setStatut($values->Statut);
            $errors = $validator->validate($user);
            if(count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés email et password'
        ];
        return new JsonResponse($data, 500);
    }


     /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }

    /**
     * @Route("/bloquer/{id}", name="bloquer" , methods={"POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function bloquer(Request $request,User $user,UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $userUpdate=$entityManager->getRepository(User::class)->find($user->getId());
        $values = json_decode($request->getContent());
        $user->getEmail($values->email);
        $user->getPassword();
        $user->getProfile();
        if($user->getStatut()=="BLOQUER"){
            $userUpdate->setStatut("DEBLOQUER");
        }
        else{
            $userUpdate->setStatut("BLOQUER");
        }
        $Statut=$values->Statut;
        if($Statut=="DEBLOQUER"){
            $roles=["ROLE_BLOQUE"];    
        }
        else{
            if($user->getProfile()=="user"){
                $roles=["ROLE_USER"];
            }
            else if($user->getProfile()=="admin"){
                $roles=["ROLE_ADMIN"];
            }
            else if($user->getProfile()=="superAdmin"){
                $roles=["ROLE_SUPER_ADMIN"];
            }
        }
        $user->setRoles($roles);
        $errors = $validator->validate($userUpdate);
            if(count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été mis a jour'
            ];

            return new JsonResponse($data, 201);

    }

    
}
