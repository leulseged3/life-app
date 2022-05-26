<x-layouts.app currentpage="Frequently Asked Questions">
  @include('faqs.add')
  <div id="accordion" class="col-md-10">
    @foreach ($faqs as $faq)
      <div class="card">
        <div class="card-header row" id="heading{{$faq->id}}">
          <button class="btn btn-info btn-sm">
            <i class="fa fa-question" aria-hidden="true"></i>
          </button>
          <h5 class="mb-0" style="flex-grow: 1;">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapseOne">
              {{$faq->question}}
            </button>
          </h5>
          <div style="align-self: flex-end; justify-content: flex-end; justify-self: flex-end">
            <button 
              class="btn btn-info btn-sm"
              data-toggle="modal" 
              data-target="#faq-edit-modal"
              data-faq="{{$faq}}"
            >
              <i class="fa fa-edit" aria-hidden="true"></i>
            </button>
            <button 
              class="btn btn-danger btn-sm"
              data-toggle="modal" 
              data-target="#faq-delete-modal"
              data-faq="{{$faq}}"
            >
              <i class="fa fa-trash-alt" aria-hidden="true" ></i>
            </button>
            {{-- <a 
              href="#"
              data-toggle="modal" 
              data-target="#category-delete-modal"
              data-category="{{$category}}"
            >
              <i class="fa fa-trash-alt" style="color: red;"></i>
            </a> --}}
          </div>
        </div>
        <div id="collapse{{$faq->id}}" class="collapse" aria-labelledby="heading{{$faq->id}}" data-parent="#accordion">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <img 
                  src="{{ URL::asset('storage/faqs/'.$faq->image) }}" 
                  style="height: 150px; border-radius: 3px;"
                />
              </div>
              <div class="col-md-8">
                <p>{{$faq->answer}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    <div>
      {{$faqs->links()}}
    </div>
    @include('faqs.delete')
  </div>
</x-layouts.app>