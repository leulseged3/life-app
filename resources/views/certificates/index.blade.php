<x-layouts.app currentpage="Certificates">
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Certificates List</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Username</th>
            <th>Certificate</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($certificates as $certificate)
            <tr>
              <td>{{$certificate->user->username}}</td>
              <td>
                <a 
                  href="/certificates/open/{{$certificate->file}}"
                  style="margin-inline: 15px;"
                  target="_blank"
                >
                Open File
                <i class="fas fa-file" title="File" style="margin-left: 10px;"></i>
              </a>
              </td>
              <td>{{$certificate->status}}</td>

              <td class="d-flex" style="justify-content: space-around">
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#certificate-action-modal"
                  data-certificate="{{$certificate}}"
                  data-status="approve"
                  style="margin-inline: 15px;"
                >
                  <i class="fas fa-check" title="Approve" style="color: green"></i>
                </a>
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#certificate-action-modal"
                  data-certificate="{{$certificate}}"
                  data-status="reject"
                >
                  <i class="fas fa-ban" title="Delete" style="color: red"></i>
                </a>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer clearfix bg-white">
      {{$certificates->links()}}
    </div>
  </div>
  @include('certificates.action')
</x-layouts.app>