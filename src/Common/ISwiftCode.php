<?php

namespace OguzCabuk\SwiftFromIban\Common;


interface ISwiftCode
{
    /**
     * Get Bank Swift Code from Iban
     *
     * @param string $Iban
     * @return string|null
     */
    public function getCode($Iban);
}