


<div class="col">
    
    <div class="card d-flex dashboard-body">
        <div class="card-body">
            <div class="d-flex flex-column">
                <div class="card-header ">
                    <div class="row">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto col pt-1 ps-2">
                            <h6 class="text-test">
                                <a class="me-2 no-decor @if ($pageActive === 'view') fw-bold @endif"
                                    wire:click='viewWindow'>View</a>
                                <a class="me-2 no-decor @if ($pageActive === 'create') fw-bold @endif"
                                    wire:click='createWindow'>Create</a>
                            </h6>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto col">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endif
                            @else
                            <li class="nav-item dropdown text-end">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>




                <div class="container ">
                    @if ($pageActive === 'view')
                    <div class="row my-2 pt-2">
                        <div class="col mb-3"> <button
                                class="w-100 btn @if ($subPage === 'events') btn-primary     @else btn-secondary @endif rounded rounded-5"
                                wire:click="changeSubpage('events')">Events</button>
                        </div>
                        <div class="col"> <button
                                class="w-100 btn rounded rounded-5  @if ($subPage === 'guest') btn-primary @else btn-secondary @endif"
                                wire:click="changeSubpage('guest')">Guests</button>
                        </div>

                    </div>

                    @if ($subPage === 'events')
                    <div class="d-flex flex-column  border border-2 rounded-2 py-2 px-3">
                        @if ($events === 'empty')
                        @else
                        @if (!empty($viewEvent))

                        <div class="modal fade" id="viewEvent" tabindex="-1" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title fs-6 text-muted pt-3" id="">
                                            Status: {{ $viewEvent->active }} |

                                            <span class="cursor-pointer"
                                                wire:click="activeToggle({{ $viewEvent->id }}, {{ $viewEvent->active }} )">
                                                @if ($viewEvent->active === '1')
                                                <i class=" p-1 border rounded-5 text-white bg-success fa fa-check"></i>
                                                event is active, disable this event?
                                                @elseif ($viewEvent->active === '0')
                                                <i class=" p-1 border rounded-5 text-white bg-danger fa fa-xmark"></i>
                                                event is disabled, activate event retistration?
                                                @endif
                                            </span>


                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                    <h3><b> Event</b>: {{ $viewEvent->event_name }}</h3>
                                                    <h5><b> Description</b>: {{ $viewEvent->event_description }}
                                                    </h5>
                                                    <h5> <b>Date</b>:
                                                        @if ($viewEvent->event_date_from != $viewEvent->event_date_to)
                                                        {{ date('Y-m-d', strtotime($viewEvent->event_date_from)) }}
                                                        -
                                                        {{ date('Y-m-d', strtotime($viewEvent->event_date_to)) }}
                                                        @else
                                                        {{ date('Y-m-d', strtotime($viewEvent->event_date_from)) }}
                                                        @endif
                                                    </h5>

                                                    <div class="d-flex justify-content-center  img-thumbnail">
                                                        @if (!empty($viewEvent->poster))
                                                        <img class="poster-thumb"
                                                            src="{{ Storage::url($viewEvent->poster) }}"
                                                            alt="Event Poster">
                                                        @endif
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <h5><b> Tickets</b></h5>
                                                    <table class="table table-sm table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Price</th>
                                                                <th>Payment Links</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($viewTickets as $ticket)
                                                            <tr>
                                                                <td>{{ $ticket->ticket_names }}</td>
                                                                <td>{{ $ticket->ticket_prices }}</td>
                                                                <td>{{ $ticket->payment_links }}</td>
                                                                <td>{{ $ticket->member_types }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endif


                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th colspan="1">Event</th>
                                    <th colspan="1">Date</th>
                                    <th colspan="1">Guests</th>
                                    <th colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($eventsWithTotalGuests as $event)
                                <tr>
                                    <td>{{ $event->event_name }}</td>
                                    <td>

                                        @if ($event->event_date_from != $event->event_date_to)
                                        {{ date('Y-m-d', strtotime($event->event_date_from)) }} -
                                        {{ date('Y-m-d', strtotime($event->event_date_to)) }}
                                        @else
                                        {{ date('Y-m-d', strtotime($event->event_date_from)) }}
                                        @endif

                                    </td>
                                    <td>{{ $event->total_guests }}</td>
                                    <td><button class='btn p-0' onclick="openModal();"
                                            wire:click='viewEventDetails({{ $event->id }})'><i
                                                class="fa fa-eye"></i></button></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>



                        @endif
                    </div>
                    @elseif ($subPage === 'guest')
                    <div class="d-flex flex-column  border border-2 rounded-2 py-2 px-3">
                        <div class="row">
                            <div class="col-4">
                                <select wire:model="selectedGuestEvent" wire:change="getGuestEvent"
                                    class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    @foreach ($eventList->reverse() as $event)
                                    <option value="{{ $event->id }}">{{ Str::limit($event->event_name, 20) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-hover table-borderless table-sm w-100">
                            <thead>
                                <tr>
                                    <th colspan="1">Name</th>
                                    <th colspan="1">Membership</th>
                                    <th colspan="1">Ticket</th>
                                    <th colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$guestList->isEmpty())
                                @foreach ($guestList as $guest)
                                <tr>
                                    <td>{{ $guest->name_first }} {{ $guest->name_middle }} {{ $guest->name_last }}
                                    </td>
                                    <td>{{ Str::limit($guest->selectedMembership, 20) }}</td>
                                    <td>{{ $guest->ticket_names }}</td>
                                    <td><button class='btn p-0' onclick="openModalGuest();"
                                            wire:click='viewGuestInfo({{ $guest->guest_id }} )'><i
                                                class="fa fa-eye fs-6 "></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div id="pagination-area">
                            {{ $guestList->links('pagination::bootstrap-4') }}
                        </div>
                        <div class="modal fade" id="viewGuestDetails" tabindex="-1" aria-labelledby=""
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title fs-6 text-muted" id="">
                                            Guest Details
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container responsive-text">
                                            @if (!empty($guestInformation[0]))
                                            <div class="row">
                                                <h5> <b>Name</b>: {{ $guestInformation[0]->name_first }}
                                                    {{ $guestInformation[0]->name_middle }}
                                                    {{ $guestInformation[0]->name_last }}</h5>

                                                <h5><b>Membership</b>: {{ $guestInformation[0]->selectedMembership }}
                                                </h5>

                                                <h5><b>Email_address</b>: {{ $guestInformation[0]->email_address }}
                                                </h5>

                                                <hr>

                                                <h5><b>Company</b>: {{ $guestInformation[0]->company }}</h5>

                                                <h5><b>Industry</b>: {{ $guestInformation[0]->industry }}</h5>

                                                <h5><b>Sector</b>:
                                                    {{ ltrim(str_replace('_@_', ', ',
                                                    $guestInformation[0]->sectorBoxoption), ', ') }}
                                                </h5>

                                                <hr>

                                                <h5><b>Event Expectation</b>: {{ $guestInformation[0]->expectation }}
                                                </h5>


                                                @if ($guestInformation[0]->reference != '' &&
                                                $guestInformation[0]->reference_text === '')
                                                <h5><b>Found the event through</b>:
                                                    {{ ltrim(str_replace('_@_', ', ', $guestInformation[0]->reference),
                                                    ', ') }}
                                                </h5>
                                                @elseif ($guestInformation[0]->reference === '' &&
                                                $guestInformation[0]->reference_text != '')
                                                <h5><b>Found the event through</b>:
                                                    {{ $guestInformation[0]->reference_text }}</h5>
                                                @else
                                                <h5><b>Found the event through</b>:
                                                    {{ ltrim(str_replace('_@_', ', ', $guestInformation[0]->reference),
                                                    ', ') }}
                                                    and {{ $guestInformation[0]->reference_text }}</h5>
                                                @endif


                                                @if ($guestInformation[0]->connect != '' &&
                                                $guestInformation[0]->connect_text === '')
                                                <h5><b>Want's to connect with</b>:
                                                    {{ ltrim(str_replace('_@_', ', ', $guestInformation[0]->connect), ',
                                                    ') }}
                                                </h5>
                                                @elseif ($guestInformation[0]->connect === '' &&
                                                $guestInformation[0]->connect_text != '')
                                                <h5><b>Want's to connect with</b>:
                                                    {{ $guestInformation[0]->connect_text }}</h5>
                                                @else
                                                <h5><b>Want's to connect with</b>:
                                                    {{ ltrim(str_replace('_@_', ', ', $guestInformation[0]->connect), ',
                                                    ') }}
                                                    and
                                                    {{ $guestInformation[0]->connect_text }}</h5>
                                                @endif


                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" data-bs-target="#viewGuestDetails2"
                                                    data-bs-toggle="modal">Ticket Details</button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="viewGuestDetails2" aria-hidden="true"
                            aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered responsive-text">
                                @if (!empty($guestInformation[0]))
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-6 text-muted" id="">
                                            {{ $guestInformation[0]->name_first }}
                                            {{ $guestInformation[0]->name_middle }}
                                            {{ $guestInformation[0]->name_last }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Ticket bought: {{ $guestInformation[0]->ticket_names }}</h5>
                                        <h5>Ticket link: {{ $guestInformation[0]->tickets }}</h5>
                                        <h5>Date registered:
                                            {{ date('Y-m-d', strtotime($guestInformation[0]->created_at)) }}</h5>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" data-bs-target="#viewGuestDetails"
                                            data-bs-toggle="modal">Back</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @elseif($pageActive === 'create')
                    <div class="row my-2 pt-2">
                        <div class="col mb-3"> <button class="w-100 btn btn-primary rounded rounded-5"
                                wire:click="activeSet(0)">
                                Event Details </button>
                        </div>
                        <div class="col"> <button
                                class="w-100 btn rounded rounded-5 @if ($activeSetTicket || $activeSetConfirm) btn-primary @else btn-secondary @endif"
                                wire:click="activeSet(1)"> Tickets </button>
                        </div>
                        <div class="col"> <button
                                class="w-100 btn rounded rounded-5 @if ($activeSetConfirm) btn-primary @else btn-secondary @endif"
                                wire:click="activeSet(2)"> Confirm </button>
                        </div>
                    </div>
                    @csrf
                    <div class="container-fluid px-3 pb-2">
                        <div
                            class="container border border-2 rounded-3 d-flex flex-folumn justify-content-center mb-4 mt-3">
                            @if (!$activeSetTicket && !$activeSetConfirm)
                            <div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-12 mb-3">
                                        <div class="form-outline mb-3">
                                            <label class="form-label ps-1 mb-0" for="event_name">Event Name</label>
                                            <input wire:model.lazy='event_name' type="text" id="event_name"
                                                class="form-control" />
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label ps-1 mb-0" for="event_from">Event
                                                    From</label>
                                                <input wire:model.lazy='event_from' type="date" id="event_from"
                                                    class="form-control" />
                                            </div>
                                            <div class="col">
                                                <label class="form-label ps-1 mb-0" for="event_to">To</label>
                                                <input wire:model.lazy='event_to' type="date" id="event_to"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label ps-1 mb-0" for="description">Description</label>
                                        <textarea wire:model.lazy='event_description' type="text" id="description"
                                            rows="4" class="form-control"></textarea>
                              


                                    
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label ps-1 mb-0" for="event_poster">Image Poster</label>
                                        <input wire:model.lazy='event_poster' type="file" id="event_poster"
                                            class="form-control" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            @elseif ($activeSetTicket && !$activeSetConfirm)
                            <div class="container-fluid mb-3">
                                <table class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th colspan="5" scope="col">Ticket Name</th>
                                            <th colspan="5" scope="col">Price</th>
                                            <th colspan="5" scope="col">Payment Link</th>
                                            <th colspan="1" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="ticket-table">
                                        @for ($i = 0; $i < $ticketRows; $i++) <tr id="tr_ticket_{{ $i + 1 }}">
                                            <td colspan="5"> <input wire:model.lazy="tickets.{{ $i }}" type="text"
                                                    id="ticket_name_{{ $i }}" class="form-control" />
                                            </td>
                                            <td colspan="5"> <input wire:model.lazy="ticket_prices.{{ $i }}" type="text"
                                                    id="ticket_price_{{ $i }}" class="form-control" />
                                            </td>
                                            <td colspan="5"> <input wire:model.lazy="payment_links.{{ $i }}" type="text"
                                                    id="ticket_link_{{ $i }}" class="form-control" /> </td>
                                            <td colspan="5"> <input wire:model.lazy="member_types.{{ $i }}" type="text"
                                                        id="member_type_{{ $i }}" class="form-control" /> </td>

                                            <td colspan="1"> <button class="btn"
                                                    wire:click='deleteTicketRow({{ $i }})'><i
                                                        class="fa fa-trash"></i></button> </td>
                                            </tr>
                                            @endfor
                                    </tbody>
                                </table>
                                <div class="w-100 text-end">
                                    <button wire:click='addTicketRow' type="button" class="btn btn-primary">Add More
                                        <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            @elseif ($activeSetTicket && $activeSetConfirm)
                            <div class="container-fluid mb-3">
                                <div class="row mt-3">
                                    <div class="col">
                                        <h5 class="@if (!$event_name) text-danger @endif">Event Name:
                                            {{ $event_name }} </h5>
                                        <h5 class="@if (!$event_from) text-danger @endif">Date:
                                            {{ $event_from }} @if ($event_to)
                                            - {{ $event_to }}
                                            @endif
                                        </h5>
                                        <h5 class="@if (!$event_description) text-danger @endif">Description:
                                            {{ $event_description }}</h5>
                                    </div>
                                    <div class="col">
                                        <h5 class="fw-bold @if (!$event_poster_file_name) text-danger @endif">
                                            Poster:
                                            {{ $event_poster_file_name }}</h5>
                                    </div>

                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Tickets</th>
                                                    <th>Price</th>
                                                    <th>Payment Link</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tickets as $index => $ticket)
                                                <tr>
                                                    <td>{{ $ticket }}</td>

                                                    <td>{{ $ticket_prices[$index] }}</td>

                                                    <td>{{ $payment_links[$index] }}</td>

                                                    <td>{{ $member_types[$index] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>

                                <div class="text-end">
                                    <button wire:click='clearAll' type="button" class="btn btn-secondary">Clear</button>
                                    <button type="submit" wire:click="storeEvent" class="btn btn-success">Add
                                        Event</button>
                                </div>

                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
    
        </div>
    </div>
</div>