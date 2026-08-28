        </div> <!-- End dash-content -->
    </section> <!-- End dashboard -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const body = document.querySelector("body"),
              modeToggle = body.querySelector(".mode-toggle"),
              sidebar = body.querySelector("nav"),
              sidebarToggle = body.querySelector(".sidebar-toggle");

        let getMode = localStorage.getItem("mode");
        if(getMode && getMode === "dark") {
            body.classList.add("dark");
        }

        let getStatus = localStorage.getItem("status");
        if(getStatus && getStatus === "close") {
            sidebar.classList.add("close");
        }

        if (modeToggle) {
            modeToggle.addEventListener("click", () => {
                body.classList.toggle("dark");
                if(body.classList.contains("dark")) {
                    localStorage.setItem("mode", "dark");
                } else {
                    localStorage.setItem("mode", "light");
                }
            });
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener("click", () => {
                sidebar.classList.toggle("close");
                if(sidebar.classList.contains("close")) {
                    localStorage.setItem("status", "close");
                } else {
                    localStorage.setItem("status", "open");
                }
            });
        }
    });
    </script>
</body>
</html>