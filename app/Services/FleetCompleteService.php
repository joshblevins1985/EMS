<?php

namespace Vanguard\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Vanguard\Http\Clients\FleetCompleteClient;

class FleetCompleteService
{
    private $id;
    
    public function __construct(FleetCompleteClient $client)
    {
        $this->client = $client;
    }
    
     public function assets(): Collection
     {
         // Retrieve the data from the api
         
         $response = $this->client->get('GPS/Asset?skip=350');
         
         $body = json_decode((string) $response->getBody(), true);
         
         //dd($body);
         //Convert the data to a collection
         
         $collection = collect($body['Data'])->map(function($asset){
             return[
                 'LicensePlate' => $asset['LicensePlate'],
                 'VIN' => $asset['VIN'],
                 'Make' => $asset['Make'],
                 'Model' => $asset['Model'],
                 'Year' => $asset['Year'],
                 'Manufacturer' => $asset['Manufacturer'],
                 'ID' => $asset['ID'],
                 'Description' => $asset['Description']
                 ];
         });
         
         //Return the collection
         
         return $collection;
     }
     
     public function assetInformation($id): Collection
     {
         $response = $this->client->get('GPS/Asset/'.$id);
         
         $body = json_decode((string) $response->getBody(), true);
         
         //dd($body);
         //Convert the data to a collection
         
         $collection = collect(
             [
                'engineStatus' => $body['Data']['VehicleDetails']['IsEngineDisabled'],
                'odometer' =>  floor((float)$body['Data']['VehicleDetails']['Odometer'] / 1609.335),
                'location' => $body['Data']['Position']['Address'],
                'speed' => $body['Data']['Position']['Speed'],
                'speed_limit' => $body['Data']['Position']['SpeedLimitMI']
                 ]);
         
         
         
         return $collection;
         
     }
}