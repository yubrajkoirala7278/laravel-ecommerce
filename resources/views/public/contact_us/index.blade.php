@extends('public.layouts.master')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="http://localhost/amazing-shop/">Home</a></li>
                        <li class="breadcrumb-item">Contact Us</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-10">
            <div class="container">
                <div class="section-title mt-5 ">
                    <h2>Love to Hear From You</h2>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mt-3 pe-lg-5">
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page
                            when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                            distribution of letters, as opposed to using Content.</p>
                        <address>
                            Cecilia Chapman <br>
                            711-2880 Nulla St.<br>
                            Mankato Mississippi 96522<br>
                            <a href="tel:+xxxxxxxx">(XXX) 555-2368</a><br>
                            <a href="mailto:jim@rock.com">jim@rock.com</a>
                        </address>
                    </div>

                    <div class="col-md-6">
                        <form class="shake" role="form" method="POST" action="{{ route('frontend.contact') }}"
                            id="contactForm" name="contact-form">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2" for="name">Name</label>
                                <input class="form-control" id="name" type="text" name="name" 
                                    data-error="Please enter your name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="mb-2" for="email">Email</label>
                                <input class="form-control" id="email" type="email" name="email" 
                                    data-error="Please enter your Email">
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="mb-2">Subject</label>
                                <input class="form-control" id="msg_subject" type="text" name="subject" 
                                    data-error="Please enter your message subject">
                                    @if ($errors->has('subject'))
                                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="message" class="mb-2">Message</label>
                                <textarea class="form-control" rows="3" id="message" name="message"  data-error="Write your message"></textarea>
                                @if ($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif
                            </div>

                            <div class="form-submit">
                                <button class="btn btn-dark" type="submit" id="form-submit"><i
                                        class="material-icons mdi mdi-message-outline"></i> Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
