<?php

require_once('temando.php');
$obj_tem = new TemandoWebServices;

$Weight = 5000;
$length = 5;
$Width = 3;
$height = 4;
$quantity = 2;


$username = 'TEMANDOTEST';
$password = 'temandopass1';
$endpoint = 'http://api.hazarikar.temando.com/schema/2009_06/server.wsdl';

$request = array ( 'anythings' => array ( 'anything' => array ( 0 => array ('class' => 'General Goods', 
																			'subclass' => 'Household Goods',
																			'packaging' => 'Box',
																			'qualifierFreightGeneralFragile' => 'N',
																			'weight' => $Weight,
																			'length' => $length,
																			'width' => $Width,
																			'height' => $height,
																			'distanceMeasurementType' => 'Centimetres',
																			'weightMeasurementType' => 'Grams',
																			'quantity' => $quantity, ), ), ),
					'anywhere' => array ( 	'itemNature' => 'Domestic',
											'itemMethod' => 'Door to Door',
											'originCountry' => 'AU',
											'originCode' => '4069',
											'originSuburb' => 'KENMORE', 
											'originIs' => 'Business', 
											'originBusDock' => 'N', 
											'originBusUnattended' => 'N', 
											'originBusForklift' => 'N', 
											'originBusLoadingFacilities' => 'N', 
											'originBusInside' => 'N', 
											'originBusNotifyBefore' => 'N',
											'originBusLimitedAccess' => 'N', 
											'originBusHeavyLift' => 'N', 
											'originBusContainerSwingLifter' => 'N', 
											'originBusTailgateLifter' => 'N', 
											'destinationCountry' => 'AU', 
											'destinationCode' => '4000', 
											'destinationSuburb' => 'BRISBANE', 
											'destinationIs' => 'Business', 
											'destinationBusDock' => 'N', 
											'destinationBusPostalBox' => 'N', 
											'destinationBusUnattended' => 'N', 
											'destinationBusForklift' => 'N', 
											'destinationBusLoadingFacilities' => 'N', 
											'destinationBusInside' => 'N', 
											'destinationBusNotifyBefore' => 'N', 
											'destinationBusLimitedAccess' => 'N', 
											'destinationBusHeavyLift' => 'N', 
											'destinationBusContainerSwingLifter' => 'N', 
											'destinationBusTailgateLifter' => 'N', ), 
						'anytime' => array ('readyDate' => '2014-11-24',
											'readyTime' => 'PM', ),
						'clientId' => '20420',
						'promotionCode' => 'A0001', 
						'general' => array ( 'goodsValue' => 5,
											 'goodsCurrency' => 'AUD', ), );
				
$response = $obj_tem->getQuotesByRequest($request,$username,$password,$endpoint);

echo '<PRE>';
print_r($response);
//echo sizeof($response);
//echo " Name of 1st carrier is " .$response['quote'][1]['carrier']['companyName'];
//echo "The carrier's listed for the quote are  " .$quote['']

//echo count($response['quote']);


for ($i=0;$i<sizeof($response['quote']);$i++)
{
    echo "Total Price " . $response['quote'][$i]['totalPrice']."\n";
    //Store only the totalPrice from all the carriers
    $tprice[] = array($response['quote'][$i]['totalPrice']);
    //Store extra details with the totalPrice
    $tpriceall[]= array($response['quote'][$i]['totalPrice'],$response['quote'][$i]['carrier']['companyName'],$response['quote'][$i]['carrier']['id']);
    echo "Base Price " .$response['quote'][$i]['basePrice']."\n";
    echo "Tax " .$response['quote'][$i]['tax']."\n";
    echo "Currency ".$response['quote'][$i]['currency']."\n";
    echo "Company Name " .$response['quote'][$i]['carrier']['companyName'] . "\n";
    echo "***************************************************"."\n";
}

//Print ONLY the TotalPrice from all carriers
//print_r($tprice);
//Store ONLY the most cheapest price amongst the carriers
$min = min($tprice);

//print_r($tpriceall);
//Print the cheapest price amongst the carriers
//print_r($min);

//$result = array_intersect($tpriceall,$min);

//Sorts the array in ascending order , i.e the cheapest - expensive
array_multisort($tpriceall);

//echo "The order of quotes from Cheapest to Expensive are as below "."\n";
print_r($tpriceall);

//***************************************************************************
// Make booking function
/*$quoteFilter = array ('quoteFilter' => array ('preference' => 'Carriers Only',
                                        'carriers' => array ('carrier' => array('carrierId' => $tpriceall[0][2]))));
$bookingRequest = array_push($request,$quoteFilter);


$bresponse = $obj_tem->makeBookingByRequest($bookingRequest,$username,$password,$endpoint);

print_r($bresponse);*/



?>

