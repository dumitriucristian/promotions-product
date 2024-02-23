<?php

namespace App\Controller;

use App\DTO\LowestPriceEnquiry;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductsController extends AbstractController
{
    
    #[Route('/products/{id}/lowest-price', name: 'lowest-price')]
    public function lowestPrice(Request $request, int $id, DTOSerializer $serializer): Response
    {
     
        $forceFail = $request->headers->has('force-fail');
        if($forceFail) {
            return $this->json([
                'message' => 'Bad error',
                'path' => 'src/Controller/ProductsController.php',
            ],400);
        }
        
      //  $lowestPrice = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class,'json');
        $lowestPriceEnquiry = new LowestPriceEnquiry();
        $lowestPriceEnquiry->setPrice(100);
        $lowestPriceEnquiry->setQuantity(5);
        $lowestPriceEnquiry->setProductId(1);
        $lowestPriceEnquiry->setRequestLocation("bucharest");

       $data = $serializer->serialize($lowestPriceEnquiry,'json');
        return new Response($data);


    }
}
