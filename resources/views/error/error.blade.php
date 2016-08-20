{{-- <ul class="error_msg">
	<li>Lỗi số 1</li>
	<li>Lỗi số 2</li>
</ul> --}}


@if (count($errors) > 0)

        <ul class="error_msg">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
   
@endif