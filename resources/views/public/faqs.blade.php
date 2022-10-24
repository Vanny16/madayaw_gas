<div id="faq-body">
    @if(isset($faqs))
        @foreach($faqs as $faq)
            <div class="card card-default">
                <div class="card-header">
                    <a data-toggle="collapse" href="#collapse-{{$faq->faq_id}}">
                        <span class="fa fa-info-circle"></span> {{ $faq->faq_title }}
                    </a>
                </div>
                <div id="collapse-{{$faq->faq_id}}" class="card-collapse collapse">
                    <div class="card-body">
                        {!! $faq->faq_value !!}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
