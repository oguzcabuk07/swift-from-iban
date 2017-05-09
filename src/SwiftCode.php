<?php

namespace OguzCabuk\SwiftFromIban;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use OguzCabuk\SwiftFromIban\Common\ISwiftCode;

class SwiftCode implements ISwiftCode
{
    const URL = "https://www.ibancalculator.com";

    /**
     * Get Bank Swift Code from Iban
     *
     * @param string $Iban
     * @return string|null
     */
    public function getCode($Iban)
    {
        $client = new Client([
            "base_uri" => self::URL,
        ]);

        try {
            $response = $client->post("/iban_validieren.html", [
                "form_params" => [
                    "tx_valIBAN_pi1" => [
                        "iban" => $Iban,
                        "fi" => "fi",
                    ],
                    "no_cache" => 1,
                ]
            ]);
            $response = $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            $response = $e->getResponse()->getBody()->getContents();
        }

        $pattern = "/<b>BIC:<\/b>\s+(.*)>(.*)<\/a>/";
        preg_match_all($pattern, $response, $match);
        $code = isset($match[2][0]) ? $match[2][0] : null;

        if ($code == null) {
            $pattern = "/<b>BIC:<\/b>\s+(.*)<button/";
            preg_match_all($pattern, $response, $match);
            $code = isset($match[1][0]) ? $match[1][0] : null;
        }

        if ($code != null) {
            $code = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($code))))));
        }

        return $code;
    }
}