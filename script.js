function openSimple() {
    document.body.style.filter = "blur(5vh)";

    // Redirect to simple.html
    window.setTimeout(function() {
        location.href = "simple.html";

    }, 200);
}

function openCustom() {
    document.body.style.filter = "blur(5vh)";

    // Redirect to custom.html
    window.setTimeout(function() {
        location.href = "custom.html";

    }, 200);
}




// 
// Everything for the custom page
// 

density_slider = document.getElementById("density_slider");

// Check if there is a saved value
if (density_slider) {

    // Get all other elements
    density_slider_output = document.getElementById("density_slider_output");
    resize_field_div = document.getElementById("resize_size");

    // Repeat everything every 0.1 seconds
    window.setInterval(function() {

        // 
        // Slider
        // 

        // Get the value from the slider
        var density_value = density_slider.value;

        // Set the value to the output
        density_slider_output.innerHTML = "Every pixel has a 1/" + density_value + " chance of being colored";


        // 
        // Resize radios
        // 

        resize_radio = document.querySelector('input[name="resize_radio"]:checked').value;
        console.log(resize_radio);
        if (resize_radio == "yes") {

            resize_field_div.style.display = "block";
        } else {

            resize_field_div.style.display = "none";
        }
    }, 100);
}