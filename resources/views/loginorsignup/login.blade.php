@include('pages.include.header')

<body class="sig-body">

    <div class="container-sig" id="container-sig">
        <div class="form-container-sig sign-up-container-sig">
            <form action="{{url('/addAdminUser')}}" method="POST" class="form">
                @csrf
                <h1 class="sig-h">Create Account</h1>

                <input type="text" name="name" placeholder="User Name" class="signup-input" required>
                <input type="email" name="email" placeholder="Email" class="signup-input" required>
                <input type="password" name="password" placeholder="Password" class="signup-input" required>
                <a href="#" class="sig-a">Forgot your password?</a>
                <button type="submit" class="button-2">Submit</button>
            </form>

        </div>
        <div class="form-container-sig sign-in-container-sig">
            <form action="{{url('/adminUserLogin')}}" method="POST" class="form">
                @csrf
                <h1 class="sig-h">Login</h1>

                <input type="email" name="email" placeholder="Email"
                    class="signup-input {{ $errors->has('email') ? 'input-error' : '' }}" value="{{ old('email') }}">
                @if ($errors->has('email'))
                <p style="color: red;">{{ $errors->first('email') }}</p>
                @endif

                <input type="password" name="password" placeholder="Password"
                    class="signup-input {{ $errors->has('password') ? 'input-error' : '' }}"
                    value="{{ old('password') }}">
                @if ($errors->has('password'))
                <p style="color: red;">{{ $errors->first('password') }}</p>
                @endif

                <button type="submit" class="button-2">Login</button>
            </form>
        </div>
        <div class="overlay-container-sig">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="sig-h">Already Have An Account?</h1>
                    <p class="sig-p">Then Login</p>
                    <button class="ghost" id="signIn" class="button-2">Login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="sig-h">Don't Have An Account?</h1>
                    <p class="sig-p">Create Your Account And Sign In.</p>
                    <button class="ghost" id="signUp">Sign Up </button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p class="sig-p">
            Created by
            <a target="_blank" href="https://tukisoft.com.np/" class="sig-a">Tuki Soft</a>

        </p>
    </footer>
</body>
<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container-sig');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});
</script>