@include('includes.website.ajax_template')
<section class="header-margin upcoming_event">
    <div class="banner_inner" style="background: url('./public/website/img/inner_banner.png');">
      <div class="banner_inner_cont">
        <h3>UPCOMING EVENTS</h3>
        <div class="breadcrumb">  

          <ul class="">
            <li><a ref="#" class="home">Home</a></li>
            <li>&gt;</li>
            <li class="post post-page current-item">Upcoming Events</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="list_evnt">
            <ul>
             <?php foreach($event_info as $event_infos){ ?>
              <li>
                <div class="bx_list">
                  <div class="img_bx">
                    <img src="<?php echo $event_infos['image'];  ?>" alt="">
                  </div>
                  <div class="evnt_date">
                    <div class="day_no"><?php echo  $event_infos['day']; ?></div>
                    <div class="day_name">
                      <h3><?php echo  $event_infos['month']; ?></h3>
                      <p><?php echo  $event_infos['day_name']; ?></p>
                    </div>
                  </div>
                  <div class="evnt_cont">
                    <h3><?php echo  $event_infos['event_name']; ?></h3>
                    <h4><?php echo  $event_infos['address']; ?></h4>
                    <p>Delhi India</p>
                  </div>
                  <div class="btn_evnt">
                    <a href="#">Read More</a>
                  </div>
                </div>
              </li>
             <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="footer" class="footer">
        @include('includes.website.footer')
             </section>

  
