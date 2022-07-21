// Toggle hiding the options on each card if 3 verticle dot icon is clicked

// Dots are the 3 verticle dots svg
let dots = document.querySelectorAll('.dots-icon');
// Loop through each found dot svg, and add a click event to them
dots.forEach((dot) => {
    dot.addEventListener('click' , (event) => {
        // parent_container contains the parent element titled "card-body"
        parent_container = event.target.parentElement.parentElement.parentElement;
        // Selects the children within the "card-body" parent, that are buttons with svg images
        let option_buttons = parent_container.querySelectorAll('button');
        // Loop through each image and toggle the class name to hide or show them
        option_buttons.forEach((icon) =>  {
            icon.classList.toggle('hide');
        });
})});
