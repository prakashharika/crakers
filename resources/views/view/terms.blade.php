@extends('layouts.main')

@section('content')
<style>
    

    

    .terms-conditions {
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin: 20px auto;
        max-width: 100%;
    }

    .terms-conditions h1,
    .terms-conditions h2,
    .terms-conditions h3 {
        color: #333;
    }

    .terms-conditions p,
    .terms-conditions ul li {
        line-height: 1.6;
        color: #555;
    }

    ul {
        padding-left: 1.5rem;
    }

    @media (min-width: 768px) {
        .terms-conditions {
            padding: 30px 50px;
            margin: 20px auto;
            max-width: 900px;
        }
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #777;
        padding: 10px;
        background-color: #ffffff;
        border-top: 1px solid #ddd;
    }
</style>
<div class="container-fluid px-3">
    <div class="container-fluid px-3">
        <div class="terms-conditions">
            {!! $terms->content??'' !!}
        </div>
    
    </div>

</div>
@endsection