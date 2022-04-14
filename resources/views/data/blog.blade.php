@if($items->count() != 0)
    @foreach($items as $item)
        <div class="col-md-6 col-lg-4 mb-6" data-animate="zoomIn">
            <div class="card border-0">
                <a class="hover-scale" href="{{$item->route()}}">
                    <img src="{{$item->img()}}" alt="{{$item->name()}}" class="blog_img card-img-top image">
                </a>
                <div class="card-body px-0">
                    <div class="mb-2">
                        <a href="{{$item->route()}}" class="link-hover-dark-primary">{{$item->sub_name()}}</a>
                    </div>
                    <h5 class="card-title lh-13 letter-spacing-25">
                        <a href="{{$item->route()}}" class="link-hover-dark-primary text-capitalize">
                            {{$item->name()}}
                        </a>
                    </h5>
                    <ul class="list-inline">
                        <li class="list-inline-item mr-0">
                            <span class="text-gray">{{$item->date('')}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12 alert alert-danger">
        {{$lang->Empty}}
    </div>
@endif
<div class="col-md-12">
    <div class="text-center">
        {{$items->appends([
                                   'tags' => app('request')->input('tags'),
                                   'q' => app('request')->input('q'),
                                   'page' => app('request')->input('page'),
                                   ])->render()}}
    </div>
</div>
