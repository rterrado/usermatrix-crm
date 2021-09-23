<?php

declare(strict_types=1);

namespace usermatrix;
use usermatrix\Config;
use usermatrix\ShopifyClient;
use cachebin\CacheBin;

class UserMatrix {

    private array $user;
    private bool $hasLoaded;

    public function __construct(
        private string $userID
        )
    {
        $this->hasLoaded = false;
    }

    public function doExist()
    {
        $cache= new CacheBin(
            appkey: Config::CACHE_BIN_APPKEY
        );
        $data = $cache->loadCache(
            $this->userID
        );

        # Return cache
        if ($data['cacheExists']) {
            $this->user = json_decode($data['cacheFile'],TRUE);
            $this->hasLoaded = true;
            return true;
        }

        # Get fresh data from Shopify's database
        $shopifyClient = new ShopifyClient();
        $userData = $shopifyClient->getCustomer($this->userID);

        # Check if the response has error, and it it has,
        # then return as user not found
        if (isset(json_decode($userData,TRUE)['errors'])) {
            return false;
        }

        $data = $cache->saveCache(
            cacheID: $this->userID,
            content: $userData
        );

        return true;

    }

    public function getCached()
    {

    }

}
