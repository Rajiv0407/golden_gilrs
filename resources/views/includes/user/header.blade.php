 <header class="navbar_menu">
    <nav class="navbar sticky-top navbar-expand-lg">
      <div class="logo">
        <button class="menu_but navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="{{URL::to('/public/website')}}/img/logo.png" style="max-width:150px;" alt=""></a>
      </div>
      <div class="collapse navbar-collapse nav-menu" id="navbarSupportedContent">
        <div class="search_grp mg-auto">
          <input type="text" placeholder="search">   

        </div>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">About US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Experiences</a>
          </li>

          <li class="dropdown">
            <a class="btn dropdown-toggle" href="javascript(vid0);" role="button" id="dropdownMenuLink"
              data-bs-toggle="dropdown" aria-expanded="false">
              Resources
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="#">Add Event</a></li>
              <li><a class="dropdown-item" href="#">Upcoming Event</a></li>
              <li><a class="dropdown-item" href="#">Monthly Events</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="btn dropdown-toggle" href="javascript(vid0);" role="button" id="dropdownMenuLink"
              data-bs-toggle="dropdown" aria-expanded="false">
              Events
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="#">Add Event</a></li>
              <li><a class="dropdown-item" href="#">Upcoming Event</a></li>
              <li><a class="dropdown-item" href="#">Monthly Events</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact us
            </a>
          </li>
          <li class="rgt_menu">
            <div class="right_nav">
              <i class="fa fa-bars"></i>
            </div>
          </li>


          <div class="menuBtn ">  
             <a href="{{URL::to('/')}}/logout">logout</a>     
          </div>

        </ul>

      </div>
    </nav>
    <div class="right_navbar">
      <div class="close-side">
        <i class="fa fa-chevron-left"></i>
      </div>
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Service</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>