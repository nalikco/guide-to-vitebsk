<div>

</div>

@assets
<script src="https://telegram.org/js/telegram-web-app.js"></script>
@endassets

@script
<script>
    let initData = window.Telegram.WebApp.initData;
    if ('{{ config('app.env') }}' === 'local') {
        // Fake init data for testing
        initData = 'auth_date=1712603287&query_id=QoCJwq2LEOltYeZ0&user=%7B%22id%22%3A3453455%2C%22first_name%22%3A%22John%22%2C%22last_name%22%3A%22Doe%22%2C%22username%22%3A%22johndoe%22%2C%22language_code%22%3A%22en%22%2C%22allows_write_to_pm%22%3Atrue%7D&hash=a572c00d30c1407ec9d7357241b1558c6ec5fcc41cffe6484d0efca54423511b';
    }

    $wire.authenticate(initData);
</script>
@endscript
