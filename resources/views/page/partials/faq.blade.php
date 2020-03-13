@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<section class="faq">
    <div class="title">
        <h2>{{ trans('faq.faq_title') }}</h2>
        <h5>ViarStudia</h5>
        <p>{{ trans('faq.faq_description') }}</p>
    </div>
    <div class="faq-content clearfix">
        <img src="../img/faq-img1.png" alt="" class="faq-img1">
        <div class="accordion" id="accordion">
            <?php $i=1; ?>
            @foreach ($questions as $question)
                <h3><?php echo $i; ?>. {{ $question->title }}</h3>
                <div>
                    <p>{{ $question->text_info }}</p>
                </div>
                <?php $i++; ?>
            @endforeach
        </div>
        <i>{{ trans('faq.faq_description_2') }}</i>
        <img src="../img/faq-img2.png" alt="" class="faq-img2">
    </div>
</section>