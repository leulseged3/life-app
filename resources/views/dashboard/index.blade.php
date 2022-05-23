<x-layouts.app>
  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$data['users']}}</h3>
          <p>Users</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="/users" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>    

    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$data['mhps']}}</h3>
          <p>Medical Health Professionals</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-md"></i>
        </div>
        <a href="/mhps" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>    

    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>0</h3>
          <p>Categories and Specialities</p>
        </div>
        <div class="icon">
          <i class="fas fa-list-alt"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>    

    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>0</h3>
          <p>Resources</p>
        </div>
        <div class="icon">
          <i class="fas fa-rss"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>0</h3>
          <p>Tickets</p>
        </div>
        <div class="icon">
          <i class="fas fa-ticket-alt"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
</x-layouts.app>
