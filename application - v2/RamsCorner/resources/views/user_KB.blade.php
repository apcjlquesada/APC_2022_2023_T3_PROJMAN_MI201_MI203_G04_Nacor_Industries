@include('header')



@foreach ($client as $clients)
    @include('sidebar_client')



    <!-- 1st -->
    <div class=""
        style="text-align: center; border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; left: 7%; height: 89%; width: 92%; padding: 3%;">
        <div style="position: relative;">
            <h1>Knowledge Base</h1>

            <form id="search-form">
                <input id="search-input" type="search" name="searchKB" placeholder="Search Knowledge Base"
                    style=" flex: 1; padding: 12px 20px;  margin: 8px 0; box-sizing: border-box;  border: 2px solid #ccc;  border-radius: 4px; width: 70%;">
                <button type="submit" value="Search"
                    style=" width: auto;  padding: 10px 18px;  background-color: #4CAF50; color: white; margin: 8px 0; border: none;  border-radius: 4px; cursor: pointer;">Search</button>
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

        <div id="kbs" class="overflow-auto border border-secondary-subtle"
            style="position: relative; height: 75%; padding: 1%;">
            <div>
                @foreach ($kb_info as $kb_info)
                    <div class=" {{ $kb_info->kb_category }} kbs-content">
                        <a href="userkbView/{{ $kb_info->kb_ID }}" class="card content {{ $kb_info->kb_category }}"
                            id="content clickable"
                            style="margin: 1%; cursor: pointer; text-decoration:  none; color: black;">
                            <div class="card-header">
                                <h5>{{ 'KBID #' . $kb_info->kb_ID . ': ' . $kb_info->kb_title }}</h5>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>{{ \Illuminate\Support\Str::limit($kb_info->kb_content, 100) }}</p>

                                    <footer class="blockquote-footer">
                                        {{ \Illuminate\Support\Str::limit($kb_info->kb_resolution, 50, '...') }}<cite
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
@endforeach
@include('footer')
