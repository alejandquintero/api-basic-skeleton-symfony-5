<?php

namespace App\Controller\Api;

use App\Entity\Profession;
use App\Entity\User;
use App\Form\Type\UserFormType;
use App\Repository\ProfessionRepository;
use App\Repository\UserRepository;
use App\Service\TokenPassword;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends AbstractFOSRestController
{   

    /**
     * @Rest\Post(path="/users")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     * 
    */
    // public function getActions(UserRepository $userRepository)
    // {   
        
    //     return $userRepository->findAll();
    // }

    public function getActions(UserRepository $userRepository){
        $response = new JsonResponse();
        $statusCode =  Response::HTTP_OK;
        $user =  $userRepository->find('3');  
        $response->setData([
            'status' => $statusCode,
            'data' => [
                'name' => $user->getMail(),
                'profession' => $user->getProfession()->getUniversidadpais()
            ]
            ]);
        return $response;
    }   

    /**
     * @Rest\Post(path="/users/form")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     * 
     */

    public function postAction(Request $request, EntityManagerInterface $em)
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($form);
            $em->flush();
            return $user;
        }

        return $form;
     }

    /**
     * @Rest\Post(path="/users/create")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     * 
     */

    public function createAction(Request $request, EntityManagerInterface $em, ProfessionRepository $professionRepository)
    {

        if($request->getMethod() == 'POST'){

            $profession = $professionRepository->find('1');

            $user = new User();
            $data = json_decode($request->getContent(), true);

            $user->setName($data['name']);
            $user->setLastname($data['lastname']);
            $user->setMail($data['mail']);
            $user->setProfession($profession);

            $em->persist($user);
            $em->flush();

            return $user;
        }

        throw new HttpException('', 'Method not allowed');
     }

     /*Demo de servicio personalizado */
 
     /**
      * @Rest\Post(path="/users/token")
      * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
      * 
      */

     public function tokenAction(Request $request, EntityManagerInterface $em, TokenPassword $tokenPassword )
     {
         $token =  $tokenPassword->getMd5Password('123456');
         return $token;
      }



    }


?>