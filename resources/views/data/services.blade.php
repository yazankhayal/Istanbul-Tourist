<div class="store-listing-style store-listing-style-02">

    @if($items->count() != 0)
        @foreach($items as $item)
            <div class="mb-6">
                <div class="store media align-items-stretch bg-white job-store">
                    <a href="{{$item->route()}}" class="fe_1_img store-image"
                       style="background-image: url('{{$item->img()}}')">
                    </a>
                    <div class="media-body px-0 px-md-4 pt-4 pt-lg-0">
                        <div class="d-flex align-items-center lh-1">
                            <span class="text-gray">{{$item->Category->name()}}</span>
                        </div>
                        <a href="{{$item->route()}}"
                           class="h5  text-dark d-inline-block store-name"><span
                                class="letter-spacing-25">{{$item->name()}}</span>
                        </a>
                        <div class="row mb-3">
                            @if($item->address)
                                <div class="col-lg-6">
                                    <i class="fal fa-map-marker-alt"></i><span
                                        class="d-inline-block ml-2">{{$item->address}}</span>
                                </div>
                            @endif
                            <div class="col-lg-6">
                                <i class="fal fa-briefcase"></i><span
                                    class="d-inline-block ml-2 text-link">{{$item->City->name()}}</span>
                            </div>
                            <div class="col-lg-12"><i class="fal fa-clock"></i><span
                                    class="d-inline-block ml-2">{{$item->Catalogue->name()}}</span>
                            </div>
                        </div>
                        <div class="border-top pt-2 px-0 pb-0">
                            {{$item->sub_name()}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="pagination">
        {{$items->appends([
                                    'address' => app('request')->input('address'),
                                    'category_id' => app('request')->input('category_id'),
                                    'city_id' => app('request')->input('city_id'),
                                    'q' => app('request')->input('q'),
                                    'page' => app('request')->input('page'),
                                    ])->render()}}
    </div>
</div>
