@include('includes.website.ajax_template')
<section class="header-margin about_sect">
    <div class="banner_inner" style="background: url('./public/website/img/inner_banner.png');">    
    <div class="banner_inner_cont">
      <h3>About Us</h3>
      <div class="breadcrumb">
         
        <ul class="">
          <li>
            <a ref="#" class="home">Home</a>  
          </li>
          <li>&gt;</li>
          <li class="post post-page current-item">About Us</li>
        </ul>            
      </div>
    </div>
  </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="img_bx">
            <img src="{{URL::to('/public/website')}}/img/abt_img.png" alt="">
            <div class="ab_hvr">
              <div class="icons-block"> 
                <ul>
                  <li>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                  </li>
                </ul>
               </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="about-content">
            <h3 class="title">Ajay core</h3>

            <ul class="abt_dtl">
              <li>
                <span class="meta-title">Speciality</span>
                <span>CTO</span>
              </li>
              <li>
                <span class="meta-title">Email</span>
                <span>ajaycore@gmail.com</span>
              </li>
              <li>
                <span class="meta-title">Twitter</span>
                <span>@Spker_ajaycore</span>
              </li>
              <li>
                <span class="meta-title">Website</span>
                <span>http://spker.ajaycore.com</span>
              </li>
              <li>
                <span class="meta-title">Phone</span>
                <span>+844 123.456.789</span>
              </li>
              <li>
                <span class="meta-title">Fax</span>
                <span>+844 123.456.789</span>
              </li>
            </ul>
            <div class="about-desc">
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.</p>
            </div>
            </div>
        </div>
      </div>
    </div>
  </section>
<section id="footer" class="footer">
        @include('includes.website.footer')
             </section>
  
 
 