<!DOCTYPE html >
<html lang="{{ app()->getLocale() }}">

<head>
    <title>Dentia — Rehab</title>
    <link rel="icon" href="{{ asset('website/images/icon.webp')}}" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Dentia — Rehab" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS Files
    ================================================== -->
    <link href="{{ asset('website/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="{{ asset('website/css/plugins.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('website/css/swiper.css')}}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('website/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('website/fonts/elegant_font/HTML_CSS/style.css')}}" rel="stylesheet"  type="text/css">
    <!-- <link rel="stylesheet" href="{{ asset('website/fonts/icofont/icofont.min.css')}}"> -->
    <!-- color scheme -->
    <link id="colors" href="{{ asset('website/css/colors/scheme-01.css')}}" rel="stylesheet" type="text/css">
   <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body>
    <div id="wrapper">
        <a href="#" id="back-to-top"></a>

        <!-- preloader begin -->
        <div id="de-loader"></div>
        <!-- preloader end -->

        <!-- header begin -->
        <header class="transparent header-light header-float">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-inner">
                            <div class="de-flex sm-pt10">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="index.html">
                                            <img class="logo-main" src="{{ asset('website/images/logo-black.webp')}}" alt="">
                                            <img class="logo-scroll" src="{{ asset('website/images/logo-black.webp')}}" alt="">
                                            <img class="logo-mobile" src="{{ asset('website/images/logo-black.webp')}}" alt="">
                                        </a>
                                    </div>
                                    <!-- logo end -->
                                </div>
                                <div class="de-flex-col header-col-mid">
                                    <!-- mainemenu begin -->
                                    <ul id="mainmenu">
                                        <li><a class="menu-item" href="{{ route('home') }}"data-i18n="home">Home</a></li>
                                        <li><a class="menu-item" href="{{ route('services') }}"data-i18n="services">Services</a>
                                            <ul>
                                                {{--  <li><a class="menu-item" href="{{ route('services.general') }}" data-i18n="general">General Dentistry</a></li>  --}}
                                                <li><a class="menu-item" href="{{ route('services.cosmetic') }}" data-i18n="cosmetic">Cosmetic Dentistry</a></li>
                                                <li><a class="menu-item" href="{{ route('services.pediatric') }}" data-i18n="pediatric">Pediatric Dentistry</a></li>
                                                <li><a class="menu-item" href="{{ route('services.restorative') }}" data-i18n="restorative">Restorative Dentistry</a></li>
                                                <li><a class="menu-item" href="{{ route('services.preventive') }}" data-i18n="preventive">Preventive Dentistry</a></li>
                                                <li><a class="menu-item" href="{{ route('services.orthodontics') }}" data-i18n="orthodontics">Orthodontics</a></li>
                                                {{--  <li><a class="menu-item" href="services.html" data-i18n="all_services">All Services</a></li>  --}}
                                            </ul>
                                        </li>
                                        <li><a class="menu-item" href="{{ route('dentists') }}"data-i18n="dentists">Dentists</a></li>
                                        <li><a class="menu-item" href="#" data-i18n="pages">Pages</a>
                                            <ul>
                                                <li><a class="menu-item" href="{{ route('pages.about') }}"data-i18n="about_us">About Us</a></li>
                                                <li><a class="menu-item" href="{{ route('pages.faq') }}"data-i18n="faq">FAQ</a></li>
                                                <li><a class="menu-item" href="{{ route('pages.gallery') }}"data-i18n="gallery">Gallery</a></li>
                                            </ul>
                                        </li>
                                        <!-- <li><a class="menu-item" href=""data-i18n="blog">Blog</a></li> -->
                                        <li><a class="menu-item" href="{{ route('contact') }}"data-i18n="contact">Contact</a></li>
                                        <li><a class="menu-item" href="{{ route('booking') }}"data-i18n="book_appointment">Book Appointment</a></li>
                                    </ul>
                                    <!-- mainmenu end -->
                                </div>
                                <!-- <div class="de-flex-col">
                                    <div class="menu_side_area">
                                        <a href="{{ route('booking') }}" class="btn-main"><span>Book Appointment</span></a>
                                        <span id="menu-btn"></span>
                                    </div>
                                </div> -->
                                <div class="de-flex-col">
                                    <div id="languageBtn" class="mt-1">
                                        <i class="fa-solid fa-globe fs-5 id-color"></i>
                                    </div>
                                    <div class="menu_side_area d-flex align-items-center gap-2">
                                        <div  class=" whats-btn fx-slide d-inline-flex justify-content-center align-items-center gap-2 whatsapp-link"> <!--btn-main-->
                                            <i class="fs-20 fa-brands fa-whatsapp id-color fs-3"></i>
                                            <!-- <span>للحجز و الاستعلام</span> -->
                                        </div>
                                        <span id="menu-btn"></span>
                                    </div>

                                    <div id="btn-extra">
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">

            <div id="top"></div>

            <section class="text-light bg-dark no-top no-bottom overflow-hidden">
                <div class="container-fluid position-relative half-fluid">
                  <div class="container">
                    <div class="row">
                      <!-- Image -->
                      <div class="col-lg-6 position-lg-absolute right-half h-100">
                        <div class="headImage" data-bgimage="url({{ asset('website/images/misc/s1.webp')}}) center"></div>
                      </div>
                      <!-- Text -->
                      <div class="col-lg-6">
                            <div class="pt-lg-5 mt-lg-5 me-lg-3">
                                <div class="py-5 mt-lg-5 mb-3 me-lg-3">
                                    <div class="subtitle id-color wow fadeInUp" data-wow-delay=".0s"data-i18n="brand_name">Welcome to Dentia</div>
                                    <h1 class="wow fadeInUp" data-wow-delay=".2s"data-i18n="brand_title">Transforming Smiles With Precision And Gentle Touch</h1>
                                    <p class="col-lg-10 wow fadeInUp" data-wow-delay=".4s"data-i18n="brand_description">We offer high-quality dental care tailored for the whole family. From routine checkups to advanced treatments, our compassionate team ensures your smile stays healthy and confident.</p>

                                    <a class="btn-main mb10 mb-3 wow fadeInUp" data-wow-delay=".6s" href="{{ route('booking') }}"><span data-i18n="book_appointment">Book Appointment</span></a>

                                        <div class="border-bottom my-3"></div>

                                    <div class="d-lg-flex align-items-center">
                                        <div class="me-3"data-i18n="google_rating">Google Rating</div>
                                        <div class="de-flex justify-content-start align-items-center">
                                            <div class="me-3">5.0</div>
                                            <div class="d-flex fs-14 d-rating me-3">
                                                <i class="fa fa-solid fa-star m-1"></i>
                                                <i class="fa fa-solid fa-star m-1"></i>
                                                <i class="fa fa-solid fa-star m-1"></i>
                                                <i class="fa fa-solid fa-star m-1"></i>
                                                <i class="fa fa-solid fa-star m-1"></i>
                                            </div>
                                        </div>
                                        <div class="me-3"data-i18n="review">Based on 23k Reviews</div>
                                    </div>
                                </div>
                            </div>
                      </div>
                    </div>
                  </div>
                </div>
            </section>

            <section class="bg-dark text-light pt-50 pb-30 pb-0">
                <div class="container relative">
                    <div class="row g-4 grid-divider slider-extra sm-hide">
                        <div class="col-lg-4 col-md-6 mb-sm-30">
                            <div class="d-flex justify-content-center">
                                <i class="fs-60 fa-solid fa-phone id-color"></i>
                                <div class="ms-3">
                                    <h4 class="mb-0" data-i18n="need_service">Need Dental Services?</h4>
                                    <p>Call: +1 123 456 789</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-sm-30">
                            <div class="d-flex justify-content-center">
                                <i class="fs-60 id-color fa-solid fa-clock"></i>
                                <div class="ms-3">
                                    <h4 class="mb-0"data-i18n="opening_hours">Opening Hours</h4>
                                    <p data-i18n="working_date">Mon to Sat 08:00 - 20:00</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-sm-30">
                            <div class="d-flex justify-content-center">
                                <i class="fs-60 id-color fa-solid fa-envelope"></i>
                                <div class="ms-3">
                                    <h4 class="mb-0" data-i18n="email_us">Email Us</h4>
                                    <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a7c4c8c9d3c6c4d3e7c3c2c9d3cec6c4cbcec9cec489c4c8ca">[email&#160;protected]</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <section class="bg-color-op-1" style="padding: 60px 0;">
                <div class="container">
                    <div class="d-flex justify-content-center align-items-center w-50 mx-auto section-heading">
                        <div class="text-center">
                            <h2 class="wow fadeInUp" data-wow-delay=".2s" data-i18n="offer">Offers</h2>
                            <div class="spacer-single"></div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="owl-carousel owl-theme offers-carousel wow fadeInUp">

                            @forelse ($offers as $offer)
                            <div class="item">
                                <div class="offer-card"
                                    data-offer-id="{{ $offer['id'] }}"
                                    data-title-en="{{ $offer['title_en'] }}"
                                    data-title-ar="{{ $offer['title_ar'] }}"
                                    data-description-en="{{ $offer['description_en'] }}"
                                    data-description-ar="{{ $offer['description_ar'] }}"
                                    style="background:#fff; border-radius:16px; overflow:hidden;
                                           border:1px solid #e5e7eb; display:flex; flex-direction:column;
                                           margin: 0 10px;">

                                    {{-- Header --}}
                                    <div style="background:#1a6fc4; padding:28px 24px 20px; text-align:center; position:relative;">

                                        @if (!empty($offer['discount']))
                                        <div style="position:absolute; top:14px; right:14px;
                                                    background:#ef4444; color:#fff;
                                                    font-size:11px; font-weight:600; padding:4px 10px;
                                                    border-radius:999px;">
                                            {{ $offer['discount'] }}% OFF
                                        </div>
                                        @endif

                                        <div style="width:56px; height:56px; border-radius:50%;
                                                    background:rgba(255,255,255,0.15);
                                                    display:flex; align-items:center; justify-content:center;
                                                    margin:0 auto 10px; overflow:hidden;">
                                            @if (!empty($offer['image_url']))
                                                <img src="{{ $offer['image_url'] }}" alt=""
                                                    style="width:56px; height:56px; object-fit:cover; border-radius:50%;">
                                            @else
                                                <svg width="28" height="28" fill="none" stroke="#fff" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @endif
                                        </div>

                                        <p style="color:rgba(255,255,255,0.7); font-size:11px; margin:0 0 4px;
                                                letter-spacing:0.8px; text-transform:uppercase;"
                                           data-i18n="special_offer">Special Offer</p>

                                        <h3 class="offer-title"
                                            style="color:#fff; font-size:17px; font-weight:600; margin:0; line-height:1.4;">
                                            {{ $offer['title_en'] }}
                                        </h3>
                                    </div>

                                    {{-- Body --}}
                                    <div style="padding:20px 24px; display:flex; flex-direction:column; flex:1;">

                                        <p class="offer-description"
                                           style="font-size:13px; color:#6b7280; margin:0 0 16px;
                                                  line-height:1.6; text-align:center; min-height:40px;">
                                            {{ Str::limit($offer['description_en'], 100) }}
                                        </p>

                                        @if (!empty($offer['expires_at']))
                                        <div style="display:flex; align-items:center; gap:10px;
                                                    background:#f9fafb; border-radius:10px; padding:10px 12px; margin-bottom:8px;">
                                            <svg width="15" height="15" fill="none" stroke="#3b82f6" stroke-width="1.8"
                                                viewBox="0 0 24 24" style="flex-shrink:0;">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <div>
                                                <p style="font-size:14px; color:#9ca3af; margin:0;" data-i18n="expires_on">Expires</p>
                                                <p style="font-size:13px; color:#111827; font-weight:600; margin:0;">
                                                    {{ \Carbon\Carbon::parse($offer['expires_at'])->format('d M Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        @endif

                                        @if (!empty($offer['discount']))
                                        <div style="display:flex; align-items:center; justify-content:center; gap:6px;
                                                    margin-bottom:16px; padding:10px 12px;
                                                    background:#eff6ff; border-radius:10px;">
                                            <span style="font-size:13px; color:#3b82f6;" data-i18n="save">Save</span>
                                            <span style="font-size:22px; font-weight:700; color:#1a6fc4;">{{ $offer['discount'] }}%</span>
                                            <span style="font-size:13px; color:#3b82f6;" data-i18n="on_this_service">on this service</span>
                                        </div>
                                        @endif

                                        <div style="margin-top:auto;">
                                            <button onclick="openOfferPopup({{ $offer['id'] }})"
                                                    style="width:100%; padding:12px; border-radius:10px;
                                                           background:#1a6fc4; color:#fff; border:none;
                                                           cursor:pointer; font-size:14px; font-weight:600;
                                                           transition:background 0.2s;"
                                                    onmouseover="this.style.background='#1558a0'"
                                                    onmouseout="this.style.background='#1a6fc4'">
                                                <span data-i18n="request_offer">طلب العرض</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="item">
                                <p class="text-center text-muted">{{ __('No active offers available') }}</p>
                            </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row g-4 gx-5 align-items-center">
                        <div class="col-lg-6">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class=" rounded-1 overflow-hidden wow zoomIn">
                                                <img src="{{ asset('website/images/misc/p1.webp')}}" class="w-100 wow scaleIn" alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row g-4">
                                        <div class="spacer-single sm-hide"></div>

                                        <div class="col-lg-12">
                                            <div class=" rounded-1 overflow-hidden wow zoomIn" data-wow-delay=".3s">
                                                <img src="{{ asset('website/images/misc/p2.webp')}}" class="w-100 wow scaleIn" alt=""
                                                    data-wow-delay=".3s">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="col-lg-6">
                          <div class="me-lg-3">
                              <div class="subtitle s2 mb-3 wow fadeInUp" data-wow-delay=".0s"data-i18n="about_us">About Us</div>
                              <h2 class="wow fadeInUp" data-wow-delay=".2s"data-i18n="about_us_tilte">Professionals and Personalized Dental Excellence</h2>
                              <p class="wow fadeInUp" data-wow-delay=".4s"data-i18n="about_us_description">We offer high-quality dental care tailored for the whole family. From routine checkups to advanced treatments, our compassionate team ensures your smile stays healthy and confident.</p>
                              <ul class="ul-check text-dark cols-2 fw-600 mb-4 wow fadeInUp" data-wow-delay=".6s">
                                <li data-i18n="about_us_option_1">Personalized Treatment Plans</li>
                                <li data-i18n="about_us_option_2">Gentle Care for Kids and Adults</li>
                                <li data-i18n="about_us_option_3">State-of-the-Art Technology</li>
                                <li data-i18n="about_us_option_4">Flexible Appointment Scheduling</li>
                              </ul>

                              <a class="btn-main fx-slide wow fadeInUp" data-wow-delay=".8s" href="{{ route('booking') }}"data-i18n="book_appointment"><span>Book Appointment</span></a>
                          </div>
                    </div>
                  </div>
                </div>
            </section>

            <section class="bg-color-op-1">
                <div class="container">
                    <div class="row g-4 justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="subtitle wow fadeInUp mb-3"data-i18n="our_service">Our Services</div>
                            <h2 class="wow fadeInUp" data-wow-delay=".2s"data-i18n="our_service_title">Complete Care for Every Smile</h2>
                            <p class="mx-auto mb-0 wow fadeInUp"data-i18n="our_service_description">From routine cleanings to advanced restorations, we
                                provide personalized dental solutions for patients of all ages.</p>
                            <div class="spacer-single"></div>
                            <div class="spacer-half"></div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- <div class="col-lg-3 col-sm-6">
                            <div class="hover">
                                <div class="bg-white h-100 p-40 rounded-1">
                                    <img src="{{ asset('website/images/icons/tooth-1.png')}}" class="w-70px mb-3 wow scaleIn" alt="">
                                    <div class="relative mt-4 wow fadeInUp">
                                        <h4 data-i18n="general">General Dentistry</h4>
                                        <p data-i18n="general_description">Complete oral care for every smile with cleanings, exams, and more.</p>
                                        <a class="btn-plus" href="{{ route('services.general') }}">
                                            <i class="fa fa-plus"></i>
                                            <span data-i18n="read_more">Read more</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="hover">
                                <div class="bg-white h-100 p-40 rounded-1">
                                    <img src="{{ asset('website/images/icons/tooth-2.png')}}" class="w-70px mb-3 wow scaleIn" alt="">
                                    <div class="relative mt-4 wow fadeInUp">
                                        <h4 data-i18n="cosmetic">Cosmetic Dentistry</h4>
                                        <p data-i18n="cosmetic_description">Enhance your smile’s beauty with whitening, veneers, and more.</p>
                                        <a class="btn-plus" href="{{ route('services.cosmetic') }}">
                                            <i class="fa fa-plus"></i>
                                            <span data-i18n="read_more">Read more</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="hover">
                                <div class="bg-white h-100 p-40 rounded-1">
                                    <img src="{{ asset('website/images/icons/tooth-3.png')}}" class="w-70px mb-3 wow scaleIn" alt="">
                                    <div class="relative mt-4 wow fadeInUp">
                                        <h4 data-i18n="pediatric">Pediatric Dentistry</h4>
                                        <p data-i18n="pediatric_description"></p>
                                        <a class="btn-plus" href="service-pediatric-dentistry.html">
                                            <i class="fa fa-plus"></i>
                                            <span data-i18n="read_more">Read more</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="hover">
                                <div class="bg-white h-100 p-40 rounded-1">
                                    <img src="{{ asset('website/images/icons/tooth-4.png')}}" class="w-70px mb-3 wow scaleIn" alt="">
                                    <div class="relative mt-4 wow fadeInUp">
                                        <h4 data-i18n="restorative">Restorative Dentistry</h4>
                                        <p data-i18n="restorative_description">Repair and restore your teeth for lasting comfort and function, and more.</p>
                                        <a class="btn-plus" href="service-restorative-dentistry.html">
                                            <i class="fa fa-plus"></i>
                                            <span data-i18n="read_more">Read more</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-5 text-center">
                            <a class="btn-main fx-slide" href="{{ route('services') }}"><span data-i18n="view_all_services">View All Services</span></a>
                        </div>

                    </div>
                </div>
            </section>

            <section class="bg-dark text-light pt-60 pb-60">
                <div class="container">

                    <div class="row g-4">
                        <div class="col-md-3 col-sm-6 text-center">
                            <div class="de_count wow fadeInRight" data-wow-delay=".0s">
                                <h3 class="fs-40 mb-0"><span class="timer" data-to="10000" data-speed="3000">0</span>+</h3>
                                <div data-i18n="happy_patients">Happy Patients</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center">
                            <div class="de_count wow fadeInRight" data-wow-delay=".2s">
                                <h3 class="fs-40 mb-0"><span class="timer" data-to="2500" data-speed="3500">0</span>+</h3>
                                <div data-i18n="teeth_whitened">Teeth Whitened</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center">
                            <div class="de_count wow fadeInRight" data-wow-delay=".4s">
                                <h3 class="fs-40 mb-0"><span class="timer" data-to="800" data-speed="3000">0</span>+</h3>
                                <div data-i18n="dental_implants">Dental Implants</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center">
                            <div class="de_count wow fadeInRight" data-wow-delay=".6s">
                                <h3 class="fs-40 mb-0"><span class="timer" data-to="15" data-speed="3000">0</span>+</h3>
                                <div data-i18n="years_of_experience">Years of Experience</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row gy-4 gx-5 align-items-center">
                        <div class="col-lg-6">
                            <div class="subtitle id-color wow fadeInUp" data-wow-delay=".0s" data-i18n="dental_care">Why Choose Our Dental Care</div>
                            <h2 class="wow fadeInUp" data-wow-delay=".2s" data-i18n="dental_care_title">Exceptional Service With a Personal Touch</h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s" data-i18n="dental_care_description">Choosing the right dental provider matters. We combine expert care, advanced technology, and a warm atmosphere to ensure every visit is comfortable, efficient, and tailored to your unique needs.</p>

                            <div class="border-bottom mb-4"></div>

                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="h-100">
                                        <div class="relative wow fadeInUp">
                                            <h5 data-i18n="dental_care_1_title">Experienced Dental</h5>
                                            <p class="mb-0" data-i18n="dental_care_1_description">Skilled care backed by years of trusted dental experience.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="h-100">
                                        <div class="relative wow fadeInUp">
                                            <h5 data-i18n="dental_care_2_title">Advanced Technology</h5>
                                            <p class="mb-0" data-i18n="dental_care_2_description">Modern tools ensure accurate and efficient treatments.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="h-100">
                                        <div class="relative wow fadeInUp">
                                            <h5 data-i18n="dental_care_3_title">Personalized Treatment</h5>
                                            <p class="mb-0" data-i18n="dental_care_3_description">Custom care plans made to fit your smile and lifestyle.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="h-100">
                                        <div class="relative wow fadeInUp">
                                            <h5 data-i18n="dental_care_4_title">Family-Friendly</h5>
                                            <p class="mb-0" data-i18n="dental_care_4_description">Welcoming space for kids, teens, adults, and seniors.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="row g-4 align-items-center">
                                <div class="col-sm-6 text-end">
                                    <div class="w-80 rounded-1 overflow-hidden mb-25 wow zoomIn d-inline-block">
                                        <img src="{{ asset('website/images/misc/s2.webp')}}" class="w-100 wow scaleIn" alt="">
                                    </div>
                                    <div class="w-100 rounded-1 overflow-hidden mb-25 wow zoomIn d-inline-block">
                                        <img src="{{ asset('website/images/misc/s3.webp')}}" class="w-100 wow scaleIn" alt="">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="w-100 rounded-1 overflow-hidden mb-25 wow zoomIn d-inline-block">
                                        <img src="{{ asset('website/images/misc/p3.webp')}}" class="w-100 wow scaleIn" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </section>

            <!-- <section class="bg-color-op-1">
                <div class="container">
                    <div class="d-flex justify-content-center align-items-center mx-auto section-heading w-50">
                        <div class=" text-center">
                            <div class="subtitle wow fadeInUp mb-3">Meet Our Dental Team</div>
                            <h2 class="wow fadeInUp" data-wow-delay=".2s">Committed to Your Smile</h2>
                            <p class="wow fadeInUp">Our experienced dental team is here to make every visit positive and
                                personalized. With gentle hands and caring hearts.</p>
                            <div class="spacer-single"></div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="relative rounded-1 overflow-hidden">
                                <div class="rounded-1 overflow-hidden wow fadeIn zoomIn">
                                    <img src="{{ asset('website/images/team/1.webp')}}" class="w-100 wow scaleIn" alt="">
                                </div>

                                <div class="abs w-100 start-0 bottom-0 z-3">
                                    <div class="p-2 rounded-10 m-3 text-center bg-white wow fadeInDown">
                                        <h4 class="mb-0">Dr. Sarah Bennett</h4>
                                        <p class="mb-2"data-i18n="dr_specialist_1">Lead Dentist</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="relative rounded-1 overflow-hidden">
                                <div class="rounded-1 overflow-hidden wow fadeIn zoomIn">
                                    <img src="{{ asset('website/images/team/2.webp')}}" class="w-100 wow scaleIn" alt="">
                                </div>

                                <div class="abs w-100 start-0 bottom-0 z-3">
                                    <div class="p-2 rounded-10 m-3 text-center bg-white wow fadeInDown">
                                        <h4 class="mb-0">Dr. Maya Lin</h4>
                                        <p class="mb-2" data-i18n="dr_specialist_2">Cosmetic Dentist</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="relative rounded-1 overflow-hidden">
                                <div class="rounded-1 overflow-hidden wow fadeIn zoomIn">
                                    <img src="{{ asset('website/images/team/3.webp')}}" class="w-100 wow scaleIn" alt="">
                                </div>

                                <div class="abs w-100 start-0 bottom-0 z-3">
                                    <div class="p-2 rounded-10 m-3 text-center bg-white wow fadeInDown">
                                        <h4 class="mb-0">Dr. Michael Reyes</h4>
                                        <p class="mb-2" data-i18n="dr_specialist_3">Pediatric Specialist</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="relative rounded-1 overflow-hidden">
                                <div class="rounded-1 overflow-hidden wow fadeIn zoomIn">
                                    <img src="{{ asset('website/images/team/4.webp')}}" class="w-100 wow scaleIn" alt="">
                                </div>

                                <div class="abs w-100 start-0 bottom-0 z-3">
                                    <div class="p-2 rounded-10 m-3 text-center bg-white wow fadeInDown">
                                        <h4 class="mb-0">Dr. James Carter</h4>
                                        <p class="mb-2" data-i18n="dr_specialist_4">Dental Hygienist</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

            <!-- <section>
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="subtitle id-color wow fadeInUp" data-wow-delay=".0s" data-i18n="question_title">Everything You Need to Know</div>
                            <h2 class="wow fadeInUp" data-wow-delay=".2s" data-i18n="question_title_2">Frequently Asked Questions</h2>
                        </div>

                        <div class="col-lg-7">
                            <div class="accordion s2 wow fadeInUp">
                                <div class="accordion-section">
                                    <div class="accordion-section-title" data-tab="#accordion-a1" data-i18n="question_1">
                                        How often should I visit the dentist?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a1" data-i18n="question_answer_1">It’s recommended to see your dentist every 6 months for a routine check-up and cleaning, unless advised otherwise.
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-a2" data-i18n="question_2">
                                        What should I do in a dental emergency?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a2" data-i18n="question_answer_2">
                                        Call our office immediately. We offer same-day emergency care for issues like severe pain, broken teeth, or swelling.
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-a3" data-i18n="question_3">
                                        Do you offer services for kids?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a3" data-i18n="question_answer_3">
                                        Absolutely! We provide gentle, friendly pediatric dental care for children of all ages.
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-a4" data-i18n="question_4">
                                        What are my options for replacing missing teeth?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a4" data-i18n="question_answer_4">
                                        We offer dental implants, bridges, and dentures depending on your needs and preferences.
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-a5" data-i18n="question_5">
                                         Is teeth whitening safe?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a5" data-i18n="question_answer_5">
                                        Yes, when performed by a dental professional, teeth whitening is safe and effective with long-lasting results.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

            <section aria-label="section" class="p-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="d-block hover popup-youtube" href="https://www.youtube.com/watch?v=C6rf51uHWJg">
                                <div class="relative overflow-hidden">
                                    <div class="absolute start-0 w-100 abs-middle fs-36 text-white text-center z-2">
                                        <div class="player circle wow scaleIn"><span></span></div>
                                    </div>
                                    <div class="absolute w-100 h-100 top-0 bg-dark hover-op-05"></div>
                                    <img src="{{ asset('website/images/background/1.webp')}}" class="w-100 hover-scale-1-1" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-color-op-1">
                <div class="container">
                    <div class="d-flex justify-content-center align-items-center w-50 mx-auto section-heading ">
                        <div class="text-center">
                            <div class="subtitle wow fadeInUp mb-3" data-i18n="testimonials">Testimonials</div>
                            <h2 class="wow fadeInUp" data-wow-delay=".2s" data-i18n="testimonials_title">Our Happy Customers</h2>
                            <p class="wow fadeInUp" data-i18n="testimonials_description">Join thousands of happy patients who trust us for gentle, expert care and beautiful smiles. Your perfect dental experience starts here!</p>
                            <div class="spacer-single"></div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="owl-carousel owl-theme wow fadeInUp four-cols-center-dots text-center">
                            <div class="item">
                                <div class="gradient-white-top p-40 py-4 rounded-1">
                                    <blockquote>
                                        <!-- <i class="fs-32 absolute start-0 mt-2 p-0 id-color fa-solid fa-quote-left"></i> -->
                                        <div class="de_testi_by">
                                            <img class="circle" alt="" src="{{ asset('website/images/testimonial/1.webp')}}">
                                            <div>Michael S.<span>Customer</span></div>
                                        </div>
                                        <p class="mt-4 mb-0 text-dark op-6">"I’ve always been nervous about dental
                                            visits, but the staff made me feel completely comfortable. Their gentle care
                                            and attention to detail truly stand out."
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gradient-white-top p-40 py-4 rounded-1">
                                    <blockquote>
                                        <!-- <i class="fs-32 absolute start-0 mt-2 p-0 id-color fa-solid fa-quote-left"></i> -->
                                        <div class="de_testi_by">
                                            <img class="circle" alt="" src="{{ asset('website/images/testimonial/2.webp')}}">
                                            <div>Robert L.<span>Customer</span></div>
                                        </div>
                                        <p class="mt-4 mb-0 text-dark op-6">"My family and I have been coming here for
                                            years. The service is exceptional, and the team always goes the extra mile
                                            to make sure we’re happy and well taken care of."</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gradient-white-top p-40 py-4 rounded-1">
                                    <blockquote>
                                        <!-- <i class="fs-32 absolute start-0 mt-2 p-0 id-color fa-solid fa-quote-left"></i> -->
                                        <div class="de_testi_by">
                                            <img class="circle" alt="" src="{{ asset('website/images/testimonial/3.webp')}}">
                                            <div>Jake M.<span>Customer</span></div>
                                        </div>
                                        <p class="mt-4 mb-0 text-dark op-6">"I came in for a whitening treatment and
                                            left with a brand new level of confidence. The results were amazing, and the
                                            staff made it such a relaxing experience."</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gradient-white-top p-40 py-4 rounded-1">
                                    <blockquote>
                                        <!-- <i class="fs-32 absolute start-0 mt-2 p-0 id-color fa-solid fa-quote-left"></i> -->
                                        <div class="de_testi_by">
                                            <img class="circle" alt="" src="{{ asset('website/images/testimonial/4.webp')}}">
                                            <div>Alex P.<span>Customer</span></div>
                                        </div>
                                        <p class="mt-4 mb-0 text-dark op-6">"They’re professional, friendly, and
                                            genuinely care about your dental health. I trust them completely and
                                            recommend them to anyone looking for great care."</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gradient-white-top p-40 py-4 rounded-1">
                                    <blockquote>
                                        <!-- <i class="fs-32 absolute start-0 mt-2 p-0 id-color fa-solid fa-quote-left"></i> -->
                                        <div class="de_testi_by">
                                            <img class="circle" alt="" src="{{ asset('website/images/testimonial/5.webp')}}">
                                            <div>Carlos R.<span>Customer</span></div>
                                        </div>
                                        <p class="mt-4 mb-0 text-dark op-6">"Hands down the best dental experience I’ve
                                            ever had. Everything from scheduling to treatment was smooth, comfortable,
                                            and handled with a personal touch."</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gradient-white-top p-40 py-4 rounded-1">
                                    <blockquote>
                                        <!-- <i class="fs-32 absolute start-0 mt-2 p-0 id-color fa-solid fa-quote-left"></i> -->
                                        <div class="de_testi_by">
                                            <img class="circle" alt="" src="{{ asset('website/images/testimonial/6.webp')}}">
                                            <div>Edward B.<span>Customer</span></div>
                                        </div>
                                        <p class="mt-4 mb-0 text-dark op-6">"I’ve never felt more comfortable at a
                                            dentist’s office. The team is so kind, professional, and thorough. They
                                            always explain everything in detail, and I leave with a smile every time!"
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gradient-white-top p-40 py-4 rounded-1">
                                    <blockquote>
                                        <!-- <i class="fs-32 absolute start-0 mt-2 p-0 id-color fa-solid fa-quote-left"></i> -->
                                        <div class="de_testi_by">
                                            <img class="circle" alt="" src="{{ asset('website/images/testimonial/7.webp')}}">
                                            <div>Daniel H.<span>Customer</span></div>
                                        </div>
                                        <p class="mt-4 mb-0 text-dark op-6">
                                            "My experience here has been wonderful! The
                                            staff is friendly, the office is spotless, and the care is top-notch. I
                                            always feel relaxed, and my teeth have never looked better!"
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gradient-white-top p-40 py-4 rounded-1">
                                    <blockquote>
                                        <!-- <i class="fs-32 absolute start-0 mt-2 p-0 id-color fa-solid fa-quote-left"></i> -->
                                        <div class="de_testi_by">
                                            <img class="circle" alt="" src="{{ asset('website/images/testimonial/8.webp')}}">
                                            <div>Bryan G.<span>Customer</span></div>
                                        </div>
                                        <p class="mt-4 mb-0 text-dark op-6">"From the moment I walked in, I felt at
                                            ease. The staff made me feel like family, and the care I received was
                                            exceptional. I’m so happy with my smile—thank you for everything!"</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- content end -->

        <!-- footer begin -->
        <footer class="section-dark">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-4 col-sm-6">
                        <img src="{{ asset('website/images/logo-white.webp')}}" class="logo-footer" alt="">
                        <div class="spacer-20"></div>
                        <p data-i18n="logo_description">At Dentia, we’re dedicated to providing high-quality, personalized dental care for patients of all ages. Our skilled team uses the latest technology to ensure comfortable, efficient treatments and beautiful, healthy smiles for life.</p>

                        <div class="social-icons mb-sm-30">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5 data-i18n="company">Company</h5>
                                    <ul>
                                        <li><a href="{{ route('home') }}" data-i18n="home">Home</a></li>
                                        <li><a href="{{ route('services') }}" data-i18n="our_service">Our Services</a></li>
                                        <li><a href="{{ route('pages.gallery') }}" data-i18n="gallery">Gallery</a></li>
                                        <li><a href="{{ route('pages.about') }}" data-i18n="about_us">About Us</a></li>
                                        <li><a href="{{ route('blog') }}" data-i18n="blog">Blog</a></li>
                                        <li><a href="{{ route('contact') }}" data-i18n="contact">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5 data-i18n="our_service">Our Services</h5>
                                    <ul>
                                        {{--  <li><a href="{{ route('services.general') }}" data-i18n="general">General Dentistry</a></li>  --}}
                                        <li><a href="{{ route('services.cosmetic') }}" data-i18n="cosmetic">Cosmetic Dentistry</a></li>
                                        <li><a href="{{ route('services.pediatric') }}" data-i18n="pediatric">Pediatric Dentistry</a></li>
                                        <li><a href="{{ route('services.restorative') }}" data-i18n="restorative">Restorative Dentistry</a></li>
                                        <li><a href="{{ route('services.preventive') }}" data-i18n="preventive">Preventive Dentistry</a></li>
                                        <li><a href="{{ route('services.orthodontics') }}" data-i18n="orthodontics">Orthodontics</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 order-lg-2 order-sm-1">
                        <div class="widget">
                            <h5 data-i18n="contact_us">Contact Us</h5>
                            <div class="fw-bold text-white" data-i18n="clinic_location"><i class="icofont-location-pin me-2 id-color"></i>Clinic Location</div>
                            100 S Main St, New York, NY

                            <div class="spacer-20"></div>

                            <div class="fw-bold text-white" data-i18n="call_us"><i class="fa-solid fa-phone me-2 id-color"></i>Call Us</div>
                            +1 123 456 789

                            <div class="spacer-20"></div>

                            <div class="fw-bold text-white" data-i18n="send_message"><i class="me-2 fa-solid fa-envelope me-2 id-color"></i>Send
                                a Message</div>
                            <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="593a36372d383a2d193d3c372d30383a382b3c773a3634">[email&#160;protected]</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-flex">
                                <div class="de-flex-col">
                                    Copyright 2025 - Dentia by Designesia
                                </div>
                                <ul class="menu-simple">
                                    <li><a href="#">Terms &amp; Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer end -->
    </div>

    <!-- overlay content begin -->
    <div id="extra-wrap" class="text-light">
        <div id="btn-close">
            <span></span>
            <span></span>
        </div>

        <div id="extra-content">
            <img src="{{ asset('website/images/logo-white.webp')}}" class="w-150px" alt="">

            <div class="spacer-30-line"></div>

            <h5>Our Services</h5>
            <ul class="ul-check">
                <li><a href="{{ route('services.general') }}">General Dentistry</a></li>
                <li><a href="{{ route('services.cosmetic') }}">Cosmetic Dentistry</a></li>
                <li><a href="{{ route('services.pediatric') }}">Pediatric Dentistry</a></li>
                <li><a href="{{ route('services.restorative') }}">Restorative Dentistry</a></li>
                <li><a href="{{ route('services.preventive') }}">Preventive Dentistry</a></li>
                <li><a href="{{ route('services.orthodontics') }}">Orthodontics</a></li>
            </ul>

            <div class="spacer-30-line"></div>

            <h5>Contact Us</h5>
            <div><i class="fa-solid fa-clock me-2 op-5"></i>Monday - Friday 08.00 - 18.00</div>
            <div><i class="fa-solid fa-location-dot me-2 op-5 fa-solid fa-location-dot"></i>100 S Main St, New York,
            </div>
            <div><i class="fa-solid fa-envelope me-2 op-5"></i><a href="/cdn-cgi/l/email-protection"
                    class="__cf_email__"
                    data-cfemail="e0838f8e94818394a084858e94898183819285ce838f8d">[email&#160;protected]</a> </div>

            <div class="spacer-30-line"></div>

            <h5>About Us</h5>
            <p>At Dentia, we’re dedicated to providing high-quality, personalized dental care for patients of all ages.
                Our skilled team uses the latest technology to ensure comfortable, efficient treatments and beautiful,
                healthy smiles for life.</p>

            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <div id="what-up" class="show-on-scroll">
        <a href="https://wa.me/966547574741?text=." target="_blank">
            <span>
                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="38" height="38" fill="none" viewBox="0 0 24 24">
                    <path fill="#fff" fill-rule="evenodd"
                        d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"
                        clip-rule="evenodd" />
                    <path fill="#fff"
                        d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                </svg>
            </span>
        </a>
    </div>

    <!-- Floating Offer Button -->
    <div id="offer-btn" class="show-on-scroll">
        <a href="#" onclick="openOfferPopup(); return false;" title="Offer">
            <span class="offer-text" data-i18n="offer">العروض</span>
        </a>
    </div>

    <!-- Offer Popup Modal -->
    <div class="modal fade" id="offerModal" tabindex="-1" aria-labelledby="offerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="offerModalLabel" data-i18n="book_your_appointment">Schedule an Offer</h5>
                    <button type="button" class="btn-close btn-close-white" style="margin: 0;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="offerForm" id="offerForm" method="POST" action="{{ route('guest.offer') }}">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <h3 class="mb-3"  data-i18n="book_your_appointment"><i class="fa-solid fa-envelope id-color me-2"></i> Book Your Appointment</h3>
                                <!-- Offer -->
                                <p  data-i18n="book_your_appointment_description">Book your appointment today for expert dental care tailored to your needs. Healthy, beautiful smiles start with a simple step, schedule now!</p>
                                <div class="relative">
                                    {{--  <select name="offer_id" id="service" class="form-control" required >
                                        <option disabled selected value data-i18n="select_offer">Select Offer</option>
                                        <option value="General Dentistry">General Dentistry</option>
                                        <option value="Cosmetic Dentistry">Cosmetic Dentistry</option>
                                        <option value="Pediatric Dentistry">Pediatric Dentistry</option>
                                        <option value="Restorative Dentistry">Restorative Dentistry</option>
                                        <option value="Preventive Dentistry">Preventive Dentistry</option>
                                        <option value="Orthodontics">Orthodontics</option>
                                        {{--  @foreach ($offers as $offer )
                                            <option value="{{ $offer->id }}">{{ $offer->title }}</option>
                                        @endforeach

                                    </select>  --}}
                                    <select name="offer_id" id="service" class="form-control" required>
                                        <option disabled selected value>{{ __('Select Offer') }}</option>
                                        @foreach ($offers as $offer)
                                            <option value="{{ $offer['id'] }}">
                                                {{ app()->getLocale() === 'ar' ? ($offer['title_ar'] ?: $offer['title_en'] ) : ($offer['title_en'] ) }}
                                            </option>
                                        @endforeach
                                    </select>


                                    <i class="absolute top-0 id-color pt-3 pe-3 fa-solid fa-angle-down"></i>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div id="date" class="relative input-group date" data-date-format="mm-dd-yyyy">
                                    <i class="absolute top-0 end-0 id-color pt-3 pe-3 icofont-calendar"></i>
                                    <input class="form-control" data-i18n="select_date"style="font-size: large;" placeholder="Select Date" value="" name="date" type="text" id="appointmentDate" required>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <select name="country" id="country" class="form-control" required>
                                    <option disabled selected value>Select Country</option>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <select name="region" id="region" class="form-control" required>
                                    <option disabled selected value>Select Region</option>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <div class="relative">
                                    <select name="time" id="time" class="form-control" required >
                                        <option disabled selected value data-i18n="select_time">Select Time</option>
                                        {{--  <option value="10:00">10:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="12:00">12:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:00">16:00</option>
                                        <option value="17:00">17:00</option>
                                        <option value="18:00">18:00</option>
                                        <option value="19:00">19:00</option>
                                        <option value="20:00">20:00</option>  --}}
                                    </select>
                                    <i class="absolute top-0 id-color pt-3 pe-3 fa-solid fa-angle-down"></i>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <input type="text" name="name" id="name" data-i18n="name" placeholder="Name" class="form-control" required>
                            </div>

                            <div class="col-lg-6">
                                <input type="text" name="phone" id="phone" data-i18n="phone" placeholder="Phone" class="form-control" required>
                            </div>

                            <div class="col-lg-6">
                                <select name="branch_id" id="branch" class="form-control" >
                                    <option disabled selected value>Select Branch</option>
                                </select>
                            </div>

                            <div class="col-lg-12">
                                <textarea name="message" id="message" data-i18n="message" class="form-control" placeholder="Message"></textarea>
                            </div>

                            <div class="text-end">
                                <!-- Cancel button -->
                                <!-- <button type="button" class="btn btn-secondary me-2" data-i18n="cancel" data-bs-dismiss="modal">Cancel</button> -->

                                <!-- <button type="button" class="btn-secondary fx-slide btn-line" data-bs-dismiss="modal">
                                    <span data-i18n="cancel">Cancel</span>
                                </button> -->

                                <!-- Submit button -->
                                <button class="btn-main fx-slide btn-line"  type="submit" >
                                    <span data-i18n="submit"></span>
                                </button>
                            </div>
                        </div>

                        <div id="error_message" class="error">
                            Sorry there was an error sending your form.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="{{ asset('website/js/plugins.js')}}"></script>
    <script src="{{ asset('website/js/designesia.js')}}"></script>
    <script src="{{ asset('website/js/swiper.js')}}"></script>
    <script src="{{ asset('website/js/custom-swiper-1.js')}}"></script>
    <script src="{{ asset('website/js/custom-marquee.js')}}"></script>
    <script src="{{ asset('website/js/script.js')}}"></script>
    <script src="{{ asset('website/js/validation-booking.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scroll Styling -->

    <script>

    const timeSelect = document.getElementById('time');
    const dateInput  = document.getElementById('appointmentDate');

    const workingDays       = @json($workingDays);
    const extraWorkingDates = @json($extraWorkingDates);
    const holidayDates      = @json($holidayDates);

    function loadAvailableTimes(selectedDate) {
        timeSelect.innerHTML = '<option disabled selected value>Select Time</option>';

        $.ajax({
            url: '{{ route('available.times') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                date: selectedDate   // always Y-m-d format from flatpickr
            },
            success: function (response) {
                if (response.times && response.times.length > 0) {
                    response.times.forEach(slot => {
                        const opt = document.createElement('option');
                        opt.value = slot.time;
                        opt.textContent = slot.disabled ? slot.time + ' (Full)' : slot.time;
                        if (slot.disabled) opt.disabled = true;
                        timeSelect.appendChild(opt);
                    });
                } else {
                    const opt = document.createElement('option');
                    opt.textContent = 'No available hours';
                    opt.disabled = true;
                    timeSelect.appendChild(opt);
                }
            },
            error: function (xhr) {
                console.error('Available times error:', xhr.status, xhr.responseText);
                const opt = document.createElement('option');
                opt.textContent = 'Error loading hours';
                opt.disabled = true;
                timeSelect.appendChild(opt);
            }
        });
    }

    flatpickr("#appointmentDate", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",      // actual value sent to server
        minDate: "today",
        maxDate: new Date().fp_incr(30),
        disable: [
            function(date) {
                const jsDay    = date.getDay();
                const dayIso   = jsDay === 0 ? 7 : jsDay;
                const formatted = date.toLocaleDateString('en-CA');

                if (holidayDates.includes(formatted))      return true;
                if (extraWorkingDates.includes(formatted)) return false;
                return !workingDays.includes(dayIso);
            }
        ],
        // ✅ Use flatpickr's own callback — dateStr is always Y-m-d
        onChange: function(selectedDates, dateStr) {
            if (dateStr) {
                loadAvailableTimes(dateStr);
            }
        }
    });

    // ❌ Remove the old dateInput.addEventListener('change', ...) block entirely

        document.addEventListener('DOMContentLoaded', function () {
            <!-- datepicker begin -->

            {{--  flatpickr("#date input.form-control", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                minDate: "today"
            });  --}}

            <!-- datepicker close -->

            // countries, regions, branches, and offers
            const countrySelect = document.getElementById('country');
            const regionSelect = document.getElementById('region');
            const branchSelect = document.getElementById('branch');
            const offerSelect = document.getElementById('service');

            const countriesData = @json($countries);
            const offersData = @json($offers);

            let language = document.documentElement.lang || 'en';

            // --- Populate offers ---
            function populateOffers() {
                offerSelect.innerHTML = '<option disabled selected value>' +
                    (language === 'ar' ? 'اختر العرض' : 'Select Offer') + '</option>';
                offersData.forEach(offer => {
                    const opt = document.createElement('option');
                    opt.value = offer.id;
                    // ✅ Use title_ar or title_en based on current language
                    opt.textContent = language === 'ar'
                        ? (offer.title_ar || offer.title_en)
                        : offer.title_en;
                    offerSelect.appendChild(opt);
                });
            }

            // --- Populate countries ---
            function populateCountries() {
                countrySelect.innerHTML = '<option disabled selected value>' +
                    (language === 'ar' ? 'اختر الدولة' : 'Select Country') + '</option>';
                countriesData.forEach(country => {
                    const opt = document.createElement('option');
                    opt.value = country.id;
                    opt.textContent = language === 'ar' ? country.name_ar : country.name_en;
                    countrySelect.appendChild(opt);
                });
            }

            // --- Populate regions when a country is chosen ---
            function populateRegions(countryId) {
                regionSelect.innerHTML = '<option disabled selected value>' +
                    (language === 'ar' ? 'اختر المنطقة' : 'Select Region') + '</option>';
                branchSelect.innerHTML = '<option disabled selected value>' +
                    (language === 'ar' ? 'اختر الفرع' : 'Select Branch') + '</option>';
                const country = countriesData.find(c => c.id == countryId);
                if (country && country.regions) {
                    country.regions.forEach(region => {
                        const opt = document.createElement('option');
                        opt.value = region.id;
                        opt.textContent = language === 'ar' ? region.name_ar : region.name_en;
                        regionSelect.appendChild(opt);
                    });
                }
            }

            // --- Populate branches when a region is chosen ---
            function populateBranches(regionId) {
                branchSelect.innerHTML = '<option disabled selected value>' +
                    (language === 'ar' ? 'اختر الفرع' : 'Select Branch') + '</option>';
                countriesData.forEach(country => {
                    country.regions.forEach(region => {
                        if (region.id == regionId && region.branches) {
                            region.branches.forEach(branch => {
                                const opt = document.createElement('option');
                                opt.value = branch.id;
                                opt.textContent = branch.name;
                                branchSelect.appendChild(opt);
                            });
                        }
                    });
                });
            }

            // --- Listen to selections ---
            countrySelect.addEventListener('change', e => populateRegions(e.target.value));
            regionSelect.addEventListener('change', e => populateBranches(e.target.value));

            // --- Initialize data ---
            populateOffers();
            populateCountries();

            // --- Detect language change dynamically (for live language switchers) ---
            const observer = new MutationObserver(() => {
                const newLang = document.documentElement.lang;
                if (newLang !== language) {
                    language = newLang;
                    populateOffers();
                    populateCountries();
                    regionSelect.innerHTML = '<option disabled selected value>' +
                        (language === 'ar' ? 'اختر المنطقة' : 'Select Region') + '</option>';
                    branchSelect.innerHTML = '<option disabled selected value>' +
                        (language === 'ar' ? 'اختر الفرع' : 'Select Branch') + '</option>';
                }
            });

            observer.observe(document.documentElement, { attributes: true, attributeFilter: ['lang'] });
        });

    </script>


    <script>
        function updateOfferCards(lang) {
            document.querySelectorAll('.offer-card').forEach(function (card) {
                var title       = card.getAttribute('data-title-' + lang)
                            || card.getAttribute('data-title-en');
                var description = card.getAttribute('data-description-' + lang)
                            || card.getAttribute('data-description-en');

                // Truncate description to ~100 chars
                if (description && description.length > 100) {
                    description = description.substring(0, 100) + '...';
                }

                var titleEl = card.querySelector('.offer-title');
                var descEl  = card.querySelector('.offer-description');

                if (titleEl) titleEl.textContent = title;
                if (descEl)  descEl.textContent  = description;
            });
        }

        // Run on page load with current language
        document.addEventListener('DOMContentLoaded', function () {
            var lang = document.documentElement.lang || 'en';
            updateOfferCards(lang);

            // Watch for language changes
            var offerLangObserver = new MutationObserver(function () {
                var newLang = document.documentElement.lang || 'en';
                updateOfferCards(newLang);
            });
            offerLangObserver.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['lang']
            });
        });
        // validate phone number if phone registerd many time and make subnit button is disabled
        // Make language global
        let language = document.documentElement.lang || 'en';

        // Validation messages
        const validationMessages = {
            duplicatePhone: language === 'ar'
                ? 'لقد قمت بالفعل بالحجز باستخدام رقم الهاتف هذا.'
                : 'You have already placed an order using this phone number.',
            invalidPhone: language === 'ar'
                ? 'رقم الهاتف يجب أن يكون 11 رقمًا ويبدأ بـ 010 أو 011 أو 012 أو 015.'
                : 'Phone number must be 11 digits and start with 010, 011, 012, or 015.'
        };

        // Observe language changes
        const observer = new MutationObserver(() => {
            const newLang = document.documentElement.lang;
            if (newLang !== language) {
                language = newLang;

                // Update validation messages when language changes
                validationMessages.duplicatePhone = language === 'ar'
                    ? 'لقد قمت بالفعل بالحجز باستخدام رقم الهاتف هذا.'
                    : 'You have already placed an order using this phone number.';
                validationMessages.invalidPhone = language === 'ar'
                    ? 'رقم الهاتف يجب أن يكون 11 رقمًا ويبدأ بـ 010 أو 011 أو 012 أو 015.'
                    : 'Phone number must be 11 digits and start with 010, 011, 012, or 015.';
            }
        });

        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['lang'] });

        $(document).ready(function () {
        // ── Owl Carousel — RTL based on page language ─────────────────────────
        const isRtl = document.documentElement.lang === 'ar';

        // Destroy all existing instances first
        $(".owl-carousel").trigger('destroy.owl.carousel').removeClass('owl-loaded owl-drag');
        $(".owl-carousel").find('.owl-stage-outer').children().unwrap();

        // Offers carousel
        $(".offers-carousel").owlCarousel({
            loop: true,
            margin: 25,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            rtl: isRtl,          // ✅ true for Arabic → slides right to left
            smartSpeed: 800,
            dots: true,
            nav: false,
            responsive: {
                0:    { items: 1 },
                768:  { items: 2 },
                1200: { items: 3 }
            }
        });

        // Testimonials carousel
        $(".owl-carousel:not(.offers-carousel)").owlCarousel({
            loop: true,
            margin: 25,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            rtl: isRtl,          // ✅ same — RTL for Arabic
            smartSpeed: 800,
            dots: true,
            nav: false,
            responsive: {
                0:    { items: 1 },
                768:  { items: 2 },
                1200: { items: 3 }
            }
        });

            const phoneInput = $('#phone');
            const submitBtn = $('#offerForm button[type="submit"]');
            const phoneError = $('<div id="phone-error" style="color:red; font-size:0.9em; margin-top:5px;"></div>');
            phoneInput.after(phoneError);

            let lastCheckedPhone = '';

            phoneInput.on('input', function () {
                const phone = $(this).val().trim();

                // Reset error message & enable button by default
                phoneError.text('');
                submitBtn.prop('disabled', false);

                // Check local phone format first
                const phoneRegex = /^(010|011|012|015)\d{8}$/;

                if (!phoneRegex.test(phone)) {
                    phoneError.text(validationMessages.invalidPhone);
                    submitBtn.prop('disabled', true);
                    return;
                }

                // Skip if same phone as before
                if (phone === lastCheckedPhone) return;
                lastCheckedPhone = phone;

                // AJAX check for duplicate phone
                $.ajax({
                    url: '{{ route('guest.offer.checkPhone') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        phone: phone
                    },
                    success: function (response) {
                        if (response.exists) {
                            phoneError.text(validationMessages.duplicatePhone);
                            submitBtn.prop('disabled', true);
                        } else {
                            phoneError.text('');
                            submitBtn.prop('disabled', false);
                        }
                    },
                    error: function () {
                        phoneError.text('{{ __("Error checking phone number") }}');
                        submitBtn.prop('disabled', false);
                    }
                });
            });
        });

        // Open popup when button clicked
        function openOfferPopup(offerId) {
            // Open the modal
            var modal = new bootstrap.Modal(document.getElementById('offerModal'));
            modal.show();

            // Pre-select the offer in the dropdown
            if (offerId) {
                // Wait for modal to be shown before setting value
                document.getElementById('offerModal').addEventListener('shown.bs.modal', function onShown() {
                    var select = document.getElementById('service');
                    if (select) {
                        select.value = offerId;
                    }
                    // Remove listener after first run so it doesn't keep firing
                    document.getElementById('offerModal').removeEventListener('shown.bs.modal', onShown);
                });

                // Also try setting immediately in case modal is already open
                var select = document.getElementById('service');
                if (select) {
                    select.value = offerId;
                }
            }
        }

        $('#offerForm').submit(function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();
            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    form[0].reset();
                    $('#offerModal').modal('hide');
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    let message = '';

                    if (errors) {
                        message = Object.values(errors).flat().join('<br>');
                    } else {
                        message = xhr.responseJSON?.message || 'Something went wrong';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("Error") }}',
                        html: message
                    });
                }
            });
        });

    </script>
</body>

</html>
