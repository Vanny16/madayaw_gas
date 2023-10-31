{{-- @if(session('errorMessage'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-exclamation-triangle"></i> Alert!</h5>
    {!! session('errorMessage') !!}
</div>
@endif
@if(session('successMessage'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-check"></i> Alert!</h5>
    {!! session('successMessage') !!}
</div>
@endif
@if(session('infoMessage'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-info"></i> Alert!</h5>
    {!! session('infoMessage') !!}
</div>
@endif
@if(session('warningMessage'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-exclamation-triangle"></i> Alert!</h5>
    {!! session('warningMessage') !!}
</div>
@endif --}}
@if($errors->has('g-recaptcha-response'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-exclamation-triangle"></i> Alert!</h5>
    <em>Invalid captcha response!</em>
</div>
@endif

@if(session('errorMessage'))
<script>
	$(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		Toast.fire({
			type: 'error',
			title: '&nbsp;&nbsp;&nbsp; ALERT! {!! session('errorMessage') !!} &nbsp'
		})
	});
</script>
@endif
@if(session('successMessage'))
<script>
	$(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		Toast.fire({
			type: 'success',
			title: '&nbsp;&nbsp;&nbsp; SUCCESS! {!! session('successMessage') !!} &nbsp'
		})
	});
</script>
@endif
@if(session('infoMessage'))
<script>
	$(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		Toast.fire({
			type: 'info',
			title: '&nbsp;&nbsp;&nbsp; INFO! {!! session('infoMessage') !!} &nbsp'
		})
	});
</script>
@endif
@if(session('warningMessage'))
<script>
	$(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		Toast.fire({
			type: 'warning',
			title: '&nbsp;&nbsp;&nbsp; WARNING! {!! session('warningMessage') !!} &nbsp'
		})
	});
</script>
@endif