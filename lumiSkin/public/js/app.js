document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".update-quantity");
    inputs.forEach((input) => {
        input.addEventListener("change", function () {
            console.log("Cambio detectado en:", this);
            const form = this.closest("form");
            form.submit();
        });
    });
});
