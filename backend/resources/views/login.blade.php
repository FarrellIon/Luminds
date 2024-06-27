<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <form id="loginForm">
            @csrf
            <input type="text" name="email">
            <input type="password" name="password">
            <button type="submit">s</button>
        </form>
    </body>
</html>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the default way

            var form = this;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", '/api/login?level_akun=admin', true);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    // Handle successful response
                } else {
                    console.error('Request failed.  Returned status of ' + xhr.status);
                    // Handle error response
                }
            };

            xhr.send(formData);
        });
</script>