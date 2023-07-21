@include('sweetalert::alert')

<div class="position-absolute bottom-0 end-0 me-4 " style="margin-bottom: 3%">
    <a type="button" class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#TicketSubmition"
        title="Create New Ticket">
        <i class="bi bi-plus-square-fill" style="font-size: 50px; color:white"></i>
        <h5 style="color: white;">NEW <br> TICKET</h5>
    </a>
</div>

<div class="modal fade" id="TicketSubmition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="text-align: left">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="TicketSubmitionLabel">Ticket Creation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{ url('createTicket') }}">
                @csrf
                <div class="modal-body">

                    {{-- CC --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text">CC</span>
                        <input type="text" name="cc" class="form-control" placeholder="Enter name"
                            aria-label="CC" id="autocomplete"
                            title="CC - tag a related person in your ticket (e.g. Your instructor, classmate) that needs to be notified, too." />
                    </div>

                    <div class="row">
                        {{-- Category   --}}
                        <div class="col-md">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Category</span>
                                <select class="form-control form-select" aria-label="Default select example"
                                    name="category" required title="Category - these are the scope of ITRO's service. ">
                                    <option selected value="">Choose...</option>
                                    <option value="Infrastructure"
                                        title="Infrastructure - these are related to desktop hardware support such as faulty keyboards. This also includes problems in the borrowed equipment, as well as problems within your accounts such as LinkedIn, MS Teams.">
                                        Infrastructure (e.g. Desktop Support,
                                        Audio/Video Equipment Support, Server and Cloud Services Support)</option>
                                    <option value="Software"
                                        title="Software - these are related to developing software needed in APC, Business Analysis, and Data Analysis for APC constituents.
                                    ">
                                        Software (e.g. Software Development, Business
                                        Analysis, Data Analysis)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Urgency --}}
                        {{-- <div class="col-md-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Urgency</span>
                                <select class="form-control form-select" aria-label="Default select example"
                                    name="urgency" required>
                                    <option selected value="">Choose...</option>
                                    <option value="1">Critical</option>
                                    <option value="2">Urgent</option>
                                    <option value="3">Normal</option>
                                </select>
                            </div>
                        </div> --}}

                        {{-- Impact --}}
                        {{-- <div class="col-md-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Impact</span>
                                <select class="form-control form-select" aria-label="Default select example"
                                    name="impact" required>
                                    <option selected value="">Choose...</option>
                                    <option value="1">High</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Low</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>


                    {{-- Title --}}
                    <div class="flex-nowrap">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" name="title" class="form-control"
                                placeholder="Add a short description of your ticket" aria-label="title" required
                                title="Title - give a short description of your ticket (e.g. Faulty Keyboard, No internet in 317)" />
                        </div>
                    </div>


                    {{-- Content --}}

                    <div class="mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ticket<br> Description</span>
                            <textarea placeholder="Type the long description of your ticket here... " class="form-control"
                                id="exampleFormControlTextarea1" rows="3" name="content" required
                                title="Ticket Description - input here all the necessary and expounded information about your ticket, an explanation of the incident will be a better content for better resolution"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" id="formFile" name="profile"
                                title="File - Attach an image or any document (limited only to 1 attachment per ticket) for better understanding of your concern." />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>

        </div>
    </div>
</div>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        "use strict";
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll(".needs-validation");
        // Loop over them and prevent submission
        Array.from(forms).forEach((form) => {
            form.addEventListener(
                "submit",
                (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

<script>
    var autocompleteData = [
        @foreach ($allUser as $users)
            '{{ $users }}',
        @endforeach
    ];
    var autocompleteInput = document.getElementById('autocomplete');
    var suggestionsList = document.createElement('ul');
    suggestionsList.classList.add('autocomplete-list', 'list-group');

    autocompleteInput.addEventListener('input', function() {
        var inputText = autocompleteInput.value;
        var suggestions = [];

        // Filter the autocompleteData array for suggestions that match the input text
        for (var i = 0; i < autocompleteData.length; i++) {
            if (autocompleteData[i].toLowerCase().indexOf(inputText.toLowerCase()) !== -1) {
                suggestions.push(autocompleteData[i]);
            }
        }

        // Limit the suggestions to the first 10 items
        suggestions = suggestions.slice(0, 5);

        // Remove any existing suggestions from the list
        while (suggestionsList.firstChild) {
            suggestionsList.removeChild(suggestionsList.firstChild);
        }

        // Add the filtered suggestions to the list
        for (var i = 0; i < suggestions.length; i++) {
            var suggestionItem = document.createElement('li');
            suggestionItem.classList.add('list-group-item');
            suggestionItem.textContent = suggestions[i];
            suggestionItem.addEventListener('click', function(event) {
                autocompleteInput.value = event.target.textContent;
                suggestionsList.innerHTML = '';
            });
            suggestionsList.appendChild(suggestionItem);
        }

        // Show the suggestions list after the input field but before the next input field
        var nextInput = autocompleteInput.nextElementSibling;
        if (nextInput) {
            autocompleteInput.parentNode.insertBefore(suggestionsList, nextInput);
        } else {
            autocompleteInput.parentNode.appendChild(suggestionsList);
        }
    });

    // Hide the suggestions list when the user clicks outside the input field or suggestions list
    document.addEventListener('click', function(event) {
        if (event.target !== autocompleteInput && event.target !== suggestionsList) {
            suggestionsList.innerHTML = '';
        }
    });

    // Hide the suggestions list when the user clicks outside the input field or suggestions list
    document.addEventListener('click', function(event) {
        if (event.target !== autocompleteInput && event.target !== suggestionsList) {
            suggestionsList.innerHTML = '';
        }
    });
</script>
