<?php

namespace App\Http\Livewire;

use App\Models\Guests;
use Livewire\Component;
use Illuminate\Support\Facades\Cookie;
use App\Models\Events;
use App\Models\Tickets;

class Registration extends Component
{
    public $counter = 0;

    public $intro;
    public $selectedMembership;
    public $name_first;
    public $name_last;
    public $name_middle;
    public $email_address;
    public $company;
    public $sectorBoxoption = [];
    public $industry;
    public $reference;
    public $reference_text;
    public $expectation;
    public $connect = [];
    public $connect_text;
    public $ticket_type;
    public $events;
    public $ticketLink;
    public $payment_choices;
    public $paymentURL;
    public $count = 0;
    public $linkSet;
    public $imagePoster;

    protected $rules = [
        'name_first' => 'required|string|max:255',
        'name_last' => 'required|string|max:255',
        'name_middle' => 'nullable|string|max:255',
        'selectedMembership' => 'nullable|string|max:255',
        'email_address' => 'required|email|max:255',
        'company' => 'nullable|string|max:255',
        'industry' => 'nullable|string|max:255',
        'reference' => 'nullable|string|max:255',
        'reference_text' => 'nullable|string|max:255',
        'connect_text' => 'nullable|string|max:255',
        'sectorBoxoption' => 'nullable|string|max:255',
        'connect' => 'nullable|string|max:255',
    ];
    public $panels = [
        'intro',
        'membership',
        'name',
        'email_address',
        'company',
        'sectorBoxoption',
        'industry',
        'reference',
        'expectation',
        'connect',
        'ticket_type'
    ];

    public $activePanel;


    public function render()
    {
        // $this->events = Events::leftJoin('table_tickets', 'table_events.id', '=', 'table_tickets.event_id')
        //     ->where('table_events.active', 1)
        //     ->get([
        //         'table_tickets.payment_links',
        //         'table_tickets.ticket_names',
        //         'table_tickets.ticket_prices',
        //         'table_tickets.id as ticket_id',
        //         'table_events.event_name',
        //         'table_events.event_description',
        //         'table_events.poster',
        //     ]);


        $latestEventId = Events::orderBy('created_at', 'desc')
        ->limit(1)
        ->value('id');
    
    $events = Tickets::leftJoin('table_events', 'table_tickets.event_id', '=', 'table_events.id')
        ->where('table_tickets.event_id', '=', $latestEventId)
        ->get([
            'table_tickets.*', // Select all columns from table_tickets
            'table_events.event_name',
            'table_events.event_description',
            'table_events.poster',
        ]);
    

    $this->events = $events;
    
        

     
if($this->imagePoster){
    $this->imagePoster = $this->events[0]->poster;

}

        return view('livewire.registration', compact('events'));
    }

    public function mount()
    {

        $cookieData = Cookie::get('cookie');
        $data = unserialize($cookieData);


        if ($data) {
            $this->counter = $data['counter'] ?? 0;
            $this->activePanel = $data['activePanel'] ?? $this->panels[$this->counter];

            $this->name_first = $data['name_first'] ?? $this->name_first;
            $this->name_last = $data['name_last'] ?? $this->name_last;
            $this->name_middle = $data['name_middle'] ?? $this->name_middle;
            $this->selectedMembership = $data['selectedMembership'] ?? $this->selectedMembership;
            $this->email_address = $data['email_address'] ?? $this->email_address;

            $this->company = $data['company'] ?? $this->company;
            $this->industry = $data['industry'] ?? $this->industry;
            $this->reference = $data['reference'] ?? $this->reference;
            $this->reference_text = $data['reference_text'] ?? $this->reference_text;
            $this->connect_text = $data['connect_text'] ?? $this->connect_text;

            $this->sectorBoxoption = isset($data['sectorBoxoption']) ? explode('_@_', $data['sectorBoxoption']) : $this->sectorBoxoption;
            $this->connect = isset($data['connect']) ? explode('_@_', $data['connect']) : $this->connect;
        } else {
            $this->counter = 0;
            $this->activePanel = $this->panels[$this->counter];
        }




    }
    public function saveCookie()
    {
        $this->activePanel = $this->panels[$this->counter];

        $cookie = [
            'counter' => $this->counter,
            'activePanel' => $this->activePanel,
            'name_first' => $this->name_first,
            'name_last' => $this->name_last,
            'name_middle' => $this->name_middle,
            'selectedMembership' => $this->selectedMembership,

            'email_address' => $this->email_address,
            'company' => $this->company,
            'industry' => $this->industry,
            'reference' => $this->reference,
            'reference_text' => $this->reference_text,
            'connect_text' => $this->connect_text,
            'sectorBoxoption' => implode('_@_', $this->sectorBoxoption),
            'connect' => implode('_@_', $this->connect)
        ];
        Cookie::queue('cookie', serialize($cookie), 365);

    }


    public function nextPanel()
    {

        $this->counter += 1;
        $this->saveCookie();

    }
    public function back()
    {
        if ($this->counter <= 0) {
            $this->counter = 1;
        } else {
            $this->counter -= 1;
        }
        $this->saveCookie();

    }




    public function saveGuest()
    {



        $data = [
            'name_first' => $this->name_first,
            'name_last' => $this->name_last,
            'name_middle' => $this->name_middle,
            'selectedMembership' => $this->selectedMembership,
            'email_address' => $this->email_address,
            'company' => $this->company,
            'industry' => $this->industry,
            'reference' => $this->reference,
            'reference_text' => $this->reference_text,
            'connect_text' => $this->connect_text,
            'sectorBoxoption' => implode('_@_', $this->sectorBoxoption),
            'connect' => implode('_@_', $this->connect)
        ];


        Guests::create($data);

        $this->emit('showToast', ['message' => 'Data saved successfully!', 'type' => 'success']);


        Cookie::queue(Cookie::forget('adminCookie'));

        $this->render();
    }

}