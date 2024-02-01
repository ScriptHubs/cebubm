<form>
    @csrf
    <div class="vh-100">
        <section id="main-registration-container" class="container-fluid h-100">
            <div class="container-fluid h-100 d-flex justify-content-center">
                <div class="col-11">
                    <div class="row h-100">
                        <div class="col-1"></div>
                        <div class="col-12 col-lg-6 pb-5 h-100 justify-content-center d-flex flex-column">
                            @if ($counter >= 1)
                                <button wire:click='back' id="back_btn" type="button" class="position-fixed">
                                    <h3><i id="back_btn_content" class="fa fa-arrow-left"></i></h1>
                                </button>
                            @endif
                            @if (!$events->isEmpty())
                                @if ($activePanel === 'intro')
                                  
                                    <div class="fade-in">
                                        <h3 class="ps-1">You are on your way to buying a ticket for the event: 
                                            <br>
                                            <b>{{ $events[0]->event_name }}</b>.
                                        </h3>
                                        <br>
                                        <h6 class="ps-1" style="white-space: pre-wrap;">{{ $events[0]->event_description }}</h5>
                                            <br>
                                            <button wire:click='nextPanel("intro")' wire:ignore type="button"
                                                class="btn btn-orange trigger-enter text-white fs-4 ms-1">Start</button>
                                    </div>
                                @elseif($activePanel === 'membership')
                                    <div id="membership-panel" class="fade-in">
                                        <h3 class="q-title fw-bold ps-1">Membership Type</h3>
                                        <br>
                                        <div class="form-check">
                                            <div class="form-check">
                                                <input wire:model.lazy="selectedMembership"
                                                    class="form-check-input radio-membership" type="radio"
                                                    name="membership_radio" id="mem-flexRadioDefault1"
                                                    value="CCCI (Cebu Chamber of Commerce and Industry) Member">
                                                <label class="form-check-label" for="mem-flexRadioDefault1">
                                                    CCCI (Cebu Chamber of Commerce and Industry) Member
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="selectedMembership"
                                                    class="form-check-input radio-membership" type="radio"
                                                    name="membership_radio" id="mem-flexRadioDefault2"
                                                    value="Non CCCI (Cebu Chamber of Commerce and Industry) Member">
                                                <label class="form-check-label" for="mem-flexRadioDefault2">
                                                    Non CCCI (Cebu Chamber of Commerce and Industry) Member
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="selectedMembership"
                                                    class="form-check-input radio-membership" type="radio"
                                                    name="membership_radio" id="mem-flexRadioDefault3"
                                                    value="CBM 2023 SPONSOR">
                                                <label class="form-check-label" for="mem-flexRadioDefault3">
                                                    CBM 2023 SPONSOR
                                                </label>
                                            </div>
                                        </div>
                                        <br>
                                        <button wire:click='nextPanel("{{$activePanel}}")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>
                                    </div>
                                @elseif($activePanel === 'name')
                                    <div id="name-panel" class="fade-in">
                                        <h3 class="q-title fw-bold ps-1">Last Name *</h3>
                                        <div class="col-lg-8 col-12">
                                            <div class="input-group mb-3">
                                                <input wire:model.lazy='name_last' name="name_last" type="text"
                                                    class="form-control no-border" placeholder="Last Name"
                                                    aria-label="Last Name" aria-describedby="">
                                            </div>
                                        </div>
                                        <h3 class="q-title fw-bold ps-1">First Name *</h3>
                                        <div class="col-lg-8 col-12">
                                            <div class="input-group mb-3">
                                                <input wire:model.lazy='name_first' name="name_first" type="text"
                                                    class="form-control no-border" placeholder="First Name"
                                                    aria-label="First Name" aria-describedby="">
                                            </div>
                                        </div>
                                        <h3 class="q-title fw-bold ps-1">Middle Name</h3>
                                        <div class="col-lg-8 col-12">
                                            <div class="input-group mb-3">
                                                <input wire:model.lazy='name_middle' name="name_middle" type="text"
                                                    class="form-control no-border" placeholder="Middle Name"
                                                    aria-label="Middle Name" aria-describedby="">
                                            </div>
                                        </div>
                                        <br>
                                        <button wire:click='nextPanel("name")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>

                                    </div>
                                @elseif($activePanel === 'email_address')
                                    <div id="email-panel" class="fade-in">
                                        <h3 class="q-title fw-bold ps-1">Email Address</h3>
                                        <div class="col-lg-8 col-12">
                                            <div class="input-group mb-3">
                                                <input wire:model.lazy='email_address' name="email_address"
                                                    type="text" class="form-control no-border" placeholder="Email"
                                                    aria-label="Last Name" aria-describedby="">
                                            </div>
                                        </div>

                                        <br>
                                        <button wire:click='nextPanel("email")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>
                                    </div>
                                @elseif($activePanel === 'company')
                                    <div id="company-panel">
                                        <h3 class="q-title fw-bold ps-1">Company / Organization</h3>
                                        <div class="col-lg-8 col-12">
                                            <div class="input-group mb-3">
                                                <input wire:model.lazy='company' name="company" type="text"
                                                    class="form-control no-border"
                                                    placeholder="Company / Organization" aria-label="Last Name"
                                                    aria-describedby="">
                                            </div>
                                        </div>

                                        <br>
                                        <button wire:click='nextPanel("company")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>
                                    </div>
                                @elseif($activePanel === 'sectorBoxoption')
                                    <div id="sector-panel" class="fade-in">
                                        <h3 class="q-title fw-bold ps-1">Sector</h3>
                                        <div class="ps-1">
                                            <div class="form-check">
                                                <input wire:model.lazy="sectorBoxoption"
                                                    class="form-check-input checkbox-sector" type="checkbox"
                                                    value="Private Business" name="sectorBoxoption"
                                                    id="sect-flexCheckDefault">
                                                <label class="form-check-label" for="sect-flexCheckDefault">
                                                    Private Business
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="sectorBoxoption"
                                                    class="form-check-input checkbox-sector" type="checkbox"
                                                    value="Tech Startup Entrepreneur" name="sectorBoxoption"
                                                    id="sect-flexCheckChecked2">
                                                <label class="form-check-label" for="sect-flexCheckChecked2">
                                                    Tech Startup Entrepreneur
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="sectorBoxoption"
                                                    class="form-check-input checkbox-sector" type="checkbox"
                                                    value="Investor/Accelerator/Incubator" name="sectorBoxoption"
                                                    id="sect-flexCheckChecked3">
                                                <label class="form-check-label" for="sect-flexCheckChecked3">
                                                    Investor/Accelerator/Incubator
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="sectorBoxoption"
                                                    class="form-check-input checkbox-sector" type="checkbox"
                                                    value="LGU/Government Agency" name="sectorBoxoption"
                                                    id="sect-flexCheckChecked4">
                                                <label class="form-check-label" for="sect-flexCheckChecked4">
                                                    LGU/Government Agency
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="sectorBoxoption"
                                                    class="form-check-input checkbox-sector" type="checkbox"
                                                    value="Non-Profit/Civic Organization" name="sectorBoxoption"
                                                    id="sect-flexCheckChecked5">
                                                <label class="form-check-label" for="sect-flexCheckChecked5">
                                                    Non-Profit/Civic Organization
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="sectorBoxoption"
                                                    class="form-check-input checkbox-sector" type="checkbox"
                                                    value="Academe/Student" name="sectorBoxoption"
                                                    id="sect-flexCheckChecked6">
                                                <label class="form-check-label" for="sect-flexCheckChecked6">
                                                    Academe/Student
                                                </label>
                                            </div>
                                            <br>
                                        </div>
                                        <button wire:click='nextPanel("sector")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>

                                    </div>
                                @elseif($activePanel === 'industry')
                                    <div id="industry-panel" class="fade-in">

                                        <h3 class="q-title fw-bold ps-1">Industry / Line of Business</h3>
                                        <div class="col-lg-8 col-12">
                                            <div class="input-group mb-3">
                                                <input wire:model.lazy='industry' name="industry" type="text"
                                                    class="form-control no-border" placeholder="Line of Business"
                                                    aria-label="Line of Business" aria-describedby="">
                                            </div>
                                        </div>

                                        <br>
                                        <button wire:click='nextPanel("industry")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>
                                    </div>
                                @elseif($activePanel === 'reference')
                                    <div id="reference-panel" class="fade-in">


                                        <h3 class="q-title fw-bold ps-1">Where did you head about this event?</h3>
                                        <div class="ps-1">
                                            <br>
                                            <div class="form-check">
                                                <input wire:model.lazy="reference" value="Viber"
                                                    class="form-check-input radio-reference" type="radio"
                                                    name="reference_radio" id="ref-flexRadioDefault1" checked>
                                                <label class="form-check-label" for="ref-flexRadioDefault1">
                                                    Viber
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="reference" value="Email"
                                                    class="form-check-input radio-reference" type="radio"
                                                    name="reference_radio" id="ref-flexRadioDefault2">
                                                <label class="form-check-label" for="ref-flexRadioDefault2">
                                                    Email
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="reference" value="Social Media"
                                                    class="form-check-input radio-reference" type="radio"
                                                    name="reference_radio" id="ref-flexRadioDefault3">
                                                <label class="form-check-label" for="ref-flexRadioDefault3">
                                                    Social Media
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="reference" value="Company / Workmates"
                                                    class="form-check-input radio-reference" type="radio"
                                                    name="reference_radio" id="ref-flexRadioDefault4">
                                                <label class="form-check-label" for="ref-flexRadioDefault4">
                                                    Company / Workmates
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy="reference" value="LinkedIn"
                                                    class="form-check-input radio-reference" type="radio"
                                                    name="reference_radio" id="ref-flexRadioDefault5">
                                                <label class="form-check-label" for="ref-flexRadioDefault5">
                                                    LinkedIn
                                                </label>
                                            </div>
                                            <br>
                                            <div class="col-lg-8 col-12">
                                                <div class="input-group mb-3">
                                                    <span class="mt-2 pt-1 me-2">other:</span>
                                                    <input wire:model.lazy="reference_text" name="reference_text"
                                                        type="text" class="form-control no-border" placeholder=""
                                                        aria-label="other" aria-describedby="">
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <button wire:click='nextPanel("reference")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>
                                    </div>
                                @elseif($activePanel === 'expectation')
                                    <div id="expectation-panel" class="fade-in">
                                        <div class="ps-1">
                                            <h3 class="q-title fw-bold">What are you looking forward to? </h3>
                                            <br>
                                            <h5>Do you have any expectations, burning questions or topics you look
                                                forward
                                                to
                                                cover
                                                during
                                                the event? We
                                                hope that all participants have a fruitful and engaging experience!</h5>
                                            <br>
                                            <h6>Please provide questions you want the speaker/s to address during the
                                                summit
                                            </h6>
                                        </div>
                                        <div class="col-lg-8 col-12">
                                            <div class="input-group mb-3">
                                                <input wire:model.lazy='expectation' name="expectation"
                                                    type="text" class="form-control no-border"
                                                    placeholder="Your Answer" aria-label="Your Answer"
                                                    aria-describedby="">
                                            </div>
                                        </div>
                                        <br>
                                        <button wire:click='nextPanel("expectation")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>
                                    </div id="connect-panel">
                                @elseif($activePanel === 'connect')
                                    <div id="connect-panel" class="fade-in">
                                        <div class="ps-1">
                                            <h3 class="q-title fw-bold">Who do you want to connect/network with? </h3>
                                            <br>
                                            <div class="form-check">
                                                <input wire:model.lazy='connect' value="Speakers & Exhibitors"
                                                    class="form-check-input radio-reference" type="checkbox"
                                                    name="connect_check" id="connect-flexRadioDefault1" checked>
                                                <label class="form-check-label" for="connect-flexRadioDefault1">
                                                    Speakers & Exhibitors
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy='connect'
                                                    value="Technology Professionals / Tech Talent"
                                                    class="form-check-input radio-reference" type="checkbox"
                                                    name="connect_check" id="connect-flexRadioDefault2">
                                                <label class="form-check-label" for="connect-flexRadioDefault2">
                                                    Technology Professionals / Tech Talent
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy='connect' value="Tech Startups / Founders"
                                                    class="form-check-input radio-reference" type="checkbox"
                                                    name="connect_check" id="connect-flexRadioDefault3">
                                                <label class="form-check-label" for="connect-flexRadioDefault3">
                                                    Tech Startups / Founders
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy='connect' value="Investors/Advisors/Mentors"
                                                    class="form-check-input radio-reference" type="checkbox"
                                                    name="connect_check" id="connect-flexRadioDefault4">
                                                <label class="form-check-label" for="connect-flexRadioDefault4">
                                                    Investors/Advisors/Mentors
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy='connect' value="SMEs"
                                                    class="form-check-input radio-reference" type="checkbox"
                                                    name="connect_check" id="connect-flexRadioDefault5">
                                                <label class="form-check-label" for="connect-flexRadioDefault5">
                                                    SMEs
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy='connect' value="Students/Schools"
                                                    class="form-check-input radio-reference" type="checkbox"
                                                    name="connect_check" id="connect-flexRadioDefault6">
                                                <label class="form-check-label" for="connect-flexRadioDefault6">
                                                    Students/Schools
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input wire:model.lazy='connect' value="Government Agencies"
                                                    class="form-check-input radio-reference" type="checkbox"
                                                    name="connect_check" id="connect-flexRadioDefault7">
                                                <label class="form-check-label" for="connect-flexRadioDefault7">
                                                    Government Agencies
                                                </label>
                                            </div>
                                            <br>
                                            <div class="col-lg-8 col-12">
                                                <div class="input-group mb-3">
                                                    <span class="mt-2 pt-1 me-2">other:</span>
                                                    <input wire:model.lazy='connect_text' name="connect_text"
                                                        type="text" class="form-control no-border" placeholder=""
                                                        aria-label="Connect" aria-describedby="">
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <button wire:click='nextPanel("connect")' wire:ignore type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4 ms-1">Next</button>

                                    </div>
                                @elseif($activePanel === 'ticket_type')
                                    <div id="final-window"class="fade-in">
                                        <h2 class="q-title fw-bold">3-Day Pass (Summit & Expo Inclusions)</h2>
                                        <h4>Your ticket includes full access to plenary talks and panel discussions at
                                            the
                                            main
                                            stage, the tech expo and
                                            networking areas with LUNCH MEAL per day. </h4>
                                        <br>
                                        <h4>Limited Seats Available on a First Come First Served Basis. </h4>
                                        <br>
                                        <h4>Thank you.</h4>
                                        <br>
                                        @foreach ($events as $event)
                                            @if ($event->member_types == $selectedMembership)
                                                <div class="form-check">
                                                    <input wire:model.lazy="ticketLink"
                                                        value="{{ $event->id }}"
                                                        class="form-check-input radio-reference" type="radio"
                                                        name="ticketChoices" id="ticket_{{ $event->id }}">
                                                    <label class="form-check-label" for="ticket_{{ $event->id }}">
                                                        {{ $event->ticket_names }} ({{ $event->ticket_prices }})
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    
                                        <br>
                                        <button id="paymentWindowOpen" wire:click='saveGuest' type="button"
                                            class="btn btn-orange trigger-enter text-white fs-4">Proceed to
                                            Payment</button>
                                    </div>
                                @endif
                            @else
                                <div id="thank-you-panel" 
                                    class="col-12 col-lg-8 pb-5 h-100 justify-content-center d-flex flex-column fade-in">
                                    <div class="">
                                        <h5 class="q-title fw-bold">Hi there!</h5>
                                        <br>
                                        <h3 class="fw-bold">Cebu Business Months</h3>
                                        <h5>Will be updating the ticket registration soon!</h5>
                                        <br>
                                        <h6>For any other inquiries please email us at <a>cbm@cebuchamber.org</a></h6>
                                        <br>
                                    </div>
                                </div>

                            @endif

                            <div id="thank-you-panel"
                                class="col-12 col-lg-8 pb-5 h-100 justify-content-center d-flex flex-column  hidden ">
                                <div class="">
                                    <h3 class="q-title fw-bold">CHECKING FOR PAYMENT CONFIRMATION</h3>
                                    <br>
                                    <h5>See you at the event!</h5>
                                    <br>
                                    <h6>For any other inquiries please email us at <a>cbm@cebuchamber.org</a></h6>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="image-panel col-4 justify-content-center d-flex flex-column">
                            @if (!$events->isEmpty())                       
                            <div class="">
                                <img class="poster-thumb" src="{{ Storage::url($imagePoster) }}" alt="Event Poster">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </section>
</form>
