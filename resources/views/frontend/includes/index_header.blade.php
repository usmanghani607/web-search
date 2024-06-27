<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<div class="topheader">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="col">
                        <div class="right_btn">
                            <button class="btn">Sign in</button>
                            <button class="btn_red" id="signUpButton">Sign Up</button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>


<!-- Sign Up Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>For Sign Up, please download our Android/iOS mobile app.</p>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const signUpModal = new bootstrap.Modal(document.getElementById('signUpModal'));

        document.getElementById('signUpButton').addEventListener('click', function() {
            signUpModal.show();
        });

    });
</script>

