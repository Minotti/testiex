<?php

namespace App\Repositories;

use App\Models\HistoricalPrices;
use GuzzleHttp\Client;

class IEXRepository
{
    private $client;
    private $sandbox = 'https://sandbox.iexapis.com';
    private $production = 'https://cloud.iexapis.com';
    private $url;
    private $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = env('IEX_TOKEN');

        if(env('IEX_SANDBOX')) {
            $this->url = $this->sandbox;
        } else {
            $this->url = $this->production;
        }
    }

    public function quote($symbol)
    {
        try {
            $res = $this->client->get('/stable/stock/' . $symbol . '/quote?token=' . $this->token, ['base_uri' => $this->url]);
        } catch (\Exception $e){
            if($e->getCode() == 404){
                return ['code' => 404, 'message' => 'Símbolo não encontrado'];
            }

            return ['code' => $e->getCode(), 'message' => 'Não foi possível concluir a busca.'];
        }

        $json = json_decode($res->getBody()->getContents());
        return ['code' => 200, 'company' => $json->companyName, 'latestPrice' => $json->latestPrice];
    }

    public function history($symbol, $range)
    {
        try {
            $uri = "/stable/stock/$symbol/chart/$range";
            $historical_prices = HistoricalPrices::where(['symbol' => $symbol, 'endpoint_searched' => $uri])->whereDate('created_at', now()->format('Y-m-d'))->first();

            if($historical_prices){
                $historical_prices = json_decode($historical_prices->historic);
            }else {
                $r = $this->client->get($uri."?token=".env('IEX_TOKEN'), ['base_uri' => $this->url]);
                $historical_prices = $r->getBody()->getContents();

                HistoricalPrices::create(['symbol' => $symbol, 'endpoint_searched' => $uri, 'historic' => $historical_prices]);
                $historical_prices = json_decode($historical_prices);
            }

            return $historical_prices;
        } catch (\Exception $e){
            if($e->getCode() == 404){
                return ['error' => 404, 'message' => 'Símbolo não encontrado'];
            }
            return ['code' => $e->getCode(), 'message' => 'Não foi possível concluir a busca.'];
        }
    }
}