<x-layouts.app currentpage="Article Detail">
  <div class="card col-md-8">
    <img 
      src="{{ URL::asset('storage/feature_images/'.$article->feature_image) }}" 
      alt="{{$article->title}}" 
      title="{{$article->title}}"
      style="height: 400px; border-radius: 3px;margin-top: 7px;"
    /> 
    <div class="card-body">
      @foreach($article->categories as $category)
        <span class="badge badge-info">{{$category->title}}</span>
      @endforeach
      <p style="font-size: 25px;font-weight: bold;">{{$article->title}}</p>
      <p class="text-muted"><i class="fas fa-user"></i>&nbsp;&nbsp;{{$article->user->name}}</p>
      <p class="text-muted"><i class="fas fa-clock"></i>&nbsp;{{date('D j, Y',strtotime($article->updated_at))}}</p>
      <hr/>
      <p>{{$article->description}}</p>
    </div>
  </div>
</x-layouts.app>