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

            // Extract custom data attributes (image, price, name) from the selected <option>
            // This basically extracts the attributes from the HTML code in product-detail.php
            const newImg = selectedOption.dataset.image;
            const newPrice = selectedOption.dataset.price;
            const newName = selectedOption.dataset.name;

            // Select the DOM elements that display the product's image, price, and name
            const productImage = document.getElementById('product-image');
            const productPrice = document.getElementById('product-price');
            const productName = document.getElementById('product-name');

            // Check if a new image URL is provided and the product image element exists
            if (newImg && productImage) {
                // Fade out each image for a smooth transition between images
                productImage.style.opacity = 0;

                // After fade out duration, change the src and fade back in
                setTimeout(() => {
                    productImage.src = newImg;
                    productImage.style.opacity = 1;
                }, 250); // Set the transition duration to 250 milliseconds
            }
            // Update the displayed price. Use new price if it is available, or fall back to base price by using the stored price from the php file. Convert string to number with two decimal places.
            if (productPrice) {
                const priceToSet = newPrice ? parseFloat(newPrice).toFixed(2) : parseFloat(productPrice.dataset.basePrice).toFixed(2); 
                productPrice.textContent = priceToSet;
            }

            // Use the same logic as above to update the name of the product.
            if (productName) {
                productName.textContent = newName;
            }

        });
    });

    // For the theme selector
    // We need to grab the theme selector element and the theme names from the HTML back in index.php
    const themeSelector = document.getElementById("theme-selector");

    // Define an object with theme names and their corresponding CSS variables that will be applied to the theme selector
    const themes = {
        default: { "--bg-color": "", "--text-color": "" },
        winter: { "--bg-color": "#f0f8ff", "--text-color": "#1e3a8a" },
        minty: { "--bg-color": "#a8e6cf", "--text-color": "#34495e" },
    };

    // Function to apply the selected theme to the page
    function applyTheme(themeName) {
        // Set the selected theme as the active theme
        const theme = themes[themeName];
        // Check to see if the theme exists, if not, exit
        if (!theme){
            return
        };
        // Set the CSS variables for the page by going through each key-value pair in the theme object and set the CSS property to the value
        Object.entries(theme).forEach(([key, value]) => {
            document.documentElement.style.setProperty(key, value);
        });
    }

    // Make sure to get the saved theme from local storage and apply it to the theme selector in case the user has a saved theme already
    const savedTheme = localStorage.getItem("selectedTheme") || "default";
    applyTheme(savedTheme);

    // A function that checks if the theme selector exists and if it does...
    if (themeSelector) {
        // Set the theme selector value to the saved theme from local storage
        themeSelector.value = savedTheme;
        // Add an event listener to the theme selector that fires when the user changes the selected theme
        themeSelector.addEventListener("change", () => {
            const selectedTheme = themeSelector.value;
            // Make sure that the selected theme gets added to local storage
            localStorage.setItem("selectedTheme", selectedTheme);
            applyTheme(selectedTheme);
        });
    }

    // For the delete button when viewing order details 
    // Grab the status select and delete button elements
    const statusSelect = document.getElementById('statusSelect');
    const deleteBtn = document.getElementById('deleteButton');

    // Function to toggle the visibility of the delete button based on the selected status. 
    // We want the button to show when the status is 'Cancelled'
    // and hide when the status is anything else

    // If the status select or delete button doesn't exist, exit the function
    function toggleDeleteButton() {
        if (!statusSelect || !deleteBtn) {
            return;
        }
        // Check the status select value and show or hide the delete button accordingly
        if (statusSelect.value === 'Cancelled') {
            deleteBtn.classList.add('visible');
        } else {
            deleteBtn.classList.remove('visible');
        }
    }

    // Initial check
    toggleDeleteButton();

    // Listen for changes
    statusSelect.addEventListener('change', toggleDeleteButton);


});