<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Events;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cookie;
use App\Models\Tickets;
use App\Models\Guests;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
class DashboardPanels extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $pageActive;
    public $subPage;

    public $activeSetTicket;
    public $activeSetConfirm;
    public $event_name;
    public $event_from;
    public $event_to;
    public $event_description;
    public $event_poster;
    public $tickets = [];
    public $payment_links = [];
    public $ticket_prices = [];
    public $viewTickets;
    public $eventValue;
    public $ticketRows;
    public $event_poster_file_name;
    public $selectedGuestEvent;
    public $guest;
    public $eventList;
    public $viewEvent;
    public $guestInformation;
    public $latestEventId;
    public $mountTickets;
    public $mountEvents;
    public $selectedComponent;
    public $initialGuestId;
    public $eventToDelete;
    public $search_event;
    public $modalStatus;
    public $modalConfirm;
    public $forDeletionId;
    public $forDeletionName;

    public $edit_event_name;
    public $edit_event_from;
    public $edit_event_to;
    public $edit_event_description;
    public $searchResultsList = [];

    public $edit_event_id;

    public $edit_event_poster;
    public $edit_tickets;
    public $edit_ticket_prices;
    public $edit_payment_links;
    public $edit_ticket_names;
    public $edit_event_poster_update;

    public $guest_view_event_id;
    public $guest_view_event_name;
    public $guest_view_event_to;
    public $guest_view_event_from;
    public $guest_view_event_description;
    public $guest_view_event_poster;
    public $guest_view_tickets;
    public $guest_view_ticket_names;
    public $guest_view_ticket_prices;
    public $guest_view_payment_links;


    public function render()
    {

        $this->latestEventId = Events::orderBy('created_at', 'desc')
            ->limit(1)
            ->value('id');

        $this->viewEventDetails($this->latestEventId);

        // $this->guestList = $this->getGuests('render');

        $guests = Guests::select(
            'guests.id as guest_id',
            'table_events.id as table_events_id',
            'table_tickets.id as table_tickets_id',
            'name_first',
            'name_last',
            'name_middle',
            'selectedMembership',
            'email_address',
            'company',
            'industry',
            'expectation',
            'reference',
            'reference_text',
            'connect',
            'connect_text',
            'sectorBoxoption',
            'tickets',
            'guests.created_at as date_registered',
            'event_id',
            'event_name',
            'event_date_from',
            'event_date_to',
            'ticket_names',
            'ticket_prices',
            'payment_links'
        )
        ->leftJoin('table_tickets', 'table_tickets.id', '=', 'Guests.tickets')
        ->leftJoin('table_events', 'table_events.id', '=', 'table_tickets.event_id')
        ->paginate(10);


        return view('livewire.dashboard-panels')->with(['guestList' => $guests]);

    }



    public function mount($selectedComponent)
    {

        $this->ticketRows = 1;
        $this->latestEventId = Events::orderBy('created_at', 'desc')
            ->limit(1)
            ->value('id');
         $this->selectedComponent = 'selectedComponent';

        $this->selectedGuestEvent = $this->latestEventId;
        $adminCookie = Cookie::get('adminCookie');
        $posterCookie = Cookie::get('posterCookie');
        $data = unserialize($adminCookie);

        $posterIdentifier = Cookie::get('posterIdentifier');
        if ($posterIdentifier) {
            $filename = base64_decode($posterIdentifier);
            $fileContents = Storage::disk('public')->get($filename);
            $this->event_poster = $fileContents;
        }

        if ($data) {

            $this->selectedComponent = $data['selectedComponent'] ?? $this->selectedComponent;
            $this->event_name = $data['event_name'] ?? $this->event_name;
            $this->selectedGuestEvent = $data['selectedGuestEvent'] ?? $this->selectedGuestEvent;
            $this->event_from = $data['event_from'] ?? $this->event_from;
            $this->event_to = $data['event_to'] ?? $this->event_to;
            $this->event_description = $data['event_description'] ?? $this->event_description;
            $this->ticketRows = $data['ticketRows'] ?? $this->ticketRows;
            $this->tickets = isset($data['tickets']) ? explode('_@_', $data['tickets']) : $this->tickets;
            $this->ticket_prices = isset($data['ticket_prices']) ? explode('_@_', $data['ticket_prices']) : $this->ticket_prices;
            $this->payment_links = isset($data['payment_links']) ? explode('_@_', $data['payment_links']) : $this->payment_links;
        }

         $guests = Guests::select(
            'guests.id as guest_id',
            'table_events.id as table_events_id',
            'table_tickets.id as table_tickets_id',
            'name_first',
            'name_last',
            'name_middle',
            'selectedMembership',
            'email_address',
            'company',
            'industry',
            'expectation',
            'reference',
            'reference_text',
            'connect',
            'connect_text',
            'sectorBoxoption',
            'tickets',
            'guests.created_at as date_registered',
            'event_id',
            'event_name',
            'event_date_from',
            'event_date_to',
            'ticket_names',
            'ticket_prices',
            'payment_links'
        )
        ->leftJoin('table_tickets', 'table_tickets.id', '=', 'Guests.tickets')
        ->leftJoin('table_events', 'table_events.id', '=', 'table_tickets.event_id')
        ->paginate(10);

        if ($guests->isNotEmpty()) {
            $this->initialGuestId = $guests->first()->guest_id;
        }

        $this->modalStatus = '';

        $this->mountEvents = Events::orderBy('id', 'desc')->get();


        $this->viewGuestInfo($this->initialGuestId);
        $this->pageActive = 'view';
        $this->eventList = Events::get();


    }

    public function getGuests($event_id)
    {

        if ($event_id === 'render') {

            $guests = DB::table('Guests')
                ->leftJoin('table_tickets', 'table_tickets.id', '=', 'Guests.tickets')
                ->leftJoin('table_events', 'table_events.id', '=', 'table_tickets.event_id')
                ->select(
                    'guests.id as guest_id',
                    'table_events.id as table_events_id',
                    'table_tickets.id as table_tickets_id',
                    'name_first',
                    'name_last',
                    'name_middle',
                    'selectedMembership',
                    'email_address',
                    'company',
                    'industry',
                    'expectation',
                    'reference',
                    'reference_text',
                    'connect',
                    'connect_text',
                    'sectorBoxoption',
                    'tickets',
                    'guests.created_at as date_registered',
                    'event_id',
                    'event_name',
                    'event_date_from',
                    'event_date_to',
                    'ticket_names',
                    'ticket_prices',
                    'payment_links'
                )
                ->paginate(10);
    
        } else {
            $guests = DB::table('Guests')
                ->leftJoin('table_tickets', 'table_tickets.id', '=', 'Guests.tickets')
                ->leftJoin('table_events', 'table_events.id', '=', 'table_tickets.event_id')
                ->where('table_events.id', '=', $event_id) // Add the condition here
                ->select(
                    'guests.id as guest_id',
                    'table_events.id as table_events_id',
                    'table_tickets.id as table_tickets_id',
                    'name_first',
                    'name_last',
                    'name_middle',
                    'selectedMembership',
                    'email_address',
                    'company',
                    'industry',
                    'expectation',
                    'reference',
                    'reference_text',
                    'connect',
                    'connect_text',
                    'sectorBoxoption',
                    'tickets',
                    'guests.created_at as date_registered',
                    'event_id',
                    'event_name',
                    'event_date_from',
                    'event_date_to',
                    'ticket_names',
                    'ticket_prices',
                    'payment_links'
                )
                ->paginate(10);
dd($guests);
                return view('livewire.dashboard-panels')->with(['guestList' => $guests]);
        }
    }
    public function deleteEventConfirmation($event_id)
    {
        $event = Events::find($event_id);

        if ($event) {
            $event->delete();
            $this->modalToggle('0', '0');
        }


    }
    public function deleteEvent($event_id)
    {
        $event = Events::find($event_id);
        if ($event) {
            $this->modalToggle($event_id, $event->event_name);
        }

    }
    public function searchEvent()
    {
        $this->searchIsFocused = true;
        if ($this->search_event != '') {
            $results = Events::where('event_name', 'like', '%' . (string) $this->search_event . '%')
                ->get();
            if (!empty($results)) {
                $this->searchResultsList = $results;
            } else {
                $this->searchResultsList = '';
            }
        }




    }
    public function eventListGuest($event_id)
    {

        $events = Events::with('tickets')
            ->where('id', $event_id)
            ->get();

        $eventE = $events[0];
        $this->search_event = $eventE->event_name;
        $this->guest_view_event_id = $eventE->id;


    }



    public function editEvent($event_id)
    {

        $this->selectedComponent = 'editEvent';

        $events = Events::with('tickets')
            ->where('id', $event_id)
            ->get();
        $eventE = $events[0];

        $this->search_event = $eventE->event_name;

        $this->edit_event_id = $eventE->id;
        $this->edit_event_name = $eventE->event_name;
        $this->edit_event_to = Carbon::parse($eventE->event_date_to)->toDateString();
        $this->edit_event_from = Carbon::parse($eventE->event_date_from)->toDateString();
        $this->edit_event_description = $eventE->event_description;
        $this->edit_event_poster = $eventE->poster;
        $this->edit_tickets = $eventE->tickets;

        $ticketArrayNames = [];
        $ticketArrayPrice = [];
        $ticketArrayLink = [];

        foreach ($this->edit_tickets as $ticket) {
            array_push($ticketArrayNames, $ticket->ticket_names);
            array_push($ticketArrayPrice, $ticket->ticket_prices);
            array_push($ticketArrayLink, $ticket->payment_links);
        }
        $this->edit_ticket_names = $ticketArrayNames;
        $this->edit_ticket_prices = $ticketArrayPrice;
        $this->edit_payment_links = $ticketArrayLink;
        $this->ticketRows = count($this->edit_ticket_names);

        $this->editCookie();
    }

    public function component($selected)
    {
        $this->selectedComponent = $selected;
        $this->saveCookie();
        if ($selected === 'editEvent') {
            $this->clearEdit();
        }


    }
    public function modalToggle($event_id, $event_name)
    {
        if ($event_id != 0 && $event_name != 0) {
            $this->forDeletionId = $event_id;
            $this->forDeletionName = $event_name;
        }


        if ($this->modalStatus === 'show') {
            $this->modalStatus = '';
        } else {
            $this->modalStatus = 'show';
        }
    }


    public function getGuestEvent()
    {
        $guests = Guests::select('guests.*', 'guests.id as guest_id', 'table_tickets.*', 'table_events.*')
            ->leftJoin('table_tickets', 'guests.tickets', '=', 'table_tickets.payment_links')
            ->leftJoin('table_events', 'table_tickets.event_id', '=', 'table_events.id')
            ->where('table_events.id', '=', $this->selectedGuestEvent)
            ->paginate(11);
        $this->saveCookie();

    }


    public function viewGuestInfo($guest_id)
    {
        $this->guestInformation = Guests::select('*')
            ->leftJoin('table_tickets', 'table_tickets.payment_links', '=', 'guests.tickets')
            ->where('guests.id', '=', $guest_id)
            ->get();

    }



    public function viewEventDetails($event_id)
    {

        $this->viewEvent = Events::where('id', $event_id)->first();
        $this->viewTickets = Tickets::where('event_id', $event_id)->get();

    }





    public function addTicketRow()
    {
        $this->ticketRows += 1;
        $this->tickets[] = '';
        $this->ticket_prices[] = '';
        $this->payment_links[] = '';

    }
    public $searchIsFocused;
    public function searchUnfocused()
    {
        $this->searchIsFocused = false;
    }

    public function deleteTicketRow($row_id)
    {


        if ($this->ticketRows >= 2) {
            $this->ticketRows -= 1;
            array_splice($this->tickets, $row_id, 1);
            array_splice($this->ticket_prices, $row_id, 1);
            array_splice($this->payment_links, $row_id, 1);
        }

    }

    public function deleteEditTicketRow($row_id)
    {
        if ($this->ticketRows >= 2) {
            $this->ticketRows -= 1;
            array_splice($this->edit_ticket_names, $row_id, 1);
            array_splice($this->edit_ticket_prices, $row_id, 1);
            array_splice($this->edit_payment_links, $row_id, 1);
        }

    }
    public function clearAll()
    {
        $this->reset(['event_name', 'event_description', 'event_from', 'event_to', 'event_poster', 'event_poster_file_name', 'tickets', 'payment_links', 'ticket_prices']);

        Cookie::queue(Cookie::forget('adminCookie'));
    }
    public function clearEdit()
    {




        $this->reset([
            'search_event',
            'edit_event_name',
            'edit_event_to',
            'edit_event_from',
            'edit_event_description',
            'edit_event_poster',
            'edit_event_poster_update',
            'edit_tickets',
            'edit_ticket_names',
            'edit_ticket_prices',
            'edit_payment_links',
            'ticketRows',
            'edit_event_id'
        ]);

        $this->ticketRows = 1;

        Cookie::queue(Cookie::forget('editCookie'));
    }
    public function undoPosterUpdate()
    {
        $this->edit_event_poster_update = null;
        $this->reset(['edit_event_poster_update']);

    }
    public function saveCookie()
    {
        $adminCookie = [
            'selectedComponent' => $this->selectedComponent,
            'event_name' => $this->event_name,
            'event_from' => $this->event_from,
            'event_to' => $this->event_to,
            'event_description' => $this->event_description,
            'ticketRows' => $this->ticketRows,
            'tickets' => implode('_@_', $this->tickets),
            'ticket_prices' => implode('_@_', $this->ticket_prices),
            'payment_links' => implode('_@_', $this->payment_links)
        ];

        if ($this->event_poster) {
            $filename = $this->event_poster->store('posters', 'public');

            Cookie::queue('posterFilename', $filename);
        }

        Cookie::queue('adminCookie', serialize($adminCookie), 365);


    }

    public function editCookie()
    {

        $editCookie = [

            'selectedComponent' => $this->selectedComponent,
            'edit_event_name' => $this->edit_event_name,
            'edit_event_from' => $this->edit_event_from,
            'edit_event_to' => $this->edit_event_to,
            'edit_event_description' => $this->edit_event_description,
            'edit_event_poster' => $this->edit_event_poster,
            'ticketRows' => $this->ticketRows,
            'edit_ticket_names' => implode('_@_', $this->edit_ticket_names),
            'edit_ticket_prices' => implode('_@_', $this->edit_ticket_prices),
            'edit_payment_links' => implode('_@_', $this->edit_payment_links)
        ];

        if ($this->event_poster) {
            $filename = $this->event_poster->store('posters', 'public');

            Cookie::queue('posterFilename', $filename);
        }

        Cookie::queue('editCookie', serialize($editCookie), 365);
    }

    public function updateEvent()
    {
        $eventU = Events::find($this->edit_event_id);

        $ticketsU = Tickets::where('event_id', $this->edit_event_id)->get();
        $ticketsU = Tickets::where('event_id', $this->edit_event_id)->delete();

        $eventU->event_name = $this->edit_event_name;
        $eventU->event_date_from = $this->edit_event_from;
        $eventU->event_date_to = $this->edit_event_to;
        $eventU->event_description = $this->edit_event_description;
        $eventU->poster = $this->edit_event_poster;



        $numTickets = count($this->edit_ticket_names);
        for ($i = 0; $i < $numTickets; $i++) {
            Tickets::create([
                'event_id' => $this->edit_event_id,
                'ticket_names' => $this->edit_ticket_names[$i],
                'ticket_prices' => $this->edit_ticket_prices[$i],
                'payment_links' => $this->edit_payment_links[$i],
            ]);
        }

        if ($this->edit_event_poster_update) {
            $path = $this->edit_event_poster_update->store('posters', 'public');
            $eventU['poster'] = $path;
        }
        $saveSuccess = $eventU->save();

        if ($saveSuccess) {

            $this->clearEdit();

        } else {


        }


    }
    public function storeEvent()
    {

        $this->tickets;
        $this->ticket_prices;
        $this->payment_links;

        for ($i = count($this->tickets) - 1; $i >= 0; $i--) {
            if (
                empty($this->tickets[$i]) &&
                empty($this->ticket_prices[$i]) &&
                empty($this->payment_links[$i])
            ) {
                array_splice($this->tickets, $i, 1);
                array_splice($this->ticket_prices, $i, 1);
                array_splice($this->payment_links, $i, 1);
            }
        }


        $this->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_from' => 'required',
        ]);

        if ($this->event_poster) {
            $path = $this->event_poster->store('posters', 'public');
            $data['poster'] = $path;
        }


        $event = Events::create([
            'event_name' => $this->event_name,
            'event_description' => $this->event_description,
            'event_date_from' => $this->event_from,
            'event_date_to' => $this->event_to,
            'poster' => $data['poster'],
            'active' => '1'
        ]);

        $numTickets = count($this->tickets);
        for ($i = 0; $i < $numTickets; $i++) {
            Tickets::create([
                'event_id' => $event->id,
                'ticket_names' => $this->tickets[$i],
                'ticket_prices' => $this->ticket_prices[$i],
                'payment_links' => $this->payment_links[$i],
            ]);
        }

        $this->activeSetTicket = false;
        $this->activeSetConfirm = false;

        $this->reset(['event_name', 'event_description', 'event_from', 'event_to', 'event_poster', 'event_poster', 'tickets', 'ticket_prices', 'payment_links']);
        $this->emit('showToast', ['message' => 'Data saved successfully!', 'type' => 'success']);
        Cookie::queue(Cookie::forget('adminCookie'));

        $this->render();

    }


}