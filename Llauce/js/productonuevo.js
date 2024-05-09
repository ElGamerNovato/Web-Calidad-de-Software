/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


// script.js
document.addEventListener("DOMContentLoaded", function() {
    const steps = document.querySelectorAll(".step");
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            if (index === stepIndex) {
                step.classList.add("active");
            } else {
                step.classList.remove("active");
            }
        });
    }

    document.body.addEventListener("click", function(event) {
        const target = event.target;
        if (target.classList.contains("step__button")) {
            const toStep = parseInt(target.getAttribute("data-to_step"), 10);
            if (toStep >= 1 && toStep <= steps.length) {
                currentStep = toStep - 1;
                showStep(currentStep);
            }
        }
    });
});
