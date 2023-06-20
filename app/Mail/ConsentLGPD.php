<?php

namespace App\Mail;

use App\Models\Document;
use App\Models\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsentLGPD extends Mailable
{
    use Queueable, SerializesModels;

    private $document;
    private $company;
    private $customerID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerID)
    {
        $this->customerID = $customerID;
        $this->company = session()->get('company');
        $this->document = Document::where(
                            'company_id', $this->company['id']
                            )
                            ->where(['status' => 1])
                            ->where(['type' => 1])
                            ->orderByDesc('version')
                            ->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $companyName = $this->company['name'];

        $baseUrl = "https://".$companyName.".".env('APP_URL');

        $termUrl = $baseUrl."/public/document/".$this->document->id."/accept/".$this->customerID;

        return $this->view('mails.consentlgpd', compact(
            'companyName', 
            'termUrl'
        ))->subject("Consentimento LGPD | ".$companyName);
    }
}
