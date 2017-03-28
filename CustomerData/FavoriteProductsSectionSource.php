<?php

declare(strict_types = 1);

namespace VinaiKopp\FavoriteProducts\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use VinaiKopp\FavoriteProducts\Api\FavoriteProductsRepositoryInterface;

class FavoriteProductsSectionSource implements SectionSourceInterface
{
    /**
     * @var FavoriteProductsRepositoryInterface
     */
    private $favoriteProductsRepository;

    public function __construct(FavoriteProductsRepositoryInterface $favoriteProductsRepository)
    {
        $this->favoriteProductsRepository = $favoriteProductsRepository;
    }

    public function getSectionData()
    {
        return ['skus' => $this->favoriteProductsRepository->getSkus()];
    }
}
