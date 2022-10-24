@extends('layouts.themes.public.main')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-inline w-100" src="{{ asset('images/carousel/main01.png') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-inline w-100" src="{{ asset('images/carousel/main02.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-inline w-100" src="{{ asset('images/carousel/main03.png') }}" alt="Third slide">
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
                                    <label for="std_id_no">Student/Employee ID Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="std_id_no" value="{{ $std_id_no }}" readonly required/>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="std_name">Name (Last Name, First Name &  Middle Initial)<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="std_name" value="{{ $std_name }}" readonly required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="std_email">E-Mail <span style="color:red;">*</span></label>
                                    <input class="form-control" type="email" name="std_email" value="{{ $std_email }}" required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="std_mobile">Mobile Number <span style="color:red;">*</span></label>
                                    <input class="form-control" type="number" name="std_mobile" value="{{ $std_mobile }}" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="color:white;background:#363636;">
                            <span class="fa fa-comment"></span>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 mb-3">
                                <label for="typ_id">
                                    Feedback Type
                                </label>
                                <select class="form-control" id="typ_id" name="typ_id" onchange="ShowHideUrl()" required>
                                    @foreach($feedback_types as $feedback_type)
                                        <option value="{{ $feedback_type->typ_id }}">{{ $feedback_type->typ_value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="thm_id">
                                    <div id="inquiry" style="display:inline;">
                                        I would like to ask about: <span style="color:red;">*</span>
                                    </div>
                                    <div id="concern" style="display:none;">
                                        I would like to raise my concern about: <span style="color:red;">*</span>
                                    </div>
                                    <div id="suggestion" style="display:none;">
                                        I would like to suggest about:
                                    </div>
                                    <div id="complaint" style="display:none;">
                                        I would like to raise my concern about: <span style="color:red;">*</span>
                                    </div>
                                    <div id="commendation" style="display:none;">
                                        I would like to commend:
                                    </div>
                                </label>
                                <select class="form-control" id="thm_id" name="thm_id" onchange="generateFaq()" required>
                                    @foreach($thematic_values as $thematic_value)
                                        <option value="{{ $thematic_value->thm_id }}">{{ $thematic_value->thm_value }}</option>
                                    @endforeach
                                </select>
                            </div>

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

    <script>
        $(document).ready(function() {
            
            $('select[name="typ_id"]').on('change', function(){
                var typ_id = $(this).val();
                if(typ_id) {
                    $.ajax({
                        url: '/validation/theme-loader/'+typ_id,
                        type:"GET",
                        dataType:"json",
                        beforeSend: function(){
                            $('#loader').css("visibility", "visible");
                        },
                        success:function(data) {
                            $('select[name="thm_id"]').empty(); 
                            //$('select[name="thm_id"]').append('<option value=""></option>');
                            $.each(data, function(key, value){
                                $('select[name="thm_id"]').append('<option value="'+ key +'">' + value + '</option>');
                            });
                        },
                        complete: function(){
                            $('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[name="thm_id"]').empty();
                }
            });
        });
    </script> 

    <script type="text/javascript">
        function ShowHideUrl() {
            try {
                var typ_id = document.getElementById("typ_id");
                var x = typ_id.options[typ_id.selectedIndex].value;

                var inquiry = document.getElementById("inquiry");
                var concern = document.getElementById("concern");
                var suggestion = document.getElementById("suggestion");
                var complaint = document.getElementById("complaint");
                var commendation = document.getElementById("commendation");

                if(x=='1'){
                    inquiry.style.display = "inline";
                    concern.style.display = "none";
                    suggestion.style.display = "none";
                    complaint.style.display = "none";
                    commendation.style.display = "none";
                }else if(x=='2'){
                    inquiry.style.display = "none";
                    concern.style.display = "inline";
                    suggestion.style.display = "none";
                    complaint.style.display = "none";
                    commendation.style.display = "none";
                }else if(x=='3'){
                    inquiry.style.display = "none";
                    concern.style.display = "none";
                    suggestion.style.display = "inline";
                    complaint.style.display = "none";
                    commendation.style.display = "none";
                }else if(x=='4'){
                    inquiry.style.display = "none";
                    concern.style.display = "none";
                    suggestion.style.display = "none";
                    complaint.style.display = "inline";
                    commendation.style.display = "none";
                }else if(x=='5'){
                    inquiry.style.display = "none";
                    concern.style.display = "none";
                    suggestion.style.display = "none";
                    complaint.style.display = "none";
                    commendation.style.display = "inline";
                }
            }
            catch(err) {
                alert(err.message);
            }
        }
    </script>

@endsection