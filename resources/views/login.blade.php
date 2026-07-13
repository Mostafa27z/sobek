@extends('layouts.app')

@section('title', 'سوبك ترافيل - تسجيل الدخول لوحة التحكم')

@section('styles')
<style>
    .login-wrapper {
        max-width: 420px;
        margin: 60px auto;
        padding: 0 20px;
    }
    .login-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 24px;
        text-align: center;
        border-bottom: 2px solid var(--border);
        padding-bottom: 12px;
    }
    .form-group {
        margin-bottom: 18px;
    }
    label {
        font-size: 13px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 6px;
        display: block;
    }
    input {
        width: 100%;
        padding: 12px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 13px;
        font-family: inherit;
        background: #fff;
        color: var(--dark);
        transition: border-color 0.25s ease;
    }
    input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0,119,182,0.1);
    }
    .submit-btn {
        width: 100%;
        padding: 14px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.25s ease, transform 0.2s ease;
        margin-top: 10px;
    }
    .submit-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="login-wrapper">
    <div class="card reveal visible">
        <h2 class="login-title">تسجيل الدخول للوحة التحكم</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">البريد الإلكتروني *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="example@domain.com">
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور *</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="submit-btn">دخول</button>
        </form>
    </div>
</div>
@endsection
