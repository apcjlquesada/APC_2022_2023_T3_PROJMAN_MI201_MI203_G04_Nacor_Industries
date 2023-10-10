<div class="modal fade" id="chatboxModal" tabindex="-1" role="dialog" aria-labelledby="chatboxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatboxModalLabel">Chat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <div id="chat-messages">
                    @if ($chatss == 0)
                        <h5 style="padding: 50px;">No conversation available.</h5>
                    @elseif($chatss > 0)
                        @foreach ($chats as $chatsss)
                            <p>{{ $chatsss->us_id }} | {{ $chatsss->m_content }}</p>
                        @endforeach

                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <form id="chat-form" action="{{ url('sendmessages/' . $tickets->t_ID) }}" enctype="multipart/form-data"
                    method="post">
                    @csrf
                    <input type="text" id="message" name="message" class="form-control"
                        placeholder="Type your message">
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
