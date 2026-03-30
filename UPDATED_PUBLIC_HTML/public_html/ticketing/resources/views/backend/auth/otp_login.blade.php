<!DOCTYPE html>
<html>

<head>
    <title>OTP Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <h2>OTP Login</h2>

    <div id="otp-container"></div>

    <!-- ✅ Step 1: Define configuration BEFORE loading the script -->
    <script type="text/javascript">
        var configuration = {
            widgetId: "3565786d5950393437353938", // ✅ Use your actual Widget ID
            tokenAuth: "444743TU4B2wAExI6831cddcP1", // ✅ Use your actual Token Auth
            exposeMethods: true,
            success: function(data) {
                console.log('✅ Success response:', data);

                // ✅ Send token to Laravel route for verification
                fetch("{{ route('verify.msg91.jwt') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                "content")
                        },
                        body: JSON.stringify({
                            token: data.token
                        })
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.status === "success") {
                            window.location.href = response.redirect_url;
                        } else {
                            alert(response.message || "Invalid OTP");
                        }
                    });
            },
            failure: function(error) {
                console.error('❌ Failure reason:', error);
                alert("OTP verification failed.");
            }
        };
    </script>

    <!-- ✅ Step 2: Load the OTP widget script after defining the config -->
    <script src="https://verify.msg91.com/otp-provider.js" onload="initSendOTP(configuration)"></script>

</body>

</html>
