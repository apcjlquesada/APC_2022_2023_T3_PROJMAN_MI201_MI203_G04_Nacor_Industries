@include('header')
@foreach ($staff as $user)
    @include('sidebar_staff')
    @include('sweetalert::alert')
    <!-- 1st -->
    <div class=""
        style="text-align: center; border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; left: 7%; height: 89%; width: 92%; padding: 3%;">
        <div style="position: relative;">
            <h1 style="text-align: left;margin-bottom:2%">Knowledge Base</h1>

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

        <div id="kbs" class="overflow-auto border border-secondary-subtle shadow"
            style="position: relative; height: 75%;">
            <div>
                @foreach ($kb_info as $kb_info)
                    <div class=" {{ $kb_info->kb_category }} kbs-content">
                        <a href="staffkbView/{{ $kb_info->kb_ID }}" class="card content {{ $kb_info->kb_category }}"
                            id="content clickable"
                            style="margin: 1%; cursor: pointer; text-decoration:  none; color: black;">
                            <div class="card-header">
                                <h4>{{ $kb_info->kb_title }}</h4>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>{{ \Illuminate\Support\Str::limit($kb_info->kb_content, 100) }}</p>

                                    <footer class="blockquote-footer">Ticket # {{ $kb_info->kb_ID }}<cite
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
                data-bs-whatever="" style="width:130%"><i class="bi bi-plus-circle-fill"></i> Create KB</button>
        </div>

    </div>

    </div>

    <!-- create KB -->
    <form method="post" encytpe="multipart/form-data" action="{{ url('/createKB') }}" class="row g-3 needs-validation"
        novalidate>
        @csrf
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Knowledge Base Creation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        </div>
    </form>

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
