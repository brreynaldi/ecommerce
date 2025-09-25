<!--begin::Javascript-->
<script>
    var hostUrl = "{{ asset('metronic/assets') }}/";
</script>

<!-- Global JS -->
<script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}"></script>

<!-- Vendors -->
<script src="{{ asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<!-- Custom -->
<script src="{{ asset('metronic/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('metronic/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('metronic/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<!--end::Javascript-->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const toggleBtn = document.querySelector("#kt_aside_toggle");

    toggleBtn.addEventListener("click", function() {
        body.classList.toggle("aside-minimize");

        const toggleOn = toggleBtn.querySelector(".toggle-on");
        const toggleOff = toggleBtn.querySelector(".toggle-off");

        if (toggleOn && toggleOff) {
            toggleOn.classList.toggle("d-none");
            toggleOff.classList.toggle("d-none");
        }
    });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const body = document.body;
        const toggleBtn = document.querySelector("#kt_aside_toggle");

        toggleBtn.addEventListener("click", function() {
            body.classList.toggle("aside-minimize");

            // switch icon
            toggleBtn.querySelector(".toggle-on").classList.toggle("d-none");
            toggleBtn.querySelector(".toggle-off").classList.toggle("d-none");
        });
    });
</script>