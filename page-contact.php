<?php get_header(); ?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="<?php echo get_site_url() ?>">Home</a>
                <span class="breadcrumb-item active">Contact</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Contact Start -->
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
            class="bg-secondary pr-3">Contact Us</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                    <div class="control-group">
                        <input type="text" class="form-control" id="name" placeholder="Your Name"
                               required="required" data-validation-required-message="Please enter your name"/>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" id="email" placeholder="Your Email"
                               required="required" data-validation-required-message="Please enter your email"/>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" id="subject" placeholder="Subject"
                               required="required" data-validation-required-message="Please enter a subject"/>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                            <textarea class="form-control" rows="8" id="message" placeholder="Message"
                                      required="required"
                                      data-validation-required-message="Please enter your message"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-30">
                <iframe style="width: 100%; height: 250px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3578.402668468728!2d-80.20047288445966!3d26.248591694681025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d904980177bba7%3A0xacd614169258e134!2s5441%20NW%2015th%20St%2C%20Margate%2C%20FL%2033063!5e0!3m2!1sen!2sus!4v1663343550862!5m2!1sen!2sus"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>5441 NW 15th Street #1 Margate,
                    FL, 33063</p>
                <a href="mailto:nutraflaxproducts@gmail.com">
                    <p class="mb-2">
                        <i class="fa fa-envelope text-primary mr-3"></i>nutraflaxproducts@gmail.com
                    </p>
                </a>
                <a href="tel:866-593-5777">
                    <p class="mb-0">
                        <i class="fa fa-phone-alt text-primary mr-3"></i>866-593-5777
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


<?php get_footer() ?>