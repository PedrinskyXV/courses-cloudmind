<?php include('template/header.php'); ?>

<main>
    <!--? slider Area Start-->
    <section class="slider-area ">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-12">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay="0.2s">Elige,<br> Aprende, <br> Disfruta.
                                </h1>
                                <p data-animation="fadeInLeft" data-delay="0.4s">Desarrolle habilidades con cursos y
                                    certificados sin salir de casa.</p>
                                <a href="#" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Saber
                                    mas</a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5 col-md-12 d-flex align-items-center justify-content-center">
                            <div class="p-5">
                                <div class="text-white" style="font-size: 4em;">
                                    <i class="fab fa-skyatlas"></i>
                                    <span class="text-uppercase font-weight-bold">CloudMind</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ? services-area -->
    <div class="services-area">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="assets/img/icon/icon1.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>20+ Cursos</h3>
                            <p>Enfocado en las diferentes areas del software</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="assets/img/icon/icon2.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Instructores Expertos</h3>
                            <p>Experiencia en empresas de tecnolog??a l??der en mercado del software</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="assets/img/icon/icon3.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Siempre disponible</h3>
                            <p>No importa tu horario los cursos siempre estan disponibles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ? linkedind-api-area -->
    <div class="container">
        <?php
        require_once 'linkedin-api-config.php';
        require_once 'vendor/autoload.php';

        use GuzzleHttp\Client;

        if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "linkdone") {
        ?>
            <div class="alert alert-success my-4" role="alert">
                Ya publicaste en LInkedIn!, revisa tu perfil.
            </div>
            <?php
        }

        if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "linkauth") {
            try {
                //access token
                $client = new Client(['base_uri' => 'https://www.linkedin.com']);
                $response = $client->request('POST', '/oauth/v2/accessToken', [
                    'form_params' => [
                        "grant_type" => "authorization_code",
                        "code" => $_GET['code'],
                        "redirect_uri" => REDIRECT_URL,
                        "client_id" => CLIENT_ID,
                        "client_secret" => CLIENT_SECRET,
                    ],
                ]);
                $data = json_decode($response->getBody()->getContents(), true);
                $access_token = $data['access_token'];
                //user id
                try {
                    $client = new Client(['base_uri' => 'https://api.linkedin.com']);
                    $response = $client->request('GET', '/v2/me', [
                        'headers' => [
                            "Authorization" => "Bearer " . $access_token,
                        ],
                    ]);
                    $data = json_decode($response->getBody()->getContents(), true);
                    $linkedin_profile_id = $data['id']; // store this id somewhere
            ?>
                    <form action="linkedin-api_share.php" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" id="text" name="text" rows="3">Visite la pagina de CloudMind y me gusto!</textarea>
                            <input type="hidden" name="id" value="<?php echo $linkedin_profile_id; ?>">
                            <input type="hidden" name="token" value="<?php echo $access_token; ?>">
                            <button type="submit" class="btn btn-primary my-4">Publicar en LinkedIn</button>
                        </div>
                    </form>
            <?php

                } catch (Exception $e) {
                    //echo $e->getMessage();
                }
            } catch (Exception $e) {
                //echo $e->getMessage();
            }
        } else {
            require_once 'linkedin-api-config.php';
            $url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=" . CLIENT_ID . "&redirect_uri=" . REDIRECT_URL . "&scope=" . SCOPES;
            ?>
            <h3>Para poder compartir en LinkedIn <a href="<?php echo $url; ?>"><u>Ingresa a LinkedIn</u></a></h3>
        <?php
        }
        ?>

    </div>

    <!-- Courses area start -->
    <div class="courses-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Nuestros cursos destacados</h2>
                    </div>
                </div>
            </div>
            <div class="courses-actives">
                <!-- Single -->
                <div class="properties pb-20">
                    <div class="properties__card">
                        <div class="properties__img overlay1">
                            <a href="#"><img src="assets/img/courses/7.png" alt=""></a>
                        </div>
                        <div class="properties__caption">
                            <p>Desarrollo/p>
                            <h3><a href="#">Desarrollo de API'S</a></h3>
                            </p>
                            <div class="properties__footer d-flex justify-content-between align-items-center">
                                <div class="restaurant-name">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p><span>(5)</span> based on 120</p>
                                </div>

                            </div>
                            <a href="#" class="border-btn border-btn2">M??s informaci??n</a>
                        </div>

                    </div>
                </div>
                <!-- Single -->
                <!-- Single -->
                <div class="properties pb-20">
                    <div class="properties__card">
                        <div class="properties__img overlay1">
                            <a href="#"><img src="assets/img/courses/8.png" alt=""></a>
                        </div>
                        <div class="properties__caption">
                            <p>Base de datos</p>
                            <h3><a href="#">Dise??o de base de datos</a></h3>
                            </p>
                            <div class="properties__footer d-flex justify-content-between align-items-center">
                                <div class="restaurant-name">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half"></i>
                                    </div>
                                    <p><span>(4.6)</span> based on 120</p>
                                </div>

                            </div>
                            <a href="#" class="border-btn border-btn2">M??s informaci??n</a>
                        </div>

                    </div>
                </div>
                <!-- Single -->
                <!-- Single -->
                <div class="properties pb-20">
                    <div class="properties__card">
                        <div class="properties__img overlay1">
                            <a href="#"><img src="assets/img/courses/6.png" alt=""></a>
                        </div>
                        <div class="properties__caption">
                            <p>Servidores</p>
                            <h3><a href="#">Configuraci??n de servidores</a></h3>
                            </p>
                            <div class="properties__footer d-flex justify-content-between align-items-center">
                                <div class="restaurant-name">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half"></i>
                                    </div>
                                    <p><span>(4.7)</span> based on 120</p>
                                </div>

                            </div>
                            <a href="#" class="border-btn border-btn2">M??s informaci??n</a>
                        </div>

                    </div>
                </div>
                <!-- Single -->
                <!-- Single -->
                <div class="properties pb-20">
                    <div class="properties__card">
                        <div class="properties__img overlay1">
                            <a href="#"><img src="assets/img/courses/5.png" alt=""></a>
                        </div>
                        <div class="properties__caption">
                            <p>Sistemas</p>
                            <h3><a href="#">Administraci??n de sistemas</a></h3>
                            </p>
                            <div class="properties__footer d-flex justify-content-between align-items-center">
                                <div class="restaurant-name">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half"></i>
                                    </div>
                                    <p><span>(4.4)</span> based on 120</p>
                                </div>

                            </div>
                            <a href="#" class="border-btn border-btn2">M??s informaci??n</a>
                        </div>

                    </div>
                </div>
                <!-- Single -->
                <!-- Single -->
                <div class="properties pb-20">
                    <div class="properties__card">
                        <div class="properties__img overlay1">
                            <a href="#"><img src="assets/img/courses/4.png" alt=""></a>
                        </div>
                        <div class="properties__caption">
                            <p>Dise??o</p>
                            <h3><a href="#">Dise??o Web Responsivo</a></h3>
                            </p>
                            <div class="properties__footer d-flex justify-content-between align-items-center">
                                <div class="restaurant-name">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half"></i>
                                    </div>
                                    <p><span>(4.5)</span> based on 120</p>
                                </div>

                            </div>
                            <a href="#" class="border-btn border-btn2">M??s informaci??n</a>
                        </div>

                    </div>
                </div>
                <!-- Single -->

            </div>
        </div>
    </div>
    <!-- Courses area End -->

    <!--? Last Videos Area Start -->
    <div class="topic-area section-padding40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>??ltimos Videos</h2>
                    </div>
                </div>
            </div>

            <div class="row" id="ultimos-videos">

            </div>
        </div>
    </div>
    <!-- Last Videos End -->

    <!--? About Area-1 Start -->
    <section class="about-area1 fix pt-10">
        <div class="support-wrapper align-items-center">
            <div class="left-content1">
                <div class="about-icon">
                    <img src="assets/img/icon/about.svg" alt="">
                </div>
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-55">
                    <div class="front-text">
                        <h2 class="">Aprende nuevas habilidades en l??nea con los mejores educadores</h2>
                        <p>Nuestros educadores han trabajado por muchos a??os en empresas de tecnolog??a con bastante
                            experiencia en el desarrollo de software.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Todo el contenido imparto es revisado por expertos en el area de ense??anza</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>??nete a millones de personas de todo el mundo aprendiendo juntas.</p>
                    </div>
                </div>

                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>El aprendizaje en l??nea es igual de f??cil y natural que ir a una universidad.</p>
                    </div>
                </div>
            </div>
            <div class="right-content1">
                <!-- img -->
                <div class="right-img">
                    <img src="assets/img/gallery/about.png" alt="">

                    <div class="video-icon">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/9I25jRwCmTg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
    <!--? top subjects Area Start -->
    <div class="topic-area section-padding40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Explora los temas principales</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="assets/img/gallery/topic1.png" alt="">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#">Dise??o</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="assets/img/gallery/topic2.png" alt="">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#">Desarrollo</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="assets/img/gallery/topic3.png" alt="">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#">Informatica y Software</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="assets/img/gallery/topic4.png" alt="">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#">Base de datos</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="assets/img/gallery/topic5.png" alt="">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#">VideoJuegos</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="assets/img/gallery/topic6.png" alt="">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#">Servidores</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="assets/img/gallery/topic7.png" alt="">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#">Sistemas</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="assets/img/gallery/topic8.png" alt="">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#">Arquitectura Software</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section-tittle text-center mt-20">
                            <a href="courses.html" class="border-btn">View More Subjects</a>
                        </div>
                    </div>
                </div> -->
        </div>
    </div>
    <!-- top subjects End -->

    <!--? Team -->
    <section class="team-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Nuestros Instructores</h2>
                    </div>
                </div>
            </div>
            <div class="team-active">
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="assets/img/gallery/team1.png" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Pedro P??rez</a></h5>
                        <p>Ingeniero en Desarrollo de Software.</p>
                    </div>
                </div>
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="assets/img/gallery/team2.png" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Rodrigo Hidalgo</a></h5>
                        <p>Ingeniero en Desarrollo de Software.</p>
                    </div>
                </div>
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="assets/img/gallery/team3.png" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Adilson Arbuez</a></h5>
                        <p>Ingeniero en Desarrollo de Software.</p>
                    </div>
                </div>
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="assets/img/gallery/team4.png" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Guillermo Hern??ndez</a></h5>
                        <p>Ingeniero en Desarrollo de Software.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services End -->
    <!--? About Area-2 Start -->
    <section class="about-area2 fix pb-padding">
        <div class="support-wrapper align-items-center">
            <div class="right-content2">
                <!-- img -->
                <div class="right-img">
                    <img src="assets/img/gallery/about2.png" alt="">
                </div>
            </div>
            <div class="left-content2">
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-20">
                    <div class="front-text">
                        <h2 class="">Da el siguiente paso hacia tus objetivos personales y profesionales con nosotros.
                        </h2>

                        <a href="#" class="btn">Conoce mas</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
</main>
<!-- GetButton.io widget -->
<script type="text/javascript">
    (function() {
        var options = {
            facebook: "104391435555996", // Facebook page ID
            instagram: "cloudd_mindd", // Instagram username
            call_to_action: "Contactanos!!!", // Call to action
            button_color: "#6674FC", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "facebook,instagram", // Order of buttons
        };
        var proto = document.location.protocol,
            host = "getbutton.io",
            url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function() {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    var resPorPagina = 6;
    var key = "AIzaSyD_OrSd1xPBRcwZaUqQ973hBAdvQJrN3vE";
    var idCanal = "UCRqNh4nXqiMywN1-otMZ1gQ";
    var url = "https://www.googleapis.com/youtube/v3/search?key=" + key + "&channelId=" + idCanal +
        "&part=snippet,id&order=date&maxResults=" + resPorPagina;
    $("#contenedor").append(url);
    $.getJSON(url, function(data) {

        for (var k in data.items) {
            var tituloVideo = data.items[k]["snippet"].title;
            var urlVideo = "https://www.youtube.com/watch?v=" + data.items[k]["id"].videoId;
            var fechaVideo = data.items[k]["snippet"].publishedAt;
            var descripcion = data.items[k]["snippet"].description;
            var idVideo = data.items[k]["id"].videoId;

            var div2 = `<div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card">
                    <iframe width="360" height="300" src="https://www.youtube.com/embed/${idVideo}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                      <div class="card-body">
                        <h3 class="card-title"><a href="${urlVideo}">${tituloVideo}</a></h3>                        
                        <p class="card-text">${descripcion}</p>
                      </div>
                    </div>
                </div>`

            $("#ultimos-videos").append(div2);
        }

    });
</script>

<?php include('template/footer.php'); ?>