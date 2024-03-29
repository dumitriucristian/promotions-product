<?php

namespace App\Controller;

use App\DTO\Filter\PromotionsFilterInterface;
use App\DTO\LowestPriceEnquiry;
use App\DTO\PromotionEnquiryInterface;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsController extends AbstractController
{
    
    #[Route('/products/{id}/lowest-price', name: 'lowest-price')]
    public function lowestPrice(
        Request $request,
        int $id,
        DTOSerializer $serializer,
        PromotionsFilterInterface $promotionsFilter
    ): Response
    {
     
        $forceFail = $request->headers->has('force-fail');
        if($forceFail) {
            return $this->json([
                'message' => 'Bad error',
                'path' => 'src/Controller/ProductsController.php',
            ],400);
        }
        
        $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class,'json');
      //  $lowestPriceEnquiry = new LowestPriceEnquiry();
    //


        //apply a filter to the lo
        $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry);
       // dd($modifiedEnquiry);



       $data = $serializer->serialize($modifiedEnquiry,'json');
        return new Response($data);


    }
}
