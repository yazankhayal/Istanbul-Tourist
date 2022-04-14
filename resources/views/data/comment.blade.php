<h4 class="font-size-md mb-1">{{$comments->count()}} {{lang_name('Reviews_for_Thai_Taste_Restaurant')}}</h4>
<div class="reviews">
    @if($comments->count() != 0)
        @foreach($comments as $k)
            <div class="py-6 media border-top">
                <a href="#" class="author-image">
                    @if($k->User->type_login == null)
                        <img src="{{path().$k->User->avatar}}" alt="{{$k->User->name}}"
                             class="rounded-circle">
                    @else
                        <img src="{{$k->User->avatar}}" alt="{{$k->User->name}}"
                             class="rounded-circle">
                    @endif
                </a>
                <div class="media-body">
                    <div class="mb-4 row flex-md-nowrap mb-5">
                        <div class="col-12 col-md-10">
                            <div class="h5 mb-1">
                                {{$k->name}}
                            </div>
                            <ul class="list-inline text-gray">
                                <li class="list-inline-item">
                                    <span>{{lang_name('by')}}</span>
                                    <a href="#">{{$k->User->name}}</a>
                                </li>
                                <li class="list-inline-item">
                                    <span>|</span>
                                </li>
                                <li class="list-inline-item">
                                    <span>{{date_format($k->created_at,'d-M-Y')}}</span>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="ml-0 ml-md-auto text-left text-md-right col-12 col-md-2 mt-2 mt-md-0">
                                                    <span
                                                        class="badge badge-success d-inline-block font-size-h5 font-weight-semibold">{{$k->star}}</span></div>
                    </div>
                    <p class="mb-0">
                        {{$k->text}}
                    </p>
                </div>
            </div>
        @endforeach
    @endif
</div>

{!! $comments->render() !!}
