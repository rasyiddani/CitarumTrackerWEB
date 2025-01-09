@if (session()->has('success'))
<div class="contact-info bg-danger mb-3">
    <p class="mb-0 text-center text-white"> {{ session('success') }}</p>
</div>
@endif