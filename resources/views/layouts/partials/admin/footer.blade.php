<footer class="main-footer">
    Developed by Infinit Solutions
    <div class="float-right d-none d-sm-inline-block">
        Version <b>1.0.{{ getVersionNumber() }}</b> | Last updated <b>{{ \Carbon\Carbon::parse(getVersionDate())->addHour(-8)->diffForHumans() }}</b>
    </div>
</footer>