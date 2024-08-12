<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p>
            @if($setting->first()->footer != null)
                <span>{{ $setting->first()->footer }} </span>
            @endif
            | Design and Development By <a href="https://www.boguraweb.com/" target="_blank">Boguraweb</a>
          </p>
    </div>
</footer>
