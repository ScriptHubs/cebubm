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
    public $affiliated_event;
    public $ticket_id_bought;
    protected $rules = [
        'name_first' => 'required|string|max:255',
        'name_last' => 'required|string|max:255',
        'name_middle' => 'nullable|string|max:255',
        'selectedMembership' => 'nullable|string|max:255',
        'email_address' => 'required|email|max:255',
        'company' => 'nullable|string|max:255',
        'industry' => 'nullable|string|max:255',
        'expectation' => 'nullable|string|max:255',
        'reference' => 'nullable|string|max:255',
        'reference_text' => 'nullable|string|max:255',
        'connect_text' => 'nullable|string|max:255',
        'sectorBoxoption' => 'nullable|string|max:255',
        'connect' => 'nullable|string|max:255',
        'tickets' => 'nullable|string|max:255',
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
   


        $latestEventId = Events::where('active', 1)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->value('id');

        $events = Tickets::leftJoin('table_events', 'table_tickets.event_id', '=', 'table_events.id')
            ->where('table_tickets.event_id', '=', $latestEventId)
            ->get([
                'table_tickets.id',
                'table_tickets.ticket_names',
                'table_tickets.ticket_prices',
                'table_tickets.payment_links',
                'table_events.event_name',
                'table_events.event_description',
                'table_events.poster',
            ]);
         

        $this->events = $events;
        $this->affiliated_event = $latestEventId;

        if ($events->isEmpty()) {
            $events = 'empty';
            return view('livewire.registration')->with('events', $events);
        } else {
            $this->imagePoster = $this->events[0]->poster;

            return view('livewire.registration', compact('events'));
        }


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

            $this->expectation = $data['expectation'] ?? $this->expectation;

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
            'expectation' => $this->expectation,

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


    public function nextPanel($check)
    {

        if ($check === 'intro') {
            $this->counter += 1;
            $this->saveCookie();
        }
        if ($check === 'membership') {
            if ($this->selectedMembership === null) {

            } else {
                $this->counter += 1;
                $this->saveCookie();
            }

        }
        if ($check === 'name') {
            if ($this->name_first === null || $this->name_last === null || $this->name_last === null) {
            } else {
                $this->counter += 1;
                $this->saveCookie();
            }

        }
        if ($check === 'email') {
            if ($this->email_address === null) {
            } else {
                $this->counter += 1;
                $this->saveCookie();
            }

        }
        if ($check === 'company') {
            if ($this->company === null) {
            } else {
                $this->counter += 1;
                $this->saveCookie();
            }

        }
        if ($check === 'sector') {
            if (count($this->sectorBoxoption) === 1) {
       
            } else {
                $this->counter += 1;
                $this->saveCookie();
            }

        }
        if ($check === 'industry') {
            if ($this->industry === null) {

            } else {
                $this->counter += 1;
                $this->saveCookie();
            }
        }
        if ($check === 'reference' || $check === 'reference_text') {
            if ($this->reference != null || $this->reference_text != null) {
                $this->counter += 1;
                $this->saveCookie();
            }

        }
        if ($check === 'expectation') {
            if ($this->expectation === null) {

            } else {
                $this->counter += 1;
                $this->saveCookie();
            }

        }
        if ($check === 'connect' || $check === 'connect_text') {
            if ($this->connect != null || $this->connect_text != null) {
                $this->counter += 1;
                $this->saveCookie();
            }
        }

        $this->render();
        return redirect(url('/'));
        // $this->counter += 1;
        // $this->saveCookie();

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
            'expectation' => $this->expectation,
            'industry' => $this->industry,
            'affiliated_event' =>   $this->affiliated_event,
            'reference' => $this->reference,
            'tickets' => $this->ticketLink,
            'sectorBoxoption' => implode('_@_', $this->sectorBoxoption),
            'connect' => implode('_@_', $this->connect)
        ];


        $emptyValues = [];

        foreach ($data as $key => $value) {
            if (empty($value)) {
                $emptyValues[] = $key;
            }
        }

        $additionalData = [
            'reference_text' => $this->reference_text,
            'connect_text' => $this->connect_text,
        ];


        $data = array_merge($data, $additionalData);


        if (count($emptyValues) > 2) {

        } else {

            Guests::create($data);

            Cookie::queue(Cookie::forget('cookie'));

            $this->reset(
                [
                    'name_first',
                    'name_last',
                    'name_middle',
                    'selectedMembership',
                    'email_address',
                    'company',
                    'expectation',
                    'industry',
                    'reference',
                    'reference_text',
                    'connect_text',
                    'sectorBoxoption',
                    'connect'
                ]
            );

            $this->render();

        }



    }

}