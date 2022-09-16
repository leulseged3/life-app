<x-layouts.app currentpage="Tickets Raised">
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Ticket Raised List</h3>
    </div>
    <div class="card-body" 
    {{-- style="overflow-x: hidden;" --}}
    >
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Image</th>
            <th>Username</th>
            <th>Message</th>
            <th>Reply</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tickets as $ticket)
            <tr>
              <td>
                @if ($ticket->image)
                  <img 
                    src="{{ URL::asset('storage/tickets/'.$ticket->image) }}" 
                    style="height: 50px;width: 75px; border-radius: 3px;"
                  />
                @endif
              </td>

              <td>{{$ticket->user->username}}</td>
              @php
                  $array = explode(' ', $ticket->message);
              @endphp
              @if (count($array) === 1)
              <td>{{substr($ticket->message,0,35)}}</td>
              @else
              <td>
                {{$ticket->message}}
              </td>
              @endif
                
                <td>{{$ticket->reply}}</td>
                <td style="margin-left: 30px;">
                {{-- <a href="/tickets/{{$ticket->id}}">
                  <i class="fas fa-info-circle" title="Details"></i>
                </a> --}}

                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#ticket-reply-modal"
                  data-ticket="{{$ticket}}"
                  data-backdrop="static" 
                  data-keyboard="false"
                  style="margin-inline: 15px;"
                >
                  <i class="fas fa-reply" title="Reply"></i>
                </a>
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#ticket-delete-modal"
                  data-backdrop="static" 
                  data-keyboard="false"
                  data-ticket="{{$ticket}}"
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
      {{$tickets->links()}}
    </div>
  </div>
  @include('tickets.reply')
  @include('tickets.delete')
</x-layouts.app>