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
                                <a href="#" class="nav-link px-0 align-middle text-white text-decoration-none">
                                    <i class="fs-4 bi-chat-square-text-fill"></i> <span
                                        class="ms-1 d-none d-sm-inline">Contact Number</span></a>
                            </li>
                            <li>
                                <a href={{ url('/en/admin/dashboard/trash') }}
                                    class="nav-link px-0 align-middle text-white text-decoration-none">
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
                    <div class="row justify-content-between">
                        <div class="col-12">
                            <h2>Contact Number and Message</h2>
                            @if ($errors->any())
                                <div class="alert alert-danger my-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        @foreach ($contacts as $contact)
                            <div class="col-sm-12 col-md-6 mb-2">
                                <div class="card custom-card h-100" style="background: white">
                                    <div class="card-body">
                                        <h3>{{ $contact['country'] == 'uae' ? '🇦🇪 UAE' : '🇸🇦 Saudi Arabia' }}</h3>
                                        <p>Please, add the number with country code like this <strong class="text-primary">{{$contact['country'] == 'uae' ? '+971' : '+966'}}</strong>123456789 so this feature work appropriately.</p>
                                        <form action={{url('/en/admin/dashboard/contact/'.$contact['id'])}} method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-2">
                                                <label for="phone_number">Phone Number</label>
                                                <input type="tel" class="form-control" name="phone_number" id="phone_number" value={{$contact['phone_number']}}>
                                            </div>
                                            <div class="mb-2">
                                                <label for="messageen">Whatsapp Message (En)</label>
                                                <textarea class="form-control" id="messageen" name="messageen" rows="3">{{$contact['message_en']}}</textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label for="message">Whatsapp Message (Ar)</label>
                                                <textarea class="form-control" id="messagear" name="messagear" rows="3">{{$contact['message_ar']}}</textarea>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Done">
                                        </form>
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
