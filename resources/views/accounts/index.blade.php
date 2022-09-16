<x-layouts.app currentpage="Accounts">
  @include('accounts.add')
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Accounts List</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($accounts as $account)
            <tr>
              <td>{{$account->name}}</td>
              <td>{{$account->email}}</td>
              @if (count($account->roles))
                <td>{{$account->roles[0]->name}}</td>
              @else
                  <td>Has no role</td>
              @endif

              <td>
                <a 
                  href="#" 
                  data-toggle="modal" 
                  data-target="#account-edit-modal"
                  data-account="{{$account}}"
                  data-backdrop="static" 
                  data-keyboard="false"
                >
                  <i class="fas fa-edit" title="Edit" ></i>
                </a>
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#account-delete-modal"
                  data-account="{{$account}}"
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
      {{$accounts->links()}}
    </div>
  </div>
  @include('accounts.edit')
  @include('accounts.delete')
</x-layouts.app>
