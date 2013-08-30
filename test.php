<?php
$client = new SoapClient('http://traindata.njtransit.com:8090/NJTTrainData.asmx?WSDL');
echo '<pre>';
print_r($client->__getFunctions());

/*
Array
(
    [0] => getTrainScheduleXMLResponse getTrainScheduleXML(getTrainScheduleXML $parameters)
    [1] => getStationListXMLResponse getStationListXML(getStationListXML $parameters)
    [2] => getTrainScheduleJSONResponse getTrainScheduleJSON(getTrainScheduleJSON $parameters)
    [3] => getTrainScheduleXMLResponse getTrainScheduleXML(getTrainScheduleXML $parameters)
    [4] => getStationListXMLResponse getStationListXML(getStationListXML $parameters)
    [5] => getTrainScheduleJSONResponse getTrainScheduleJSON(getTrainScheduleJSON $parameters)
)
*/

$soapParameters = array('UserCredentials'=>array('userName' => $username, 'password' => $password));

$soapFunction = "getTrainScheduleJSONResponse" ;
$soapFunctionParameters = Array('station' => "NY") ;

$soapClient = new soapClient($soapURL, $soapParameters);

$soapResult = $soapClient->__soapCall($soapFunction, $soapFunctionParameters);

?>
