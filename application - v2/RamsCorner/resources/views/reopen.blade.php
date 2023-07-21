@include('sweetalert::alert')


<div class="modal fade" id="TicketSubmition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="text-align: left">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="TicketSubmitionLabel">Ticket Creation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{ url('reopenTicket/' . $tickets->t_ID) }}">
                @csrf
                <div class="modal-body">

                    {{-- CC --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text">CC</span>
                        <input type="text" name="cc" class="form-control" placeholder="Enter name"
                            aria-label="CC" id="autocomplete" />
                    </div>


                    <div class="row">
                        {{-- Category   --}}
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Category</span>
                                <select class="form-control form-select" aria-label="Default select example"
                                    name="category" required>
                                    <option selected value="{{ $tickets->t_category }}">{{ $tickets->t_category }}
                                    </option>
                                    <option value="Infrastructure">Infrastructure (e.g. Desktop Support,
                                        Audio/Video Equipment Support, Server and Cloud Services Support)</option>
                                    <option value="Software">Software (e.g. Software Development, Business
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
                                placeholder="Add a short description of your concern" aria-label="title"
                                value="{{ $tickets->t_title }}" required />

                        </div>
                    </div>


                    {{-- Content --}}

                    <div class="mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ticket<br> Description</span>
                            <textarea placeholder="Type your inquiry/request here... " class="form-control" id="exampleFormControlTextarea1"
                                rows="3" name="content" required>{{ $tickets->t_content }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" id="formFile" name="profile" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reopen</button>
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
