<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Illuminate\Http\Client\Request;
use Livewire\Component;


class ApiBabyName extends Component
{

    public $apiData = null;
    public $buttonName = "Find name baby";
    public $genderSelect;

    public $title = "Api Baby Name";

    public function loadingButton(\Symfony\Component\HttpFoundation\Request $request)
    {
        $this->buttonName = "Loading...";
        $this->buttonName = "Find name baby";
        dd($request);
        $this->apiRequest($request);
    }


    public function apiRequest(Request $request) : array
    {
        $client = new Client();
        

        if($request->genderSelect == null) {
            $this->genderSelect = "neutral";
        }

        if ($this->genderSelect != "neutral" || "boy" || "girl") {
            $this->apiData = array(0=>"Gender error");
        }

        $request = $client->get('https://api.api-ninjas.com/v1/babynames?gender=' . $this->genderSelect, [
            'headers' => [
                'Content-type' => 'application/json',
                'X-Api-Key' => 'p0WkEXuZvuYIVAQ8utKfLA==JO52yIOxvwprgI3X'
            ]
        ]
        );
        

        if($request->getStatusCode() !== 200) {
            return $this->apiData = array(0 => $request->getStatusCode());
        }

        $response = $request->getBody();
        return $this->apiData = json_decode($response, true);
    }

    public function render()
    {
        return view('livewire.api-baby-name');
    }
}
