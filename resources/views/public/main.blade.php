@extends('layouts.themes.public.main')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('images/carousel/main01.png') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('images/carousel/main02.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('images/carousel/main03.png') }}" alt="Third slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
                @include('layouts.partials.alert')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ action('FeedbackController@submit') }}" enctype="multipart/form-data">
                {{ csrf_field() }} 

                    <div class="card">
                        <div class="card-header" style="color:white;background:#363636;">
                            <span class="fa fa-id-badge"></span> Personal Details
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <h5><span class="fa fa-exclamation-circle"></span> We value your privacy!</h5>
                                <small>Unless otherwise needed, your personal information will not be disclosed. </small><br/>
                                <small>Please fill-out your contact details so that the University can contact you. Otherwise, your feedback will be discarded. </small>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="std_id_no">Student ID Number</label>
                                    <input class="form-control" type="text" name="std_id_no" />
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="std_name">Name (Last Name, First Name &  Middle Initial)<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="std_name" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="std_email">E-Mail <span style="color:red;">*</span></label>
                                    <input class="form-control" type="email" name="std_email" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="std_mobile">Mobile Number <span style="color:red;">*</span></label>
                                    <input class="form-control" type="number" name="std_mobile" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="color:white;background:#363636;">
                            <span class="fa fa-comment"></span> {{ $feedback_type->typ_value }}
                        </div>
                        <div class="card-body">
                            @if($feedback_type->typ_id == '1')
                                {{-- inquiry --}}
                                <div class="col-md-12 mb-3">
                                    <label for="thm_id">
                                        I would like to ask about: <span style="color:red;">*</span>
                                        <a id="faqslink" style="display:none;" href="#faqs"> (View FAQs)</a>
                                    </label>
                                    <select class="form-control" id="thm_id" name="thm_id" onchange="generateFaq()" required>
                                        <option value="0" selected>-Select One-</option>
                                        @foreach($thematic_values as $thematic_value)
                                            <option value="{{ $thematic_value->thm_id }}">{{ $thematic_value->thm_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif($feedback_type->typ_id == '2')
                                {{-- concern  --}}
                                <div class="col-md-12 mb-3">
                                    <label for="thm_id">
                                        I would like to raise my concern about: <span style="color:red;">*</span>
                                        <a id="faqslink" style="display:none;" href="#faqs"> View FAQs</a>
                                    </label>
                                    <select class="form-control" id="thm_id" name="thm_id" onchange="generateFaq()" required>
                                        <option value="0" selected>-Select One-</option>
                                        @foreach($thematic_values as $thematic_value)
                                            <option value="{{ $thematic_value->thm_id }}">{{ $thematic_value->thm_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif($feedback_type->typ_id == '3')
                                {{-- suggestions --}}
                            @elseif($feedback_type->typ_id == '4')
                                {{-- complaints  --}}
                                <div class="col-md-12 mb-3">
                                    <label for="thm_id">
                                        I would like to raise my concern about: <span style="color:red;">*</span>
                                        <a id="faqslink" style="display:none;" href="#faqs"> View FAQs</a>
                                    </label>
                                    <select class="form-control" id="thm_id" name="thm_id" onchange="generateFaq()" required>
                                        <option value="0" selected>-Select One-</option>
                                        @foreach($thematic_values as $thematic_value)
                                            <option value="{{ $thematic_value->thm_id }}">{{ $thematic_value->thm_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                {{-- commendations  --}}
                            @endif

                            <div class="col-md-12 mb-3">
                                <label for="fbk_details">Details <span style="color:red;">*</span></label>
                                <textarea class="form-control" name="fbk_details" rows="5" placeholder="write details here"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="fbk_file">Attach file (if needed)</label><br/>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fbk_file" name="fbk_file" value="Attach a file" aria-describedby="inputGroupFileAddon01"/>
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                                <small id="fileHelp" class="form-text text-muted">Allowed files: zip, rar, jpg, png, gif, txt, doc, docx, xls, xlsx, ppt, pptx ,pdf (Must not exceed 15MB)</small>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 mb-3">
                                    <div class="alert alert-warning fade show" role="alert">
                                        <h5><span class="fa fa-info-circle"></span> Please confirm!</h5>
                                        <small>I give consent to provide my personal information such as ID number and name to better facilitate my concern(s).</small><br/>
                                        <small><input type="checkbox" checked disabled/> Show my personal information</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 mb-3">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 mb-3">
                                    <input type="hidden" name="src_id" value="{{ $src_id }}" />
                                    <input type="hidden" name="typ_id" value="{{ $feedback_type->typ_id }}" />
                                    <button type="submit" class="btn" style="color:white;background:maroon;"><span class="fa fa-paper-plane"></span> Submit</button> 
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="color:white;background:#363636;">
                        <span class="fa fa-question-circle"></span> Frequently Asked Questions
                    </div>
                    <div class="card-body" id="faqs">
                        @include('public.faqs')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>  
        function generateFaq() {
            var faqslink = document.getElementById("faqslink");
            var thm_id = Number(document.getElementById("thm_id").value);

            var url='/faqs/'+thm_id;
            var chatBody=$('#faq-body');
            $.get(url).done(function(r){chatBody.replaceWith(r);}).fail(function(){});

            if(thm_id=='0'){
                faqslink.style.display = "none";
            }else{
                faqslink.style.display = "inline";
            }
        }
    </script>

    <script>
        $('#regen-captcha').on('click', function(e){
            e.preventDefault();

            var anchor = $(this);
            var captcha = anchor.prev('img');

            $.ajax({
                type: "GET",
                url: '/ajax_regen_captcha',
            }).done(function( msg ) {
                captcha.attr('src', msg);
            });
        });
    </script>

@endsection