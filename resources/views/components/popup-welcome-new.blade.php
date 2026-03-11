<!-- Popup -->
<div id="parentPopup"
    style="background-color: rgba(0, 0, 0, 0.801); width: 100vw; height: 100vh; position: fixed; z-index: 10000;">
<div id="imagePopup" class="image-popup">
    <img src="{{ asset('assets/images/new_logo.png') }}" alt="Popup Image" style="z-index: 10005;">
</div>
</div>


<style>
    .image-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(1);
        padding: 20px;
        width: 90%;
        max-width: 500px;
        height: 300px;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        z-index: 10055;
        opacity: 1;
        /* transition: opacity 1s ease, transform 1s ease; */
    }

    .image-popup img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Active state */
    .image-popup.show {
        opacity: 1;
        transform: translate(-50%, -50%) scale(2);
    }

    /* Fade out */
    .image-popup.hide {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.95);
    }

    #parentPopup.hide {
        opacity: 0;
        transform: scale(0);
        display: none;
    }
</style>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const popup = document.getElementById("imagePopup");
        const parentPopup = document.getElementById("parentPopup");

        const today = new Date().toISOString().split("T")[0]; // YYYY-MM-DD
        const lastSeen = localStorage.getItem("homePopupLastSeen");

        // Show only once per day
        /* if (lastSeen == today) {
            parentPopup.classList.add('show');
            popup.classList.add("show");
            localStorage.setItem("homePopupLastSeen", today);

            // Hide after 2 seconds
            setTimeout(() => {
                popup.classList.add("hide");
                parentPopup.classList.add('hide');
                parentPopup.classList.remove('show');

                setTimeout(() => {
                    popup.remove();
                }, 400);
            }, 2000);
        } else {
            popup.remove(); // prevent flash
        } */

        parentPopup.classList.add('show');
        popup.classList.add("show");
        localStorage.setItem("homePopupLastSeen", today);

        // Hide after 2 seconds
        setTimeout(() => {
            popup.classList.add("hide");
            parentPopup.classList.add('hide');
            parentPopup.classList.remove('show');

            setTimeout(() => {
                popup.remove();
            }, 400);
        }, 2000);
    });
</script> --}}

<script>
    $(document).ready(function() {
        $('#parentPopup').hide();
        $('#imagePopup').hide();
        $('#parentPopup').fadeIn(1000);
        $('#imagePopup').pop;
    })
</script>
