<div id="onlinecontact" class="">
  <div class="head">
    <h3>Online Contacts
      <span class="notif"></span>
    </h3>
  </div>
  <?php if(sizeof($online_contact) > 0){   ?>
  <div class="memu_inner">
    <div class="menu_inner_list">

      <ul class="nav nav-tabs" role="tablist">
        <?php foreach($online_contact as $online_contacts){ ?>
		<a style="text-decoration: none !important;" href="{{URL::to('/')}}/message/<?php echo $online_contacts->id; ?>">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="Home-tab" data-bs-toggle="tab" data-bs-target="#Home-menu" type="button"
            role="tab" aria-selected="true">
            <span class="nk-menu-icon"><img src="<?php echo $online_contacts->image; ?>" alt=""></span>
            <span class="nk-menu-text">
              <h3>
                <?php echo $online_contacts->name; ?>
              </h3>
            </span>
          </button>
        </li>
		</a>
        <?php } ?>
      </ul>
    </div>
  </div>
  <?php } else{ ?>
  <div class="ofl_notfound">
    <div class="media"><img src="{{URL::to('/public/website')}}/images/no_record/l_norecrd.png" alt=""> </div>
    <h3>No record Found</h3>
    <p>Online Friends not yet</p>
  </div>
  <?php } ?>
</div>