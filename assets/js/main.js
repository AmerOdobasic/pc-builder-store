// Add an event listener to the document to to execute the function when the DOM is fully loaded.
document.addEventListener("DOMContentLoaded", function () {
    // Select all dropdown elements with class 'option-select' to every dropdown element
    const selectElements = document.querySelectorAll('.option-select');
    // For each dropdown element, update the image, price, and name of the product based on the selected option.
    selectElements.forEach(select => {
        // Add an event listener that fires when the user changes the selected option
        select.addEventListener('change', function () {
            const selectedOption = select.selectedOptions[0];
            // Exit if no option is selected
            if (!selectedOption) {
                return;
            }

            // Get custom data attributes from the selected option
            const newImg = selectedOption.dataset.img;
            const newPrice = selectedOption.dataset.price;
            const newName = selectedOption.dataset.name;

            // Update the image, price, and name of the product if the custom data attributes exist
            if (newImg) {
                    document.getElementById('product-image').src = newImg;
                }
            if (newPrice) {
                document.getElementById('product-price').textContent = parseFloat(newPrice);
            }
            if (newName) {
                document.getElementById('product-name').textContent = newName;
            }
        });
    });
});