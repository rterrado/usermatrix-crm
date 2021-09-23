<?php

declare(strict_types=1);
namespace cachebin;

class CacheBin {

    private const BIN_PATH = '/data/cachebin/bins/';

    public function __construct(
        private string $appkey
        )
    {
        $this->bin = $_SERVER['DOCUMENT_ROOT'].CacheBin::BIN_PATH.$appkey;
    }

    public function loadCache (
        string $cacheID
        )
    {
        $cacheData = $this->bin.'/'.$cacheID.'.cache';
        if (!file_exists($cacheData)) {
            return [
                'cacheExists' => false,
                'cacheFile'=> ''
            ];
        }
        return [
            'cacheExists' => true,
            'cacheFile' => file_get_contents($cacheData)
        ];
    }

    public function saveCache(
        string $cacheID,
        string $content
        )
    {
        file_put_contents($this->bin.'/'.$cacheID.'.cache',$content);
    }

}
