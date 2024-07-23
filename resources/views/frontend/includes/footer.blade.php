{{-- <footer class="footer-area footer-bg">
    <div class="container">
        <div class="footer-top pt-100 pb-70">
            <div class="row">

                <div class="col-lg-5 col-sm-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">
                                <?php if (isset($company_logos)) { ?>
                                    @foreach ($company_logos as $company)

                                    <a href="{{route('frontend.index')}}">
                                        <img src="{{asset('').'/'.$company['header']}}" alt="Images" style="width: 216px;"></a>
                                    <p style="margin-bottom:0px; padding-bottom:0px;">&nbsp;</p>
                                    <p style="margin:0 10px; max-width:350px;">{{ $company['description']}}</p>
                                    @endforeach
                                <?php } ?>
                            </a>
                        </div>
                        <p class="social-icon">
                            <a href="#">
                                <i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.linkedin.com/company/skynet-solutionz-pvt-ltd/mycompany/">
                                <i class="fa fa-linkedin-square fa-2x"></i>
                            </a>
                        </p>

                        <div class="footer-call-content">
                            <h3>Talk to Our Support</h3>
                            <span>
                            <a href=""> +92 (301) 8485302 </a>
                                <?php if (isset($contacts)) { ?>
                                    @foreach ($contacts as $contact)
                                    <!-- <a href="{{$contact['phone']}}">{{$contact['phone']}}</a> -->

                                    @endforeach
                                <?php } ?>
                            </span>
                            <i class="bx bx-headphone"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget pl-2">
                        <h3>Services</h3>
                        <ul class="footer-list">
                            <?php if (isset($services_details)) { ?>
                                @foreach ($services_details as $services)
                                <li>
                                    <a href="{{route('frontend.services.detail', $services['page_link'])}}">
                                        <i class="bx bx-chevron-right"></i>

                                        {{$services['name']}}
                                    </a>
                                </li>
                                @endforeach
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact-info_2">

                        <h2>Let's Connect With Us</h2>
                        <br>
                        <ul>
                            <li>
                                <div class="content">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>Phone Number</h3>
                                    <a href="tel:+92 (301) 8485302">+92 (301) 8485302</a>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <i class="bx bxs-map"></i>
                                    <h3>Address</h3>
                                    <span>72, Block N, Model Town, <br> Lahore – Pakistan</span>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <i class="bx bx-message"></i>
                                    <h3>Contact Info</h3>
                                    <a href="mailto:info@skynetsolutionz.com">info@skynetsolutionz.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="copy-right-area">
            <div class="copy-right-text">
                <p>
                    © 2022 Recz. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer> --}}


<footer class="footer-bg">
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="footer_widgth">
                        <h4>legal</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="#">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="footer_widgth">
                        <h4>The Community</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#">Our Brand Partners</a>
                            </li>
                            <li>
                                <a href="#">Partnerships</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="footer_widgth">
                        <h4>About Us</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#">FAQ</a>
                            </li>
                            <li>
                                <a href="#">News</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="footer_widgth">
                        <h4>Social</h4>
                        <ul class="list-unstyled">
                            <li class="social_icon">
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="widgth_app">
                        <h4>Download App</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#"><img src="{{asset('images/ios.png')}}" alt="playstore"></a>
                                <a><img src="{{asset('images/play_store.png')}}" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="copy-right-area">
                    <div class="copy-right-text">
                        <p>
                            © 2024 Recz. All Rights Reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
