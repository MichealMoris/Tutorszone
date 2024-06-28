<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div
                    class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 mt-2 ">
                    <div>
                        <a href="/"
                            class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <img src={{ asset('assets/app_logo.png') }} class="img-fluid" style="width: 5rem">
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">
                            <li class="nav-item">
                                <a href={{ url('/en/admin/dashboard') }}
                                    class="nav-link align-middle px-0 text-white text-decoration-none">
                                    <i class="fs-4 bi-person-workspace"></i> <span
                                        class="ms-1 d-none d-sm-inline">Teachers (en)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href={{ url('/en/admin/dashboard/ar') }}
                                    class="nav-link align-middle px-0 text-white text-decoration-none">
                                    <i class="fs-4 bi-person-workspace"></i> <span
                                        class="ms-1 d-none d-sm-inline">Teachers (ar)</span>
                                </a>
                            </li>
                            <li>
                                <a href={{ url('/en/admin/dashboard/contact') }}
                                    class="nav-link px-0 align-middle text-white text-decoration-none">
                                    <i class="fs-4 bi-chat-square-text-fill"></i> <span
                                        class="ms-1 d-none d-sm-inline">Contact Number</span></a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0 align-middle text-white text-decoration-none">
                                    <i class="fs-4 bi-trash3-fill"></i> <span
                                        class="ms-1 d-none d-sm-inline">Trash</span></a>
                            </li>
                            @if (Auth::user()->permission == "superadmin")
                                <li>
                                    <a href={{ url('/en/admin/dashboard/admins') }}
                                        class="nav-link px-0 align-middle text-white text-decoration-none">
                                        <i class="fs-4 bi-person-fill-gear"></i> <span
                                            class="ms-1 d-none d-sm-inline">Admins</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="mt-3">
                        <a href={{url('/en/admin/logout')}} class="btn btn-danger rounded">
                            <i class="fs-6 bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <div class="container-fluid">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-6">
                            <h2>Deleted Teachers</h2>
                        </div>
                        <div class="col-6" style="text-align: end">
                            <form action="{{ url('/en/admin/dashboard/trash/deleteAll') }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none;border:none;">
                                    <strong class="text-danger">Delete All</strong>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        @foreach ($deletedTeachers as $teacher)
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                <div class="card custom-card h-100" style="background: white"
                                    data-id="{{ $teacher['id'] }}">
                                    <div class="card-body">
                                        <img src={{ asset('storage/' . $teacher['teacher_image']) }} class="me-2 img-fluid"
                                            alt={{ $teacher['teacher_name'] }}
                                            style={{ 'padding:5px;width:10rem;height:10rem;object-fit:cover;border-radius:50%;border:2px;border-style:solid;border-color:' . $teacher['teacher_color'] }} />
                                        <h5 class="card-title mt-2" style="margin-bottom:0px;color:#252525;">
                                            {{ $teacher['teacher_name'] }}
                                        </h5>
                                        <h6 class="text-secondary">
                                            @if ($teacher['lang'] == 'en')
                                                {{ $teacher['teacher_country'] == 'uae' ? 'UAE' : ($teacher['teacher_country'] == 'sa' ? 'Saudi Arabia' : 'Both') }}
                                            @else
                                                {{ $teacher['teacher_country'] == 'uae' ? 'الإمارات' : ($teacher['teacher_country'] == 'sa' ? 'السعودية' : 'الدولتين') }}
                                            @endif
                                        </h6>
                                        <h6 style={{ 'margin-top:0px;color:' . $teacher['teacher_color'] }}>
                                            {{ $teacher['teacher_subject'] }}
                                        </h6>
                                        <p>{{ $teacher['teacher_description'] }}</p>
                                        <div class="d-flex">
                                            <form
                                                action="{{ url('/en/admin/dashboard/' . $teacher['id'] . '/' . $teacher['lang']) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bi bi-box-arrow-in-up-right"></i></button>
                                            </form>
                                            <form
                                                action="{{ url('/en/admin/dashboard/delete/' . $teacher['id'] . '/' . $teacher['lang']) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ms-2"><i
                                                        class="bi bi-trash3"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
