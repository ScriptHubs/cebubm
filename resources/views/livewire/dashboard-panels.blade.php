<div class="">
  <div class="sidebar">
    <div class="logo-details">
      <div class="logo_name mt-3">
        <img class="img-fluid w-75 pt-5 mt-5 ps-5" src="{{ asset('../images/logos/cbm.png') }}" alt="">
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
      {{-- <li class="mb-2" wire:click="component('editEvent')">
        <a href="#" class="@if ($selectedComponent === 'editEvent') bg-info @endif">
          <i class="bx bx-edit @if ($selectedComponent === 'editEvent') text-white @endif"></i>
          <span class="links_name @if ($selectedComponent === 'editEvent') text-white @endif">Edit
            Event</span>
        </a>
        <span class="tooltip">Edit Event</span>
      </li> --}}

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
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
            <i class="bx bx-log-out" id="log_out"></i>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </div>
  <section class="home-section pe-3 pb-5">
    <div class="container-fluid w-100  pt-5 ps-4">
      @if ($selectedComponent === 'viewEvents')
        <h5 class="fw-bold">Events List</h5>
        <hr>
        <br>
        <div class="table-horizontal-scroll">
          <table class="table table-hover table-responsive">
            <thead>
              <tr>
                <th style="width: 50px">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="headerCheckbox">
                  </div>
                </th>
                <th class="thead">Poster</th>
                <th class="thead">Name</th>
                <th class="thead">Description</th>
                <th class="thead">Date From</th>
                <th class="thead">Date To</th>
                <th class="thead">Number of Guest</th>
                <th class="thead">Tickets</th>
                <th class="thead">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($mountEvents as $event)
                <tr>
                  <td class="align-middle">
                    <div class="form-check">
                      <input class="form-check-input event-checkbox" type="checkbox" value="{{ $event->id }}"
                        id="flexCheckDefault">
                    </div>
                  </td>
                  <td class="align-middle" style="width: 100px">
                    @if (!empty($event->poster))
                      <img class="img-fluid rounded" src="{{ Storage::url($event->poster) }}" alt="Event Poster">
                    @endif
                  </td>
                  <td class="align-middle">{{ $event->event_name }}</td>
                  <td class="align-middle">{{ Illuminate\Support\Str::limit($event->event_description, 30) }}</td>
                  <td class="align-middle">{{ date('Y-m-d', strtotime($event->event_date_from)) }}</td>
                  <td class="align-middle">{{ date('Y-m-d', strtotime($event->event_date_to)) }}</td>
                  <td class="align-middle">{{ $event->guest_count ?? 0 }}</td>
                  <td class="align-middle">
                    @foreach ($event->tickets as $ticket)
                      <div class="row">
                        <div class="col-8 long-label">
                          <label>{{ $ticket->ticket_names }} </label>
                        </div>
                        <div class="col-4 long-label">
                          <label>{{ $ticket->ticket_prices }}</label>
                        </div>
                      </div>
                    @endforeach
                  </td>
                  <td class="align-middle">
                    <button class="btn btn-primary" wire:click="editEvent({{ $event->id }})">
                      <i class='bx bx-edit-alt'></i>
                    </button>
                    <button class="btn btn-danger" wire:click="deleteEvent({{ $event->id }})">
                      <i class='bx bx-trash'></i>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @elseif ($selectedComponent === 'createNewEvent')
        <section>
          <h5 class="fw-bold">Create New Event</h5>
          <hr>

          <div class="row d-flex">
            <div class="col-12 col-lg-6 pe-2">
              <div class="row mt-3 mb-3">
                <div class="col-12 mb-3">
                  <div class="form-outline mb-3">
                    <label class="form-label ps-1 mb-0" for="event_name">Event
                      Name</label>
                    <input wire:model.lazy='event_name' type="text" id="event_name" class="form-control"
                      wire:blur="saveCookie" />
                    @error('event_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col">
                      <label class="form-label ps-1 mb-0" for="event_from">Event
                        From</label>
                      <input wire:model.lazy='event_from' type="date" id="event_from" class="form-control"
                        wire:blur="saveCookie" />
                      @error('event_from')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                    <div class="col">
                      <label class="form-label ps-1 mb-0" for="event_to">To</label>
                      <input wire:model.lazy='event_to' type="date" id="event_to" class="form-control"
                        wire:blur="saveCookie" />
                      @error('event_to')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                  </div>
                </div>
                <div class="col">
                  <label class="form-label ps-1 mb-0" for="description">Description</label>
                  <textarea wire:model.lazy='event_description' type="text" id="description" rows="10" class="form-control"
                    style="white-space: pre-wrap;" wire:blur="saveCookie"></textarea>
                  @error('event_description')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror

                  <br>

                </div>
              </div>

              <div class="row mb-3">
                <div class="col-12 col-lg-8">
                  <label class="form-label ps-1 mb-0" for="event_poster">Image
                    Poster</label>
                  <input wire:model.lazy='event_poster' type="file" id="event_poster" class="form-control"
                    accept="image/*" wire:blur="saveCookie">
                  @error('event_poster')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-lg-4 mt-3 mt-lg-0">
                  @if ($event_poster)
                    <img class="w-100" src="{{ $event_poster->temporaryUrl() }}" alt="Event Poster Preview" />
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
                    <th scope="col">Member Type</th>
                    <th class="rounded-right" scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                  @for ($i = 0; $i < $ticketRows; $i++)

                  <tr class="spacer">
                      <td colspan="100"></td>
                  </tr>
                  <tr scope="row" class="rounded-2" id="tr_ticket_{{ $i }}">
                      <td>
                          <input wire:model.lazy="tickets.{{ $i }}" type="text" id="ticket_name_{{ $i }}"
                              class="form-control" wire:blur="saveCookie" />
                          @error("tickets.$i") <span class="text-danger">{{ $message }}</span> @enderror
                      </td>
              
                      <td>
                          <input wire:model.lazy="ticket_prices.{{ $i }}" type="text" id="ticket_price_{{ $i }}"
                              class="form-control" wire:blur="saveCookie" />
                          @error("ticket_prices.$i") <span class="text-danger">{{ $message }}</span> @enderror
                      </td>
              
                      <td>
                          <input wire:model.lazy="payment_links.{{ $i }}" type="text" id="ticket_link_{{ $i }}"
                              class="form-control" wire:blur="saveCookie" />
                          @error("payment_links.$i") <span class="text-danger">{{ $message }}</span> @enderror
                          @error("payment_links") <span class="text-danger">{{ $message }}</span> @enderror
                      </td>
              
                      <td>
                          <select wire:model.lazy="member_types.{{ $i }}" id="member_type_{{ $i }}"
                              class="form-control" wire:blur="saveCookie" style="width: 150px;">
                              <option selected value="CCCI (Cebu Chamber of Commerce and Industry) Member">CCCI (Cebu Chamber
                                  of Commerce and Industry) Member</option>
                              <option value="Non CCCI (Cebu Chamber of Commerce and Industry) Member">Non CCCI (Cebu
                                  Chamber of Commerce and Industry) Member</option>
                          </select>
                          @error("member_types.$i") <span class="text-danger">{{ $message }}</span> @enderror
                      </td>
              
                      <td>
                          <button class="btn" wire:click='deleteTicketRow({{ $i }})'><i class="fa fa-trash"></i></button>
                      </td>
                  </tr>
                  <tr>
              @endfor
              
              @error('payment_links')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              


                </tbody>
              </table>
              <div class="me-4">
                <div class="w-100 text-end mb-3">
                  <button wire:click='addTicketRow' type="button" class="btn btn-primary">Add
                    More Tickets
                    <i class="fa fa-plus"></i></button>
                </div>
                <div class="text-end pb-5 pt-2">
                  <button wire:click='clearAll' type="button" class="btn btn-secondary">Clear</button>
                  <button type="submit" wire:click="storeEvent" class="btn btn-success">Add
                    Event</button>
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
        <input wire:model="search_event" wire:keydown.debounce.300ms="searchEvent" type="text" id="search_event"
          class="form-control" placeholder="Search for event" type="text" wire:blur="searchUnfocused" />
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
                @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif class="form-control" wire:blur="saveCookie" />
            </div>
            <div class="row">
              <div class="col">
                <label class="form-label ps-1 mb-0" for="edit_event_from">Event
                  From</label>
                <input wire:model.lazy='edit_event_from' type="date" id="edit_event_from"
                  @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif class="form-control" wire:blur="saveCookie" />
              </div>
              <div class="col">
                <label class="form-label ps-1 mb-0" for="edit_event_to">To</label>
                <input wire:model.lazy='edit_event_to' type="date" id="edit_event_to"
                  @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif class="form-control" wire:blur="saveCookie" />
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
            <input wire:model.lazy='edit_event_poster_update' type="file" id="edit_event_poster_update"
              class="form-control" accept="image/*" @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif
              wire:blur="saveCookie">
            @if ($edit_event_poster_update)
              <button wire:click='undoPosterUpdate' type="button" onClick="clearUpdatePoster();"
                class="btn btn-secondary mt-3 ms-1">Undo
                Poster Change</button>
            @endif
          </div>

          <div class="col-12 col-lg-4 pt-3">
            @if (!empty($edit_event_poster) && !$edit_event_poster_update)
              <img class="poster-thumb object-fit-cover w-100" src="{{ asset('storage/' . $edit_event_poster) }}"
                alt="Event Poster">
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
              <tr scope="row" class="rounded-2" id="tr_ticket_{{ $i }}">
                <td> <input wire:model.lazy="edit_ticket_names.{{ $i }}" type="text"
                    @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif id="edit_ticket_names{{ $i }}"
                    class="form-control" wire:blur="saveCookie" />
                </td>

                <td> <input wire:model.lazy="edit_ticket_prices.{{ $i }}" type="text"
                    @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif id="edit_ticket_prices{{ $i }}"
                    class="form-control" wire:blur="saveCookie" />
                </td>

                <td> <input wire:model.lazy="edit_payment_links.{{ $i }}" type="text"
                    @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif id="edit_payment_links{{ $i }}"
                    class="form-control" wire:blur="saveCookie" />
                </td>

                <td>
                  <select wire:model.lazy="edit_member_types.{{ $i }}"
                    id="edit_member_type_{{ $i }}" class="form-control" wire:blur="saveCookie"
                    style="width: 150px;" @if ($edit_event_id === '' || $edit_event_id === null) disabled @endif>
                    <option selected value="CCCI (Cebu Chamber of Commerce and Industry) Member">CCCI (Cebu Chamber of Commerce and Industry) Member</option>
                    <option value="Non CCCI (Cebu Chamber of Commerce and Industry) Member">Non CCCI (Cebu Chamber of
                      Commerce and Industry) Member</option>
                  </select>
                </td>

                <td> <button class="btn" wire:click='deleteEditTicketRow({{ $i }})'><i
                      class="fa fa-trash"></i></button> </td>
              </tr>

              <tr>
            @endfor

          </tbody>
        </table>

        <div class="me-4">
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
    </div>
  </section>
@elseif ($selectedComponent === 'viewGuests')
  <section>
    <div class="row align-items-center">
      <div class="col-auto align-content-end">
        <h5 class="fw-bold">View by event</h5>
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
        <h5 class="fw-bold">View by name</h5>
      </div>
      <div class="col col-lg-3 search-bar position-relative">
        <input wire:model="search_guest_name" wire:keydown.debounce.100ms="searchGuestName" type="text"
          id="search_guest_name" class="form-control" placeholder="Search for guest"
          wire:blur="searchGuestNameUnfocused" />
        @if ($searchNameFocus)
          <div class="drop-down-search position-absolute rounded-search-dropdown border-bottom ">
            @if ($searchGuestNameResultsList)
              @foreach ($searchGuestNameResultsList as $guest)
                @if (count($searchGuestNameResultsList) != 0)
                  <div wire:click="getGuest({{ $guest->id }})"
                    class="cursor-pointer hover-highlight w-100 h-100 ps-3 pt-2 pb-1 overflow-hidden">
                    <h5 class=" fs-5">{{ $guest->name_first }} {{ $guest->name_middle }}
                      {{ $guest->name_last }}</h5>
                  </div>
                @endif
              @endforeach
              @if (count($searchGuestNameResultsList) === 0 && $search_guest_event != '')
                <div class="w-100 h-100 ps-3 pt-2 pb-1 cursor-none ">
                  <h5 class="fs-5 text-muted">No results for
                    {{ $this->search_guest_name }}
                  </h5>
                </div>
              @endif
            @endif
          </div>
        @endif
      </div>
    </div>
    <hr>
    <button wire:click="exportGuestsToCsv" class="btn btn-primary mb-3">Export to CSV</button>

    <!-- Filter Modal -->
    <div wire:ignore.self class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter by Created Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input wire:model.defer="startDate" type="date" class="form-control" id="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input wire:model.defer="endDate" type="date" class="form-control" id="endDate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button wire:click="filterByDate" class="btn btn-primary">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0">
      <div class="container">
        <div class="col-12">
          <h5>Guest List</h5>
          @if (isset($guestList) && count($guestList) > 0)
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Organization</th>
                    <th>Member Type</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($guestList->items() as $guest)
                    <tr id="{{ $guest->guest_id }}" wire:click="getGuest({{ $guest->guest_id }})"
                      class="cursor-pointer hover-highlight">
                      <td>{{ $guest->name_last }}</td>
                      <td>{{ $guest->name_first }}</td>
                      <td>{{ $guest->email_address }}</td>
                      <td>{{ $guest->company }}</td>
                      <td>{{ str_replace('(Cebu Chamber of Commerce and Industry)', '', $guest->selectedMembership) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <p>No guests found.</p>
          @endif

          @if (isset($eventGuestListing))
            <div class="row mt-auto">
              <div id="pagination-area">
                {{ $guestList->links('pagination::bootstrap-4') }}
              </div>
            </div>
          @endif
        </div>

        <div class="col-12">
          <div class="row pt-4 pt-lg-4 mt-lg-0">
            @if ($guestNameFirst)
              <h5>Details</h5>
              <table class="table">
                <tbody>
                  <tr>
                    <td class="fw-normal text-muted">Name</td>
                    <td><span class="text-dark fw-medium">{{ $guestNameFirst }} {{ $guestMiddle }} {{ $guestNameLast }}</span></td>
                  </tr>
                  <tr>
                    <td class="fw-normal text-muted">Email</td>
                    <td><span class="text-dark fw-medium">{{ $guestEmail }}</span></td>
                  </tr>
                  <tr>
                    <td class="fw-normal text-muted">Membership:</td>
                    <td class="text-dark fw-medium">{{ $guestMembership }}</td>
                  </tr>
                  <tr>
                    <td class="fw-normal text-muted">Company / Organization:</td>
                    <td class="text-dark fw-medium">{{ $guestCompany }}</td>
                  </tr>
                  <tr>
                    <td class="fw-normal text-muted">Sector:</td>
                    <td class="text-dark fw-medium">{{ $guestSector }}</td>
                  </tr>
                  <tr>
                    <td class="fw-normal text-muted">Industry / Line of Business:</td>
                    <td class="text-dark fw-medium">{{ $guestIndustry }}</td>
                  </tr>
                  <tr>
                    <td class="fw-normal text-muted">Heard about CBM through:</td>
                    <td class="text-dark fw-medium">
                        {{ $guestReference }} {{ $guestReferenceText }}
                    </td>
                  </tr>
                  <tr>
                    <td class="fw-normal text-muted">Want to connect / network with:</td>
                    <td class="text-dark fw-medium">
                        {{ $guestConnect }} {{ $guestConnectText }}
                    </td>
                  </tr>
                  <tr>
                    <td class="fw-normal text-muted">Looking forward for:</td>
                    <td class="text-dark fw-medium">{{ $guestExpectation }}</td>
                  </tr>
                  <tr>
                    <td class="fw-normal">Affiliated Event:</td>
                    <td class="text-dark fw-medium">{{ $guest_affiliated_event }}</td>
                  </tr>
                  <tr>
                    <td class="fw-normal">Ticket bought:</td>
                    <td class="text-dark fw-medium">{{ $guestTicketName }}</td>
                  </tr>
                  <tr>
                    <td class="fw-normal">Payment link used:</td>
                    <td class="text-dark fw-medium">{{ $guestPaymentLink }}</td>
                  </tr>
                  <tr>
                    <td class="fw-normal pb-5">Register Date:</td>
                    <td class="text-dark fw-medium">{{ $guestRegistrationDate }}</td>
                  </tr>
                </tbody>
              </table>
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
        <h1 class="modal-title fs-5" id="staticModalLabel">Confirm deleting event?</h1>
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
          class="btn btn-danger">Confirm</button>
      </div>
    </div>
  </div>
</div>
</div>
