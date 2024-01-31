<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>ENTER OTP CODE</h4>
                    <br />
                    <label>4 Digit Code Here</label>
                    <input id="otp" placeholder="Code" class="form-control" type="text" />
                    <br />
                    <button onclick="VerifyOtp()" class="btn w-100 float-end bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function VerifyOtp() {
        var email = sessionStorage.getItem('email');
        var otp = document.getElementById("otp").value;
        if (otp.length === 0) {
            errorToast("OTP is required");
        } else {
            showLoader()
            let res = await axios.post('/verify-otp', { otp, email });
            hideLoader();
            if (res.status === 200 && res.data['status'] === 'Success') {
                successToast("OTP verify successfully");
                setTimeout(() => {
                    window.location.href = "/reset-pass";
                }, 1000);
            }
            else {
                errorToast(res.data['message']);
            }
        }
    }
</script>