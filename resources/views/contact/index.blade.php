@extends('layouts.app')

@section('content')

    <div class="contact text-center">
        <h1 class="contact__title">{{$title}}</h1>
        <p class="contact__description">{{$description}}</p>
        <p class="contact__location">Location: {{$location}}</p>
        <p class="contact__phone">Phone: {{$phone}}</p>
        <p class="contact__email">Email: {{$email}}</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="contact__form text-center">
                <form action="#" method="#" class="contact__form-container" style="max-width: 500px; margin: 0 auto;">
                    <p class="contact__form-description">Do you have any questions or comments for us? We would love 
                        to hear from you! Whether you're interested in one of our Mobile Homes, have a general query or 
                        just want to say hello, we're here to listen.
                    </p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="message" placeholder="Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
            <div class="contact__services text-center">
            <!--<p class="contact__services-description">If you're interested in learning more about our services, 
                please don't hesitate to contact us. We're always happy to discuss your needs and provide you with a free consultation.</p>-->
            </div>
    </div>
</div>

@endsection
