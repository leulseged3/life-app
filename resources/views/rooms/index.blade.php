<x-layouts.app currentpage="Rooms">
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Articles List</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Owner</th>
            <th>Title</th>
            <th>Date</th>
            <th>Time</th>
            <th>Limit</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($rooms as $room)
            <tr>
              <td>
                <a href="/mhps/{{$room->user->id}}">{{$room->user->username}}</a>
              </td>

              <td>{{substr($room->title,0,30)}}</td>
              <td>{{date("F j, Y",strtotime($room->date))}}</td>
              <td>{{date("g:i a",strtotime($room->time))}}</td>
              <td>{{$room->limit}}</td>

              {{-- <td>
                @foreach($article->categories as $category)
                  <span class="badge badge-secondary">{{$category->title}}</span>
                @endforeach
              </td> --}}

              {{-- <td>{{substr($article->description,0,100)}}</td> --}}

              <td style="display: flex;border-bottom-width: 0px;justify-content: space-around;">
                <a href="/rooms/{{$room->id}}">
                  <i class="fas fa-info-circle" title="Details"></i>
                </a>
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#room-delete-modal"
                  data-room="{{$room}}"
                  data-backdrop="static" 
                  data-keyboard="false"
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
      {{$rooms->links()}}
    </div>
  </div>
  @include('rooms.delete')
</x-layouts.app>