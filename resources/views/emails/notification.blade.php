<b>UET-Supporter Thông báo</b>


<p>Thông tin mới</p>
@foreach($data_news as $data)
	<?php $link = $data['link'] ?>
@if(substr($data['link'],0,1)==='/')
<?php	$link ='http://uet.vnu.edu.vn'.$data['link'] ?>
@endif
<p><b>{!!$data['title']!!}:</b></p>

<br>
<p>{!!$link!!}</p>
@endforeach

<p>Chúc bạn một ngày vui vẻ</p>
<p>UET-Supporter</p>