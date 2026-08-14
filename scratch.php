<?php
$xmlString = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<ApiResponse xmlns="http://api.namecheap.com/xml.response">
  <CommandResponse Type="namecheap.users.getPricing">
    <UserGetPricingResult>
      <ProductType Name="DOMAIN">
        <ProductCategory Name="REGISTER">
          <Product Name="COM">
            <Price Duration="1" DurationType="YEAR" Price="9.98" Currency="USD"/>
          </Product>
        </ProductCategory>
      </ProductType>
    </UserGetPricingResult>
  </CommandResponse>
</ApiResponse>
XML;

$xml = simplexml_load_string($xmlString);
$products = $xml->CommandResponse->UserGetPricingResult->ProductType->ProductCategory->Product;

$pricingList = [];
foreach ($products as $product) {
    $tld = (string)$product['Name'];
    $priceElements = $product->Price;
    
    foreach ($priceElements as $priceData) {
        if ((string)$priceData['Duration'] === '1' && (string)$priceData['DurationType'] === 'YEAR') {
            $pricingList[] = [
                'tld' => '.' . strtolower($tld),
                'price_usd' => (float)$priceData['Price'],
                'currency' => (string)$priceData['Currency']
            ];
            break;
        }
    }
}
print_r($pricingList);
