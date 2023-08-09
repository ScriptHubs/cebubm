<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Events;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cookie;
use App\Models\Tickets;

class Dashboard extends Component
{
    use WithFileUploads;

    public $page;
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


    public $ticketRows;
    public $event_poster_file_name;


    public function render()
    {

        return view('livewire.dashboard');
    }

    public function mount()
    {
        $this->ticketRows = 1;
        $this->page = 'create';


        $adminCookie = Cookie::get('adminCookie');
        $data = unserialize($adminCookie);

        if ($data) {
            $this->page = $data['page'] ?? $this->page;
            $this->subPage = $data['subPage'] ?? $this->subPage;
            $this->activeSetTicket = $data['activeSetTicket'] ?? $this->activeSetTicket;
            $this->activeSetConfirm = $data['activeSetConfirm'] ?? $this->activeSetConfirm;
            $this->event_name = $data['event_name'] ?? $this->event_name;

            $this->event_from = $data['event_from'] ?? $this->event_from;
            $this->event_to = $data['event_to'] ?? $this->event_to;
            $this->event_description = $data['event_description'] ?? $this->event_description;
            $this->ticketRows = $data['ticketRows'] ?? $this->ticketRows;

            $this->tickets = isset($data['tickets']) ? explode('_@_', $data['tickets']) : $this->tickets;
            $this->payment_links = isset($data['payment_links']) ? explode('_@_', $data['payment_links']) : $this->payment_links;
        } else {

        }


    }

    public function createWindow()
    {
        $this->page = 'create';
    }
    public function viewWindow()
    {
        $this->page = 'view';
    }

    public function changeSubpage($subPage)
    {
        $this->subPage = $subPage;
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
        $this->reset(['event_name', 'event_description', 'event_from', 'event_to', 'event_poster', 'event_poster_file_name', 'tickets', 'payment_links']);
        $this->emit('showToast', ['message' => 'Data saved successfully!', 'type' => 'success']);
        Cookie::queue(Cookie::forget('adminCookie'));
    }




    public function deleteTicketRow($row_id)
    {

        if ($this->ticketRows >= 2) {
            $this->ticketRows -= 1;
            array_splice($this->tickets, $row_id, 1);
            array_splice($this->payment_links, $row_id, 1);
        }

    }




    public function saveCookie()
    {
        $this->tickets = array_intersect($this->tickets, $this->payment_links);

        $adminCookie = [
            'page' => $this->page,
            'subPage' => $this->subPage,
            'activeSetTicket' => $this->activeSetTicket,
            'activeSetConfirm' => $this->activeSetConfirm,
            'event_name' => $this->event_name,
            'event_from' => $this->event_from,
            'event_to' => $this->event_to,
            'event_description' => $this->event_description,
            'ticketRows' => $this->ticketRows,

            'tickets' => implode('_@_', $this->tickets),
            'payment_links' => implode('_@_', $this->payment_links)
        ];

        $ticketCount = count($this->tickets);
        $paymentLinksCount = count($this->payment_links);


         $additionalData = [
                'tickets' => implode('_@_', $this->tickets),
                'payment_links' => implode('_@_', $this->payment_links)
         ];

      

        $adminCookie = array_merge($adminCookie, $additionalData);
        Cookie::queue('adminCookie', serialize($adminCookie), 365);


    }




    public function storeEvent()
    {
        $this->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_from' => 'required|date',
            'event_to' => 'required|date|after_or_equal:event_from',
            'event_poster' => 'image|max:2048',
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
            'poster' =>  $data['poster'],
            'active' => '1'
        ]);

        if ($this->event_poster) {
            $path = $this->event_poster->store('posters', 'public');
            $data['poster'] = $path;
        }


        $numTickets = count($this->tickets);
        for ($i = 0; $i < $numTickets; $i++) {
            Tickets::create([
                'event_id' => $event->id,
                'ticket_names' => $this->tickets[$i],
                'payment_links' => $this->payment_links[$i],
            ]);
        }

        $this->activeSetTicket = false;
        $this->activeSetConfirm = false;

        $this->reset(['event_name', 'event_description', 'event_from', 'event_to', 'event_poster', 'event_poster_file_name', 'tickets', 'payment_links']);
        $this->emit('showToast', ['message' => 'Data saved successfully!', 'type' => 'success']);
        Cookie::queue(Cookie::forget('adminCookie'));

        $this->render();

    }
}