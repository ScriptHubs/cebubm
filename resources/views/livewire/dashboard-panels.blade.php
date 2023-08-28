<div class="">
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name mt-3">
                <img class="img-fluid w-75 pt-5 mt-5 ps-5" src="{{ asset('../images/cbm.png') }}" alt="">
            </div>
            <i class="bx bx-menu" id="btnSideNav"></i>
        </div>
        <ul class="nav-list ms-3 pt-4 mt-5">
            <li class="mt-5 mb-2" wire:click="component('viewEvents')">
                <a href="#" class="@if ($selectedComponent === 'viewEvents') bg-info @endif">
                    <i class="bx bx-grid-alt @if ($selectedComponent === 'viewEvents') text-white @endif"></i>
                    <span class="links_name @if ($selectedComponent === 'viewEvents') text-white @endif'>">View
                        Events</span>
                </a>
                <span class="tooltip">View Events</span>
            </li>


            <li class="mb-2" wire:click="component('createNewEvent')">
                <a href="#" class="@if ($selectedComponent === 'createNewEvent') bg-info @endif">
                    <i class="bx bx-message-add @if ($selectedComponent === 'createNewEvent') text-white @endif"></i>
                    <span class="links_name @if ($selectedComponent === 'createNewEvent') text-white @endif">Create New
                        Event</span>
                </a>
                <span class="tooltip">Create New Event</span>
            </li>
            <li class="mb-2" wire:click="component('editEvent')">
                <a href="#" class="@if ($selectedComponent === 'editEvent') bg-info @endif">
                    <i class="bx bx-edit @if ($selectedComponent === 'editEvent') text-white @endif"></i>
                    <span class="links_name @if ($selectedComponent === 'editEvent') text-white @endif">Edit
                        Event</span>
                </a>
                <span class="tooltip">Edit Event</span>
            </li>

            <li class="mb-2" wire:click="component('viewGuests')">
                <a href="#" class="@if ($selectedComponent === 'viewGuests') bg-info @endif">
                    <i class="bx bx-user @if ($selectedComponent === 'viewGuests') text-white @endif"></i>
                    <span class="links_name @if ($selectedComponent === 'viewGuests') text-white @endif'>">View
                        Guests</span>
                </a>
                <span class="tooltip">View Guests</span>
            </li>
            <li class="profile ms-0 cursor-pointer mb-5" href="{{ route('logout') }}"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <div class="w-100 text-end pe-5 pt-2">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <i class="bx bx-log-out" id="log_out"></i>
            </li>
        </ul>
    </div>
    <section class="home-section pe-3 pb-5">
        <div class="container-fluid w-100  pt-5 ps-4">
            @if ($selectedComponent === 'viewEvents')
                <h3 class="fw-bold">Events List</h3>
                <hr>
                <br>
                <div class="container-fluid">
                    @if ($mountEvents)
                        @foreach ($mountEvents as $event)
                            <section class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-12 col-lg-8">
                                            <div class="row">
                                                <div class="col-12 col-lg-2">
                                                    @if (!empty($event->poster))
                                                        <img class="poster-thumb object-fit-cover w-100"
                                                            src="{{ Storage::url($event->poster) }}" alt="Event Poster">
                                                    @endif
                                                </div>
                                                <div class="col mt-3 mt-lg-0 d-flex flex-column">
                                                    <h5 class="text-center text-lg-start fw-bold">
                                                        {{ $event->event_name }} <span><label
                                                                class="text-secondary small fs-6 fw-normal">

                                                                @if ($event->event_date_from != $event->event_date_to)
                                                                    {{ date('Y-m-d', strtotime($event->event_date_from)) }}
                                                                    -
                                                                    {{ date('Y-m-d', strtotime($event->event_date_to)) }}
                                                                @else
                                                                    {{ date('Y-m-d', strtotime($event->event_date_from)) }}
                                                                @endif
                                                        </span>


                                                    </h5>
                                                    <h6 class="pt-2" style="white-space: pre-wrap;">{{ $event->event_description }}</h6>


                                                    <h6 class="pt-5 mt-auto">Guests for this event: @if ($event->guest_count != '')
                                                            {{ $event->guest_count }}
                                                        @else
                                                            0
                                                        @endif
                                                    </h6>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4 border-3 border pe-3 mt-3 mt-lg-0">
                                            @foreach ($event->tickets as $ticket)
                                                <div class="row">
                                                    <div class="col-8  long-label">
                                                        <label>{{ $ticket->ticket_names }} </label>
                                                    </div>
                                                    <div class="col-4 long-label">
                                                        <label>{{ $ticket->ticket_prices }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <h5 class="fw-bold text-center mt-3 mt-lg-0">Actions</h5>
                                    <div class="row gap-3 ps-3 justify-content-between">
                                        {{-- <div class="col-5 hover-shadow text-center cursor-pointer bg-info border rounded-2 text-white  p-2"
                                            wire:click="viewEventInfo({{ $event->id }})">Info </div> --}}
                                        <div class="col-5 hover-shadow text-center cursor-pointer bg-primary border rounded-2 text-white  p-2"
                                            wire:click="editEvent({{ $event->id }})">Edit </div>
                                        <div class="col-5 hover-shadow text-center cursor-pointer bg-danger border rounded-2 text-white  p-2"
                                            wire:click="deleteEvent({{ $event->id }})">Delete </div>

                                    </div>
                            </section>
                            <br>
                            <br>
                            <hr>
                            <br>
                        @endforeach
                    @endif
                </div>
            @elseif ($selectedComponent === 'createNewEvent')
                <section>
                    <h3 class="fw-bold">Create New Event</h3>
                    <hr>

                    <div class="row d-flex">
                        <div class="col-12 col-lg-6 pe-2">
                            <div class="row mt-3 mb-3">
                                <div class="col-12 mb-3">
                                    <div class="form-outline mb-3">
                                        <label class="form-label ps-1 mb-0" for="event_name">Event
                                            Name</label>
                                        <input wire:model.lazy='event_name' type="text" id="event_name"
                                            class="form-control" wire:blur="saveCookie" />
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label ps-1 mb-0" for="event_from">Event
                                                From</label>
                                            <input wire:model.lazy='event_from' type="date" id="event_from"
                                                class="form-control" wire:blur="saveCookie" />
                                        </div>
                                        <div class="col">
                                            <label class="form-label ps-1 mb-0" for="event_to">To</label>
                                            <input wire:model.lazy='event_to' type="date" id="event_to"
                                                class="form-control" wire:blur="saveCookie" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label ps-1 mb-0" for="description">Description</label>
                                    <textarea wire:model.lazy='event_description' type="text" id="description" rows="3" class="form-control" style="white-space: pre-wrap;"
                                        wire:blur="saveCookie"></textarea>
                                    <br>
                                    <button type="button" class="btn btn-primary">Add Pharagraph
                                        <i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 col-lg-8">
                                    <label class="form-label ps-1 mb-0" for="event_poster">Image
                                        Poster</label>
                                    <input wire:model.lazy='event_poster' type="file" id="event_poster"
                                        class="form-control" accept="image/*" wire:blur="saveCookie">

                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    @if ($event_poster)
                                        <img class="w-100" src="{{ $event_poster->temporaryUrl() }}"
                                            alt="Event Poster Preview" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 ps-2">
                            <h3 class="opacity-0">Tickets</h3>
    
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th class="rounded-left" scope="col">Ticket Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Payment Link</th>
                                        <th class="rounded-right" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @for ($i = 0; $i < $ticketRows; $i++)
                                        <tr class="spacer">
                                            <td colspan="100"></td>
                                        </tr>
                                        <tr scope="row" class="rounded-2" id="tr_ticket_{{ $i + 1 }}">
                                            <td> <input wire:model.lazy="tickets.{{ $i }}" type="text"
                                                    id="ticket_name_{{ $i }}" class="form-control"
                                                    wire:blur="saveCookie" />
                                            </td>
    
                                            <td> <input wire:model.lazy="ticket_prices.{{ $i }}"
                                                    type="text" id="ticket_price_{{ $i }}"
                                                    class="form-control" wire:blur="saveCookie" />
                                            </td>
    
                                            <td> <input wire:model.lazy="payment_links.{{ $i }}"
                                                    type="text" id="ticket_link_{{ $i }}"
                                                    class="form-control" wire:blur="saveCookie" /> </td>
    
                                            <td> <button class="btn"
                                                    wire:click='deleteTicketRow({{ $i }})'><i
                                                        class="fa fa-trash"></i></button> </td>
                                        </tr>
    
                                        <tr>
                                    @endfor
    
                                </tbody>
                            </table>
    
    
                            <div class="text-end pb-5 pt-2">
                                <div class="row  justify-content-end d-flex">
                                    <div class="col-12 col-lg-6">
                                        <div class="w-100 text-end mb-3">
                                            <button wire:click='addTicketRow' type="button"
                                                class="col-12  btn btn-primary">Add
                                                More Tickets
                                                <i class="fa fa-plus"></i></button>
                                        </div>
                                        <div class="col-12 d-flex  justify-content-between">
                                            <button wire:click='clearAll' type="button"
                                                class="btn btn-secondary col-5 col-lg-5 ">Clear</button>
                                            <button type="submit" wire:click="storeEvent"
                                                class="btn btn-success col-5 col-lg-5 ">Add
                                                Event</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
        </div>
    </section>
@elseif ($selectedComponent === 'editEvent')
    <section>
        <div class="row align-items-center">
            <div class="col-auto align-content-end">
                <h3 class="fw-bold">Edit Event</h3>
            </div>
            <div class="col col-lg-3 search-bar position-relative">
                <input wire:model="search_event" wire:keydown.debounce.300ms="searchEvent" type="text"
                    id="search_event" class="form-control" placeholder="Search for event" type="text"
                    wire:blur="searchUnfocused" />
                @if ($searchIsFocused)
                    <div class="drop-down-search position-absolute rounded-search-dropdown border-bottom ">
                        @foreach ($searchResultsList as $event)
                            @if (count($searchResultsList) != 0)
                                <div wire:click="editEvent({{ $event->id }})"
                                    class="cursor-pointer hover-highlight w-100 h-100 ps-3 pt-2 pb-1">
                                    <h5 class=" fs-5">{{ $event->event_name }}</h5>
                                </div>
                            @endif
                        @endforeach
                        @if (count($searchResultsList) === 0 && $search_event != '')
                            <div class="w-100 h-100 ps-3 pt-2 pb-1 cursor-none ">
                                <h5 class="fs-5 text-muted">No results for {{ $this->search_event }}</h5>
                            </div>
                        @endif
                    </div>

                @endif
            </div>
        </div>

        <hr>

        <div class="row ">
            <div class="col-12 col-lg-6">
                <div class="row mt-3 mb-3">
                    <div class="col-12 mb-3">
                        <div class="form-outline mb-3">
                            <label class="form-label ps-1 mb-0" for="edit_event_name">Event
                                Name </label>
                            <input wire:model.lazy='edit_event_name' type="text" id="edit_event_name"
                                @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif class="form-control"
                                wire:blur="saveCookie" />
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label ps-1 mb-0" for="edit_event_from">Event
                                    From</label>
                                <input wire:model.lazy='edit_event_from' type="date" id="edit_event_from"
                                    @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif class="form-control"
                                    wire:blur="saveCookie" />
                            </div>
                            <div class="col">
                                <label class="form-label ps-1 mb-0" for="edit_event_to">To</label>
                                <input wire:model.lazy='edit_event_to' type="date" id="edit_event_to"
                                    @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif class="form-control"
                                    wire:blur="saveCookie" />
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label ps-1 mb-0" for="edit_event_description">Description</label>
                        <textarea wire:model.lazy='edit_event_description' type="text" id="edit_description" rows="10" 
                            @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif class="form-control" wire:blur="saveCookie"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-8">
                        <label class="form-label ps-1 mb-0" for="edit_event_poster_update">Update
                            Poster</label>
                        <input wire:model.lazy='edit_event_poster_update' type="file"
                            id="edit_event_poster_update" class="form-control" accept="image/*"
                            @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif wire:blur="saveCookie">
                        @if ($edit_event_poster_update)
                            <button wire:click='undoPosterUpdate' type="button" onClick="clearUpdatePoster();"
                                class="btn btn-secondary mt-3 ms-1">Undo
                                Poster Change</button>
                        @endif
                    </div>

                    <div class="col-12 col-lg-4 pt-3">
                        @if (!empty($edit_event_poster) && !$edit_event_poster_update)
                            <img class="poster-thumb object-fit-cover w-100"
                                src="{{ asset('storage/' . $edit_event_poster) }}" alt="Event Poster">
                        @endif
                        @if ($edit_event_poster_update)
                            <img class="w-100" src="{{ $edit_event_poster_update->temporaryUrl() }}"
                                alt="Event Poster Preview" />
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6">
                <h3 class="opacity-0">Tickets</h3>
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th class="rounded-left" scope="col">Ticket Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Payment Link</th>
                            <th class="rounded-right" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @for ($i = 0; $i < $ticketRows; $i++)
                            <tr class="spacer">
                                <td colspan="100"></td>
                            </tr>
                            <tr scope="row" class="rounded-2" id="tr_ticket_{{ $i + 1 }}">
                                <td> <input wire:model.lazy="edit_ticket_names.{{ $i }}" type="text"
                                        @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif
                                        id="edit_ticket_names{{ $i }}" class="form-control"
                                        wire:blur="saveCookie" />
                                </td>

                                <td> <input wire:model.lazy="edit_ticket_prices.{{ $i }}" type="text"
                                        @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif
                                        id="edit_ticket_prices{{ $i }}" class="form-control"
                                        wire:blur="saveCookie" />
                                </td>

                                <td> <input wire:model.lazy="edit_payment_links.{{ $i }}" type="text"
                                        @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif
                                        id="edit_payment_links{{ $i }}" class="form-control"
                                        wire:blur="saveCookie" />
                                </td>

                                <td> <button class="btn" wire:click='deleteEditTicketRow({{ $i }})'><i
                                            class="fa fa-trash"></i></button> </td>
                            </tr>

                            <tr>
                        @endfor

                    </tbody>
                </table>

                <div class="w-100 text-end mb-3">
                    <button wire:click='addTicketRow' type="button" class="btn btn-primary"
                        @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif>Add
                        More Tickets
                        <i class="fa fa-plus"></i></button>
                </div>
                <div class="text-end pb-5 pt-2">
                    <button wire:click='clearEdit' type="button" class="btn btn-secondary"
                        @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif>Clear</button>
                    <button type="submit" wire:click="updateEvent" class="btn btn-success"
                        @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif>Update Event</button>
                </div>
            </div>
        </div>
    </section>
@elseif ($selectedComponent === 'viewGuests')
    <section>
        <div class="row align-items-center">
            <div class="col-auto align-content-end">
                <h3 class="fw-bold">View by event</h3>
            </div>
            <div class="col col-lg-3 search-bar position-relative">
                <input wire:model="search_guest_event" wire:keydown.debounce.100ms="searchGuestEvent" type="text"
                    id="search_guest_event" class="form-control" placeholder="Search for event"
                    wire:blur="searchGuestEventUnfocused" />
                @if ($searchGuestFocus)
                    <div class="drop-down-search position-absolute rounded-search-dropdown border-bottom ">
                        @if ($searchGuestResultsList)
                            @foreach ($searchGuestResultsList as $event)
                                @if (count($searchGuestResultsList) != 0)
                                    <div wire:click="getEventGuests({{ $event->id }})"
                                        class="cursor-pointer hover-highlight w-100 h-100 ps-3 pt-2 pb-1 overflow-hidden">
                                        <h5 class=" fs-5">{{ $event->event_name }}</h5>
                                    </div>
                                @endif
                            @endforeach
                            @if (count($searchGuestResultsList) === 0 && $search_guest_event != '')
                                <div class="w-100 h-100 ps-3 pt-2 pb-1 cursor-none ">
                                    <h5 class="fs-5 text-muted">No results for
                                        {{ $this->search_guest_event }}
                                    </h5>
                                </div>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
            <div class="col-auto align-content-end">
                <h3 class="fw-bold">View by name</h3>
            </div>
            <div class="col col-lg-3 search-bar position-relative">
                <input wire:model="search_guest_name" wire:keydown.debounce.100ms="searchGuestName" type="text"
                id="search_guest_name" class="form-control" placeholder="Search for guest"
                wire:blur="searchGuestNameUnfocused" />
                {{-- @if ($searchGuestFocus)
                    <div class="drop-down-search position-absolute rounded-search-dropdown border-bottom ">
                        @if ($searchGuestResultsList)
                            @foreach ($searchGuestResultsList as $event)
                                @if (count($searchGuestResultsList) != 0)
                                    <div wire:click="getEventGuests({{ $event->id }})"
                                        class="cursor-pointer hover-highlight w-100 h-100 ps-3 pt-2 pb-1 overflow-hidden">
                                        <h5 class=" fs-5">{{ $event->event_name }}</h5>
                                    </div>
                                @endif
                            @endforeach
                            @if (count($searchGuestResultsList) === 0 && $search_guest_event != '')
                                <div class="w-100 h-100 ps-3 pt-2 pb-1 cursor-none ">
                                    <h5 class="fs-5 text-muted">No results for
                                        {{ $this->search_guest_event }}
                                    </h5>
                                </div>
                            @endif
                        @endif
                    </div>
                @endif --}}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-lg-3 position-relative bg-white rounded-2 pt-3 ps-3 d-flex flex-column pb-3">
                <h4>Guest Name</h4>
                @if (isset($guestList))
                    @if (count($guestList) > 0)
                        @foreach ($guestList->items() as $guest)
                            <div id="{{ $guest->guest_id }}" wire:click="getGuest({{ $guest->guest_id }})"
                                class="w-100 cursor-pointer hover-highlight p-2 pt-3 rounded-3 text-nowrap">
                                <h6 class="small ps-3">{{ $guest->name_first }} {{ $guest->name_middle }}
                                    {{ $guest->name_last }}</h6>
                            </div>
                        @endforeach
                    @endif
                @endif
                <br>
                @if (isset($eventGuestListing))
                    <div class="row mt-auto">
                        <div id="pagination-area ">
                            {{ $guestList->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-12 col-lg-9">

                <div class="container">
                    <div class="row  ps-lg-5 pt-4 pt-lg-4 mt-lg-0">

                        @if ($guestNameFirst)

                            <h3 class="fw-bold">{{ $guestNameFirst }} {{ $guestMiddle }}
                                {{ $guestNameLast }}
                                <span class="fs-5 fw-normal text-muted"> {{ $guestEmail }}</span>
                            </h3>


                            <h5 class="fw-medium pb-1 pt-4 pt-lg-0">{{ $guestMembership }}</h5>
                            <hr>
                            <h5 class="fw-normal pb-1 text-muted mt-4 mt-lg-0">Company / Organization: <span
                                    class="text-dark fw-medium mt-4 mt-lg-0"> {{ $guestCompany }}</span></h5>
                            <h5 class="fw-normal pb-1 text-muted mt-4 mt-lg-0">Sector: <span
                                    class="text-dark fw-medium">
                                    {{ $guestSector }}</span></h5>
                            <h5 class="fw-normal pb-1 text-muted mt-4 mt-lg-0">Industry / Line of Business: <span
                                    class="text-dark fw-medium mt-4 mt-lg-0"> {{ $guestIndustry }}</span></h5>
                            <h5 class="fw-normal pb-1 text-muted mt-4 mt-lg-0">Heard about CBM through: <span
                                    class="text-dark fw-medium mt-4 mt-lg-0">
                                    @if ($guestReferenceText != '')
                                        {{ $guestReference }}
                                    @elseif($guestReference != '')
                                        {{ $guestReferenceText }}
                                    @elseif($guestReference != '' && $guestReferenceText != '')
                                        {{ $guestReference }} & {{ $guestReferenceText }}
                                    @else
                                        Didn't say.
                                    @endif
                                </span>
                            </h5>

                            <h5 class="fw-normal pb-1 text-muted mt-4 mt-lg-0">Want to connect / network with:
                                <span class="text-dark fw-medium mt-4 mt-lg-0">
                                    @if ($guestConnectText != '')
                                        {{ $guestConnect }}
                                    @elseif($guestConnect != '')
                                        {{ $guestConnectText }}
                                    @elseif($guestConnect != '' && $guestConnectText != '')
                                        {{ $guestConnect }} & {{ $guestConnectText }}
                                    @else
                                        Didn't say.
                                    @endif
                                </span>
                            </h5>
                            <h5 class="fw-normal text-muted mt-4 mt-lg-0">Looking forward for:<span
                                    class="text-dark fw-medium mt-4 mt-lg-0"> {{ $guestExpectation }}</span></h5>

                            <h5 class="fw-normal mt-4 pt-lg-5 mt-lg-0">Ticket bought: <span
                                    class="text-dark fw-medium">
                                </span>{{ $guestTicketName }}</h5>
                            <h5 class="fw-normal mt-4 mt-lg-0">Payment link used: <span class="text-dark fw-medium">
                                </span>{{ $guestPaymentLink }}</h5>
                            <h5 class="fw-normal pb-5 mt-4 mt-lg-0">Register Date: <span class="text-dark fw-medium">
                                </span> {{ $guestRegistrationDate }}</h5>
                        @else
                            <h3 class="fw-bold"> Select a guest on the left.

                            </h3>

                        @endif
                    </div>
                </div>
            </div>


        </div>

    </section>
    @endif
</div>
</section>







<div class="modal fade @if ($modalStatus === 'show') show @endif "
    @if ($modalStatus === 'show') style="display: block;" @endif id="staticModal" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticModalLabel">Confirm to remove event:</h1>
                <button type="button" wire:click="modalToggle(0,0)" class="btn-close" data-bs-dismiss="staticModal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($forDeletionName)
                    <h5>{{ $forDeletionName }}</h5>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="modalToggle(0,0)" class="btn btn-secondary"
                    data-bs-dismiss="staticModal">Close</button>
                <button type="button"
                    wire:click="deleteEventConfirmation( @if ($forDeletionId) {{ $forDeletionId }} @else 0 @endif )"
                    class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
</div>
