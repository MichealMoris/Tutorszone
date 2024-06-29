<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content={{ __('content.description') }} />
    <title>Tutorszone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
</head>

<body>
    @php
        $message = App::isLocale('ar')
            ? $contacts[0]['message_ar']
            : $contacts[0]['message_en'];
        $whatsappUrl = 'https://wa.me/' . $contacts[0]["phone_number"] . '?text=' . urlencode($message);
    @endphp
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg pt-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <div class="d-flex align-items-end">
                        <img src={{ asset('assets/app_logo.png') }} class='img-fluid' style="width: 8rem" />
                        <span style="color: #aaa;font-size:0.7rem">.{{$country}}</span>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#contactussection">{{ __('content.nav.contactus') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#aboutussection">{{ __('content.aboutus') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#teacherssection">{{ __('content.ourteachers') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('content.language') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ url('en') }}"><x-flag-country-us
                                            style="width: 1.2rem;height:1.2rem;margin-right: 5px;
                                  margin-left: 5px;" />English</a>
                                </li>
                                <li><a class="dropdown-item"href="{{ url('ar') }}"><x-flag-country-sa
                                            style="width: 1.2rem;height:1.2rem;margin-right: 5px;
                                  margin-left: 5px;" />العربية</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <hr />
        <div class="row align-items-center mt-4">
            <div
                class="{{ App::isLocale('ar') ? 'd-xxl-none d-xl-none d-lg-none d-md-none col-sm-12 d-sm-inline animate-slide-from-left' : 'd-xxl-none d-xl-none d-lg-none d-md-none col-sm-12 d-sm-inline animate-slide-from-right' }}">
                <img src="{{ asset('assets/hero_img.jpg') }}" class='img-fluid' />
            </div>
            <div
                class="{{ App::isLocale('ar') ? 'col-md-6 col-sm-12 animate-slide-from-right' : 'col-md-6 col-sm-12 animate-slide-from-left' }}">
                <h1 class="fw-bolder" id="contactussection">
                    <span style="color: #fd5658">{{ __('content.herotext.main') }}</span><br />
                    {{ __('content.herotext.headline') }}
                </h1>
                <p class='lead'>{{ __('content.herotext.text') }}</p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                    class='btn btn-warning p-2 action-btn'>
                    <i class="bi bi-whatsapp me-1 text-white"></i>
                    {{ __('content.herotext.button') }}
                </a>
            </div>
            <div
                class="{{ App::isLocale('ar') ? 'col-md-6 d-md-inline d-none animate-slide-from-left' : 'col-md-6 d-md-inline d-none animate-slide-from-right' }}">
                <img src="{{ asset('assets/hero_img.jpg') }}" class='img-fluid' />
            </div>
        </div>
        <div
            class="{{ App::isLocale('ar') ? 'row mt-5 align-items-center animate-slide-from-right' : 'row mt-5 align-items-center animate-slide-from-left' }}">
            <div class='col-12'>
                <h2 id="aboutussection" class="fw-bolder" style="color: #fd8a56;">{{ __('content.aboutus') }}</h2>
                <p class="lead">{{ __('content.viddesc') }}</p>
            </div>
            <div class="col-12">
                <video id="myVideo" muted controls style="border-radius: 10px; width:-webkit-fill-available;">
                    <source
                        src="{{ App::isLocale('ar') ? asset('assets/aboutusar.mp4') : asset('assets/aboutusen.mp4') }}"
                        type="video/mp4">
                </video>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h2 class="fw-bolder" id="teacherssection" style="color: #2077e7;">{{ __('content.ourteachers') }}</h2>
                <p class="lead">{{ __('content.techdesc') }}</p>
            </div>
            @if (App::isLocale('en'))
                @foreach ($enTeachers as $teacher)
                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                        <div class="card custom-card h-100" style="background: white" data-id="{{ $teacher['id'] }}">
                            <div class="card-body">
                                <img src={{ asset('storage/' . $teacher['teacher_image']) }} class="me-2 img-fluid"
                                    alt={{ $teacher['teacher_name'] }}
                                    style={{ 'padding:5px;width:10rem;height:10rem;object-fit:cover;border-radius:50%;border:2px;border-style:solid;border-color:' . $teacher['teacher_color'] }} />
                                <h5 class="card-title mt-2" style="margin-bottom:0px;color:#252525;">
                                    {{ $teacher['teacher_name'] }}
                                </h5>
                                <h6 style={{ 'margin-top:0px;color:' . $teacher['teacher_color'] }}>
                                    {{ $teacher['teacher_subject'] }}
                                    {{ __('content.teacher') }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($arTeachers as $teacher)
                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                        <div class="card custom-card h-100" style="background: white" data-id="{{ $teacher['id'] }}">
                            <div class="card-body">
                                <img src={{ asset('storage/' . $teacher['teacher_image']) }} class="me-2 img-fluid"
                                    alt={{ $teacher['teacher_name'] }}
                                    style={{ 'padding:5px;width:10rem;height:10rem;object-fit:cover;border-radius:50%;border:2px;border-style:solid;border-color:' . $teacher['teacher_color'] }} />
                                <h5 class="card-title mt-2" style="margin-bottom:0px;color:#252525;">
                                    {{ $teacher['teacher_name'] }}
                                </h5>
                                <h6 style={{ 'margin-top:0px;color:' . $teacher['teacher_color'] }}>
                                    {{ __('content.teacher') }}
                                    {{ $teacher['teacher_subject'] }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" style="padding-top: 2rem;padding-right: 2rem;padding-left: 2rem;">
            <div class="modal-content rounded-top">
                <div class="modal-body">
                    <div class="container-fluid h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-sm-12 col-md-5">
                                <img src="" id="modalImg" class="me-2 img-fluid" alt="teacher_img" />
                            </div>
                            <div class="col-sm-12 col-md-7">
                                @if (App::isLocale('en'))
                                    <div class="d-flex justify-content-between">
                                        <button id="modalPrev" class="btn btn-secondary rounded-circle"
                                            style="width:2.5rem;height:2.5rem;background:lightgrey !important;border-color:lightgray !important;">
                                            <i class="bi bi-arrow-left text-white" style="font-size: 1.2rem"></i>
                                        </button>
                                        <button id="modalNext" class="btn btn-primary rounded-circle"
                                            style="width:2.5rem;height:2.5rem">
                                            <i class="bi bi-arrow-right text-white" style="font-size: 1.2rem"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-between">
                                        <button id="modalNext" class="btn btn-primary rounded-circle"
                                            style="width: 2.5rem;height:2.5rem">
                                            <i class="bi bi-arrow-right text-white" style="font-size: 1.2rem"></i>
                                        </button>
                                        <button id="modalPrev" class="btn btn-secondary rounded-circle"
                                            style="width:2.5rem;height:2.5rem;background:lightgrey !important;border-color:lightgray !important;">
                                            <i class="bi bi-arrow-left text-white" style="font-size: 1.2rem"></i>
                                        </button>
                                    </div>
                                @endif
                                <h1 id="modalTitle"></h1>
                                <h3 id="modalSub"></h3>
                                <p id="modalDescription" class="mt-2"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (App::isLocale('en'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const cards = document.querySelectorAll('.custom-card');
                fetch('/data')
                    .then(response => response.json())
                    .then(data => {
                        let currentIndex = 0;

                        let titleInterval, subInterval, descInterval;

                        const findById = (id) => {
                            return data.find(item => item.id === id);
                        };

                        const typeWriter = (element, text, delay = 50) => {
                            let i = 0;
                            element.innerText = '';
                            clearInterval(element.intervalId); // Clear previous interval if exists
                            element.intervalId = setInterval(() => {
                                if (i <= text
                                    .length) { // Change condition to include whitespace at the end
                                    element.innerText = text.substring(0, i);
                                    i++;
                                } else {
                                    clearInterval(element.intervalId);
                                }
                            }, delay);
                        };

                        const updateModal = (index) => {
                            let cardData = data.enTeachers[index];
                            document.getElementById('modalImg').setAttribute("src",
                                `storage/${cardData.teacher_image}`);
                            document.getElementById('modalImg').setAttribute("style",
                                `padding:5px;width:-webkit-fill-available;height:-webkit-fill-available;object-fit:cover;border-radius:10px`
                            );
                            document.getElementById('modalNext').setAttribute("style",
                                `width: 2.5rem;height:2.5rem;background:${cardData.teacher_color} !important;border-color:${cardData.teacher_color} !important;`
                            );

                            typeWriter(document.getElementById('modalTitle'), cardData.teacher_name, 150);
                            document.getElementById('modalTitle').setAttribute("style",
                                `margin-top:10px;margin-bottom:0px`);

                            typeWriter(document.getElementById('modalSub'),
                                `${cardData.teacher_subject} Teacher`,
                                150);
                            document.getElementById('modalSub').setAttribute("style",
                                `margin-bottom:0px;color:${cardData.teacher_color}`);

                            typeWriter(document.getElementById('modalDescription'), cardData
                                .teacher_description, 15);

                            currentIndex = index;
                        };
                        cards.forEach((card, index) => {
                            card.addEventListener('click', function() {
                                updateModal(index);
                                const modal = new bootstrap.Modal(document.getElementById(
                                    'cardModal'));
                                modal.show();
                            });
                        });

                        document.getElementById('modalPrev').addEventListener('click', function() {
                            if (currentIndex > 0) {
                                updateModal(currentIndex - 1);
                            } else {
                                updateModal(data.enTeachers.length - 1); // Wrap around to the last card
                            }
                        });

                        document.getElementById('modalNext').addEventListener('click', function() {
                            if (currentIndex < data.enTeachers.length - 1) {
                                updateModal(currentIndex + 1);
                            } else {
                                updateModal(0); // Wrap around to the first card
                            }
                        });
                    });
            });
        </script>
    @else
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const cards = document.querySelectorAll('.custom-card');
            fetch('/data')
                .then(response => response.json())
                .then(data => {
                    let currentIndex = 0;

                    let titleInterval, subInterval, descInterval;

                    const findById = (id) => {
                        return data.find(item => item.id === id);
                    };

                    const typeWriter = (element, text, delay = 50) => {
                        let i = 0;
                        element.innerText = '';
                        clearInterval(element.intervalId); // Clear previous interval if exists
                        element.intervalId = setInterval(() => {
                            if (i <= text
                                .length) { // Change condition to include whitespace at the end
                                element.innerText = text.substring(0, i);
                                i++;
                            } else {
                                clearInterval(element.intervalId);
                            }
                        }, delay);
                    };

                    const updateModal = (index) => {
                        let cardData = data.arTeachers[index];
                        document.getElementById('modalImg').setAttribute("src",
                            `storage/${cardData.teacher_image}`);
                        document.getElementById('modalImg').setAttribute("style",
                            `padding:5px;width:-webkit-fill-available;height:-webkit-fill-available;object-fit:cover;border-radius:10px`
                        );
                        document.getElementById('modalNext').setAttribute("style",
                            `width: 2.5rem;height:2.5rem;background:${cardData.teacher_color} !important;border-color:${cardData.teacher_color} !important;`
                        );

                        typeWriter(document.getElementById('modalTitle'), cardData.teacher_name, 150);
                        document.getElementById('modalTitle').setAttribute("style",
                            `margin-top:10px;margin-bottom:0px`);

                        typeWriter(document.getElementById('modalSub'),
                            `معلم ${cardData.teacher_subject}`,
                            150);
                        document.getElementById('modalSub').setAttribute("style",
                            `margin-bottom:0px;color:${cardData.teacher_color}`);

                        typeWriter(document.getElementById('modalDescription'), cardData
                            .teacher_description, 15);

                        currentIndex = index;
                    };
                    cards.forEach((card, index) => {
                        card.addEventListener('click', function() {
                            updateModal(index);
                            const modal = new bootstrap.Modal(document.getElementById(
                                'cardModal'));
                            modal.show();
                        });
                    });

                    document.getElementById('modalPrev').addEventListener('click', function() {
                        if (currentIndex > 0) {
                            updateModal(currentIndex - 1);
                        } else {
                            updateModal(data.enTeachers.length - 1); // Wrap around to the last card
                        }
                    });

                    document.getElementById('modalNext').addEventListener('click', function() {
                        if (currentIndex < data.enTeachers.length - 1) {
                            updateModal(currentIndex + 1);
                        } else {
                            updateModal(0); // Wrap around to the first card
                        }
                    });
                });
        });
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        let options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.7,
        };
        let callback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.target.id == 'myVideo') {
                    if (entry.isIntersecting) {
                        entry.target.play()
                    } else {
                        entry.target.pause()
                    }
                }
            })
        }
        let observer = new IntersectionObserver(callback, options);
        observer.observe(document.querySelector('#myVideo'))
    </script>
</body>

</html>
