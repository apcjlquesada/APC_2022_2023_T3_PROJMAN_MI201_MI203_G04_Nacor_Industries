@include('header')

@include('sweetalert::alert')
@foreach ($client as $clients)
    @include('sidebar_client')


    <div class="overflow-auto"
        style=" border-radius: 25px; border: 1px solid #acb1677c; position: absolute; background-color: #002975; top: 10%; left: 6%; height: 89%; width: 93%; padding: 2%;">

        <div style="text-align:center;">
            <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="width: 30%;">
        </div>


        <h2 style="color: white;">Browse Help Topics:</h2>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Creating a Ticket
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>in creating a ticket, you can go click "My Tickets" from the side bar. After opening the "My
                            Tickets" Screen,
                            you will see a square button with a plus sign on the lower right corner. Click "CREATE
                            TICKET" and a
                            dialog box will pop up containing all the necessary details for your ticket. Fill up the
                            form and click "Create" to send your ticket.
                            A system alert will then be shown to notify you if your ticket has already been sent. And
                            that's it!
                            Please be patient while waiting for the ITRO agent to work on your ticket. </p>
                    </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Processing of Ticket
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><em>Once the ITRO agent received your ticket, it will undergo the following processes:
                            </em><br>
                            1. Check the details of your ticket. <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the ticket you sent is not under the scope of ITRO
                            services, the ITRO
                            agent can reject
                            your ticket.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;But if your ticket details is valid, it will be followed by
                            process #2<br><br>
                            2. Updating Ticket Details. <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The ITRO agent who opened the ticket will investigate the
                            incident reported.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            After the investigation, the ITRO Staff can now modify the ticket details based on the
                            result of investigation.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            They can manually set the impact and urgency, or leave it as the default (urgency and
                            priority is on "Normal")
                            and then assign the ticket to themselves or assign it to other ITRO staff.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            The due of the ticket will also be dependent on the priority and will be declared after the
                            modification of ticket details.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            The ticket status will then be updated as "OPENED".<br><br>
                            3. Changing of status after opening the ticket<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Your ticket will undergo many changes in status as the process of resolution progresses.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            But do not worry! The ITRO Staff will keep you updated of the status of your ticket via
                            website
                            notification and email notification.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            You can also track the changing of status on the right
                            panel of your ticket screen.<br><br>
                            4. After resolving the ticket<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Once your ticket is resolved, the ITRO will edit the resolution details and provide you the
                            step-by-step process of resolving your problem.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            You will also be notified if your ticket has been resolved along with a confirmation
                            message.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            You can reply via the email notification if your problem is already resolved and
                            the ticket can now be closed by the ITRO Staff- provided that you have the resolution steps
                            already.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            After receiving your confirmation, the ITRO will then updadte the status of your ticket as
                            "CLOSED".<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            If, and only if, after 48 hours, you did not reply to the confirmation message, the ITRO
                            will deem your ticket as resolved and will automatically close the ticket.<br><br>
                            5. After the ticket is closed.<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Once you confirm that the ticket can be closed or is automatically closed by staff given
                            that you did not respond on their confirmation message after 24 hours, you have the
                            privilege to Reopen your ticket.<br><br>
                            6.After Reopening the ticket<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            The ITRO will proceed to doing the step #1.

                        </p>

                    </div>
                </div>
            </div>




        </div>

    </div>
@endforeach
@include('footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
