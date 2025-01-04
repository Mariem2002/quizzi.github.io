
<?php
$title = 'Quizzi';
ob_start();
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] != null){
    $user = $_SESSION['user'];
}
?>
    <main>

        <section class="hero-section d-flex" id="section_1">
            <div class="hero-container container d-flex flex-column justify-content-end">
                <div class="row h-100">

                    <div class="col-lg-6 col-12 my-auto">
                        <h2>👋 Hi there, Wanna have fun ?</h2>

                        <h1 class="text-white hero-title mb-4">Play some quiz with your friends</h1>



                        <a href="#section_2" class="custom-link custom-btn btn mt-4">Discover More</a>
                    </div>



                </div>
            </div>
        </section>


        <section class="about-section section-padding" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h2 class="section-title"> Test your knowledge</h2>

                            <div class="section-title-bottom">
                                <span class="section-title-line"></span>
                                <i class="section-title-icon bi-book-fill"></i>
                                <span class="section-title-line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="image-hover-thumb" href="app/view/quizView.php">
                            <img src="images/capitals.jpg" class="about-image img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="about-info-wrap d-flex flex-column">
                            <div class="about-info-title d-flex align-items-center my-3">
                                <h4>Geography </h4>

                                <span class="about-tag ms-2"><a href="app/view/quizView.php?idQuiz=1&images=0">Do you know the capitals ?</a></span>
                            </div>

                            <p>Test your knowledge of world capitals in this engaging geography quiz!</p>

                            <div class="social-icon-wrap mt-auto">
                                <ul class="social-icon ms-auto">
                                    <li class="social-icon-item"><a href="#" class="social-icon-link bi-facebook"></a>
                                    </li>

                                    <li class="social-icon-item"><a href="#" class="social-icon-link bi-twitter"></a>
                                    </li>

                                    <li class="social-icon-item"><a href="#" class="social-icon-link bi-instagram"></a>
                                    </li>

                                    <li class="social-icon-item"><a href="#" class="social-icon-link bi-whatsapp"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="image-hover-thumb">
                            <img src="images/arts.jpg" class="about-image img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="about-info-wrap d-flex flex-column">
                            <div class="about-info-title d-flex align-items-center my-3">
                                <h4>Arts </h4>

                                <span class="about-tag ms-2"><a href="app/view/quizView.php?idQuiz=2&images=1">Guess the artist by their work.</a></span>
                            </div>

                            <p>Challenge your artistic eye by identifying the artist behind each masterpiece!</p>
                            <div class="social-icon-wrap mt-auto">
                                <ul class="social-icon ms-auto">
                                    <li class="social-icon-item"><a href="#" class="social-icon-link bi-facebook"></a>
                                    </li>

                                    <li class="social-icon-item"><a href="#" class="social-icon-link bi-twitter"></a>
                                    </li>

                                    <li class="social-icon-item"><a href="#" class="social-icon-link bi-instagram"></a>
                                    </li>

                                    <li class="social-icon-item"><a href="#" class="social-icon-link bi-whatsapp"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="the-wedding-section section-bg section-padding" id="section_3">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h2 class="section-title">Personality tests</h2>

                            <div class="section-title-bottom">
                                <span class="section-title-line"></span>
                                <i class="bi-person-bounding-box" style="color: red;"></i>

                                <span class="section-title-line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 d-flex flex-column mb-4 mb-lg-0 mb-md-0">
                        <div class="image-hover-thumb">
                            <img src="images/adhd.jpeg" class="img-fluid" alt="">
                        </div>

                        <div class="section-block">
                            <h3 class="my-3">Do you have ADHD?</h3>

                            <p>Do you have ADHD, or are you just delightfully chaotic? Take this fun quiz to find out!
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 d-flex flex-column mb-4 mb-lg-0 mb-md-0">
                        <div class="image-hover-thumb">
                            <img src="images/wakeup.webp" class="img-fluid" alt="">
                        </div>

                        <div class="section-block">
                            <h3 class="my-3">What’s your morning wake-up vibe?</h3>

                            <p>Discover your unique wake-up style—chaos, calm, or somewhere in between!</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 d-flex flex-column">
                        <div class="image-hover-thumb">
                            <img src="images/nationality.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="section-block">
                            <h3 class="my-3">What’s Your Nationality Based on Your Looks?</h3>

                            <p>Find out which nationality your appearance matches in this fun quiz!</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="people-section section-padding" id="section_4">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h2 class="section-title">Puzzle Quizzes</h2>

                            <div class="section-title-bottom">
                                <span class="section-title-line"></span>
                                <i class="section-title-icon bi-puzzle-fill"></i>
                                <span class="section-title-line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-5 col-12 me-auto">
                        <nav>
                            <div class="nav nav-tabs flex-lg-column align-items-baseline" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-groomsmen-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-groomsmen" type="button" role="tab"
                                    aria-controls="nav-groomsmen" aria-selected="true">
                                    <h3>Brain Twisters</h3>
                                </button>

                                <button class="nav-link" id="nav-bridesmaid-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-bridesmaid" type="button" role="tab"
                                    aria-controls="nav-bridesmaid" aria-selected="false">
                                    <h3>Eye Teasers</h3>
                                </button>
                            </div>
                        </nav>
                    </div>

                    <div class="col-lg-8 col-md-6 col-12">
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-groomsmen" role="tabpanel"
                                aria-labelledby="nav-groomsmen-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="people-thumb image-hover-thumb">
                                            <img src="images/riddle.jpg" class="people-image img-fluid" alt="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="section-block">
                                            <div class="d-flex align-items-center my-3">
                                                <h4 class="mb-0">Riddle Me This!</h4>


                                            </div>

                                            <p> A quiz full of tricky riddles that’ll make you think twice before
                                                answering.p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="people-thumb image-hover-thumb">
                                            <img src="images/logicalThinking.jpg" class="people-image img-fluid" alt="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="section-block">
                                            <div class="d-flex align-items-center my-3">
                                                <h4 class="mb-0">Mind-Bending Sequences!</h4>

                                            </div>

                                            <p>Solve number or pattern sequences and test your logical thinking!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="nav-bridesmaid" role="tabpanel"
                                aria-labelledby="nav-bridesmaid-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="people-thumb image-hover-thumb">
                                            <img src="images/oddOneOut.png" class="people-image img-fluid" alt="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="section-block">
                                            <div class="d-flex align-items-center my-3">
                                                <h4 class="mb-0">Odd one out
                                                </h4>


                                            </div>

                                            <p>Can you spot the odd one out in this sequence?
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="people-thumb image-hover-thumb">
                                            <img src="images/focus.jpg" class="people-image img-fluid" alt="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="section-block">
                                            <div class="d-flex align-items-center my-3">
                                                <h4 class="mb-0">Focus Finder</h4>


                                            </div>

                                            <p>Test your focus and find the hidden details! </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="gallery-section section-bg section-padding" id="section_5">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h2 class="section-title">Different Quizzes</h2>

                            <div class="section-title-bottom">
                                <span class="section-title-line"></span>
                                <i class="bi-question-circle-fill" style="color: red;"></i>
                                <span class="section-title-line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="gallery-thumb image-hover-thumb">
                            <a href="images/HaarryPotter.jpg" class="popup-image">
                                <img src="images/HaarryPotter.jpg" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12 d-flex flex-column">
                        <div class="gallery-thumb gallery-thumb-small image-hover-thumb">
                            <a href="images/HighStandards.jpg" class="popup-image">
                                <img src="images/HighStandards.jpg" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>

                        <div class="gallery-thumb gallery-thumb-small image-hover-thumb">
                            <a href="images/mentalAge.webp" class="popup-image">
                                <img src="images/mentalAge.webp" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="gallery-thumb image-hover-thumb">
                            <a href="images/personalities9.jpg" class="popup-image">
                                <img src="images/personalities9.jpg" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12 d-flex flex-column">
                        <div class="gallery-thumb gallery-thumb-small image-hover-thumb">
                            <a href="images/pickyEater.jpg" class="popup-image">
                                <img src="images/pickyEater.jpg" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>

                        <div class="gallery-thumb gallery-thumb-small image-hover-thumb">
                            <a href="images/smarterThan5thGrader.jpg" class="popup-image">
                                <img src="images/smarterThan5thGrader.jpg" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="gallery-thumb image-hover-thumb">
                            <a href="images/typesByFood.webp" class="popup-image">
                                <img src="images/typesByFood.webp" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12 d-flex flex-column">
                        <div class="gallery-thumb gallery-thumb-small image-hover-thumb">
                            <a href="images/arts.jpg" class="popup-image">
                                <img src="images/arts.jpg" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>

                        <div class="gallery-thumb gallery-thumb-small image-hover-thumb">
                            <a href="images/capitals.jpg" class="popup-image">
                                <img src="images/capitals.jpg" class="gallery-image img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="rsvp-section section-padding" id="section_6">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="rsvp-form-wrap">
                            <div class="section-title-wrap mb-5">
                                <h2 class="section-title">Feedback</h2>

                                <div class="section-title-bottom">
                                    <span class="section-title-line"></span>
                                    <i class="section-title-icon bi-heart-fill"></i>
                                    <span class="section-title-line"></span>
                                </div>
                            </div>

                            <h5 class="mb-4">Do you have any feedback, suggestions? <span class="text-muted">Your
                                    opinion means so much to us <3</span>
                            </h5>

                            <form action = "app/addFeedback.php" method = "POST" class="custom-form rsvp-form" role="form">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <input type="text" name="full_name" id="name" class="form-control"
                                            placeholder="Full Name*" required="">
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12">
                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                            class="form-control" placeholder="Email Address*" required="">
                                    </div>

                                    <div class="col-lg-4 col-12">
                                        <select name="satisfaction_level" class="form-select" id="guests" aria-label="Guests" required>
                                            <option selected disabled>Satisfaction level</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <textarea class="form-control" id="message" name="message"
                                            placeholder="Message (Optional)" rows="5"></textarea>
                                    </div>

                                    <div class="col-lg-3 col-5 mx-auto">
                                        <button type="submit" class="form-control">Send Feedback</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="contact-section section-bg section-padding" id="section_7">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h2 class="section-title">Get in touch</h2>

                            <div class="section-title-bottom">
                                <span class="section-title-line"></span>
                                <i class="section-title-icon bi-heart-fill"></i>
                                <span class="section-title-line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <h4 class="mb-4">Where are we at?</h4>

                        <p> Sfax,
                            <br> Tunisia
                        </p>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 my-4 my-lg-0 my-md-0">
                        <h4 class="mb-4">Contact Information</h4>

                        <p class="mb-2">
                            <a href="mailto:hello@company.com">
                                hello@company.com
                            </a>
                        </p>

                        <p>
                            <a href="tel: 090-080-0760">
                                090-080-0760
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <h4 class="mb-4">Socials</h4>

                        <ul class="social-icon">
                            <li class="social-icon-item"><a href="#" class="social-icon-link bi-twitter"></a></li>

                            <li class="social-icon-item"><a href="#" class="social-icon-link bi-instagram"></a></li>

                            <li class="social-icon-item"><a href="#" class="social-icon-link bi-whatsapp"></a></li>

                            <li class="social-icon-item"><a href="https://fb.com/tooplate" target="_blank"
                                    class="social-icon-link bi-facebook"></a></li>
                        </ul>

                        <p class="copyright-text mt-3 mb-0">Copyright © 2036 Wedding Lite Co., Ltd.
                            <br> Design: <a href="https://www.tooplate.com" target="_parent">Tooplate</a>
                        </p>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <?php
$content = ob_get_clean();
require_once('app/view/layout.php');
?>
  