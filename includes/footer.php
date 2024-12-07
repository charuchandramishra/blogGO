
<div id="loader" style="display: none;">
    <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const loader = document.getElementById("loader");
        const links = document.querySelectorAll("a");

        // Add click event to all links
        links.forEach(link => {
            link.addEventListener("click", function (event) {
                const href = link.getAttribute("href");
                if (href && href !== "#" && !href.startsWith("javascript:")) {
                    loader.style.display = "flex"; // Show loader
                }
            });
        });

        // Ensure loader is hidden after the page loads
        window.addEventListener("load", function () {
            loader.style.display = "none"; // Hide loader
        });
    });
</script>
</body>
</html>
