
<div class="modal fade" id="TicketCancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="text-align: left">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="TicketCancelLabel">Ticket Cancel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cancelTicket') }}" method="POST">
                @csrf
                <div class="modal-body">



                    <input type="hidden" name="tID" value="{{ $tickets->t_ID }}">
                    <p>Are you sure you want to cancel this ticket?</p>

            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>

            </form>

        </div>
    </div>
</div>




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
