<?php

namespace App\DTO\Filter;

use App\DTO\PromotionEnquiryInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{

    public function apply(PromotionEnquiryInterface $enquiry): PromotionEnquiryInterface
    {

        $enquiry->setProductId(1);
        $enquiry->setPrice(100);
        $enquiry->setQuantity(5);
        $enquiry->setRequestLocation("bucharest");
        return $enquiry;
    }
}