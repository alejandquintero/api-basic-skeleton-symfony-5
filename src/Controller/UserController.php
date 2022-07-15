<?php

// namespace App\Controller;

// use App\Entity\User;
// use App\Repository\UserRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Routing\Annotation\Route;

// class UserController extends AbstractController
// {   
//     public function __construct()
//     {

//     }

//     /**
//      * @Route("/users", name="user_get")
//      * 
//      * @return void
//      */

//     public function list(Request $request, UserRepository $userRepository){
//         $response = new JsonResponse();
//         $users= $userRepository->findAll();
//         $userAsArray =  [];
//         foreach($users as $user){
//             $userAsArray[] = [
//                 'id' => $user->getId(),
//                 // 'mail' => $user->getMail()
//             ];
//         }
//         $response->setData([
//             'success' => true,
//             'data' => $userAsArray
//         ]);
//         return $response;
//     }

//     /**
//      * 
//      * @Route("/user/create", name="create_book")
//      */

//     public function createUser(Request $request, EntityManagerInterface $em){
//         $user = new User();
//         $user->setName('Pablo');
//         $user->setLastname('Guti');
//         $user->setMail('pablo@correo.es');
//         // Primero se persiste para que Doctrine controle este objeto
//         $em->persist($user);
//         // Luego lo insertamos en la bd con flush
//         $em->flush();


//         $response = new JsonResponse();
//         $response->setData([
//             'success' => true,
//             'data'=>[
//                 'id' => $user->getId(),
//                 'name' => $user->getName(),
//                 'lastname' => $user->getLastname(),
//                 'mail' => $user->getMail()
//             ]
//         ]);
//         return $response;
//     }
// }



?>