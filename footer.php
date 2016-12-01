</main> <!-- Content Container -->

<footer  id = "site-footer">
    <div id = "footer-container" class = "group">
        <div class = "footer-column col lg-3 md-12">
            <h3 class = "footer-title"><span class = "light">Snohomish County Volunteer</span><br> <span class = "big">Search and Rescue</span></h3>

            <figure id = "footer-logo">
                <?php $footerLogo = get_field('footer_logo', 'options'); ?>
                <img src = "<?php echo $footerLogo['url']; ?>" alt = "<?php echo $footerLogo['alt']; ?>">
            </figure>

            <a id = "privacy-link" href = "http://sr.ravennainteractive.com/privacy-policy" title = "Privacy Policy">Privacy Policy</a>
        </div>

        <div class = "footer-column col lg-3 md-12">
            <h3 class = "footer-title">Going on a hiking trip?</h3>

            <p>Consider filling out a:</p>

            <a class = "footer-button" href = "http://www.scvsar.org/documents/HikingPlan.pdf" title = "Hiking Plan" target = "_blank" role = "link">Hiking Plan</a>

            <p>Already a member?</p>

            <a class = "footer-button" href = "http://www.scvsar.org/security.asp?pg=index.htm" title = "Member Login" target = "_blank" role = "link">Member Login</a>
        </div>

        <div class = "footer-column col lg-3 md-12">
            <h3 class = "footer-title">Sign-up for our newsletter</h3>

            <!-- Begin MailChimp Signup Form -->
            <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
            <style type="text/css">
                /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                   #mc_embed_signup form {
                       padding: 0;
                   }
                   #mc_embed_signup input {
                       border: none;
                        /* -webkit-border-radius: 10px; */
                        -moz-border-radius: 10px;
                        border-radius: 10px;
                   }
                   #mc-embedded-subscribe {
                       clear: both;
                        width: auto;
                        display: block;
                        margin: 0;
                        border-radius: 0 10px 10px 0 !important;
                   }
            </style>
            <div id="mc_embed_signup" class = "">
            <form action="//scvsar.us13.list-manage.com/subscribe/post?u=e42a2aa256ed8223958f26f9c&amp;id=8e3b94c6ce" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

            <div class="footer-signup-container">
                <input type = "email" class = "footer-signup" name = "EMAIL" placeholder = "ENTER EMAIL..." id="mce-EMAIL">
                <input type="image" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="footer-submit" src = "http://sr.ravennainteractive.com/wp-content/uploads/2016/10/submit.png">
            </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e42a2aa256ed8223958f26f9c_8e3b94c6ce" tabindex="-1" value=""></div>
                </div>
            </form>
            </div>
            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
            <!--End mc_embed_signup-->

            <?php $address = get_field('address', 'options'); $phone = get_field('phone', 'options'); ?>
            <p>
                <span class = "small-text">Mailing Address:</span>
                <span class = "address"><span class = "big-text" style = "font-family:'Teko', sans-serif; font-size:2em;">SCVSAR</span><?php echo $address; ?></span>
                <span class = "small-text">Phone:</span>
                <span class = "phone"><a href = "tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></span>
                <span class = "small-text">Email:</span>
                <span class = "email"><a href = "info@scvsar.org">info@scvsar.org</a></span>
                <span class = "emergency">In an emergency dial 911</span>
            </p>
        </div>

        <div class = "footer-column col lg-3 md-12">
            <h3 class = "footer-title bold small-text">What's happening at SCVSAR?</h3>
            <?php $url = get_field('facebook_url', 'options'); ?>
            <div id="fb-root"></div>
            <div class="fb-page" data-href="<?php echo $url; ?>" data-tabs="timeline" data-height="300px" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo $url; ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $url; ?>">Snohomish County Volunteer Search &amp; Rescue</a></blockquote></div>
        </div>
    </div>
</footer>

<section id = "copyright">
    <p id = "copyright-text">&copy; <i><?php echo date('Y'); ?> SCVSAR. A <a href = "http://www.4thavenuemedia.com/" title = "4th Avenue Media" rel = "nofollow"><strong>4th Avenue Media</strong></a> Production. Developed by <a href = "http://ravennainteractive.com/" title = "Ravenna Intreactive" rel = "nofollow"><strong>Ravenna</strong></a>.</i></p>
</section>

</div> <!-- Site Container -->
</div> <!-- Site Wrapper -->
<?php wp_footer(); ?>
</body>
</html>
