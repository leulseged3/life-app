<x-layouts.app currentpage="Articles">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Articles List</h3>
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
              <td>{{$article->user->name}}</td>
              <td class="d-flex" style="justify-content: space-around">
                <a href="/articles/{{$article->id}}">
                  <i class="fas fa-info-circle" title="Details"></i>
                </a>

                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#article-edit-modal"
                  data-article="{{$article}}"
                  style="margin-inline: 15px;"
                >
                  <i class="fas fa-edit" title="Edit"></i>
                </a>
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#article-delete-modal"
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
  @include('articles.edit')
</x-layouts.app>