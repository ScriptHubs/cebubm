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

class Dashboard extends Component
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





    public $initialGuestId;
    public function render()
    {

        $this->latestEventId = Events::orderBy('created_at', 'desc')
            ->limit(1)
            ->value('id');


        // $guests = Guests::select('guests.*', 'guests.id as guest_id', 'table_tickets.*', 'table_events.*')
        //     ->leftJoin('table_tickets', 'guests.tickets', '=', 'table_tickets.payment_links')
        //     ->leftJoin('table_events', 'table_tickets.event_id', '=', 'table_events.id')
        //     ->where('table_events.id', '=', $this->selectedGuestEvent)
        //     ->get();

        $guests = Guests::select('guests.*', 'guests.id as guest_id', 'table_tickets.*', 'table_events.*')
            ->leftJoin('table_tickets', 'guests.tickets', '=', 'table_tickets.payment_links')
            ->leftJoin('table_events', 'table_tickets.event_id', '=', 'table_events.id')
            ->where('table_events.id', '=', $this->selectedGuestEvent)
            ->paginate(11); // Use paginate() to get a paginated result


        $events = Tickets::leftJoin('table_events', 'table_tickets.event_id', '=', 'table_events.id')
            ->where('table_tickets.event_id', '=', $this->latestEventId)
            ->limit(8)
            ->get([
                'table_tickets.id',
                'table_tickets.ticket_names',
                'table_tickets.ticket_prices',
                'table_tickets.payment_links',
                'table_events.event_name',
                'table_events.event_date_from',
                'table_events.event_date_to',
                'table_events.event_description',
            ]);

        $originalSqlMode = DB::selectOne('SELECT @@sql_mode as sql_mode')->sql_mode;

        DB::statement("SET SESSION sql_mode=''");

        $eventsWithTotalGuests = DB::table('table_events AS te')
            ->select('te.*', DB::raw('SUM(guest_counts.guest_count) AS total_guests'))
            ->leftJoinSub(function ($query) {
                $query->select('tt.event_id', DB::raw('COUNT(guests.id) AS guest_count'))
                    ->from('table_tickets AS tt')
                    ->leftJoin('guests', 'tt.payment_links', '=', 'guests.tickets')
                    ->groupBy('tt.event_id');
            }, 'guest_counts', 'te.id', '=', 'guest_counts.event_id')
            ->groupBy('te.id')
            ->get();


        $this->events = $events;

        // if ($events->isEmpty()) {
        //     $events = 'empty';
        //     return view('livewire.dashboard')->with('events', $events);
        // } else {
            return view('livewire.dashboard', [
                'guestList' => $guests,
                'events' => $events,
                'eventsWithTotalGuests' => $eventsWithTotalGuests,
            ]);
        // }
    }

    public function mount($pageActive)
    {
        $this->ticketRows = 1;
        $this->latestEventId = Events::orderBy('created_at', 'desc')
            ->limit(1)
            ->value('id');

        $this->selectedGuestEvent = $this->latestEventId;
        $adminCookie = Cookie::get('adminCookie');
        $data = unserialize($adminCookie);

        if ($data) {
            $this->pageActive = $data['page'] ?? $this->pageActive;
            $this->subPage = $data['subPage'] ?? $this->subPage;
            $this->activeSetTicket = $data['activeSetTicket'] ?? $this->activeSetTicket;
            $this->activeSetConfirm = $data['activeSetConfirm'] ?? $this->activeSetConfirm;
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


        $guests = Guests::select('guests.*', 'guests.id as guest_id', 'table_tickets.*', 'table_events.*')
            ->leftJoin('table_tickets', 'guests.tickets', '=', 'table_tickets.payment_links')
            ->leftJoin('table_events', 'table_tickets.event_id', '=', 'table_events.id')
            ->where('table_events.id', '=', $this->latestEventId)
            ->get();

        if ($guests->isNotEmpty()) {
            $this->initialGuestId = $guests->first()->guest_id;
        }

        $this->viewGuestInfo($this->initialGuestId);
        $this->pageActive = 'view';
        $this->eventList = Events::get();

       
    }

    public function createWindow()
    {
        $this->pageActive = 'create';
        $this->activeSetTicket = false;
        $this->activeSetConfirm = false;
    }
    public function viewWindow()
    {
        $this->pageActive = 'view';
    }
    public $tempId;
    public function changeSubpage($subPage)
    {

        $this->subPage = $subPage;
        $this->saveCookie();

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

    public function activeToggle($eventId, $eventStatus)
    {

        $event = Events::find($eventId);

        $newStatus = $eventStatus == 0 ? 1 : 0;

        if ($event) {
            // Update the event status to inactive
            $event->update(['active' => $newStatus]);

        }
        return Redirect::to('/home');

    }
    public function viewGuestInfo($guest_id)
    {

        // $this->guestInformation = Guests::where('id', $guest_id)->get();
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

    public function activeSet($active)
    {

        if ($active === 0) {
            $this->activeSetTicket = false;
            $this->activeSetConfirm = false;
        } else if ($active === 1) {
            $this->activeSetTicket = true;
            $this->activeSetConfirm = false;
        } else if ($active === 2) {
            $this->activeSetTicket = true;
            $this->activeSetConfirm = true;
        }

        $this->saveCookie();

        if ($this->event_poster) {
            $this->event_poster_file_name = $this->event_poster->getClientOriginalName();
        }

    }


    public function addTicketRow()
    {
        $this->ticketRows += 1;
    }
    public function clearAll()
    {
        $this->reset(['event_name', 'event_description', 'event_from', 'event_to', 'event_poster', 'event_poster_file_name', 'tickets', 'payment_links', 'ticket_prices']);
        $this->emit('showToast', ['message' => 'Data saved successfully!', 'type' => 'success']);
        Cookie::queue(Cookie::forget('adminCookie'));
    }




    public function deleteTicketRow($row_id)
    {
        $this->tickets = array_intersect($this->tickets, $this->ticket_prices, $this->payment_links);
        $this->ticket_prices = array_intersect($this->tickets, $this->ticket_prices, $this->payment_links);
        $this->payment_links = array_intersect($this->tickets, $this->ticket_prices, $this->payment_links);

        if ($this->ticketRows >= 2) {
            $this->ticketRows -= 1;
            array_splice($this->tickets, $row_id, 1);
            array_splice($this->ticket_prices, $row_id, 1);
            array_splice($this->payment_links, $row_id, 1);
        }

    }



    public function saveCookie()
    {
        $this->tickets = array_intersect($this->tickets, $this->ticket_prices, $this->payment_links);
        $this->ticket_prices = array_intersect($this->tickets, $this->ticket_prices, $this->payment_links);
        $this->payment_links = array_intersect($this->tickets, $this->ticket_prices, $this->payment_links);




        $adminCookie = [
            'page' => $this->pageActive,
            'subPage' => $this->subPage,
            'activeSetTicket' => $this->activeSetTicket,
            'activeSetConfirm' => $this->activeSetConfirm,
            'selectedGuestEvent' => $this->selectedGuestEvent,
            'event_name' => $this->event_name,
            'event_from' => $this->event_from,
            'event_to' => $this->event_to,
            'event_description' => $this->event_description,
            'ticketRows' => $this->ticketRows,
            'tickets' => implode('_@_', $this->tickets),
            'ticket_prices' => implode('_@_', $this->ticket_prices),
            'payment_links' => implode('_@_', $this->payment_links)
        ];

        Cookie::queue('adminCookie', serialize($adminCookie), 365);


    }




    public function storeEvent()
    {
    
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

        $this->reset(['event_name',     'event_description', 'event_from', 'event_to', 'event_poster', 'event_poster_file_name', 'tickets', 'ticket_prices', 'payment_links']);
        $this->emit('showToast', ['message' => 'Data saved successfully!', 'type' => 'success']);
        Cookie::queue(Cookie::forget('adminCookie'));

        $this->render();

    }


}