<?php
/**
 * Created by PhpStorm.
 * User: xaedo
 * Date: 2020/6/10
 * Time: 11:38
 */
namespace Xaedon\Scanner;

class Scanner
{
    protected $urls;

    protected $httpClient;

    public function __construct(array $urls)
    {
        $this->urls = $urls;
        $this->httpClient = new \GuzzleHttp\Client();
    }

    public function getInvalidUrls()
    {
        $invalidUrls = [];
        foreach ($this->urls as $url){
            try{
                $statusCode = $this->getStatusCodeForUrl($url);
            }catch (\Exception $e){
                $statusCode = 500;
            }
            if ($statusCode >= 400){
                array_push($invalidUrls,['url'=>$url,'status'=>$statusCode]);
            }
        }
        return $invalidUrls;
    }

    public function getStatusCodeForUrl(string $url)
    {
        $httpResponse = $this->httpClient->post($url);

        return $httpResponse->getStatusCode();
    }
}