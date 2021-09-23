<?php

declare(strict_types=1);

namespace usermatrix;
use \usermatrix\Config;

class ShopifyClient
{
    public function __construct()
    {
        $this->apikey = Config::SHOPIFY_API_KEY;
        $this->password = Config::SHOPIFY_PASSWORD;
        $this->hostname = Config::SHOPIFY_HOSTNAME;
        $this->build();
    }

    private function build()
    {
        $this->path = "https://{$this->apikey}:{$this->password}@{$this->hostname}";
    }

    public function getCustomer(
        string $id
        )
    {
        $endpoint = "/admin/api/2021-07/customers/{$id}.json";
        return $this->curl(
            endpoint: $endpoint
        );
    }

    public function curl(
        string $endpoint
        )
    {
        $shopifyApi = curl_init($this->path.$endpoint);
        curl_setopt($shopifyApi, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($shopifyApi, CURLOPT_HEADER, 0);
        curl_setopt($shopifyApi, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
        return curl_exec($shopifyApi);
    }
}
