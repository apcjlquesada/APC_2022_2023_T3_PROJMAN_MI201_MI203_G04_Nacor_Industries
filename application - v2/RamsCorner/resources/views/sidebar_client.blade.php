 <!-- header -->
 <style>
     .sidebar {
         position: fixed;
         /* display: inline-block; */
         top: 80px;
         left: 0;
         bottom: 0;
         width: 100px;
         color: #fff;
         padding: 20px;
         transition: 0.2s ease;
         z-index: 10;
     }

     i.iconS {
         font-size: 40px;
         color: white;
     }

     .sidebar:hover {
         width: 250px;
         transition: 0.2s ease;
     }

     ul.sideB {
         list-style-type: none;
         margin: 0;
         padding: 0;
     }

     .aa {
         display: flex;
         align-items: center;
         justify-content: flex-start;
         padding: 10px;
         color: #fff;
         text-decoration: none;
     }

     a.aa:hover {
         background-color: #eda302a5;
     }

     span.iconLabel {
         display: none;
     }

     .sidebar:hover .iconLabel {
         display: block;
         margin-left: 25px;
         font-size: 20px;
         color: white;
     }
 </style>
 <div
     style="
background-color: #22246C; color: black; position: fixed; top: 0; left: 0; right: 0; height: 80px; z-index: 10; border-bottom:#eda302a5 solid 5px;
">

     <!-- logo here -->
     <div style="position: absolute; left: 20px; top: 5px;">
         <a href="https://www.apc.edu.ph" target="_blank" rel="Asia Pacific College"><img
                 width="70px"src={{ asset('images/APCLogotrns.png') }} title="Asia Pacific College"></a>
     </div>
     <div class="" style="position: absolute; left: 5%; top: 40%;">
         <h5 class="" style="font-size: auto; color: white;">
             <strong>{{ $clients->u_name }}</strong></h6>

     </div>


     <!-- photo button -->
     <div>
         <div class="dropdown" style="position: absolute; right: 30px; top: 10px;">
             <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                 style="color: white;" title="Click the dropdown if you want to sign out.">
                 <img src={{ url('userProfile/' . $clients->u_profile) }} style="border-radius: 25px; " width="60px">
             </a>
             <ul class="dropdown-menu mt-">
                 <li><a class="dropdown-item" href="{{ url('/signout') }}">SIGN-OUT</a></li>
             </ul>

         </div>
     </div>
 </div>

 {{-- -- <!-- sidebar --> --}}


 <div class="sidebar" style="background-color: #22246C">
     <nav>
         <ul class="sideB">
             <li class="sbarIcon">
                 <a href="{{ url('/clientHome') }}" class="aa">
                     <i class="bi bi-house-door-fill iconS"></i>
                     <span class="iconLabel">Home</span>
                 </a>
             </li>
             <hr>
             <li class="sbarIcn">
                 <a href="{{ url('/notification') }}" class="aa">
                     <i class="bi bi-bell-fill iconS"></i>

                     <span class="iconLabel">Notifications</span>
                     @if ($notif != 0)
                         <span class="badge rounded-pill bg-danger" style="margin-top: -20%;">
                             {{ $notif }}
                             <span class="visually-hidden">unread messages</span>
                         </span>
                     @else
                     @endif

                 </a>
             </li>
             <hr>
             <li class="sbarIcon">
                 <a href="{{ url('/clientViewTickets') }}" class="aa">
                     <i class="bi bi-ticket-perforated iconS"></i>
                     <span class="iconLabel">My Tickets</span>
                 </a>
             </li>
             <hr>
             <li class="sbarIcon">
                 <a href="{{ url('/user_KB') }}" class="aa">
                     <i class="bi bi-book-half iconS"></i>
                     <span class="iconLabel">Knowledge Base</span>
                 </a>
             </li>
             <hr>
             <li class="sbarIcn">
                 <a href="{{ url('viewTags') }}" class="aa">
                     <i class="bi bi-tags-fill iconS"></i>
                     <span class="iconLabel">Tags</span>
                 </a>
             </li>
             <hr>
             <li class="sbarIcn">
                 <a href="{{ url('viewHelp') }}" class="aa">
                     <i class="bi bi-question-circle iconS"></i>
                     <span class="iconLabel">Help</span>
                 </a>
             </li>
             <hr>

         </ul>
     </nav>
 </div>
