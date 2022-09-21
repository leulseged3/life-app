<x-layouts.app currentpage="Pending Articles">
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Pending Articles List</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Feature</th>
            <th>Title</th>
            <th>Category</th>
            <th>Description</th>
            <th>Owner</th>
            <th>Is Admin</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($articles as $article)
            <tr>
              <td>
                <img 
                  src="{{ URL::asset('storage/feature_images/'.$article->feature_image) }}" 
                  alt="{{$article->title}}" 
                  title="{{$article->title}}"
                  style="height: 50px;width: 75px; border-radius: 3px;"
                />
              </td>

              <td>{{substr($article->title,0,50)}}</td>

              <td>
                @foreach($article->categories as $category)
                  <span class="badge badge-secondary">{{$category->title}}</span>
                @endforeach
              </td>

              <td>{{substr($article->description,0,100)}}</td>
              @if($article->owner->name)
                <td>{{$article->owner->name}}</td>
              @else
                <td>{{$article->owner->first_name}} {{$article->owner->last_name}}</td>
              @endif
              @if($article->owner->name)
                <td>Yes</td>
              @else
                <td>No</td>
              @endif
              <td style="display: flex;border-bottom-width: 0px;justify-content: space-between;">
                <a href="/articles/{{$article->id}}">
                  <i class="fas fa-info-circle" title="Details"></i>
                </a>

                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#article-approve-modal"
                  data-article="{{$article}}"
                  data-backdrop="static" 
                  data-keyboard="false"
                  style="margin-inline: 20px;"

                >
                  <i class="fas fa-check" title="approve" style="color: green;"></i>
                </a>
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#article-delete-modal"
                  data-backdrop="static" 
                  data-keyboard="false"
                  data-article="{{$article}}"
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
      {{$articles->links()}}
    </div>
  </div>
  @include('articles.delete')
  @include('articles.approve')
</x-layouts.app>