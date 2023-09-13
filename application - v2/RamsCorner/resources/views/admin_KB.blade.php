@include('header')
@foreach ($admin as $user)
    @include('sidebar_admin')
    @include('sweetalert::alert')
    <!-- 1st -->
    <div class=""
        style="text-align: center; border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; left: 7%; height: 89%; width: 92%; padding: 3%;">


        <div style="position: relative;">
            <h1 style="text-align: left;margin-bottom:2%">Knowledge Base</h1>

            <div class="container text-center">
                <div class="row" style="width:142%;margin-left:-21%;height:10%">
                    <div class="col notification m-2" id="showDiv1"
                        style="background-color: #22246C;position: relative;display: inline-block; padding: 1%; color: #fff; font-size: 18px; border-radius: 4px; cursor: pointer;">
                        <span class="text" style="margin-right: 10px">Unapproved</span>
                        @if ($unapp_count != 0)
                            <span class="badge"
                                style=" position: absolute; top: 5px; right: 5px;display: flex; justify-content: center;align-items: center; width: 25px; height: 25px; background-color: #ff0000; color: #ffffff; border-radius: 50%; font-size: 14px; box-shadow: 0 0 0 1px #f44336;">{{ $unapp_count }}</span>
                        @endif
                    </div>

                    <div class="col notification m-2" id="showDiv2"
                        style="background-color: #ffc74e; position: relative;display: inline-block; padding: 1%; color: #000000; font-size: 18px; border-radius: 4px; cursor: pointer;">
                        <span class="text" style="margin-right: 10px">Approved</span>
                        {{-- @if ($app_count != 0)
                            <span class="badge"
                                style=" position: absolute; top: 5px; right: 5px;display: flex; justify-content: center;align-items: center; width: 25px; height: 25px; background-color: #ff0000; color: #ffffff; border-radius: 50%; font-size: 14px; box-shadow: 0 0 0 1px #f44336;">{{ $app_count }}</span>
                        @endif --}}
                    </div>
                </div>
            </div>

            <form id="search-form">
                <input id="search-input" type="search" name="searchKB" placeholder="Search Knowledge Base"
                    style=" flex: 1; padding: 12px 20px;  margin: 8px 0; box-sizing: border-box;  border: 2px solid #ccc;  border-radius: 4px; width: 70%;">
                <button type="submit" value="Search"
                    style=" width: auto;  padding: 10px 18px;  background-color: #4CAF50; color: white; margin: 8px 0; border: none;  border-radius: 4px; cursor: pointer;"><i
                        class="bi bi-search"></i> Search</button>
            </form>



            <ul class="nav nav-pills m-3 fs-4" id="pills-tab" role="tablist" style="justify-content: center; ">
                <li class="nav-item" role="presentation">
                    <button onclick="showElement('All')" class="nav-link active" id="" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button onclick="showElement('Infrastructure')" class="nav-link" id="Infrastructure"
                        data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Infrastructure</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button onclick="showElement('Software')" class="nav-link" id="Software" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false">Software</button>
                </li>
            </ul>
        </div>

        <script>
            function showElement(className) {
                var soft = document.getElementsByClassName('Software');
                var infra = document.getElementsByClassName('Infrastructure');
                if (className == 'All') {
                    for (var i = 0; i < soft.length; i++) {
                        soft[i].style.display = "block";
                    }
                    for (var i = 0; i < infra.length; i++) {
                        infra[i].style.display = "block";
                    }
                }
                if (className == 'Infrastructure') {
                    for (var i = 0; i < soft.length; i++) {
                        soft[i].style.display = "none";
                    }
                    for (var i = 0; i < infra.length; i++) {
                        infra[i].style.display = "block";
                    }
                }
                if (className == 'Software') {
                    for (var i = 0; i < soft.length; i++) {
                        soft[i].style.display = "block";
                    }
                    for (var i = 0; i < infra.length; i++) {
                        infra[i].style.display = "none";
                    }
                }
            }
        </script>
        <script>
            document.getElementById('showDiv1').addEventListener('click', function() {
                var div1 = document.getElementsByName('unapp')[0];
                var div2 = document.getElementsByName('app')[0];
                div1.style.display = 'block';
                div2.style.display = 'none';
            });

            document.getElementById('showDiv2').addEventListener('click', function() {
                var div1 = document.getElementsByName('unapp')[0];
                var div2 = document.getElementsByName('app')[0];
                div1.style.display = 'none';
                div2.style.display = 'block';
            });
        </script>

        <div id="kbs" class="overflow-auto border border-secondary-subtle shadow"
            style="position: relative; height: 75%;display:block" name="unapp">
            <div>
                @foreach ($unapproved as $kb_info)
                    <div class=" {{ $kb_info->kb_category }} kbs-content">
                        <a href="adminkbView/{{ $kb_info->kb_ID }}" class="card content {{ $kb_info->kb_category }}"
                            id="content clickable"
                            style="margin: 1%; cursor: pointer; text-decoration:  none; color: black;">
                            <div class="card-header">
                                <h4>{{ $kb_info->kb_title }}</h4>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>{{ \Illuminate\Support\Str::limit($kb_info->kb_content, 100) }}</p>

                                    <footer class="blockquote-footer">KBID #{{ $kb_info->kb_ID }}<cite
                                            title="Source Title"></cite></footer>

                                </blockquote>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="kbs" class="overflow-auto border border-secondary-subtle shadow"
            style="position: relative; height: 75%;display:none" name="app">
            <div>
                @foreach ($approved as $kb_info)
                    <div class=" {{ $kb_info->kb_category }} kbs-content">
                        <a href="adminkbView/{{ $kb_info->kb_ID }}" class="card content {{ $kb_info->kb_category }}"
                            id="content clickable"
                            style="margin: 1%; cursor: pointer; text-decoration:  none; color: black;">
                            <div class="card-header">
                                <h4>{{ $kb_info->kb_title }}</h4>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>{{ \Illuminate\Support\Str::limit($kb_info->kb_content, 100) }}</p>

                                    <footer class="blockquote-footer">KBID #{{ $kb_info->kb_ID }}<cite
                                            title="Source Title"></cite></footer>

                                </blockquote>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


        <script>
            const searchForm = document.querySelector('#search-form');
            const searchInput = document.querySelector('#search-input');
            searchForm.addEventListener('submit', (event) => {
                event.preventDefault();
                const query = searchInput.value.toLowerCase().trim();
                const kbsContentElements = document.querySelectorAll('#kbs .kbs-content');
                kbsContentElements.forEach((element) => {
                    const hasMatch = element.innerText.toLowerCase().includes(query);
                    if (hasMatch) {
                        element.style.display = 'block';
                    } else {
                        element.style.display = 'none';
                    }
                });
            });
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase().trim();
                const kbsContentElements = document.querySelectorAll('#kbs .kbs-content');
                kbsContentElements.forEach((element) => {
                    const hasMatch = element.innerText.toLowerCase().includes(query);
                    if (hasMatch) {
                        element.style.display = 'block';
                    } else {
                        element.style.display = 'none';
                    }
                });
            })
        </script>

        <div style="position: fixed; top: 14%;right:6%; bottom: 5%;">

            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createModal"
                data-bs-whatever="" style="width: 130%"><i class="bi bi-plus-circle-fill"></i> Create KB</button>
        </div>

    </div>

    </div>

    <!-- create KB -->
    <form method="post" encytpe="multipart/form-data" action="{{ url('/createKB') }}"
        class="row g-3 needs-validation" novalidate>
        @csrf
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Knowledge Base Creation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <span class="input-group-text">KB Title</span>
                            <textarea class="form-control" id="title" name="title" rows="1" required></textarea>
                        </div>


                        <div class="input-group mb-3">
                            <span class="input-group-text">Category</span>
                            <select class="form-select " aria-label="Default select example" id="category"
                                name="category" required>
                                <option value="">Choose...</option>
                                <option value="Infrastructure">Infrastructure</option>
                                <option value="Software">Software</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Content</span>
                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Resolution</span>
                            <textarea class="form-control" id="resolution" name="resolution" rows="5 " required></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" value="1" name="userview"
                                    aria-label="Checkbox for following text input">
                            </div>
                            <input placeholder="Available for client view?" class="form-control"
                                aria-label="Text input with checkbox" readonly="true">
                        </div>

                        {{-- <div class="input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" value="1"
                                    name="account_info" aria-label="Checkbox for following text input">
                            </div>
                            <input placeholder="Include account information?" class="form-control"
                                aria-label="Text input with checkbox" readonly="true">
                        </div> --}}


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create KB</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function activateButton(clickedButton) {
            // Remove the active class from all buttons  var buttons = document.querySelectorAll('.notification');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove('active-button');
            }
            // Add the active class to the clicked button  clickedButton.classList.add('active-button');
        }
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endforeach
@include('footer')
