@php
  $recent_articles = App\Models\Article::where('owner_id', Auth::user()->id)->orderBy('updated_at', 'desc')->take(3)->get();
@endphp
<h4 class="text-muted" style="text-align: center; font-weight: bold;">your recent articles</h4>
<hr />
@foreach ($recent_articles as $article)
<div class="card">
  {{-- <div class="card-header"> --}}
    {{-- <h3 class="card-title">Title</h3> --}}
    {{-- <div class="card-tools"> --}}
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      {{-- <span class="badge badge-primary">Label</span> --}}
      {{-- <i class="fa fa-plus"></i> --}}
    {{-- </div> --}}
    <!-- /.card-tools -->
  {{-- </div> --}}

  <div class="card-body" style="align-items: center;">
    <p style="white-space: nowrap; overflow: hidden;font-weight: bold;">{{$article->title}}</p>
    <div class="row">
      <div class="col-md-4">
        <img 
          src="{{ URL::asset('storage/feature_images/'.$article->feature_image) }}" 
          alt="{{$article->title}}" 
          title="{{$article->title}}"
          style="height: 100px;width: 120px; border-radius: 3px;"
          class="img-thumbnail"
        />
      </div>
      <div class="col-md-8">
        <p>{{substr($article->description,0,100)}}</p>
      </div>
    </div>
    <a href="/articles/{{$article->id}}" class="btn btn-outline-primary btn-xs" style="float: right;">see more<a/>
  </div>
</div>
@endforeach