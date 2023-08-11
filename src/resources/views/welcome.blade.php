@extends('layouts.lp')

@section('title', 'Graduation Essay')

@section('content')
    <div class="row justify-content-center">
        <h1 class="lp-discription text-center fw-bold mt-4">For the best study</h1>
        <div class="top-img">
            <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/images/18y8MmcecfxD301N8UhDH5UAhGHMyvo23hbfjyo5.jpg" alt="" class="img-lp rounded-3 d-block mx-auto">
        </div>
        <h2 class="lp-heading text-center fw-bold mt-4">Let's record references soon after you read</h2>
        <p class="lp-paragraph text-center mb-4">Have you ever had any trouble managing books you read for your graduation essay? This application can solve all.</p>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-3 lp-items mb-3 pt-3">
                    <i class="fa-solid fa-book d-block text-center lp-icon"></i>
                    <h5 class="lp-heading text-center mt-3">You can <span class="items-text-strong">easily</span> record and manage books you read.</h3>
                    <p class="lp-paragraph text-center">You can record various information about books. It helps you simply manage your references.</p>
                </div>
                <div class="col-sm-3 lp-items mb-3 pt-3">
                    <i class="fa-solid fa-user-pen d-block text-center lp-icon"></i>
                    <h5 class="lp-heading text-center mt-3">You can leave notes when you get some concerns.</h3>
                    <p class="lp-paragraph text-center">You can take notes up to <span class="items-text-strong">1000</span> characters.</p>
                </div>
                <div class="col-sm-3 lp-items mb-3 pt-3">
                    <i class="fa-solid fa-users d-block text-center lp-icon"></i>
                    <h5 class="lp-heading text-center mt-3">You can find interesting books from <span class="items-text-strong">other users</span>.</h3>
                    <p class="lp-paragraph text-center">You can observe books lists of other users. If you find interesting book, let's add it to your favourite list.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-sm-6">
                <h2 class="lp-heading text-center fw-bold mb-3">Creating account is easy. Try to register and then record your references anyway.</h2>
                <div class="text-center">
                    <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#guide">How to use</button>
                </div>
            </div>
            @include('guide')
        </div>
        <div class="lp-footer mt-4">
            <p>© 2023 Yuki Miyano</p>
        </div>
    </div>
@endsection
