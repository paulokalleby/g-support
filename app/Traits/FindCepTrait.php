<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait FindCepTrait
{
    public function getLocation()
    {
        $this->validate([
            'cep' => 'formato_cep',
        ]);

        $cep = str_replace(".", "",str_replace("-", "",$this->cep));

        $response = Http::withoutVerifying()->get('https://viacep.com.br/ws/'.$cep.'/json/');

        $data = $response->json();

        if(isset($data['erro'])){

            return false;

        }

        $this->city    = $data['localidade'];
        $this->state   = $data['uf'];            
        $this->address = $data['logradouro'].', '.$data['bairro'];
        
    }

}