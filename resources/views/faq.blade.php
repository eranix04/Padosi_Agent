@extends('layouts.app')

@section('content')
<div class="sub_banner position-relative">
    @include('layouts.header')
<!-- Sub banner -->
    <section class="sub_banner_con position-relative">
        <div class="container position-relative">
            <div class="row">
                <div class="col-xl-8 col-lg-9 col-12 mx-auto">
                    <div class="sub_banner_content" data-aos="fade-up">
                        <h1 class="text-white">Got Questions?<br/> I've Got Your Answers</h1>
                        <p class="text-white text-size-18">Everything you need to know before finding your PadosiAgent</p>                   
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
   <section class="faqpage-con position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="faq_content text-center" data-aos="fade-up">
                    <h6>Faq’s</h6>
                    <h2>Frequently Asked Questions</h2>
                </div>
            </div>
        </div>
        <div class="faq" data-aos="fade-up">
            <div class="accordian-section-inner position-relative">
                <div class="accordian-inner">
                    <div id="faq_accordion1">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="accordion-card">
                                    <div class="card-header" id="headingOne">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            <h4>What exactly does PadosiAgent do for me?</h4>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faq_accordion1">
                                        <div class="card-body">
                                            <p class="text-size-14 text-left mb-0">PadosiAgent helps you find your trusted, IRDAI-licensed insurance PadosiAgent in your neighbourhood. Whether you want to buy a new policy, need help with your claim, or want your existing policies reviewed — we connect you with your verified local PadosiAgent who specializes in your needs.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingTwo">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h4>Is PadosiAgent really free for me? What's the catch?</h4>
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faq_accordion1">
                                        <div class="card-body">
                                            <p class="text-size-14 text-left mb-0">Yes, 100% free for you! There's no catch. We earn a small referral fee from insurance companies when policies are purchased through your PadosiAgent. You never pay anything — not for finding your agent, not for consultations.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingThree">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <h4>Will I get spam calls after using PadosiAgent?</h4>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faq_accordion1">
                                        <div class="card-body">
                                            <p class="text-size-14 text-left mb-0">Absolutely not! Unlike other platforms, we never share your phone number with your PadosiAgent. Only YOU can initiate contact via call or WhatsApp. This means zero spam calls for you — guaranteed.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingFour">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <h4>How do I know if my PadosiAgent is trustworthy?</h4>
                                        </a>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faq_accordion1">
                                        <div class="card-body">
                                            <p class="text-size-14 text-left mb-0">Every PadosiAgent is IRDAI (Insurance Regulatory and Development Authority of India) licensed and background verified. You can also see their customer ratings, reviews, years of experience, and specializations before you connect.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="accordion-card">
                                    <div class="card-header" id="headingFive">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            <h4>How quickly can I get help with my insurance claim?</h4>
                                        </a>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faq_accordion1">
                                        <div class="card-body">
                                            <p class="text-size-14 text-left mb-0">Your claim assistance PadosiAgent typically responds within 2-3 hours. They'll guide you through every step — from filing your paperwork to following up with the insurance company until your claim is settled.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingSix">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            <h4>What documents do I need for my policy review?</h4>
                                        </a>
                                    </div>
                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#faq_accordion1">
                                        <div class="card-body">
                                            <p class="text-size-14 text-left mb-0">Just bring your existing policy documents (health, life, motor, or any other insurance). Your PadosiAgent will review your coverage, identify gaps, check if you're overpaying, and suggest optimizations — all for free.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingSeven">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            <h4>Can I find a PadosiAgent who speaks my language?</h4>
                                        </a>
                                    </div>
                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#faq_accordion1">
                                        <div class="card-body">
                                            <p class="text-size-14 text-left mb-0">Yes! Each PadosiAgent profile shows the languages they speak. You can easily find your PadosiAgent who communicates in Hindi, English, Marathi, Tamil, Telugu, or other regional languages.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingEight">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                            <h4>What if I don't like the PadosiAgent I connected with?</h4>
                                        </a>
                                    </div>
                                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#faq_accordion1">
                                        <div class="card-body">
                                            <p class="text-size-14 text-left mb-0">No problem! You can simply find and connect with another PadosiAgent. You can also leave a review about your experience to help other users make informed choices.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function initHomeSliders() {
        // Destroy existing carousels if they exist to prevent duplication bugs
        $('.owl-carousel').trigger('destroy.owl.carousel'); 

        $('.banner-con .owl-carousel').owlCarousel({
            items: 1,
            margin: 15,
            stagePadding: 0,
            smartSpeed: 450,
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 5000,
            animateOut: 'fadeOut'
        })
        $('.policieslider-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: true
                }
            }
        })

        $('.need-help-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true
                }
            }
        })

        $('.policy-review-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: true
                }
            }
        })

        $('.why-choose-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true
                }
            }
        })

        $('.how-padosi-agent-works-con .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true
                }
            }
        })
    }
    
    // Init on load
    $(document).ready(function(){
        initHomeSliders();
    });

    // Init on HTMX swap (if this page is loaded via AJAX)
    document.addEventListener('htmx:afterSwap', function(evt) {
        // Only init if the sliders are present in the new content
        if(document.querySelector('.banner-con .owl-carousel')) {
            initHomeSliders();
        }
    });
</script>
@endpush
