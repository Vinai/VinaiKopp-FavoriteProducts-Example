<?php

declare(strict_types = 1);

namespace VinaiKopp\FavoriteProducts\Model;

use Magento\Framework\Session\SessionManager;
use Magento\Framework\Session\Storage;
use VinaiKopp\FavoriteProducts\Model\Exception\InvalidFavoriteSkuException;

class FavoriteProductsSession extends SessionManager
{
    const STORAGE_KEY = 'favorite_skus';

    /**
     * @return string[]
     */
    public function getFavoriteSkus()
    {
        return array_values($this->getFavoritesData());
    }

    /**
     * @param string $sku
     */
    public function addFavoriteSku($sku)
    {
        $this->validateSku($sku);
        $favorites = $this->getFavoritesData();
        
        if (!in_array($sku, $favorites, true)) {
            $favorites[] = $sku;
            $this->setFavoritesData($favorites);
        }
    }

    /**
     * @param string $sku
     */
    public function removeFavoriteSku($sku)
    {
        $favorites = $this->getFavoritesData();
        $key = array_search($sku, $favorites, true);
        if (false !== $key) {
            unset($favorites[$key]);
            $this->setFavoritesData($favorites);
        }
    }

    private function validateSku($sku)
    {
        if (!is_string($sku)) {
            $message = sprintf('Favorite product SKUs have to be strings, got %s', gettype($sku));
            throw new InvalidFavoriteSkuException($message);
        }
        if (empty(trim($sku))) {
            throw new InvalidFavoriteSkuException('Favorite product SKUs must not be empty');
        }
    }

    private function getFavoritesData(): array
    {
        return (array) $this->getSessionStorage()->getData(self::STORAGE_KEY);
    }

    private function setFavoritesData(array $favorites)
    {
        $this->getSessionStorage()->setData(self::STORAGE_KEY, $favorites);
    }

    /**
     * This is ugly AF!
     * But still less coupling than overriding the constructor and having to get the storage from the context.
     * Another issue is that the Session\StorageInterface does not have a getData() method.
     */
    private function getSessionStorage(): Storage
    {
        /** @var Storage $storage */
        $storage = $this->storage;
        return $storage;
    }
}
