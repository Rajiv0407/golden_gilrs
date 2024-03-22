@extends('includes.website.template')
@section('content')
    <div class="user_prof ">
      <div class="menu_section">
        <div class="memu_inner">
          <div class="menu_inner_list user_profile_menu">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="Profile-tab" data-bs-toggle="tab" 
                data-bs-target="#Profile-menu" type="button" role="tab" aria-selected="true">
                  <span class="nk-menu-img"> 
                    <img src="{{URL::to('/public/website')}}/images/up1.png" alt=""> 
                  </span>
                  <span class="nk-menu-text">
                    <h3>The Real Drama Club.</h3>
                  </span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="Marches-tab" data-bs-toggle="tab" data-bs-target="#Marches-menu" type="button" role="tab" aria-selected="false" tabindex="-1">
                  <span class="nk-menu-img">          
                    <img src="{{URL::to('/public/website')}}/images/up2.png" alt="">
                </span>
                  <span class="nk-menu-text">
                    <h3>Not Fast, Just Furious <span class="notfi_no">3</span></h3>
                  </span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="Network-tab" data-bs-toggle="tab" data-bs-target="#Network-menu" type="button" role="tab" aria-selected="false" tabindex="-1">
                  <span class="nk-menu-img">          
                    <img src="{{URL::to('/public/website')}}/images/up3.png" alt="">
                </span>
                  <span class="nk-menu-text">
                    <h3>Chamber of Secrets</h3>
                  </span>
                </button>
              </li>
               <li class="nav-item" role="presentation">
                <button class="nav-link" id="Media-tab" data-bs-toggle="tab" data-bs-target="#Media-menu" type="button" role="tab" aria-selected="false" tabindex="-1">
                  <span class="nk-menu-img"> 
                    <img src="{{URL::to('/public/website')}}/images/up4.png" alt="">
                </span>
                  <span class="nk-menu-text">
                    <h3>We Need Vacation</h3>
                  </span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="Activity-tab" data-bs-toggle="tab" data-bs-target="#Activity-menu" type="button" role="tab" aria-selected="false" tabindex="-1">
                  <span class="nk-menu-img">               
                    <img src="{{URL::to('/public/website')}}/images/up5.png" alt="">
  
                </span>
                  <span class="nk-menu-text">
                    <h3>No Turning Back</h3>
                  </span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="Settings-tab" data-bs-toggle="tab" data-bs-target="#Settings-menu" type="button" role="tab" aria-selected="false" tabindex="-1">
                  <span class="nk-menu-img"> 
                   
                    <img src="{{URL::to('/public/website')}}/images/up6.png" alt="">
  
                </span>
                  <span class="nk-menu-text">
                    <h3>Elizabeth Roason <span class="notfi_no">3</span></h3>
                  </span>
                </button>
              </li>
            </ul>
          </div>
        </div>

      </div>
      <div class="section_right">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="Profile-menu" role="tabpanel" aria-labelledby="Profile-tab">
            <div class="row">
              <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="Box_details_sect">
                    <div class="heading_title">Groups</div>
                  <div class="filter_mind mt-3">
                    <input type="text" name="" id="" placeholder="What's on you  mind?" class="form-control">
                    <button class="btn">
                      
<svg id="Group_90" data-name="Group 90" xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27">
  <rect id="Rectangle_49" data-name="Rectangle 49" width="27" height="27" rx="3" fill="#f9f4ee"/>
  <g id="Group_9" data-name="Group 9" transform="translate(6.469 5.086)">
    <path id="Vector_9" data-name="Vector 9" d="M0,0V17.914" transform="translate(7.266 17.914) rotate(-180)" fill="none" stroke="#d7792d" stroke-width="2"/>
    <path id="Polygon_1" data-name="Polygon 1" d="M0,7.266,7.266,0l7.266,7.266" transform="translate(0 0)" fill="none" stroke="#d7792d" stroke-width="2"/>
  </g>
</svg>

                    </button>

                  </div>
                 
                  <div class="post_list">
                  
                    <div class="post_card">
                      <div class="post_hd">
                      <div class="post_user">
                        <div class="user_avtar">
                          <div class="img_bx">
                            <img src="{{URL::to('/public/website')}}/images/user1.jpg" alt="">
                          </div>
                          <div class="user_details">
                         <div>
                          <h3>Miranda Shaffer</h3>
                          <p>June 21, 12:45 pm</p>
                         </div>
                           
                          </div>
                        </div>
                      </div>
                      <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                          data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ri-more-line"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="">Delete</a></li>
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                        </ul>
                      </div>
                      </div>
                      <div class="description_post">
                        <p>Lorem Ipsum is simply dummy text of <a href="#">@Sarah</a></p>
                      </div>
                      <div class="post_banner">
                        <img src="{{URL::to('/public/website')}}/images/post_b1.png" alt="">

                      </div>
                      <div class="post_footer">
                        <ul>
                          <li>
                          <a href="">             
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" fill="none"/>
                              <g id="Group-2" data-name="Group">
                                <path id="Vector-2" data-name="Vector" d="M10.7,7.249c1.233.4,1.3,1.944.264,2.951a1.865,1.865,0,0,1,0,2.881,2.137,2.137,0,0,1-.176,2.857c.946,1.616-.286,2.365-1.1,2.365H.137a68.809,68.809,0,0,1,0-8.595A9.5,9.5,0,0,1,3.879,3.057S3.967.082,4.693.012c.726-.094,1.893.3,2.047,2.881A7.119,7.119,0,0,1,5.485,7.249s3.962-.4,5.216,0Z" transform="translate(9.988 3.852)" fill="#9f866f"/>
                                <path id="Vector-3" data-name="Vector" d="M4.754,10.234H.22A.228.228,0,0,1,0,10V.234A.228.228,0,0,1,.22,0H4.754a.228.228,0,0,1,.22.234V9.976a.235.235,0,0,1-.22.258Z" transform="translate(3.764 12.997)" fill="#9f866f"/>
                              </g>
                            </g>
                          </svg>
                           <sup>1</sup></a>
                           </li>
                          <li><a href="">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" transform="translate(-45)" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(45)" fill="none"/>
                              <path id="Vector-2" data-name="Vector" d="M19.787,2.506V11.92a2.437,2.437,0,0,1-2.355,2.506H7.946L4.138,18.2a.305.305,0,0,1-.528-.234V14.426H2.355A2.437,2.437,0,0,1,0,11.92V2.506A2.437,2.437,0,0,1,2.355,0H17.41a2.469,2.469,0,0,1,2.377,2.506ZM12.04,10.328a.35.35,0,0,0-.33-.351H3.852a.35.35,0,0,0-.33.351v.164a.35.35,0,0,0,.33.351h7.858a.35.35,0,0,0,.33-.351ZM16.266,7.4a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,7.4Zm0-3a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,4.4Z" transform="translate(47.839 4.379)" fill="#9f866f"/>
                            </g>
                          </svg>
                          <sup>3</sup></a></li>
                                                     <li><a href="">
                                                  
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" transform="translate(-90)" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(90)" fill="none"/>
                              <path id="Vector-2" data-name="Vector" d="M17.806,17.681a3.048,3.048,0,0,1-2.949,3.138,3.048,3.048,0,0,1-2.949-3.138,3.727,3.727,0,0,1,.044-.515L5.172,12.459a2.909,2.909,0,0,1-2.223,1.077A3.048,3.048,0,0,1,0,10.4,3.048,3.048,0,0,1,2.949,7.26,2.89,2.89,0,0,1,5.194,8.384L12,3.864a2.62,2.62,0,0,1-.088-.726A3.048,3.048,0,0,1,14.857,0a3.048,3.048,0,0,1,2.949,3.138,3.048,3.048,0,0,1-2.949,3.138,2.826,2.826,0,0,1-1.915-.749L5.877,10.211v.422l6.911,4.777a2.883,2.883,0,0,1,2.047-.89,3.087,3.087,0,0,1,2.971,3.162Z" transform="translate(93.83 3.138)" fill="#9f866f"/>
                            </g>
                          </svg>
                          <sup>2</sup></a>
                          </li>
                          </ul>
                    </div>

                    </div>
                    <div class="post_card">
                        <div class="post_hd">
                            <div class="post_user">
                              <div class="user_avtar">
                                <div class="img_bx">
                                  <img src="{{URL::to('/public/website')}}/images/user1.jpg" alt="">
                                </div>
                                <div class="user_details">
                               <div>
                                <h3>Miranda Shaffer</h3>
                                <p>June 21, 12:45 pm</p>
                               </div>
                                 
                                </div>
                              </div>
                            </div>
                            <div class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-line"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="">Delete</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                              </ul>
                            </div>
                            </div>
                      <div class="description_post">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                          been the industry's standard dummy
                          text ever since the 1500s,</p>
                      </div>
                      <div class="post_banner">
                        <img src="{{URL::to('/public/website')}}/images/post_b2.png" alt="">

                      </div>
                      <div class="post_footer">
                        <ul>
                          <li>
                          <a href="">             
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" fill="none"/>
                              <g id="Group-2" data-name="Group">
                                <path id="Vector-2" data-name="Vector" d="M10.7,7.249c1.233.4,1.3,1.944.264,2.951a1.865,1.865,0,0,1,0,2.881,2.137,2.137,0,0,1-.176,2.857c.946,1.616-.286,2.365-1.1,2.365H.137a68.809,68.809,0,0,1,0-8.595A9.5,9.5,0,0,1,3.879,3.057S3.967.082,4.693.012c.726-.094,1.893.3,2.047,2.881A7.119,7.119,0,0,1,5.485,7.249s3.962-.4,5.216,0Z" transform="translate(9.988 3.852)" fill="#9f866f"/>
                                <path id="Vector-3" data-name="Vector" d="M4.754,10.234H.22A.228.228,0,0,1,0,10V.234A.228.228,0,0,1,.22,0H4.754a.228.228,0,0,1,.22.234V9.976a.235.235,0,0,1-.22.258Z" transform="translate(3.764 12.997)" fill="#9f866f"/>
                              </g>
                            </g>
                          </svg>
                           <sup>1</sup></a>
                           </li>
                          <li><a href="">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" transform="translate(-45)" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(45)" fill="none"/>
                              <path id="Vector-2" data-name="Vector" d="M19.787,2.506V11.92a2.437,2.437,0,0,1-2.355,2.506H7.946L4.138,18.2a.305.305,0,0,1-.528-.234V14.426H2.355A2.437,2.437,0,0,1,0,11.92V2.506A2.437,2.437,0,0,1,2.355,0H17.41a2.469,2.469,0,0,1,2.377,2.506ZM12.04,10.328a.35.35,0,0,0-.33-.351H3.852a.35.35,0,0,0-.33.351v.164a.35.35,0,0,0,.33.351h7.858a.35.35,0,0,0,.33-.351ZM16.266,7.4a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,7.4Zm0-3a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,4.4Z" transform="translate(47.839 4.379)" fill="#9f866f"/>
                            </g>
                          </svg>
                          <sup>3</sup></a></li>
                                                     <li><a href="">
                                                  
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" transform="translate(-90)" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(90)" fill="none"/>
                              <path id="Vector-2" data-name="Vector" d="M17.806,17.681a3.048,3.048,0,0,1-2.949,3.138,3.048,3.048,0,0,1-2.949-3.138,3.727,3.727,0,0,1,.044-.515L5.172,12.459a2.909,2.909,0,0,1-2.223,1.077A3.048,3.048,0,0,1,0,10.4,3.048,3.048,0,0,1,2.949,7.26,2.89,2.89,0,0,1,5.194,8.384L12,3.864a2.62,2.62,0,0,1-.088-.726A3.048,3.048,0,0,1,14.857,0a3.048,3.048,0,0,1,2.949,3.138,3.048,3.048,0,0,1-2.949,3.138,2.826,2.826,0,0,1-1.915-.749L5.877,10.211v.422l6.911,4.777a2.883,2.883,0,0,1,2.047-.89,3.087,3.087,0,0,1,2.971,3.162Z" transform="translate(93.83 3.138)" fill="#9f866f"/>
                            </g>
                          </svg>
                          <sup>2</sup></a>
                          </li>
                          </ul>
                    </div>

                    </div>
                    <div class="post_card">
                        <div class="post_hd">
                            <div class="post_user">
                              <div class="user_avtar">
                                <div class="img_bx">
                                  <img src="{{URL::to('/public/website')}}/images/user1.jpg" alt="">
                                </div>
                                <div class="user_details">
                               <div>
                                <h3>Miranda Shaffer</h3>
                                <p>June 21, 12:45 pm</p>
                               </div>
                                 
                                </div>
                              </div>
                            </div>
                            <div class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-line"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="">Delete</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                              </ul>
                            </div>
                            </div>
                      <div class="description_post">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                          been the industry's standard dummy
                          text ever since the 1500s,</p>
                      </div>
                      <div class="post_banner">
                        <img src="{{URL::to('/public/website')}}/images/post_b3.png" alt="">

                      </div>
                      <div class="post_footer">
                        <ul>
                          <li>
                          <a href="">             
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" fill="none"/>
                              <g id="Group-2" data-name="Group">
                                <path id="Vector-2" data-name="Vector" d="M10.7,7.249c1.233.4,1.3,1.944.264,2.951a1.865,1.865,0,0,1,0,2.881,2.137,2.137,0,0,1-.176,2.857c.946,1.616-.286,2.365-1.1,2.365H.137a68.809,68.809,0,0,1,0-8.595A9.5,9.5,0,0,1,3.879,3.057S3.967.082,4.693.012c.726-.094,1.893.3,2.047,2.881A7.119,7.119,0,0,1,5.485,7.249s3.962-.4,5.216,0Z" transform="translate(9.988 3.852)" fill="#9f866f"/>
                                <path id="Vector-3" data-name="Vector" d="M4.754,10.234H.22A.228.228,0,0,1,0,10V.234A.228.228,0,0,1,.22,0H4.754a.228.228,0,0,1,.22.234V9.976a.235.235,0,0,1-.22.258Z" transform="translate(3.764 12.997)" fill="#9f866f"/>
                              </g>
                            </g>
                          </svg>
                           <sup>1</sup></a>
                           </li>
                          <li><a href="">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" transform="translate(-45)" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(45)" fill="none"/>
                              <path id="Vector-2" data-name="Vector" d="M19.787,2.506V11.92a2.437,2.437,0,0,1-2.355,2.506H7.946L4.138,18.2a.305.305,0,0,1-.528-.234V14.426H2.355A2.437,2.437,0,0,1,0,11.92V2.506A2.437,2.437,0,0,1,2.355,0H17.41a2.469,2.469,0,0,1,2.377,2.506ZM12.04,10.328a.35.35,0,0,0-.33-.351H3.852a.35.35,0,0,0-.33.351v.164a.35.35,0,0,0,.33.351h7.858a.35.35,0,0,0,.33-.351ZM16.266,7.4a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,7.4Zm0-3a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,4.4Z" transform="translate(47.839 4.379)" fill="#9f866f"/>
                            </g>
                          </svg>
                          <sup>3</sup></a></li>
                                                     <li><a href="">
                                                  
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" transform="translate(-90)" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(90)" fill="none"/>
                              <path id="Vector-2" data-name="Vector" d="M17.806,17.681a3.048,3.048,0,0,1-2.949,3.138,3.048,3.048,0,0,1-2.949-3.138,3.727,3.727,0,0,1,.044-.515L5.172,12.459a2.909,2.909,0,0,1-2.223,1.077A3.048,3.048,0,0,1,0,10.4,3.048,3.048,0,0,1,2.949,7.26,2.89,2.89,0,0,1,5.194,8.384L12,3.864a2.62,2.62,0,0,1-.088-.726A3.048,3.048,0,0,1,14.857,0a3.048,3.048,0,0,1,2.949,3.138,3.048,3.048,0,0,1-2.949,3.138,2.826,2.826,0,0,1-1.915-.749L5.877,10.211v.422l6.911,4.777a2.883,2.883,0,0,1,2.047-.89,3.087,3.087,0,0,1,2.971,3.162Z" transform="translate(93.83 3.138)" fill="#9f866f"/>
                            </g>
                          </svg>
                          <sup>2</sup></a>
                          </li>
                          </ul>
                    </div>

                    </div>
                    <div class="post_card">
                        <div class="post_hd">
                            <div class="post_user">
                              <div class="user_avtar">
                                <div class="img_bx">
                                  <img src="{{URL::to('/public/website')}}/images/user1.jpg" alt="">
                                </div>
                                <div class="user_details">
                               <div>
                                <h3>Miranda Shaffer</h3>
                                <p>June 21, 12:45 pm</p>
                               </div>
                                 
                                </div>
                              </div>
                            </div>
                            <div class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-line"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="">Delete</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                              </ul>
                            </div>
                            </div>
                      <div class="description_post">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                          been the industry's standard dummy
                          text ever since the 1500s,</p>
                      </div>
                      <div class="post_banner">
                        <img src="{{URL::to('/public/website')}}/images/post_b4.png" alt="">

                      </div>
                      <div class="post_footer">
                        <ul>
                          <li>
                          <a href="">             
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" fill="none"/>
                              <g id="Group-2" data-name="Group">
                                <path id="Vector-2" data-name="Vector" d="M10.7,7.249c1.233.4,1.3,1.944.264,2.951a1.865,1.865,0,0,1,0,2.881,2.137,2.137,0,0,1-.176,2.857c.946,1.616-.286,2.365-1.1,2.365H.137a68.809,68.809,0,0,1,0-8.595A9.5,9.5,0,0,1,3.879,3.057S3.967.082,4.693.012c.726-.094,1.893.3,2.047,2.881A7.119,7.119,0,0,1,5.485,7.249s3.962-.4,5.216,0Z" transform="translate(9.988 3.852)" fill="#9f866f"/>
                                <path id="Vector-3" data-name="Vector" d="M4.754,10.234H.22A.228.228,0,0,1,0,10V.234A.228.228,0,0,1,.22,0H4.754a.228.228,0,0,1,.22.234V9.976a.235.235,0,0,1-.22.258Z" transform="translate(3.764 12.997)" fill="#9f866f"/>
                              </g>
                            </g>
                          </svg>
                           <sup>1</sup></a>
                           </li>
                          <li><a href="">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" transform="translate(-45)" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(45)" fill="none"/>
                              <path id="Vector-2" data-name="Vector" d="M19.787,2.506V11.92a2.437,2.437,0,0,1-2.355,2.506H7.946L4.138,18.2a.305.305,0,0,1-.528-.234V14.426H2.355A2.437,2.437,0,0,1,0,11.92V2.506A2.437,2.437,0,0,1,2.355,0H17.41a2.469,2.469,0,0,1,2.377,2.506ZM12.04,10.328a.35.35,0,0,0-.33-.351H3.852a.35.35,0,0,0-.33.351v.164a.35.35,0,0,0,.33.351h7.858a.35.35,0,0,0,.33-.351ZM16.266,7.4a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,7.4Zm0-3a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,4.4Z" transform="translate(47.839 4.379)" fill="#9f866f"/>
                            </g>
                          </svg>
                          <sup>3</sup></a></li>
                                                     <li><a href="">
                                                  
                          <svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072">
                            <g id="Group" transform="translate(-90)" opacity="0.49">
                              <path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(90)" fill="none"/>
                              <path id="Vector-2" data-name="Vector" d="M17.806,17.681a3.048,3.048,0,0,1-2.949,3.138,3.048,3.048,0,0,1-2.949-3.138,3.727,3.727,0,0,1,.044-.515L5.172,12.459a2.909,2.909,0,0,1-2.223,1.077A3.048,3.048,0,0,1,0,10.4,3.048,3.048,0,0,1,2.949,7.26,2.89,2.89,0,0,1,5.194,8.384L12,3.864a2.62,2.62,0,0,1-.088-.726A3.048,3.048,0,0,1,14.857,0a3.048,3.048,0,0,1,2.949,3.138,3.048,3.048,0,0,1-2.949,3.138,2.826,2.826,0,0,1-1.915-.749L5.877,10.211v.422l6.911,4.777a2.883,2.883,0,0,1,2.047-.89,3.087,3.087,0,0,1,2.971,3.162Z" transform="translate(93.83 3.138)" fill="#9f866f"/>
                            </g>
                          </svg>
                          <sup>2</sup></a>
                          </li>
                          </ul>
                    </div>

                    </div>
                    
                   
                  </div>
                </div>

              </div>
              <div class="col-lg-4 col-md-12 col-sm-12">
               
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="Network-menu" role="tabpanel" aria-labelledby="Network-tab">
            Network
          </div>
          <div class="tab-pane fade" id="Media-menu" role="tabpanel" aria-labelledby="Media-tab">
            Media
          </div>
          <div class="tab-pane fade" id="Activity-menu" role="tabpanel" aria-labelledby="Activity-tab">
            Activity
          </div>
       
          <div class="tab-pane fade" id="Settings-menu" role="tabpanel" aria-labelledby="Settings-tab">
            Settings
        </div>
        </div>
      </div>
    </div>
 
  @stop
 