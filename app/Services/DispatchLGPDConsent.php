<?php

namespace App\Services;

use App\Jobs\SendEmail;
use App\Jobs\SendSMS;
use App\Mail\ConsentLGPD;
use App\Models\Company;
use App\Models\ConsentSent;
use App\Models\Document;
use App\Models\SMS;
use Ramsey\Uuid\Uuid;

class DispatchLGPDConsent
{
    private $company;
    private $document;

    function __construct()
    {
        $this->company = session()->get('company');
        $this->document = Document::where(
                            'company_id', $this->company['id']
                            )
                            ->where(['status' => 1])
                            ->where(['type' => 1])
                            ->orderByDesc('version')
                            ->first();
    }

    //PRECISA APLICAR DESIGN PATTERN AQUI PARA OS IFS
    function send($type, $customer)
    {
        try {

            $consentID = Uuid::uuid4(); 

            $consent = ConsentSent::create([
                'id' => $consentID,
                'company_id' => $this->company['id'],
                'customer_id' => $customer->id,
                'type' => $type,
                'exception' => '',
                'document_id' => $this->document->id,
            ]);

            if ($type == 1) { //Send SMS

                $baseUrl = "https://".$this->company['name'].".".env('APP_URL');

                $termUrl = $baseUrl."/s/".substr($consentID, 0, 8);

                $message = "Ola, voce se cadastrou no sistema " . $this->company['name']; 
                $message .= ". Aceite o termo de consentimento no link: ";
                $message .= $termUrl;
                
                SendSMS::dispatch(
                    '5519992283258', 
                    '55'.$customer->cellphone, 
                    $message
                );
            } else { //E-mail
                SendEmail::dispatch(
                    $customer->email, 
                    new ConsentLGPD($customer->id)
                );
            }

        } catch (\Exception $e) {

            ConsentSent::create([
                'id' => Uuid::uuid4(),
                'company_id' => $this->company['id'],
                'customer_id' => $customer->id,
                'type' => $type,
                'exception' => $e->getMessage(),
                'document_id' => $this->document->id,
            ]);

        }
    }
}
