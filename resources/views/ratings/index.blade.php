<x-layouts.app currentpage="Ratings">
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Ratings List</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Username</th>
            <th>Users rate</th>
            <th>Average rate</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($ratings as $rating)
            <tr>

              <td>{{$rating->user->username}}</td>
              <td>{{$rating->number_of_raters}}</td>
              <td>{{$rating->total_ratings/$rating->number_of_raters}}</td>

              <td>
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#rating-delete-modal"
                  data-rating="{{$rating}}"
                >
                  <i class="fas fa-trash" title="Delete" style="color: red"></i>
                </a>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer clearfix bg-white">
      {{$ratings->links()}}
    </div>
  </div>
  @include('ratings.delete')
  {{-- @include('articles.edit') --}}
</x-layouts.app>